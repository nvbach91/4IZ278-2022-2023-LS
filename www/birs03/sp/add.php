<?php require_once 'ProductsDatabase.php';?>
<?php 

$productsDatabase = new ProductsDatabase();

if(!empty($_POST)){
    if(!empty($_POST['name'])&&!empty($_POST['price'])&&!empty($_POST['description'])&&!empty($_POST['img'])&&is_numeric($_POST['price'])){
        $productsDatabase->addRecord($_POST['name'],$_POST['price'],$_POST['description'],$_POST['img'],$_POST['category_id']);
        header('Location: index.php');
    }else{
        header('Location: addForm.php');
    }
    
}

?>