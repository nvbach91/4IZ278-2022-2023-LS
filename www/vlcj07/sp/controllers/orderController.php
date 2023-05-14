<?php 
require 'authorization.php';
require '../models/ProductsDB.php';
require '../models/OrderItemsDB.php';
require '../models/OrdersDB.php';

$ordersDatabase = new OrdersDatabase();
$productsDatabase = new ProductsDatabase();
$orderItemsDatabase = new OrderItemsDatabase();
$ids = @$_SESSION['cart'];

if (isset($_SESSION['user_id'])){

    $question_marks = str_repeat('?,', count($ids) - 1) . '?';

    $status = 'new';
    $total_price = $productsDatabase->getSum($question_marks, $ids);
    $date = date('Y-m-d H:i:s', time());
    $user_id = $_SESSION['user_id'];

    $ordersDatabase->createOrder($status, $total_price, $date, $user_id);

    $order = $ordersDatabase->fetchByUserId($user_id);
    $order_id = $order['order_id'];

    $products = $productsDatabase->fetchByIdNameOrder($question_marks, $ids);

    foreach($products as $product){
        $amount = 1; //přidat i pro více itemů od 1 id 
        $price = $product['price'];
        $product_id = $product['product_id'];

        $orderItemsDatabase->createOrder($amount, $price, $product_id, $order_id);
        
    }

}
// přidat potvrzení na email

require 'clear-cart.php';

// var_dump($_SESSION['cart']);

header('Location: ../views/order.php');
?>