<?php require('./utils.php') ?>
<?php

$email = isset($_GET['email']) ? $_GET['email'] : '';

$errors = [];
$formIsSubmitted = !empty($_POST);

if ($formIsSubmitted) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $existingUser = getUser($email);

    if ($existingUser != null) {
        if ($existingUser['password'] == $password) {
            echo 'Login succeess';
        } else {
            echo 'Incorrect password';
        }
    } else {
        echo 'This email has not been registred';
    }

}

?>

<?php require './src/head.php' ?>
<main>
    <h1>Login</h1>
    <form action="login.php" method="POST">
        <div>
            <label>Email</label>
            <input name="email" value="<?php echo $email; ?>">
        </div>
        <div>
            <label>Password</label>
            <input name="password" type="password">
        </div>
        <button>Login</button>
    </form>
</main>
<?php require './src/foot.php' ?>