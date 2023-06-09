<?php

use function Safe\file_get_contents;

ob_start();
session_start();
require_once './vendor/autoload.php';

// přesměrování uživatele na autorizační stránku GitHubu
function goToAuthUrl()
{
    $client_id = '';
    $redirect_uri = '';
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $url = 'https://github.com/login/oauth/authorize?client_id=' . $client_id . '&redirect_uri=' . urlencode($redirect_uri) .
            '&scope=user';
        header('location: ' . $url);
        exit;
    }
}

//přístupový token a údaje o uživateli
function fetchData()
{
    $client_id = '';
    $redirect_url = '';
    var_dump($_SERVER['REQUEST_METHOD']);
    var_dump($_GET['code']);

    // zda byl požadavek proveden metodou GET a zda obsahuje parametr code (autorizační kód) v dotazu.
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['code'])) {
        $code = filter_var($_GET['code'], FILTER_SANITIZE_STRING);

        //řetězec dotazu s parametry, který bude odeslán na GitHub server pro získání přístupového tokenu.
        $post = http_build_query(array(
            'client_id' => $client_id,
            'redirect_uri' => $redirect_url,
            'client_secret' => '',
            'code' => $code,
        ));

        try {
            $access_data = file_get_contents("https://github.com/login/oauth/access_token?" . $post);
            $exploded1 = explode('access_token=', $access_data);
            $exploded2 = isset($exploded1[1]) ? explode('&scope=user', $exploded1[1]) : [];
            $access_token = isset($exploded2[0]) ? $exploded2[0] : '';

            $access_token = $exploded2[0];

            //nastavení volby pro odesílání dalších požadavků na GitHub API
            $opts = [
                'http' => [
                    'method' => 'GET',
                    'header' => [
                        'Authorization: Bearer ' . $access_token,
                        'User-Agent: PHP'
                    ]
                ]
            ];

            $url = "https://api.github.com/user";
            $context = stream_context_create($opts);

            //GET požadavek na URL, aby získal informace o uživateli.
            $data = file_get_contents($url, false, $context);

            //dekóduje řetězec JSON v proměnné $data a převádí ho na asociativní pole
            $user_data = json_decode($data, true);
            $username = $user_data['login'];


            $url1 = "https://api.github.com/user/emails";
            $context1 = stream_context_create($opts);
            $emails = file_get_contents($url1, false, $context1);
            $emails = json_decode($emails, true);
            $email = $emails[0]['email'];

            $userPayload = [
                'username' => $username,
                'email' => $email,
                'fetched from' => 'github'
            ];

            $_SESSION['payload'] = $userPayload;
            $_SESSION['user'] = $username;
            if (!isset($_SESSION['user_id'])) {
                $_SESSION['user_id'] = mt_rand(1000, 9999);
            }

            return $userPayload;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    } else {
        die('CHYBA');
    }
}
