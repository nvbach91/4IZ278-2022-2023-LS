<?php
require 'utility.php';

$errors = [];

if (!empty($_POST)) {
    $email = htmlspecialchars(trim($_POST['email']));
    $name = trim($_POST['name']);
    $confirmPassword = htmlspecialchars(trim($_POST['confirmPassword']));
    $password = htmlspecialchars(trim($_POST['password']));

    if ($email == '') {
        $message = 'Email is empty';
        array_push($errors, $message);
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Invalid email';
        array_push($errors, $message);
    }
    if ($confirmPassword != $password) {
        $message = 'Passwords have to be the same';
        array_push($errors, $message);
    }    
    $existingUser = fetchUser($email);
    if ($existingUser != null) {
        array_push($errors, 'User already exists.');
    }
    if (empty($errors) && !empty($_POST)) {
        $databaseFilePath = 'users.db';
        $userRecord = "$email;$password" . PHP_EOL; 
        file_put_contents($databaseFilePath, $userRecord, FILE_APPEND);
        mail($email,'Registration','Welcome to our website!');
        header("Location: login.php?$email");
        exit;
    }
}
?>
<form action="." method="POST">
    <?php if (!empty($errors)) : ?>
        <div class="wrong_message">
            <?php foreach ($errors as $error) : ?>
                <p><?php echo $error ?></p>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <?php if (!empty($_POST)) : ?>
            <div class="success_message">Registration was successful!</div>
        <?php endif; ?>
    <?php endif; ?>
    <br>
    <div>
        <label for="">Name</label>
        <input name="name" value="<?php echo isset($name) ? $name : ''; ?>">

    </div>
    <div>
        <label for="">E-mail</label>
        <input name="email" type="email" value="<?php echo isset($email) ? $email : ''; ?>">

    </div>
	<div>
    <label for="">Password</label>
    <input name="password" type="password" value="<?php echo isset($password) ? $password : ''; ?>">
	</div>

	<div>
    <label for="">Confirm Password</label>
    <input name="confirmPassword" type="password" value="<?php echo isset($confirmPassword) ? $confirmPassword : ''; ?>">
	</div>

    <button>Submit</button>
</form>