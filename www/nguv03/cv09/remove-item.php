<?php
session_start();
require 'db.php';
# zrusime id zbozi ze session
# nekontrolujeme, jestli tam je
$id = @$_POST['id'];
#var_dump($_SESSION['cart']);
foreach ($_SESSION['cart'] as $key => $value){
    if ($value == $id) {
        unset($_SESSION['cart'][$key]);
    }
}
header('Location: cart.php');
exit();
?>