<?php
session_start();
include_once('database.php');
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
}

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    if (empty($email) || empty($username) || empty($address) || empty($phone)) {
        $error = "All fields are required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format";
    } elseif (!preg_match("/^[a-zA-Z ]*$/", $username)) {
        $error = "Invalid username format. Only letters and white space allowed";
    } elseif (!preg_match("/^[a-zA-Z0-9\s,'-]*$/", $address)) {
        $error = "Invalid address format. Only letters, numbers, commas, apostrophes, hyphens and white space allowed";
    } elseif (!preg_match("/^[0-9]*$/", $phone)) {
        $error = "Invalid phone number format. Only numbers allowed";
    } else {
        $userId = $_SESSION['user_id'];
        $stmt = $pdo->prepare("UPDATE users SET email=?, name=?, address=?, phone=? WHERE user_id=?");
        $stmt->execute([$email, $username, $address, $phone, $_SESSION["user_id"]]);
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $username;
        $_SESSION['address'] = $address;
        $_SESSION['phone'] = $phone;

        header('Location: index.php');
        exit();
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
</head>

<body>
    <?php if (isset($error)) { ?>
        <div><?php echo $error; ?></div>
    <?php } ?>
    <form method="post">
        <p>Your current email: <?php echo $_SESSION['email']; ?> </p>
        <label for="email">Enter a new email</label><br>
        <input type="text" name='email' value="<?php echo $_SESSION['email']; ?>" placeholder="email...">
        <br><br>

        <p>Your current username: <?php echo $_SESSION['name']; ?> </p>
        <label for="username">Enter a new username</label><br>
        <input type="text" name='username' value="<?php echo $_SESSION['name']; ?>" placeholder="username...">
        <br><br>

        <p>Your current address: <?php echo $_SESSION['address']; ?> </p>
        <label for="address">Enter a new address</label><br>
        <input type="text" name='address' value="<?php echo $_SESSION['address']; ?>" placeholder="address...">
        <br><br>

        <p>Your current phone number: <?php echo $_SESSION['phone']; ?> </p>
        <label for="phone">Enter a new phone number</label><br>
        <input type="text" name='phone' value="<?php echo $_SESSION['phone']; ?>" placeholder="phone...">
        <br><br>
        <input type="submit" name="submit" value="Save Changes">
    </form>
    <a href="index.php">Back</a>
</body>

</html>