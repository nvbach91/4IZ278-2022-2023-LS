<?php
require 'utils.php';
$errors = [];

$formSubmitted = !empty($_POST);
if ($formSubmitted) {
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));

    $user = getUser($email);
    if ($user == null) {
        array_push($errors, 'User is not registered');
    } else if ($user['password'] != $password) {
        array_push($errors, 'Wrong password');
    } else {
        header('Location: loggedUsers.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>


<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="Post">
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
    <div>
        <label>email</label>
        <input name = "email" placeholder="Email">
    </div>
    <div>
        <label>password</label>
        <input name = "password" placeholder="Password">
    </div>
    <button>Submit</button>
</form>
</html>