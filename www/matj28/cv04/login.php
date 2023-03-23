<?php include './includes/header.php' ?>
<?php include './includes/footer.php' ?>
<?php require './classes/utils.php' ?>
<?php
error_reporting(E_ERROR | E_PARSE);
$email = isset($_GET['email']) ? $_GET['email'] : '';
$afterLogin = isset($_GET['afterLogin']) ? $_GET['afterLogin'] : '';
$errors = [];

$formSubmitted = !empty($_POST);

if ($formSubmitted) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $existingUser = getUser($email);

    if ($email == '') {
        $message = 'Email is required.';
        array_push($errors, $message);
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Email is not valid';
        array_push($errors, $message);
    }

    if (empty($errors)) {
        if ($existingUser != null) {
            if ($existingUser['password'] == $password) {
                header('Location: users.php?loginSuccess=true');
                exit;
            } else {
                $message = 'Password incorrect';
                array_push($errors, $message);
            }
        } else {
            $message = 'Non existing user';
            array_push($errors, $message);
        }
    }
}



?>
<main>
    <form action ="login.php" method="POST">
        <h1>Login page</h1>
        <?php if ($afterLogin) : ?>
        <div>
                <p>Uspesne jste se zaregistrovali!
                nyni se muzete prihlasit</p>
        </div>
        <?php elseif (!empty($errors)) : ?>
        <div>
            <?php foreach ($errors as $error) : ?>
                <p><?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
        <?php endif ?>
        <div>
            <label>Email</label>
            <input name="email" value="<?php echo $email; ?>" type="email>"
        </div>
        <div>
            <label>Password</label>
            <input name="password" type="password>"
        </div>
        <div>
            <div>
                <input type="submit" />
            </div>
        </div>
    </form>
</main>
