<?php require_once './ProductsDatabase.php';?>
<?php 

$productsDatabase = new ProductsDatabase();

if(!empty($_GET)){
    $productsDatabase->editRecord($_GET['good_id'],$_POST['name'],$_POST['price']);
    header('Location: ./index.php');
}

?>