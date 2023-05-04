<?php
error_reporting(E_ERROR | E_PARSE);
session_start();

require_once __DIR__ . '/vendor/autoload.php';

if (!isset($_SESSION['fb_access_token'])) {
    header('Location: index.php');
    exit;
}

require_once 'fbconfig.php';

$fb = new Facebook\Facebook([
    'app_id' => APP_ID,
    'app_secret' => APP_SECRET,
    'default_graph_version' => 'v2.10',
]);

try {
    $response = $fb->get('/me?fields=id,name,email', $_SESSION['fb_access_token']);
} catch (Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch (Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

$user = $response->getGraphUser();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://bootswatch.com/4/journal/bootstrap.min.css">
    <title>User Profile</title>
</head>


<body class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-2">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="./">Best-eshop</a>
        </div>
    </nav>
    <div class="card">
        <div class="card-body">
            <h1>User Profile</h1>
            <p>ID: <?php echo $user['id']; ?></p>
            <p>Name: <?php echo $user['name']; ?></p>
            <p>Email: <?php echo $user['email']; ?></p>
            <a href="logout.php">Logout</a>
        </div>
    </div>
</body>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<!-- Popper.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<!-- Bootstrap 4.3.0 JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js"></script>

</html>