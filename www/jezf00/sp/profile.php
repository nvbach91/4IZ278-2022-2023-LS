<?php

session_start();
require_once 'auth.php';
requireLogin();

if (!isset($_COOKIE['user'])) {
    header('Location: ./login.php');
    exit;
}

$username = $_COOKIE['user'];



?>

<?php require __DIR__ . '/header.php'; ?>

<body class="container">
    <?php require __DIR__ . '/navbar.php'; ?>
    <h1>You are logged in!</h1>
    <p>Username: <?php echo $username; ?></p>
    <a href="./logout.php">Log out</a>
</body>
<?php require __DIR__ . '/footer.php'; ?>