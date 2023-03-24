
<?php
session_start();
require 'db.php';
# session pole pro kosik
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [
        // ['id' => 1, 'name' => 'PC', 'price' => 500, 'quantity' => 2]
        // ['id' => 1, 'name' => 'PC', 'price' => 500, 'quantity' => 2]
        // ['id' => 1, 'name' => 'PC', 'price' => 500, 'quantity' => 2]
    ];
}
$sql = "SELECT * FROM cv09_goods WHERE id = :id";
$stmt = $db->prepare($sql);
$stmt->execute(['id' => $_GET['id']]);
$goods = $stmt->fetch();
if (!$goods){
    exit("Unable to find goods!");
}
# pridame id zbozi do session pole
# TODO neresime, ze od jednoho zbozi muze byt vetsi mnozstvi nez 1, domaci ukol :)
$_SESSION['cart'][] = $goods["id"];
header('Location: cart.php');
exit();
?>