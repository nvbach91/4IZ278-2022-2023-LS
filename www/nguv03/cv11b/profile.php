<?php require __DIR__ . '/vendor/autoload.php' ?>

<?php 

use \Facebook\Facebook;

session_start();

if (!isset($_SESSION['fb_access_token'])) {
    header('Location: index.php');
    exit;
}

$accessToken = $_SESSION['fb_access_token'];


$fb = new Facebook([
    'app_id' => '7702675183075984',
    'app_secret' => '6cf2bf121fb5a5660fe9282bf783a7bc',
    'default_graph_version' => 'v2.10',
    'default_access_token' => $accessToken,
]);


$user = $fb->get('/me')->getGraphUser();

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
    <h1>Hello <?php echo $user->getName(); ?></h1>
</body>
</html>