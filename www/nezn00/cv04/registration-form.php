<?php
require './utils.php';

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
        $message = 'Passwords are not the same';
        array_push($errors, $message);
    }    
    $existingUser = fetchUser($email);
    if ($existingUser != null) {
        array_push($errors, 'User exists.');
    }
    if (empty($errors) && !empty($_POST)) {
        $databaseFilePath = './dtbase.db';
        $userRecord = "$email;$password" . PHP_EOL; 
        file_put_contents($databaseFilePath, $userRecord, FILE_APPEND);
        mail($email,'Registration','Thank you for your registration!');
        header("Location: login.php?$email");
        exit;
    }
}
?>
<form action="." method="POST" class="form-signup">
    <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger">
            <?php foreach ($errors as $error) : ?>
                <p><?php echo $error ?></p>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <?php if (!empty($_POST)) : ?>
            <div class="alert alert-success">Registration was successful!</div>
        <?php endif; ?>
    <?php endif; ?>
    <br>
    <div class="form-group">
        <label for="">Name</label>
        <input name="name" value="<?php echo isset($name) ? $name : ''; ?>">

    </div>
    <div class="form-group">
        <label for="">E-mail</label>
        <input name="email" type="email" value="<?php echo isset($email) ? $email : ''; ?>">

    </div>
    <div class="form-group">
        <label for="">Password</label>
        <input name="password" value="<?php echo isset($password) ? $password : ''; ?>">
    </div>

    <div class="form-group">
        <label for="">Confirm Password</label>
        <input name="confirmPassword" value="<?php echo isset($confirmPassword) ? $confirmPassword : ''; ?>">
    </div>
    <button class="btn btn-primary">Submit</button>
</form>