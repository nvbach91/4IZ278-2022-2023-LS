<?php

require 'github-config.php';

$client_id = '';
$redirect_uri = 'http://localhost/bookStore/github-callback.php';
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $url = 'https://github.com/login/oauth/authorize?client_id=' . $client_id . '&redirect_uri=' . urlencode($redirect_uri) .
        '&scope=user';
}
var_dump(goToAuthUrl());
goToAuthUrl();

echo "operation failed";
