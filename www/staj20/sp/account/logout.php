<?php
session_start();
require_once __DIR__ . '/../assets/php/core.php';

$account = new Account();
$account->logout();
if(!isset($_SESSION['gtoken'])){
    session_destroy();
  header('Location: login.php');
  exit;
}

require_once( __DIR__ . '/../assets/config/google.php');
$client = new Google\Client();
$client->setAccessToken($_SESSION['gtoken']);
# Revoking the google access token
$client->revokeToken();

# Deleting the session that we stored
$_SESSION = array();

if (ini_get("session.use_cookies")) {
  $params = session_get_cookie_params();
  setcookie(session_name(), '', time() - 42000,
      $params["path"], $params["domain"],
      $params["secure"], $params["httponly"]
  );
}

session_destroy();
header("Location: login.php");
exit;
