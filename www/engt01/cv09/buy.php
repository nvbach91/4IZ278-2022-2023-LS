<?php
require "db/ProductsDatabase.php";
session_start();

$gid = $_GET["good_id"];

$productsDb = new ProductsDatabase();

if ($productsDb->exists($gid)) $_SESSION["cart"][] = $gid;
else throw new OutOfRangeException("wrong id");

header("Location: cart.php");
