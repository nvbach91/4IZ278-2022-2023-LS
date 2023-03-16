<?php
require './utils.php';

$fileData = file_get_contents('./database.db');
$allUsers = explode(PHP_EOL, $fileData);
$usersLength = count($allUsers);
$fields = explode(';', $allUsers[$usersLength - 2]);
$lastRegistered = $fields[0];

$errors = [];

$formSubmitted = !empty($_POST);
if ($formSubmitted) {
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));

    $user = fetchUser($email);
    if ($user == null) {
        array_push($errors, 'User is not registered');
    } else if ($user['password'] != $password) {
        array_push($errors, 'Wrong password');
    } else {
        header('Location: https://esotemp.vse.cz/~cham20/cv04/logged.php');
    }
}
?>
<?php include './header.php' ?>
<main>
    <h1>Thank you for your registration!</h1>
    <h1>LOGIN</h1>
    <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger">
            <?php foreach ($errors as $error) : ?>
                <p><?php echo $error ?></p>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <?php if (!empty($_POST)) : ?>
            <div class="alert alert-success">Login was successful!</div>
        <?php endif; ?>
    <?php endif; ?>
    <form action="./login.php" method="POST">
        <div>

            <label for="">Email</label>
            <input name="email" type="xmail" value="<?php echo $lastRegistered; ?>"><!--ternary operator-->

        </div>
        <div class="form-group">
            <label for="">Password</label>
            <input name="password" value="<?php echo isset($password) ? $password : ''; ?>">

        </div>
        <div>
            <button class="btn btn-primary">Submit</button>
        </div>
    </form>
</main>
<?php include './footer.php' ?>