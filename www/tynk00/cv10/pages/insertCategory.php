<?php
session_start();
if (isset($_GET['action'])) {
    require_once('../database/loadData.php');

    if ($_GET['action'] == "insert") {
        $categoriesDatabase->insertCategory($_GET['name'], $_GET['image']);
    } else {
        $categoriesDatabase->editCategory($_GET['category_id'], $_GET['name'], $_GET['image']);
    }
    
} else {
    header("refresh:0;url=databaseManager.php");
}

?>
