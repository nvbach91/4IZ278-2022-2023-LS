<?php include "./components/base/head.php"; ?>

<?php
    if ($authUser) {
        header('Location: index.php');
        exit();
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        try {
            require_once "./classes/UsersDB.php";

            $usersDatabase = new UsersDB;
            $user = $usersDatabase->fetchByEmail($_POST['email']);

            if (!$user)
                throw new Exception(sprintf("User with email %s doesn't exist", $_POST['email']));
    
            if (!password_verify($_POST['password'], $user['password']))
                throw new Exception(sprintf("Credentials are incorrect."));
    
            setcookie('email', $user['email'], time() + 3600);
            header('Location: index.php');
            exit();
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
        }
    }
?>

<main class="container">
    <?php include "./components/login-form.php"; ?>
</main>

<?php include "./components/base/foot.php"; ?>