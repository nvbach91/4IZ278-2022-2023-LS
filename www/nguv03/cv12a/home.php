<?php

require_once __DIR__ . '/vendor/autoload.php';

const CONFIG_FACEBOOK = [
    'app_id' => '',
    'app_secret' => '',
    'default_graph_version' => 'v2.10',

];

session_start();

var_dump($_SESSION);

if (!isset($_SESSION['facebook_access_token'])) {
    header('Location: index.php');
    exit();
}

$facebook = new \JanuSoftware\Facebook\Facebook(
    array_merge(
        CONFIG_FACEBOOK,
        ['default_access_token' => $_SESSION['facebook_access_token']]
    )
);

$user = $facebook->get('/me')->getGraphNode();

var_dump($user);


$picture = $facebook->get('/me/picture?redirect=false&height=200')->getGraphNode();

var_dump($picture);

// $helper = $facebook->getRedirectLoginHelper();


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
    <h1><?php echo $user->getField('name'); ?></h1>
    <img alt="my-picture" src="<?php echo $picture->getField('url'); ?>">
</body>
</html>