<?php


function calculateTotalPrice($cart, $records) {
    $totalPrice = 0;

    foreach ($records as $item) {
        $quantity = isset($cart[$item['good_id']]) ? $cart[$item['good_id']] + 1 : 1;
        if ($quantity >= 10) {
            $quantity = 10; 
        }
        $totalPrice += $item['price'] * $quantity;
    }

    return $totalPrice;
}

$totalPrice = calculateTotalPrice($cart, $records);
?>