<?php
require_once 'config.php';
$googleClientID = '659051027523-3ifue4bvv8rhgeo632fuqihd05otjgo3.apps.googleusercontent.com';
$googleClientSecret = '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';
 
// This is the URL we'll send the user to first to get their authorization
$authorizeURL = 'https://accounts.google.com/o/oauth2/v2/auth';

// This is Google's OpenID Connect token endpoint
$tokenURL = 'https://www.googleapis.com/oauth2/v4/token';

// The URL for this script, used as the redirect URL
$baseURL = 'https://' . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'];

// Start a session so we have a place to store things between redirects
session_start();



// Start the login process by sending the user
// to Google's authorization page
if(isset($_GET['action']) && $_GET['action'] == 'login') {
  unset($_SESSION['user_id']);

  // Generate a random hash and store in the session
  $_SESSION['state'] = bin2hex(random_bytes(16));

  $params = array(
    'response_type' => 'code',
    'client_id' => $googleClientID,
    'redirect_uri' => $baseURL,
    'scope' => 'openid email',
    'state' => $_SESSION['state']
  );

  // Redirect the user to Google's authorization page
  header('Location: ' . $authorizeURL . '?' . http_build_query($params));
  die();
}

if(isset($_GET['action']) && $_GET['action'] == 'logout') {
    $_SESSION = array();
    session_destroy();
    
    header('Location: index.php');
  die();
}

// When Google redirects the user back here, there will be a "code" and "state"
// parameter in the query string
if(isset($_GET['code'])) {
  // Verify the state matches our stored state
  if(!isset($_GET['state']) || $_SESSION['state'] != $_GET['state']) {
    header('Location: ' . $baseURL . '?error=invalid_state');
    die();
  }

  // Exchange the auth code for a token
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

  // Note: You'd probably want to use a real JWT library
  // but this will do in a pinch. This is only safe to do
  // because the ID token came from the https connection
  // from Google rather than an untrusted browser redirect

  // Split the JWT string into three parts
  $jwt = explode('.', $data['id_token']);

  // Extract the middle part, base64 decode it, then json_decode it
  $userinfo = json_decode(base64_decode($jwt[1]), true);

  $_SESSION['user_id'] = $userinfo['sub'];
  $_SESSION['email'] = $userinfo['email'];

  // While we're at it, let's store the access token and id token
  // so we can use them later
  $_SESSION['access_token'] = $data['access_token'];
  $_SESSION['id_token'] = $data['id_token'];
  $_SESSION['userinfo'] = $userinfo;

  header('Location: ' . $baseURL);
  die();
}



// If there is a user ID in the session
// the user is already logged in
if(!isset($_GET['action'])) {
  if(!empty($_SESSION['user_id'])) {


    
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$_SESSION['email']]);
        $existingId = $stmt->fetchColumn();
        if ($existingId) {
            $_SESSION['user_id'] = $existingId;
            header('Location: index.php');
            exit();
        } else {
            try {
                $hashedGoogleId = password_hash($_SESSION['user_id'], PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, address, city, zip, email, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute(['', '', '', '', '', $_SESSION['email'], $hashedGoogleId]);
                $userId = $pdo->lastInsertId();
                $_SESSION['user_id'] = $userId;
        
                header('Location: index.php');
                exit();
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    } else {
        echo '<h3>Not logged in</h3>';
        echo '<p><a href="?action=login">Log In</a></p>';
    }
    die();
}
