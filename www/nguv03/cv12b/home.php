<?php

session_start();
if (!isset($_SESSION['access_token'])) {
    header('Location: index.php');
    exit();
}

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . './facebook-config.php';

$facebook = new \JanuSoftware\Facebook\Facebook(
    array_merge(
        FACEBOOK_CONFIG,
        ['default_access_token' => $_SESSION['access_token']]
    )
);

$user = $facebook->get('/me')->getGraphNode();
var_dump($user);
$picture = $facebook->get('/me/picture?redirect=false&height=200')->getGraphNode();
var_dump($picture);


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
    <h1>Welcome <?php echo $user->getField('name') ;?></h1>
    <img alt="profile-picture" src="<?php echo $picture->getField('url') ?>">
</body>
</html>