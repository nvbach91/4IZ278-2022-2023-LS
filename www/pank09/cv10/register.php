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
            $usersDatabase->create([
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'password' => $_POST['password']
            ]);

            header('Location: login.php');
            exit();
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
        }
    }
?>

<main class="container">
    <?php include "./components/register-form.php"; ?>
</main>

<?php include "./components/base/foot.php"; ?>