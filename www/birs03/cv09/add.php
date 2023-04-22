<?php require_once './ProductsDatabase.php';?>
<?php 

$productsDatabase = new ProductsDatabase();

if(!empty($_POST)){
    $productsDatabase->addRecord($_POST['name'],$_POST['price'],$_POST['description'],$_POST['img']);
    header('Location: ./index.php');
}

?>