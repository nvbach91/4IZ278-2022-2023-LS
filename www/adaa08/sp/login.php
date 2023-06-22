<?php
session_start();

require_once 'classes/Database.php';
require_once 'classes/User.php';
require_once 'classes/Cart.php';
require_once 'set_cookie.php';

$db = new Database();
$userObj = new User($db);
$cartObj = new Cart($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $user = $userObj->getUserByEmail($email);

    if ($user && $userObj->verifyPassword($password, $user['password'])) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['loggedin'] = true;

        $cart_id = $cartObj->getCartIdByUserId($_SESSION['user_id']);
    
        if (!$cart_id) {
            $cart_id = $cartObj->createCart($_SESSION['user_id']);
        }
    
        $_SESSION['cart_id'] = $cart_id;

        set_user_cookie($user['user_id']);

        if ($_SESSION['role'] == 'admin') {
            header('Location: admin.php');
        } else {
            header('Location: account.php');
        }
        exit();
    } else {
        $error_message = 'Nesprávne prihlasovacie údaje.';
    }
}

?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <title>Login</title>
    <?php include 'meta.php'; ?>
</head>
<body>

    <?php include 'header.php';?>

    <form method="POST">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Heslo:</label>
        <input type="password" id="password" name="password" required>

        <?php if (isset($error_message)): ?>
            <p><?= htmlspecialchars($error_message, ENT_QUOTES, 'UTF-8') ?></p>
        <?php endif; ?>

        <input type="submit" value="Login">
    </form>

    <?php include 'footer.php';?>
</body>
</html>