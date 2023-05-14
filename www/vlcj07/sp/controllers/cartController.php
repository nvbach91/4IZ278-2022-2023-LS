<?php
require '../models/ProductsDB.php';
require 'authorization.php';
$productsDatabase = new ProductsDatabase();
$ids = @$_SESSION['cart'];
$products = [];

if (is_array($ids) && count($ids)) {
    $question_marks = str_repeat('?,', count($ids) - 1) . '?';

    $products = $productsDatabase->fetchByIdNameOrder($question_marks, $ids);

    $sum = $productsDatabase->getSum($question_marks, $ids);
}
?>