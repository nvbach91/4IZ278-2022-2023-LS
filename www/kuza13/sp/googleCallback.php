<?php
require_once 'index.php';
require_once './vendor/autoload.php';
require_once 'googleLogin.php';

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $accessToken = $token['access_token'];

    $oauthService = new Google\Service\Oauth2($client);
    $userInfo = $oauthService->userinfo->get();
    $email = $userInfo->getEmail();

    $peopleService = new Google\Service\PeopleService($client);
    $personFields = 'names';
    $person = $peopleService->people->get('people/me', ['personFields' => $personFields]);

    $userId = rand(100, 300);
    $name = $person->getNames()[0]->getDisplayName();
    $givenName = $person->getNames()[0]->getGivenName();
    $familyName = $person->getNames()[0]->getFamilyName();
    // $phone = $person->getPhoneNumbers()[0]->getValue();
    // $addresses = $person->getAddresses();
    if (!empty($addresses)) {
        $postalCode = $addresses[0]->getPostalCode();
        $address = $addresses[0]->getFormattedValue();
    } else {
        $postalCode = '';
        $address = '';
    }
    $_SESSION['user'] = [
        "user_id" => $checkedUser['user_id'],
        "email" => $email,
        "name" => $givenName,
        "surname" => $familyName,
        "phone" => $phone,
        "adress" => $address,
        "postalCode" => $postalCode,
    ];
    $_SESSION['message'] = 'Login successful!';
    header("Location: cart.php");
    exit();
}
?>