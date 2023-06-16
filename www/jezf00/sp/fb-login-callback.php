<?php
session_start();

require_once __DIR__ . '/vendor/autoload.php';
require_once 'fbconfig.php';
require_once 'dbconfig.php';
require_once 'auth.php';

$pdo = new PDO(
    'mysql:host=' . DB_HOST .
    ';dbname=' . DB_NAME .
    ';charset=utf8mb4',
    DB_USERNAME,
    DB_PASSWORD
);

$fb = new \JanuSoftware\Facebook\Facebook([
    'app_id' => APP_ID,
    'app_secret' => APP_SECRET,
    'default_graph_version' => 'v2.10',
]);

$helper = $fb->getRedirectLoginHelper();

try {
    $accessToken = $helper->getAccessToken();
} catch (\JanuSoftware\Facebook\Exception\ResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch (\JanuSoftware\Facebook\Exception\SDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

if (!isset($accessToken)) {
    header('Location: index.php');
    exit;
}

$_SESSION['fb_access_token'] = (string) $accessToken;


try {
    $response = $fb->get('/me?fields=email,name', $accessToken);
    $user = $response->getGraphNode();
    $email = $user->getField('email');
    $name = $user->getField('name');


    $_SESSION['user']['email'] = $email;
    $_SESSION['user']['name'] = $name;
    $_SESSION['user']['privilege'] = 1;


    $statement = $pdo->prepare("SELECT * FROM sp_users WHERE email = :email");
    $statement->bindParam(':email', $email);
    $statement->execute();
    $existingUser = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$existingUser) {

        $insertStatement = $pdo->prepare("INSERT INTO sp_users (name, email, password, adress, state, postalCode, privilege) VALUES (:name, :email, 'Fill this data', 'Fill this data', 'Fill this data', 123, 1)");
        $insertStatement->bindParam(':name', $name);
        $insertStatement->bindParam(':email', $email);
        $insertStatement->execute();
    }


    header('Location: ./user/profile.php');
    exit;
} catch (\JanuSoftware\Facebook\Exception\ResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch (\JanuSoftware\Facebook\Exception\SDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}
