<?php 
require_once 'index.php';

$client = new Google_Client();
$oauthService = new Google\Service\Oauth2($client);

$client->setClientId('77564097927-b9mm26eveb3p5f4t99gmc4ibjd51vpcb.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('https://esotemp.vse.cz/~kuza13/sp/googleLogin.php');

$client->addScope('email');
$client->addScope('profile');

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $accessToken = $token['access_token'];

    $oauthService = new Google\Service\Oauth2($client);
    $userInfo = $oauthService->userinfo->get();
    $email = $userInfo->getEmail();
    $name = $userInfo->getName();

    $_SESSION['user'] = [
        "email" => $email,
        "name" => $name,
    ];

    $_SESSION['message'] = 'Login successful!';
    header("Location: cart.php");
    exit();
}

$authUrl = $client->createAuthUrl();
header("Location: $authUrl");
exit();
?>


