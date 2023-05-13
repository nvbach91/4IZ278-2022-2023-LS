<?php require_once './ProductsDatabase.php';?>
<?php 

$productsDatabase = new ProductsDatabase();

if(!empty($_GET)){
    $productsDatabase->deleteRecord($_GET['good_id']);
    header('Location: ./index.php');
}

?>