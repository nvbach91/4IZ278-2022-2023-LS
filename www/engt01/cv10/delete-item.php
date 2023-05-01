<?php
session_start();
if (!isset($_SESSION["userType"])) header("Location: login.php");
if (empty($_SESSION["userType"]) || $_SESSION["userType"] < 2) {
    http_response_code(403);
    die();
}

require "db/ProductsDatabase.php";

$productsDb = new ProductsDatabase();
$productsDb->delete($_GET["good_id"]);

header("Location: index.php");
