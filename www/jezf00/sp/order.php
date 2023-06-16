<?php
session_start();
require_once 'dbconfig.php';
$pdo = new PDO(
    'mysql:host=' . DB_HOST .
    ';dbname=' . DB_NAME .
    ';charset=utf8mb4',
    DB_USERNAME,
    DB_PASSWORD
);

$totalPrice = $_POST['totalPrice'];
$paymentMethod = $_POST['paymentMethod'];
$deliveryMethod = $_POST['deliveryMethod'];
$email = $_SESSION['user']['email'];
$cart = $_SESSION['cart'];
if(isset($_SESSION['user']['user_id'])){
    $user_id = $_SESSION['user']['user_id'];
}else{
    $stmt = $pdo->prepare("SELECT user_id FROM sp_users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
$user_id = $user['user_id'];
}


$date = date('Y-m-d H:i:s'); 
$stmt = $pdo->prepare("INSERT INTO sp_order (price, date, payment_method, delivery_method, email, user_id) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->execute([$totalPrice, $date, $paymentMethod, $deliveryMethod, $email, $user_id]);
$orderID = $pdo->lastInsertId();

$stmt = $pdo->prepare("INSERT INTO sp_order_table (order_id, good_id, amount, price) VALUES (?, ?, ?, ?)");

function fetchCartItems($pdo, $cart)
{
    $ids = implode(',', array_values($cart));
    $statement = $pdo->prepare("SELECT * FROM sp_products WHERE good_id IN ($ids)");
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

if (!empty($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
    $records = fetchCartItems($pdo, $cart);
}

foreach ($records as $item) {
    $quantity = isset($cart[$item['good_id']]) ? $cart[$item['good_id']] + 1 : 1;
    $stmt->execute([$orderID, $item['good_id'], $quantity, $item['price']]);
}

$_SESSION['cart'] = [];

$subject = 'Order Confirmation';
$message = 'Thank you for your order!';
$headers = [
    'MIME-Version' => '1.0',
    'Content-type' => 'text/html; charset=utf-8',
    'From' => 'jezf00@vse.cz',
    'Reply-To' => 'jezf00@vse.cz',
];

mail($email, $subject, $message, $headers);

header("Location: ./user/cart.php");
exit();
?>
