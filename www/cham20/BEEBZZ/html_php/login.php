<?php
require './UsersDatabase.php';
include './autoloader.php';
// TITLE HANDLING ------ konec 11:45
ob_start();
include("header.php");
$buffer = ob_get_contents();
ob_end_clean();

$buffer = str_replace("%TITLE%", "LOGIN BEEBZZ", $buffer);
echo $buffer;


$errors = [];
// LOGIN LOGIC
if (!empty($_POST)) {
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));

    //getting user
    $usersDatabase = new UsersDatabase();
    $users = $usersDatabase->getUSer($email);
    foreach ($users as $user) {
        $hashed = $user['password'];
    }
    //password verify
    if (password_verify($password, $hashed)) {
        setcookie('email', $email, time() + (60 * 60));
        header('Location: successful.php');
    } else {
        array_push($errors, "Invalid email or password.");
    }
}

if (isset($_GET['code'])) {
    $accessToken = getAccessTokenWithCode($_GET['code']);
    echo '<pre>';
    print_r($accessToken);
    die();
}
?>
<div class="text-center login-form">
    <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger">
            <?php foreach ($errors as $error) : ?>
                <p><?php echo $error ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <div class="inner">
        <form action="./login.php" method="POST">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Email:</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" name="email" placeholder="E-mail">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Password:</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
            </div>
            <div>
                <button class="btn btn-success">SUBMIT</button>
            </div>
        </form>
    </div>
    <div class="text-center">
        <a href="<?php echo getFacebookLoginUrl(); ?>"><button class="btn btn-primary">Use facebook to log in.</button></a>
    </div>
    <div class="text-center">
        <a href="./registration.php"><button class="btn btn-warning">YOU DONT HAVE ACCOUT YET? REGISTERE NOW</button></a>
    </div>
</div>
<?php include './footer.php'; ?>