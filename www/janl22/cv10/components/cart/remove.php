<?php

$productId = $_GET['id'];
$flag = $_GET['flag'];

if (isset($_SESSION['cart'][$productId])) {

	if ($flag == 'one') $_SESSION['cart'][$productId]['count'] -= 1;
	if ($_SESSION['cart'][$productId]['count'] == 0 || $flag == 'all') unset($_SESSION['cart'][$productId]);

}

Header("Location: cart");
exit();