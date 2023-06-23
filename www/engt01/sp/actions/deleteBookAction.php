<?php
require_once "../db/BooksDatabase.php";
require_once "../db/CategoriesDatabase.php";
session_start();

if (($_SESSION["userType"] ?? 0) < 3) header("Location: ../index.php");

$isbn = $_POST["isbn"];
if (!empty($isbn)) {
    BooksDatabase::getInstance()->deleteBook($isbn);
    header("Location: ../book-list.php?success=1");
} else header("Location: ../book-list.php");
