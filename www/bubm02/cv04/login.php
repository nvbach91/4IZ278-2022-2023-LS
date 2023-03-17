<?php require './utils.php' ?>
<?php

$formSubmitted = !empty($_POST);
if ($formSubmitted) {
    $username = $_POST["username"];
    if (!isset($username) || $username == "") {
        echo "Username is empty";
        exit;
    }
    $user = getUser($username);
    if ($user == null) {
        echo "User is not registered";
    } elseif (
        $user->password ==
        hash("sha256", $_POST['password'], false)
    ) {
        echo "Login success";
        header("Location: dashboard.php?username=" . $user->username);
        exit;
    } else {
        echo "Wrong password";
    }
}

if (isset($_GET["username"])) {
    $email = $_GET["username"];
}

?>

<?php include './head.php'; ?>


<h1>Login</h1>
<form method="POST" action="./login.php">
    <div class="form-container">
        <div>
            <label>Username</label>
            <input name="username" value="<?php echo isset($email) ? $email : ""  ?>">
        </div>
        <div>
            <label>Password</label>
            <input name="password" type="password">
        </div>
        <div class="button-container">
            <button class="button-green">Login</button>
            <a href="./registration.php" class="button-blue">Register</a>
        </div>
    </div>
</form>

<?php include './foot.php'; ?>