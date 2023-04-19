<?php

if (!empty($_POST)) {
    $username = $_POST['username'];

    session_start();
    setcookie('username', $username, time() + 3600);
    header('Location: ./index.php');
    exit;
}

?>

<?php require __DIR__ . '/header.php'; ?>

<body class="container">
    <?php require __DIR__ . '/navbar.php'; ?>
    <h3 class="mb-4">Login</h3>
    <form action="./login.php" method="POST">
        <input placeholder="Enter username" name="username">
        <button>Log in</button>
    </form>
</body>

<?php require __DIR__ . '/footer.php'; ?>