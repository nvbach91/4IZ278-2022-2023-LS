<?php

// http://localhost/4IZ278-2022-2023-LS/www/nguv03/cv12b/facebook-login-callback.php?
    // code=AQD7UdJMKG2sgrfeBh_Nqkd7FVwsSmbT2nAKaKd1rknuJbEdlKsvwrkOaW_BuTbvEBFZchXyvjJBbclpTenRgCx4pSizxiTt9oFIHDCgTSVXIZrDho5AJWbiowhQMJp9n-qm4FIclILoO2HPgGk_TT1xrMTncA4lRWiLez32C0vbCgfi2mJs0LMJ-TCsRz14EUala6fQhh1o0Pcoy3Wwb-xMJSeOufO6eqlOqyfMFfIpAsgal6KhgqF5dkODGMmB9gkgcoprSRmt-xIxFSyvkH6KpCGd7K3gQtMUca0JTo0xdk75WQpP4hYBjaYvFg-EeYFZZZBb0jUkfu0td-2peMFt9PzeL6vgSSLD9sSbfaBnhUC1Z27R891_rSicx1b_F7ogyxj7acamsa_RRzxvh8x7
    // &state=3b22379d787513767600a1853e9292a9c74a8bafc08f8b8adfb109ecee5ef9ed#_=_


require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . './facebook-config.php';
if (!empty($_GET)) {

    $initCode = $_GET['code'];
    $state = $_GET['state'];

    $facebook = new \JanuSoftware\Facebook\Facebook(
        FACEBOOK_CONFIG
    );
    $helper = $facebook->getRedirectLoginHelper();
    $helper->getPersistentDataHandler()->set('state', $state);

    $accessToken = $helper->getAccessToken();

    session_start();
    $_SESSION['access_token'] = $accessToken->getValue();

    header('Location: home.php');
    exit();

}



?>