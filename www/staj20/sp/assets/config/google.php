<?php
require( __DIR__ . '/../../vendor/autoload.php');

# Add your client ID and Secret
$client_id = "REDACTED";
$client_secret = "REDACTED";

$client = new Google\Client();
$client->setClientId($client_id);
$client->setClientSecret($client_secret);

# change this
$redirect_uri = 'http://localhost/account/login.php';
$client->setRedirectUri($redirect_uri);
$client->addScope("email");
$client->addScope("profile");
?>
