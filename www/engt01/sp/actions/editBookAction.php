<?php
require_once "../db/BooksDatabase.php";
require_once "../db/CategoriesDatabase.php";
session_start();

if (($_SESSION["userType"] ?? 0) < 3) header("Location: ../index.php");

$bookDb = BooksDatabase::getInstance();
$catDb = CategoriesDatabase::getInstance();

$book = htmlspecialchars($_POST["book"] ?? "");
$author = htmlspecialchars($_POST["author"] ?? "");
$isbn = htmlspecialchars($_POST["isbn"] ?? "");
$category = htmlspecialchars($_POST["category"] ?? "");
$amount = htmlspecialchars($_POST["amount"] ?? "");
$desc = htmlspecialchars($_POST["desc"] ?? "");

// TODO regex check if isbn matches format

if (empty($_POST["book"]) || empty($_POST["author"]) || empty($_POST["isbn"]) || empty($_POST["category"])
    || empty($_POST["amount"]) || empty($_POST["desc"]) || $amount <= 0) {
    header("Location: ../edit-book.php?wrong=1&book=" . rawurlencode($book) . "&author=" . rawurlencode($author) .
        "&isbn=" . rawurlencode($isbn) . "&category=" . rawurlencode($category) . "&amount=" . rawurlencode($amount) .
        "&desc=" . rawurlencode($desc));
}

$catId = $catDb->getCategoryId($category);
if ($catId === null) $catId = $catDb->addCategory($category);

if ($bookDb->getBook($isbn)) $bookDb->editBook($isbn, $book, $author, $desc, $catId, $amount);
else $bookDb->addBook($isbn, $book, $author, $desc, $catId, $amount);

header("Location: ../detail.php?saved=1&isbn=" . rawurlencode($isbn));
