<?php
require "db/ProductsDatabase.php";

$productsDb = new ProductsDatabase();
$productsDb->delete($_GET["good_id"]);

header("Location: index.php");
