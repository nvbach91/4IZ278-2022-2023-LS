<?php
require_once "db/BooksDatabase.php";
require_once "db/CategoriesDatabase.php";
session_start();

if (($_SESSION["userType"] ?? 0) < 3) header("Location: index.php");

$bookDb = BooksDatabase::getInstance();
$catDb = CategoriesDatabase::getInstance();

$errors = [];

$isbn = $_GET["isbn"] ?? "";
$book = "";
$author = "";
$category = "";
$amount = "";
$desc = "";

$currBook = $bookDb->getBook($isbn);
if (!empty($_GET["isbn"]) && $currBook) {
    $book = $currBook["name"];
    $author = $currBook["author"];
    $category = $catDb->getCategory($currBook["category_id"]);
    $amount = $currBook["amount"];
    $desc = $currBook["description"];
}

$book = $_GET["book"] ?? $book;
$author = $_GET["author"] ?? $author;
$category = $_GET["category"] ?? $category;
$amount = $_GET["amount"] ?? $amount;
$desc = $_GET["desc"] ?? $desc;

if (isset($_GET["wrong"]) && $_GET["wrong"]) $errors[] = "Špatně zadáno";

if (isset($_GET["saved"]) && $_GET["saved"]) $errors[] = "Úspěšně uloženo";

include "components/header.php" ?>
<main class="mx-4 my-3 mx-auto w-75">
    <?php if (!empty($errors)): ?>
        <div class="text-danger">
            <?php foreach ($errors as $error): ?>
                <p><?php echo $error ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif ?>
    <form method="post" action="actions/editBookAction.php" class="edit-book-grid my-3">
        <label for="book">Kniha:</label>
        <input id="book" name="book" type="text" value="<?php echo $book ?>">

        <label for="author">Autor:</label>
        <input id="author" name="author" type="text" value="<?php echo $author ?>">

        <label for="isbn">ISBN:</label>
        <input id="isbn" name="isbn" type="text" value="<?php echo $isbn ?>">

        <label for="category">Kategorie:</label>
        <input id="category" name="category" type="text" value="<?php echo $category ?>">

        <label for="amount">Množství:</label>
        <input id="amount" name="amount" type="number" value="<?php echo $amount ?>">

        <label for="desc">Popis:</label>
        <textarea id="desc" name="desc"><?php echo $desc ?></textarea>

        <button class="btn btn-primary" style="grid-column: 1 / span 2">Uložit</button>
    </form>

</main>
<?php include "components/footer.php" ?>
