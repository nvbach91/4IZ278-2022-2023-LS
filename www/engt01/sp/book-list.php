<?php
require_once "db/BooksDatabase.php";
require_once "db/UserDatabase.php";
session_start();

if (($_SESSION["userType"] ?? 0) < 3) header("Location: index.php");

$bookDb = BooksDatabase::getInstance();
$userDb = UserDatabase::getInstance();

$allBooks = $bookDb->getAllBooks();

$errors = [];
if (isset($_GET["success"]) && $_GET["success"]) {
    $errors[] = "Úspěšně smazáno";
}

include "components/header.php" ?>
<main class="mx-4 my-3 mx-auto w-75 d-flex flex-column">
    <h3 class="text-center">Seznam všech knih</h3>
    <?php if (!empty($errors)): ?>
        <div class="text-success">
            <?php foreach ($errors as $error): ?>
                <p><?php echo $error ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif ?>
    <form action="actions/deleteBookAction.php" method="post">
        <table class="table table-sm table-striped table-bordered align-middle">
            <thead>
            <tr>
                <th scope="col" class="col-md-4">Kniha (ISBN)</th>
                <th scope="col" class="col-md-4">Akce</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($allBooks as $book): ?>
                <tr>
                    <th scope="row">
                        <a href="detail.php?isbn=<?php echo $book["isbn"] ?>"><?php echo $bookDb->
                            getBook($book["isbn"])["name"] ?></a>
                        (<?php echo $book["isbn"] ?>)
                    </th>
                    <td>
                        <a href="edit-book.php?isbn=<?php echo $book["isbn"] ?>" class="btn btn-primary btn-sm">
                            Upravit
                        </a>
                        <button type="submit" class="btn btn-danger btn-sm" name="isbn"
                                value="<?php echo $book["isbn"] ?>">
                            Smazat
                        </button>
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </form>
    <!-- TODO pagination? -->
</main>
<?php include "components/footer.php" ?>
