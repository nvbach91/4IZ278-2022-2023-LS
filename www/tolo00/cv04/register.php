<?php

require_once __DIR__ . '/functions.php';

$formSubmited = !empty($_POST);
$validationErrors = [];

if ($formSubmited) {
    if (empty($_POST['full_name'])) {
        $validationErrors[] = 'Please enter your full name.';
    }

    if (empty($_POST['email'])) {
        $validationErrors[] = 'Please enter your email.';
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $validationErrors[] = 'Please enter a valid email.';
    }

    if (empty($_POST['password']) || empty($_POST['password_confirm'])) {
        $validationErrors[] = 'Please enter your password.';
    } elseif ($_POST['password'] !== $_POST['password_confirm']) {
        $validationErrors[] = 'Entered passwords do not match.';
    }
}

if ($formSubmited && !$validationErrors) {
    $fullName = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (fetchUser($email)) {
        $validationErrors[] = "This email (\"{$email}\") is already registered, please use a different one.";
    } else {
        registerNewUser($email, $password, $fullName);
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register new account</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/foundation-sites@6.7.5/dist/css/foundation.min.css"
          crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
          crossorigin="anonymous">
</head>

<body>
<div class="grid-container">
    <div class="grid-x grid-padding-x align-center">
        <div class="cell medium-6">
            <h1 class="text-center">Register new account</h1>

            <main>
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                    <?php
                        if ($validationErrors) {
                            ?>
                                <div class="callout alert">
                                    <h5>Form contains theese errors:</h5>
                                    <ul>
                                        <?php foreach ($validationErrors as $error) { echo '<li>' . $error . '</li>'; } ?>
                                    </ul>
                                </div>
                            <?php
                        }
                    ?>

                    <div class="grid-x grid-padding-x">
                        <div class="cell">
                            <label>Full Name
                                <input value="<?= $_POST['full_name'] ?? null ?>" type="text" placeholder="Enter your full name" name="full_name">
                            </label>
                        </div>

                        <div class="cell">
                            <label>Email
                                <input value="<?= $_POST['email'] ?? null ?>" type="email" placeholder="Enter your email" name="email">
                            </label>
                        </div>

                        <div class="cell">
                            <label>Password
                                <input type="password" placeholder="Enter your password" name="password">
                            </label>
                        </div>

                        <div class="cell">
                            <label>Password confirmation
                                <input type="password" placeholder="Enter your password for confirmation" name="password_confirm">
                            </label>
                        </div>

                        <div class="cell">
                            <input type="submit" value="Submit registration" class="button button-primary">
                        </div>
                    </div>
                </form>
            </main>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/foundation/6.6.3/js/foundation.min.js"></script>
</body>
</html>
