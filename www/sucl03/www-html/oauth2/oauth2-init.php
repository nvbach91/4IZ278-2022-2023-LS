<?php
// crossmile @ LXSX file:www-html/oauth2/oauth2-init.php

$_SESSION['oauth2_state'] = (!empty($_oauth2_state_salt) ? $_oauth2_state_salt : '') . genRandomString(32);
// SK Míle OAuth2 init
require_once(__DIR__ . '/oauth2-init-skmile.php');
// Google OAuth2 init
require_once(__DIR__ . '/oauth2-init-google.php');
// Github OAuth2 init
require_once(__DIR__ . '/oauth2-init-github.php');
?>