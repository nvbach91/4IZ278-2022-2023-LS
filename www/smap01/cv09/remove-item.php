<?php
session_start();
$goods=[];
if(!empty($_SESSION['goods'])&&isset($_GET['good_id'])){
    $goods=$_SESSION['goods'];
    $good_id=$_GET['good_id'];
    $goods=removeItem($goods, $good_id);
    $_SESSION['goods']=$goods;
}
header('Location: cart.php');

function removeItem($goods, $good_id){
    if (($item = array_search($good_id, $goods)) !== false) {
        unset($goods[$item]);
    }
    return $goods;
}
