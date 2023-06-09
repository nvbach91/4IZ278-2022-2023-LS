<?php
session_start();

require_once('../database/OrdersDB.php');
require_once('../database/ProductsDB.php');
require_once('../database/UsersDB.php');

$usersDB=UsersDB::getDatabase();
$ordersDB=OrdersDB::getDatabase();

//First enter tests
if(!isset($_SESSION)||!isset($_SESSION['books'])||!isset($_COOKIE)||!isset($_COOKIE['user_email'])||!$usersDB->userExists(htmlspecialchars($_COOKIE['user_email']))){
    header('Location: ../index.php');
    exit;
}

//If placing the orders is successful (return is NULL), email confirmation is send to users email address and session is destroyed ensuring the cart is emptied.
$userId=$usersDB->getUserID(htmlspecialchars($_COOKIE['user_email']));
if($ordersDB->placeOrder(htmlspecialchars($userId), $_SESSION['books'], htmlspecialchars($usersDB->getUser(htmlspecialchars($userId))['user_address']), date("Y-m-d H:i:s"))==NULL){
    sendConfirmation(htmlspecialchars($userId), $usersDB);
    session_destroy();
}
header('Location: ../profile.php?user_id='.$usersDB->getUserID(htmlspecialchars($_COOKIE['user_email'])));
exit;

//Function that sends confirmation email about users order. As parameters it takes userID and instance of UsersDB
function sendConfirmation($userId, $usersDB){
    $to      = $usersDB->getUser(htmlspecialchars($userId))['user_email'];
    $subject = 'Order using your email.';
    $message = 'Hello you account has just placed an order on books. You can check it out in your profile page here: https://esotemp.vse.cz/~smap01/sp/profile.php?user_id='.$userId.'.';
    $headers = 'From: smap01@vse.cz'       . "\r\n" .
                 'Reply-To: smap01@vse.cz' . "\r\n" .
                 'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $message, $headers);
}
?>