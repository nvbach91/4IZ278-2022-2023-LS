<?php
require_once "db/BooksDatabase.php";
require_once "db/CategoriesDatabase.php";
require_once "db/ReservationsDatabase.php";
require_once "db/LoansDatabase.php";
session_start();

$bookDb = BooksDatabase::getInstance();
$catDb = CategoriesDatabase::getInstance();
$reservationsDb = ReservationsDatabase::getInstance();
$loansDb = LoansDatabase::getInstance();

$catId = intval($_GET["cat"] ?? 0);
$page = intval($_GET["page"] ?? 1);
$userId = $_SESSION["userId"] ?? -1;
$userEmail = $_SESSION["userEmail"] ?? "";

$booksPerPage = 4;
$pageCount = intval(ceil(count($bookDb->getAllBooksOfCategory($catId)) / $booksPerPage));

if ($page > $pageCount) $page = $pageCount;
elseif ($page < 1) $page = 1;

if (isset($_GET["registered"]) && $_GET["registered"]) {
    $errors[] = "Úspěšně registrováno";
}

if (isset($_GET["logged"]) && $_GET["logged"]) {
    $errors[] = "Úspěšně přihlášeno";
}

if (isset($_GET["reserved"]) && $_GET["reserved"]) {
    $errors[] = "Úspěšně rezervováno";
}

include "components/header.php" ?>
<main class="mx-auto d-flex flex-column">
    <?php if (!empty($errors)): ?>
        <div class="text-danger">
            <?php foreach ($errors as $error): ?>
                <p><?php echo $error ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <div class="my-3 mx-4 d-flex flex-row" style="gap: 8px">
        <div class="dropdown">
            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                Filtrovat podle kategorie
            </button>
            <ul class="dropdown-menu">
                <?php if (!empty($catId)): ?>
                    <li><a class="dropdown-item" href="?cat=">Zrušit filtr</a></li>
                <?php endif;
                foreach ($catDb->getCategories() as $category): ?>
                    <li><a class="dropdown-item" href="?cat=<?php echo $category["category_id"] ?>">
                            <?php echo $category["name"] ?>
                        </a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <form action="actions/reserveIndexAction.php" method="post"
          class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 g-4 py-3 mx-auto">
        <?php foreach ($bookDb->getBooks($catId, $booksPerPage, ($page - 1) * $booksPerPage) as $book):
            $bookAvailableCount = $book["amount"] - count($loansDb->getCurrentLoansOfBook($book["isbn"])); ?>
            <section class="col flex-grow-1">
                <div class="card h-100">
                    <a class="card-body" href="detail.php?isbn=<?php echo $book["isbn"] ?>">
                        <h5 class="card-title"><?php echo $book["author"] . ": " . $book["name"] ?></h5>
                        <p class="card-text"><small class="text-body-secondary">
                                <?php echo $catDb->getCategory(intval($book["category_id"])) ?>
                            </small></p>
                        <p class="card-text"><?php
                            if ($bookAvailableCount === 0) echo "Dočasně nedostupné";
                            elseif ($bookAvailableCount === 1) echo "Dostupné (1 kus zbývá)";
                            elseif ($bookAvailableCount >= 2 && $bookAvailableCount < 5) echo "Dostupné ($bookAvailableCount kusy zbývají)";
                            else echo "Dostupné ($bookAvailableCount kus(ů) zbývá)";
                            ?></p>
                    </a>
                    <?php if ($userEmail && $bookAvailableCount > 0): ?>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" name="reservation"
                                    value="<?php echo $book["isbn"] ?>"
                                <?php echo $reservationsDb->hasReserved($book["isbn"], $userId) ? "disabled" : "" ?>>
                                <!-- TODO unreserve? -->
                                <?php echo $reservationsDb->hasReserved($book["isbn"], $userId) ? "Rezervováno" : "Rezervovat" ?>
                            </button>
                        </div>
                    <?php endif ?>
                </div>
            </section>
        <?php endforeach; ?>
    </form>

    <?php if ($pageCount > 1): ?>
        <nav class="mx-3" aria-label="Page navigation">
            <ul class="pagination">
                <li class="page-item <?php if ($page === 1) echo "disabled" ?>">
                    <a class="page-link" href="?page=<?php echo $page - 1 ?>&cat=<?php echo $catId; ?>"
                       aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                <?php for ($i = 1; $i <= $pageCount; $i++): ?>
                    <li class="page-item <?php if ($page === $i) echo "active" ?>">
                        <a class="page-link" href="?page=<?php echo $i ?>&cat=<?php echo $catId; ?>">
                            <?php echo $i ?></a>
                    </li>
                <?php endfor ?>

                <li class="page-item <?php if ($page === $pageCount) echo "disabled" ?>">
                    <a class="page-link" href="?page=<?php echo $page + 1 ?>&cat=<?php echo $catId; ?>"
                       aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    <?php endif ?>
</main>
<?php include "components/footer.php" ?>
