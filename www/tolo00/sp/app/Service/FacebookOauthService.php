<?php

namespace App\Service;

use App\Model\Entity\UserAccount;
use App\Model\UserAccountModel;
use Nette\Security\SimpleIdentity;
use Nette\Security\User;
use Nette\Utils\Image;
use Nette\Utils\Random;

class FacebookOauthService
{

    private User $user;

    private UserAccountModel $userAccountModel;

    public function __construct(User $user, UserAccountModel $userAccountModel)
    {
        $this->user = $user;
        $this->userAccountModel = $userAccountModel;
    }

    //////////////////////////////////////////////////////// Public

    public static function getProvider()
    {
        static $provider;

        if ($provider) {
            return $provider;
        }

        return $provider = new \League\OAuth2\Client\Provider\Facebook([
            'clientId'          => '1361239341381320',
            'clientSecret'      => '05bc0014b0069aea3b04aa38f976c987',
            'redirectUri'       => 'https://js-semestralka.incolorstudio.cz/home/log-in',
            'graphApiVersion'   => 'v2.10',
        ]);
    }

    public static function getLoginUrl(): string
    {
        $provider = self::getProvider();

        return $provider->getAuthorizationUrl([
            'scope' => ['email'],
        ]);
    }

    public function processLogin(?string $code, ?string $state): bool
    {
        $provider = self::getProvider();

        if (!$code || !$state) {
            $this->user->logout(true);
            return false;
        }

        $token = $provider->getAccessToken('authorization_code', [
            'code' => $_GET['code']
        ]);

        try {
            $facebookUser = $provider->getResourceOwner($token);

            if (!$userAccount = $this->userAccountModel->findOneBy(['password' => $facebookUser->getId()])) {
                $imageName = Random::generate(20) . '.jpg';

                Image::fromFile($facebookUser->getPictureUrl())
                    ->save(__DIR__ . '/../../www/img/profile/' . $imageName, null, Image::JPEG);

                $userAccount = new UserAccount;
                $userAccount->username = $facebookUser->getFirstName() . ' ' . $facebookUser->getLastName();
                $userAccount->email = $facebookUser->getEmail();
                $userAccount->password = $facebookUser->getId();
                $userAccount->role = UserAccount::ROLE_USER;
                $userAccount->profilePhoto = $imageName;

                $this->userAccountModel->save($userAccount);
            }

            $identity = new SimpleIdentity(
                $userAccount->getId(),
                $userAccount->role,
                ['username' => $userAccount->username]
            );

            $this->user->login($identity);
        } catch (\Exception $e) {
            $this->user->logout(true);
            return false;
        }

        return true;
    }

}
