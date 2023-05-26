<?php
include './utils.php';

$errors = [];

if (!empty($_POST)) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $authentication = authenticate($email, $password);
    if (!$authentication['success']) {
        $errors['authentication'] = $authentication['msg'];
    } else {
        header('Location: profile.php?email=' . $email);
        exit();
    }
}

if (isset($_GET['email'])) {
    $email = $_GET['email'];
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

<body>

    <main>
        <form method="POST">
            <?php if (isset($_GET['email']) && @$_GET['ref'] === 'registration') : ?>
                <div>successfully signed up</div>
            <?php endif; ?>
            <?php if (!empty($_POST) && !empty($errors)) : ?>
                <div>
                    <?php echo implode('<br>', array_values($errors)); ?>
                </div>
            <?php endif; ?>
            <label>Email<input name='email' value="<?php echo @$email; ?>"></label>
            <label>Heslo<input name='password' value="<?php echo @$password; ?>"></label>
            <button type="submit">Sign in</button>
        </form>
    </main>

</body>

</html>