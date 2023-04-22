<?php
    if (isset($_COOKIE['name']) || $_SERVER["REQUEST_METHOD"] == "POST") {
        setcookie("name", $_POST['name'], time() + 3600);
        header('Location: index.php');
        exit();
    }
?>

<?php include "./components/base/head.php"; ?>

<main class="container">
    <?php include "./components/login-form.php"; ?>
</main>

<?php include "./components/base/foot.php"; ?>