<?php

declare(strict_types=1);

namespace App\Model;

use App\Model\Service\PermissionService;
use App\Model\Service\UserService;
use Exception;
use JanuSoftware\Facebook\Exception\ResponseException;
use JanuSoftware\Facebook\Exception\SDKException;
use JanuSoftware\Facebook\Facebook;
use Nette\Security\AuthenticationException;
use Nette\Security\SimpleIdentity;
use Nette\Utils\ArrayHash;

require_once __DIR__ . '/../../config/facebookAuth.php';


/**
 * Authenticator service
 *
 * Service which handles user authentication and authorization.
 */
final class FacebookAuthenticator {

	private PermissionService $permissionService;
	private UserService $userService;

	public function __construct(PermissionService $permissionService, UserService $userService) {

		$this->permissionService = $permissionService;
		$this->userService = $userService;

	}

	/**
	 * @throws Exception
	 */
	public function facebookLogin(?string $backlink = null): void {

		try {

			$fb = new Facebook([
				'app_id' => FACEBOOK_APP_ID,
				'app_secret' => FACEBOOK_APP_SECRET,
				'default_graph_version' => FACEBOOK_GRAPH_VERSION,
			]);

		} catch (SDKException $e) {

			throw new Exception('Přihlášení pomocí Facebooku selhalo. Opakujte akci později.');

		}

		$helper = $fb->getRedirectLoginHelper();
		$loginUrl = $helper->getLoginUrl(FACEBOOK_CALLBACK_URL, FACEBOOK_REQUIRED_CLAIMS);

		header('Location: ' . $loginUrl);
		exit;

	}

	/**
	 * Function which authenticates user and assign permissions to the user.
	 *
	 * @return SimpleIdentity               Nette simple identity containing authentication information.
	 * @throws Exception
	 */
	public function facebookLoginCallback(): SimpleIdentity {

		try {

			$fb = new Facebook([
				'app_id' => FACEBOOK_APP_ID,
				'app_secret' => FACEBOOK_APP_SECRET,
				'default_graph_version' => FACEBOOK_GRAPH_VERSION,
			]);

		} catch (SDKException $e) {

			throw new Exception('Přihlášení pomocí Facebooku selhalo. Opakujte akci později.');

		}

		$helper = $fb->getRedirectLoginHelper();
		$helper->getPersistentDataHandler()->set('state', $_GET['state']);

		try {

			$accessToken = $helper->getAccessToken();

		} catch (SDKException $e) {

			throw new Exception('Přihlášení pomocí Facebooku selhalo. Nepovedlo se získat Access token uživatele. Opakujte akci později.');

		}

		if (!isset($accessToken)) {

			throw new Exception('Přihlášení pomocí Facebooku selhalo. Access token neexistuje. Opakujte akci později.');

		}

		try {

			$fbUser = $fb->get('/me?fields=email,first_name,last_name', $accessToken)->getDecodedBody();

		} catch (ResponseException|SDKException $e) {

			throw new Exception('Přihlášení pomocí Facebooku selhalo. Nepovedlo se získat informace o uživateli. Opakujte akci později.');

		}

		$userById = $this->userService->getUserBy('id_facebook', $fbUser['id']);
		$userByMail = $this->userService->getUserBy('mail', $fbUser['email']);

		if ($userById === null && $userByMail === null) {

			$newUserId = $this->userService->newUser(ArrayHash::from($fbUser), true, 'facebook');
			$user = $this->userService->getUserById($newUserId);
			$this->permissionService->newUserPermission(ArrayHash::from(['id_user' => $user->id_user, 'permission' => 'customer']));

		} elseif ($userById === null && $userByMail !== null) {

			$this->userService->updateUserOAuthInfo(ArrayHash::from($fbUser), 'facebook');
			$user = $this->userService->getUserBy('id_facebook', $fbUser['id']);

		} else {

			$user = $userById;

		}

		if ($user->blocked) {

			throw new AuthenticationException('Váš účet je zablokován! Kontaktujte prosím administrátora.');

		}

		$userPerms = $this->permissionService->getUserAuthPermissions($user->id_user);

		return new SimpleIdentity($user->id_user, $userPerms, [
			'username' => $user->username,
			'display_name' => $user->display_name,
			'employee' => $user->employee,
			'mail' => $user->mail
		]);

	}

}