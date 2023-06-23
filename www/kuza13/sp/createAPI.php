<?php
require_once 'index.php';
$args=[
    'product_id'=>$_POST['product_id'],
    'product_name'=>$_POST['product_name'], 
   'price'=>$_POST['price'], 
    'category_id'=>$_POST['category_id'], 
    'discount'=>$_POST['discount'], 
    'img_link'=>$_POST['img_link']
];
$productDB->create($args);
header("Location:updateProd.php");