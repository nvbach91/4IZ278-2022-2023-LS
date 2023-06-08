<?php

$googleClientID = '947648263897-34j401h4qd2svmltf2rh0m1a73lanns0.apps.googleusercontent.com';
$googleClientSecret = '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';

$authorizeURL = 'https://accounts.google.com/o/oauth2/v2/auth';
$tokenURL = 'https://www.googleapis.com/oauth2/v4/token';

$baseURL = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'];

@session_start();

if (isset($_GET['action']) && $_GET['action'] == 'login') {
    unset($_SESSION['email']);

    $_SESSION['state'] = bin2hex(random_bytes(16));

    $params = array(
        'response_type' => 'code',
        'client_id' => $googleClientID,
        'redirect_uri' => $baseURL,
        'scope' => 'openid email',
        'state' => $_SESSION['state'],
    );

    header('Location: '.$authorizeURL.'?'.http_build_query($params));
    die();
}

if (isset($_GET['code'])) {
    if (!isset($_GET['state']) || $_SESSION['state'] != $_GET['state']) {
        header('Location: ' . $baseURL . '?error=invalid_state');
        die();
    }

    $ch = curl_init($tokenURL);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
        'grant_type' => 'authorization_code',
        'client_id' => $googleClientID,
        'client_secret' => $googleClientSecret,
        'redirect_uri' => $baseURL,
        'code' => $_GET['code']
    ]));

    $response = curl_exec($ch);
    $data = json_decode($response, true);

    $jwt = explode('.', $data['id_token']);

    $userinfo = json_decode(base64_decode($jwt[1]), true);

    $_SESSION['user_email'] = $userinfo['email'];
    $_SESSION['account_level'] = 1;

    $_SESSION['access_token'] = $data['access_token'];
    $_SESSION['id_token'] = $data['id_token'];
    $_SESSION['userinfo'] = $userinfo;

    header('Location: home.php');
    die();
}