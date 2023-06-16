<?php if (!isset($_SESSION)) session_start(); ?>
<?php require_once './AdDatabase.php' ?>
<?php

$db = new AdDatabase();

if (isset($_GET['searchQuery']) && $_GET['searchQuery']) {
    $query = $_GET['searchQuery'] ?? '';
    $results = $db->fulltextSearch($query);
} else {
    $manufacturer = $_GET['manufacturer'] ?? '';
    $model = $_GET['model'] ?? '';
    $fuel = $_GET['fuel'] ?? '';
    $color = $_GET['color'] ?? '';
    $yearFrom = $_GET['yearFrom'] ?? 0;
    $yearTo = $_GET['yearTo'] ?? date("Y");
    $powerFrom = $_GET['powerFrom'] ?? 0;
    $powerTo = $_GET['powerTo'] ?? 1000;
    $priceFrom = $_GET['priceFrom'] ?? 0;
    $priceTo = $_GET['priceTo'] ?? 10000000;
    $results = $db->search($manufacturer, $model, $fuel, $color, $yearFrom, $yearTo, $powerFrom, $powerTo, $priceFrom, $priceTo);
}

?>

<?php require './header.php' ?>
<?php require './navbar.php'; ?>

<div class="p-5">
    <div class="d-flex mb-2">
        <form action="./index.php" method="GET" id="back">
            <button type="submit" class="btn btn-outline-dark">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                </svg>
            </button>
        </form>
        <h4 class="ms-3">Späť na vyhľadávanie</h4>
    </div>
    <?php foreach ($results as $row) : ?>
        <div class="card mt-4">
            <div class="row">
                <div class="col-md-4">
                    <img src="<?= htmlspecialchars($row["images"][0]["image_data"]) ?>" class="image-ad" alt="Vehicle Image">
                </div>
                <div class="col-md-3 p-2 d-flex align-items-center justify-content-center">
                    <div class="row">
                        <h4><?= htmlspecialchars($row["manufacturer"]) ?> <?= htmlspecialchars($row["model"]) ?></h4>
                    </div>
                </div>
                <div class="col-md-5 p-4">
                    <div class="row">
                        <div class="col-md-6">
                            <p>Cena: <?= number_format(htmlspecialchars($row["price"])) ?>€</p>
                            <p>Palivo: <?= htmlspecialchars($row["fuel"]) ?></p>
                            <p>Výkon: <?= htmlspecialchars($row["power"]) ?> KW</p>
                            <p>Rok: <?= htmlspecialchars($row["year"]) ?></p>
                        </div>
                        <div class="col-md-6">
                            <p>Prevodovka: <?= htmlspecialchars($row["transmission"]) ?></p>
                            <p>Farba: <?= htmlspecialchars($row["color"]) ?></p>
                            <p>Nájazd: <?= htmlspecialchars($row["mileage"]) ?> KM</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p>Popis: <?= htmlspecialchars($row["description"]) ?></p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <?php if (isLoggedIn() && $row['user_id'] != $_SESSION['user']['user_id']) : ?>
                            <div class="d-flex pe-3">
                                <form action="./chat.php" method="GET" id="chatForm">
                                    <input type="hidden" name="reciever_id" value="<?= $row['user_id'] ?>">
                                    <input type="hidden" name="listing_id" value="<?= $row['listing_id'] ?>">
                                    <button type="submit" class="btn btn-success">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-left-dots" viewBox="0 0 16 16">
                                            <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                                            <path d="M5 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                        </svg>
                                        Kontakt
                                    </button>
                                </form>
                            </div>
                        <?php endif; ?>
                        <?php if (isLoggedIn() && $row['user_id'] == $_SESSION['user']['user_id']) : ?>
                            <div class="d-flex pe-3">
                                <form action="./profile.php" method="GET" id="manage">
                                    <button type="submit" class="btn btn-outline-primary">Spravovať</button>
                                </form>
                            </div>
                        <?php endif; ?>
                        <div class="d-flex pe-5">
                            <form action="./ad-detail.php" method="GET" id="detailsForm">
                                <input type="hidden" name="listing_id" value="<?= $row['listing_id'] ?>">
                                <button type="submit" class="btn btn-primary">Detail</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php require './footer.php' ?>