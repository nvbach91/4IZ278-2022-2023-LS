<?php require __DIR__ . '/vendor/autoload.php' ?>

<?php 


use \Facebook\Facebook;

$fb = new Facebook([
    'app_id' => '7702675183075984',
    'app_secret' => '6cf2bf121fb5a5660fe9282bf783a7bc',
    'default-graph_version' => 'v2.10',
]);

$helper = $fb->getRedirectLoginHelper();
$permissions = ['email'];
$loginUrl = $helper->getLoginUrl('http://localhost/4IZ278-2022-2023-LS/cv11b/fb-login-callback.php', $permissions);



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
    <h1>Login with Facebook</h1>
    <a href="<?php echo $loginUrl; ?>">Log in</a>
</body>
</html>