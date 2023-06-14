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
$email = $_SESSION['user']['email']; 
$cart = $_SESSION['cart']; 

$date = date('Y-m-d'); 
$stmt = $pdo->prepare("INSERT INTO sp_order (price, date, payment_method, email) VALUES (?, ?, ?, ?)");
$stmt->execute([$totalPrice, $date, $paymentMethod, $email]);
$orderID = $pdo->lastInsertId(); 

$stmt = $pdo->prepare("INSERT INTO sp_order_table (order_id, good_id, amount) VALUES (?, ?, ?)");

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
    $stmt->execute([$orderID, $item['good_id'], $quantity]);
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


header("Location: ./cart.php");
exit();
?>
