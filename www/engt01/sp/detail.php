<?php
require_once "db/BooksDatabase.php";
require_once "db/CategoriesDatabase.php";
require_once "db/LoansDatabase.php";
require_once "db/ReservationsDatabase.php";
session_start();

$bookDb = BooksDatabase::getInstance();
$catDb = CategoriesDatabase::getInstance();
$loansDb = LoansDatabase::getInstance();
$reservationsDb = ReservationsDatabase::getInstance();

$userType = $_SESSION["userType"] ?? 0;
$userId = $_SESSION["userId"] ?? -1;
$userEmail = $_SESSION["userEmail"] ?? "";

if (!empty($_GET["isbn"])) $isbn = $_GET["isbn"];
else header("Location: index.php");

$book = $bookDb->getBook($isbn);
$bookAvailableCount = $book["amount"] - count($loansDb->getCurrentLoansOfBook($book["isbn"]));

if (!$book) header("Location: index.php");

include "components/header.php" ?>
<main class="d-flex flex-column">
    <form class="w-75 my-3 mx-auto" action="detail.php?isbn=<?php echo $isbn ?>" method="post">
        <div class="d-flex flex-row align-items-end justify-content-between my-4" style="gap: 8px">
            <div class="d-flex flex-column" style="gap: 16px">
                <h2><?php echo $book["name"] ?></h2>
                <h5><b><?php echo $book["author"] ?></b></h5>
                <h6><?php echo $catDb->getCategory($book["category_id"]) ?></h6>
                <span><small class="text-secondary"><?php
                        if ($bookAvailableCount === 0) echo "Dočasně nedostupné";
                        elseif ($bookAvailableCount === 1) echo "Dostupné (1 kus zbývá)";
                        elseif ($bookAvailableCount >= 2 && $bookAvailableCount < 5) echo "Dostupné ($bookAvailableCount kusy zbývají)";
                        else echo "Dostupné ($bookAvailableCount kus(ů) zbývá)";
                        ?></small></span>
            </div>
            <?php if (intval($userType) >= 3): ?>
                <a href="edit-book.php?isbn=<?php echo $isbn ?>" class="btn btn-danger" style="margin-left: auto">Upravit</a>
            <?php endif;
            if ($userEmail && $book["amount"] > 0): ?>
                <button type="submit" class="btn btn-primary"
                    <?php echo $reservationsDb->hasReserved($book["isbn"], $userId) ? "disabled" : "" ?>>
                    <!-- TODO unreserve? -->
                    <?php echo $reservationsDb->hasReserved($book["isbn"], $userId) ? "Rezervováno" : "Rezervovat" ?>
                </button>
            <?php endif ?>
        </div>
        <p class="my-1"><?php echo $book["description"] ?></p>
    </form>
</main>
<?php include "components/footer.php" ?>
