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
    
    // Get user by email
    $user = $userObj->getUserByEmail($email); 

    // If user does not exist
    if (!$user) {
        $error_message = 'User does not exist.';
    }
    else { // User exists
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['loggedin'] = true;

        $cart_id = $cartObj->getCartIdByUserId($_SESSION['user_id']);

        if (!$cart_id) {
            $cart_id = $cartObj->createCart($_SESSION['user_id']);
        }
        
        $_SESSION['cart_id'] = $cart_id;

        if ($_SESSION['role'] == 'admin') {
            header('Location: admin.php');
        } else {
            header('Location: account.php');
        }
        exit();
    }
}
?>