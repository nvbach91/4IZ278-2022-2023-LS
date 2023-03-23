<?php
require "utils.php";

$errors = [];
$databaseFilePath = 'users.db';

if (!empty($_POST)) {
    $mail = htmlspecialchars(trim($_POST['mail']));
    $name = htmlspecialchars(trim($_POST['name']));
    $password = htmlspecialchars(trim($_POST['password']));
    $passwordc = htmlspecialchars(trim($_POST['passwordc']));
    
    if (!$mail) {
            $message = 'Please enter a valid e-mail address';
            array_push($errors, $message);
        }

    if (!$name) {
        $message = 'Please enter a valid full name/nickname';
        array_push($errors, $message);
    }

    if (!$password) {
        $message = 'Please enter a valid password';
        array_push($errors, $message);
    }

    if (!$passwordc == $password) {
        $message = 'The password does not match';
        array_push($errors, $message);
    }

    $usersData = file_get_contents($databaseFilePath);
    $users = explode(PHP_EOL, $usersData);

    foreach ($users as $user) {
        $fields = explode(';', $user);
        $existingMail = $fields[0];
        if ($existingMail == $mail) {
            array_push($errors, 'E-mail is already registered');
            break;
        }
    }

    if (empty($errors)) {
        registerNewUser($mail, $name, $password);
        header("Location: login.php");
        die();
    }
}

?>

<?php include "./head.php"; ?>
<a href="login.php">Already registered?</a>
<h1>Registration form</h1>
<form class="form-signup" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <?php if (!empty($errors)): ?>
        <div>
            <?php foreach($errors as $error): ?>
                <p><?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
    <?php elseif (!empty($_POST)): ?>
        <p>Thank you for registering!</p>
    <?php endif; ?>
    <div>
        <label>E-mail</label>
        <input type="email" name="mail" value="<?php echo isset($mail) ? $mail : ''; ?>">
    </div>
    <div>
        <label>Name</label>
        <input type="text" name="name" value="<?php echo isset($name) ? $name : ''; ?>">
    </div>
    <div>
        <label>Password</label>
        <input type="password" name="password" value="<?php echo isset($password) ? $password : ''; ?>">
    </div>
    <div>
        <label>Confirm password</label>
        <input type="password" name="passwordc" value="<?php echo isset($passwordc) ? $passwordc : ''; ?>">
    </div>
    <button>Submit</button>
</form>
<?php include "foot.php"; ?>