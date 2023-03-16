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
        if ($existingUser['password'] !== $password) {
            array_push($errors, 'Wrong password');
        }
    } else {
        array_push($errors, 'User is not registered');
    }

}

?>

<?php require './header.php' ?>
<main>
    <h1>Login</h1>
    <form action="login.php" method="POST">
        <div class="form">
            <div class="form-group">
                <label>Email</label>
                <input name="email" value="<?php echo $email; ?>">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input name="password" type="password">
            </div>
            <button class="btn btn-primary" type="submit">Login</button>
        </div>
    </form>
</main>
<?php if (!empty($errors)): ?>
    <div>
        <?php foreach($errors as $error):?>
            <p class="error-message"> <?php  echo $error?></p>
            <?php endforeach;?>
    </div>
    <?php elseif (!empty($_POST)): ?>
        <div class="sucses">You have successfully logged in!</div>
    <?php endif; ?>
<?php require './footer.php' ?>