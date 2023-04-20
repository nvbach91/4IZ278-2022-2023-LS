<?php

if (!empty($_POST)) {
    $user = $_POST['user'];

    setcookie('user', $user, time() + 3600);
    header('Location: ./index.php');
    exit;
}

?>

<?php require "header.php"?>

<body>
    <h3>Login</h3>
    <form action="login.php" method="POST">
        <input placeholder="username" name="user">
        <button>Log in</button>
    </form>
</body>

<?php require "footer.php"?>