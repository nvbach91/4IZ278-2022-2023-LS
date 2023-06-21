<?php 
require_once 'index.php';
$newTitle = $_POST['title'];
$oldProdID= $_POST['oldProdID'];
$newPrice= $_POST['newPrice'];
$newCategoryId= $_POST['newCategoryId'];
$newDiscount= $_POST['newDiscount'];
$newImgLink= $_POST['newImgLink'];
$productDB -> updateProduct($oldProdID,$newTitle,$newPrice,$newCategoryId,$newDiscount,$newImgLink);
 header("Location: updateProd.php");