<?php
require_once "db/BooksDatabase.php";
require_once "db/CategoriesDatabase.php";
session_start();

$bookDb = BooksDatabase::getInstance();
$catDb = CategoriesDatabase::getInstance();

var_dump($_POST);

$book = $_POST["book"] ?? "";
$author = $_POST["author"] ?? "";
$isbn = $_POST["isbn"] ?? "";
$category = $_POST["category"] ?? "";
$amount = $_POST["amount"] ?? "";
$desc = $_POST["desc"] ?? "";

// TODO regex check if isbn matches format

if (empty($_POST["book"]) || empty($_POST["author"]) || empty($_POST["isbn"]) || empty($_POST["category"])
    || empty($_POST["amount"]) || empty($_POST["desc"]) || $amount <= 0) {
    header("Location: edit-book.php?wrong=1&book=".rawurlencode($book)."&author=".rawurlencode($author).
        "&isbn=".rawurlencode($isbn)."&category=".rawurlencode($category)."&amount=".rawurlencode($amount).
        "&desc=".rawurlencode($desc));
}

$catId = $catDb->getCategoryId($category);
if (!$catId) {
    $catDb->addCategory($category);
    $catId = $catDb->getCategoryId($category);
}

if ($bookDb->getBook($isbn)) $bookDb->editBook($isbn, $book, $author, $desc, $catId, $amount);
else $bookDb->addBook($isbn, $book, $author, $desc, $catId, $amount);

header("Location: edit-book.php?saved=1&book=".rawurlencode($book)."&author=".rawurlencode($author).
    "&isbn=".rawurlencode($isbn)."&category=".rawurlencode($category)."&amount=".rawurlencode($amount).
    "&desc=".rawurlencode($desc));
