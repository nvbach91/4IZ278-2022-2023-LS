<?php 
require_once 'index.php';
if (empty($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
if(isset($_POST['logout'])){
    session_unset();
    session_destroy();
    header("Location:login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
</head>
<body>
    <h1>User Profile</h1>

    <p><strong>Name:</strong> <?php echo $_SESSION['user']['name']; ?></p>
    <p><strong>Surname:</strong> <?php echo $_SESSION['user']['surname']; ?></p>
    <p><strong>Email:</strong> <?php echo $_SESSION['user']['email']; ?></p>
    <p><strong>Phone:</strong> <?php echo $_SESSION['user']['phone']; ?></p>
    <p><strong>Address:</strong> <?php echo $_SESSION['user']['adress']; ?></p>
    <p><strong>Postal Code:</strong> <?php echo $_SESSION['user']['postalCode']; ?></p>

    <form action="" method="POST">
        <input type="submit" name= 'logout' value="Logout">
    </form>

</body>
</html>
