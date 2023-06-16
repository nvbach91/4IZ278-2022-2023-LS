<?php
session_start();
include_once("by_detection.php");

// Fill these out with the values you got from Google
$googleClientID = '800302830377-10sh0jf0iou8fnnf0jhigbbenla7qaom.apps.googleusercontent.com';
$googleClientSecret = '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';

// This is the URL we'll send the user to first to get their authorization
$authorizeURL = 'https://accounts.google.com/o/oauth2/v2/auth';

// This is Google's OpenID Connect token endpoint
$tokenURL = 'https://www.googleapis.com/oauth2/v4/token';

// The URL for this script, used as the redirect URL
$baseURL = 'https://david.pohena.com/main_login.php';

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
  unset($_SESSION['user_id']);
  header('Location: '.$baseURL);
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
$err = false;
if (isset($_POST['submit'])) {
    include_once("by_database.php");
    $data = $conn->prepare("SELECT `password`, `privileges`, `mail`, `primary`,`secondary`, `forename`, `surname`, `gender`, `confirmed`, `wallet`, `ID`, `paypal_date`, `banned`, `birth_date` FROM `_dmp_users` WHERE `username` = ?");
    $data->execute([$_POST['username']]);
    $user = $data->fetch();
    if ($user['banned'] != '1') {
        if (password_verify($_POST['password'], $user['password'])) {
            $_SESSION['user'] = $_POST['username'];
            $_SESSION["privilege"] = $user['privileges'];
            $_SESSION["mail"] = $user['mail'];
            $_SESSION["primary"] = $user["primary"];
            $_SESSION["secondary"] = $user["secondary"];
            $_SESSION["forename"] = $user["forename"];
            $_SESSION["surname"] = $user["surname"];
            $_SESSION["gender"] = $user["gender"];
            $_SESSION["confirmed"] = $user["confirmed"];
            $_SESSION["wallet"] = $user["wallet"];
            $_SESSION["iduser"] = $user["ID"];
            $_SESSION["birth_date"] = $user["birth_date"];
            $_SESSION["paypal_date"] = $user["paypal_date"];
            header('Location: main_news.php');
            exit();
        } else {
            $err = true;
        }
    }

    if ($user['banned'] == '1') {
        $banned = true;
    }
}

if(isset($_SESSION['user_id'])){
     header('Location:https://david.pohena.com/main_news.php');
    
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>DwGym - login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login.css">
    <link rel="icon" href="icon/favicon.ico" type="image/x-icon" />
</head>

<body style="overflow:hidden;">
    <main>
        <div class="row">
            <?php include('by_pages_LogSign.html'); ?>
            <div class="col">
                <div class="rightside">
                    <div class="login">
                        <div class="form-body">
                            <h1 class="title">Log in</h1>
                            <form method="post" class="the-form" autocomplete="off">
                                <label for="text">Username</label>
                                <input type="text" name="username" id="username" placeholder="Enter your username...">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" placeholder="Enter your password...">
                                <input type="submit" name="submit" value="Log in" class="submit">
                                <?php if ($err == true) {
                                     ?>
                                    <h5>Invalid username or password.</h5>
                                     <?php

                                }
                                if ($banned == true) {
                                                                         ?>
                                    <h5>Your account has been banned.</h5>
                                     <?php
                                }
                                ?>
                                <div class="form-footer">
                                    <div class="register">
                                        <span>Don't have an account?</span> <a href="main_signin.php">Sign Up</a>
                                    </div>
                                </div>
                            </form>
                            <?php
                            if (!isset($_GET['action']) && empty($_SESSION['user_id'])) {
                                ?>
                                <button class="google" onclick="window.location.href='?action=login'">Log In with Google</button>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>