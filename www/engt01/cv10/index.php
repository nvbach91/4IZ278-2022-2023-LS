<?php
session_start();

require "db/ProductsDatabase.php";

$productsDb = new ProductsDatabase();

$page = (int) ($_GET["page"] ?? 0);
$pageSize = 12;
$pageMax = (int) ceil($productsDb->getCount() / $pageSize) - 1;

$products = $productsDb->fetchAll($pageSize, $pageSize * $page);

include "components/header.php";
?>
<main class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <?php if (isset($_GET["registered"])): ?>
            <p>Successfuly registered</p>
        <?php endif; ?>
        <?php
        if ($_SESSION && $_SESSION["userType"] >= 2): ?>
            <a href="create-item.php" style="text-decoration: none">
                <button class="btn btn-outline-dark" style="margin-bottom: 24px">Přidat</button>
            </a>
        <?php endif;
        if ($_SESSION && $_SESSION["userType"] >= 3): ?>
            <a href="users.php" style="text-decoration: none">
                <button class="btn btn-outline-dark" style="margin-bottom: 24px; margin-left: 16px">Seznam uživatelů
                </button>
            </a>
        <?php endif; ?>
        <a href="world-clock.php" style="text-decoration: none">
            <button class="btn btn-outline-dark" style="margin-bottom: 24px; margin-left: 16px">World clock
            </button>
        </a>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php foreach ($products as $item): ?>
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Product image-->
                        <?php if (!empty($item["img"])): ?>
                            <img class="card-img-top" src="<?php echo $item["img"] ?>"
                                 alt="Product image for <?php echo $item["name"] ?>"/>
                        <?php endif ?>
                        <!-- Product details-->
                        <div class="card-body p-4 text-center">
                            <!-- Product name-->
                            <h5 class="card-title fw-bolder"><?php echo $item["name"] ?></h5>
                            <!-- Product price-->
                            <span class="card-text">$<?php echo $item["price"] ?></span>
                            <p class="card-text"><?php echo $item["description"] ?></p>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center">
                                <a class="btn btn-outline-dark mt-auto"
                                   href="buy.php?good_id=<?php echo $item["good_id"] ?>">Koupit</a>
                                <?php if ($_SESSION && $_SESSION["userType"] >= 2): ?>
                                    <a class="btn btn-outline-dark mt-auto"
                                       href="edit-item.php?good_id=<?php echo $item["good_id"] ?>">Upravit</a>
                                    <a class="btn btn-outline-dark mt-auto"
                                       href="delete-item.php?good_id=<?php echo $item["good_id"] ?>">Smazat</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <nav aria-label="Page navigation">
            <ul class="pagination">
                <?php if ($page !== 0): ?>
                    <li class="page-item">
                        <a class="page-link" href=".?page=<?php echo $page - 1 ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php endif ?>
                <?php for ($i = 0; $i <= $pageMax; $i++): ?>
                    <li class="page-item"><a class="page-link" href=".?page=<?php echo $i ?>"><?php echo $i + 1 ?></a>
                    </li>
                <?php endfor; ?>
                <?php if ($page !== $pageMax): ?>
                    <li class="page-item">
                        <a class="page-link" href=".?page=<?php echo $page + 1 ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php endif ?>
            </ul>
        </nav>
    </div>
</main>
<?php include "components/footer.php" ?>
