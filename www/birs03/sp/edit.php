<?php require_once 'ProductsDatabase.php';?>
<?php 

$productsDatabase = new ProductsDatabase();

if(!empty($_GET)){
    if(!empty($_POST['name'])&&!empty($_POST['price'])&&!empty($_POST['description'])&&!empty($_POST['img'])&&is_numeric($_POST['price'])){
        $productsDatabase->editRecord($_GET['product_id'],$_POST['name'],$_POST['price'],$_POST['description'],$_POST['img'],$_POST['category_id']);
        header('Location: index.php');
    }else{
        header('Location: editForm.php?product_id='.$_GET['product_id']);
    }
    
}

?>