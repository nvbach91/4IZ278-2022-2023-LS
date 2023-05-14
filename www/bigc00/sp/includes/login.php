<?php
require('../includes/header.php');
require_once('../Utils.php');
$submittedForm = !empty($_POST);
$error = '';
if ($submittedForm) {
    $utils = new Utils();
    $form = [
        'email' => $_POST['email'],
        'password' => $_POST['password'],
    ];
    $error = $utils->checkLogin($form);
}
?>

<body>
    <main class='container'>
        <form class='blue-box' id='login' method='POST' action='../includes/login.php'>
            <h2>Login</h2>
            <a id='grey' href='../includes/registration.php'>Don't have an account? Create One</a>
            <div class='input-field'>
                <p>Your E-mail</p>
                <input type='text' class='input' name='email'>
            </div>
            <div class='input-field'>
                <p>Password</p>
                <input type='password' class='input' name='password'>
            </div>
            <?php if ($error) : ?>
                <div class='error'>
                    <p><?php echo $error; ?></p>
                </div>
            <?php endif; ?>
            <input type='submit' value='Log in' id='submit'>
        </form>
    </main>
</body>