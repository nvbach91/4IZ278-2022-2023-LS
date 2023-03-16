<?php require './utils.php'; ?>
<?php include './head.php'; ?>
<?php 


$email = isset($_GET['email']) ? $_GET['email'] : '';

$formIsSubmitted = !empty($_POST);
if ($formIsSubmitted) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $existingUser = getUser($email);
    if ($existingUser != null) {
        if ($existingUser['password'] == $password) {
            echo 'Login success';
            header('Location: home.php');
            exit;
        } else {
            echo 'Incorrect password';
        }
    } else {
        echo 'Nonexisting user';
    }
}

?>
<main>
    <h1>Login page</h1>
    <form action="login.php" method="POST">
        <div>
            <label>Email</label>
            <input name="email" value="<?php echo $email; ?>">
        </div>
        <div>
            <label>Password</label>
            <input name="password" type="password">
        </div>
        <button>Login</button>
    </form>
</main>
<?php include './foot.php'; ?>