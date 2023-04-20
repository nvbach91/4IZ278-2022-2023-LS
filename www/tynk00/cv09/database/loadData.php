<?php

require_once('categoriesDB.php');
require_once('productsDB.php');
require_once('usersDB.php');

$categoriesDatabase = new CategoriesDatabase;
$productsDatabase = new ProductsDatabase;
$usersDatabase = new UsersDatabase;
$categories = $categoriesDatabase->fetchAll();






?>