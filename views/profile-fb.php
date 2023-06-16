<?php

require_once '../vendor/autoload.php';

require '../config/fb-config.php';

session_start();

var_dump($_SESSION);

if (!isset($_SESSION['fb_access_token'])) {
    header('Location: main.php');
    exit();
}

$fb = new \JanuSoftware\Facebook\Facebook(
    array_merge(CONFIG_FACEBOOK, ['default_access_token' => $_SESSION['fb_access_token']])
);

$user = $fb->get('/me')->getGraphNode();

var_dump($user);

$picture = $fb->get('/me/picture?redirect=false&height=200')->getGraphNode();

var_dump($picture);

$helper = $fb->getRedirectLoginHelper();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1><?php echo $user ?></h1>
    <img src="<?php echo $picture ?>" alt="">
</body>

</html>