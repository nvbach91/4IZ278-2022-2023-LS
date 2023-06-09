<?php require_once 'CategoriesDatabase.php';?>
<?php 

$categoriesDatabase = new CategoriesDatabase();

if(!empty($_POST)){
    if(!empty($_POST['name'])){
        $categoriesDatabase->addCategory($_POST['name']);
        header('Location: index.php');
    }else{
        header('Location: categoryForm.php');
    }
    
}

?>