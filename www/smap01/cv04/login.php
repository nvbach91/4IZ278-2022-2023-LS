<?php include './includes/header.php' ?>
<?php include './utils.php' ?>
<?php
$email = isset($_GET['email']) ? $_GET['email'] : '';
$password = isset($_GET['password']) ? $_GET['password'] : '';

if(strlen($email)>0){
    echo "<p style='text-align:center;background-color:green;color:white;'>Registration successful</p>";
}

$formSubmitted = !empty($_POST);
if ($formSubmitted) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $existingUser = fetchUser($email);
    if ($existingUser != null) {
        if ($existingUser['password'] == $password) {
            echo '<p style="text-align:center;background-color:green; color:white;">Login success</p>';
            echo '<h1 style="margin-top:90px;text-align:center;">Welcome, ' . $existingUser['name'] . '</h1>';
            //header('Location: home.php');
            exit;
        } else {
            echo '<p style="text-align:center;background-color:red; color:white;">Incorrect password</p>';
        }
    } else {
        echo '<p style="text-align:center;background-color:red; color:white;">Nonexisting user</p>';
    }
}
?>
<main>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
        <div>
            <label>Email</label>
            <input type="text" name="email" value="<?php echo isset($email) ? $email : '' ?>">
            <label>Password</label>
            <input type="password" name="password" value="<?php echo isset($password) ? $password : '' ?>">
            <button>Submit</button>
        </div>
    </form>
</main>