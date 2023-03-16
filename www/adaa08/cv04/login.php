<?php
require 'utility.php';

$fileData = file_get_contents('users.db');
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
        array_push($errors, 'Incorrect password');
    } else {
        header("Location: logged_in.php?email={$user['email']}");
    }
}
?>
<?php include 'header.php' ?>
<main>
    <h3>Please login to your account</h3>
    <h2>LOGIN</h2>
    <?php if (!empty($errors)) : ?>
        <div class="wrong_message">
            <?php foreach ($errors as $error) : ?>
                <p><?php echo $error ?></p>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <?php if (!empty($_POST)) : ?>
            <div class="success_message">Login was successful!</div>
        <?php endif; ?>
    <?php endif; ?>
    <form action="login.php" method="POST">
        <div>

            <label for="">Email</label>
            <input name="email" type="xmail" value="<?php echo $lastRegistered; ?>"> 

        </div>
        
        <div>
            <label for="">Password*</label>
            <input type="password" name="password" value="<?php echo isset($password) ? $password : ''; ?>">
        </div>

        <div>
            <button>Submit</button>
        </div>
    </form>
</main>