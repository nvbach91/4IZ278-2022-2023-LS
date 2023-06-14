<?php if (!isset($_SESSION)) session_start(); ?>
<?php require_once './auth.php'; ?>
<?php if (requirePrivilege(2)) ?>
<?php require_once './AdDatabase.php' ?>
<?php
$adDatabase = new AdDatabase();
$listings = $adDatabase->getAllAds($_SESSION['user']['user_id']);

if (!$listings) {
    header('Location: ./index.php');
}
?>

<?php require './header.php' ?>
<?php require './navbar.php'; ?>

<div class="m-5">
    <h3 class="mt-4">Všetky inzeráty</h3>
    <?php foreach ($listings as $listing) : ?>
        <div class="card mt-4">
            <div class="row">
                <div class="col-md-4">
                    <img src="<?= $listing["images"][0]["image_data"] ?>" class="image-ad" alt="Vehicle Image">
                </div>
                <div class="col-md-3 p-2 d-flex align-items-center justify-content-center">
                    <div class="row">
                        <h4><?= htmlspecialchars($listing["manufacturer"]) ?> <?= htmlspecialchars($listing["model"]) ?></h4>
                    </div>
                </div>
                <div class="col-md-5 p-4">
                    <div class="row">
                        <div class="col-md-6">
                            <p>Cena: <?= htmlspecialchars(number_format($listing["price"])) ?>€</p>
                            <p>Palivo: <?= htmlspecialchars($listing["fuel"]) ?></p>
                            <p>Výkon: <?= htmlspecialchars($listing["power"]) ?> KW</p>
                            <p>Rok: <?= htmlspecialchars($listing["year"]) ?></p>
                        </div>
                        <div class="col-md-6">
                            <p>Prevodovka: <?= htmlspecialchars($listing["transmission"]) ?></p>
                            <p>Farba: <?= htmlspecialchars($listing["color"]) ?></p>
                            <p>Nájazd: <?= htmlspecialchars($listing["mileage"]) ?> KM</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p>Popis: <?= htmlspecialchars($listing["description"]) ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <form action="./ad-detail.php" method="GET" class="ms-2">
                    <input type="hidden" name="listing_id" value="<?php echo htmlspecialchars($listing['listing_id']) ?>">
                    <button type="submit" class="btn btn-primary">Detail</button>
                </form>
                <form action="./ad-edit.php" method="GET" class="ms-2">
                    <input type="hidden" name="listing_id" value="<?php echo htmlspecialchars($listing['listing_id']) ?>">
                    <button type="submit" class="btn btn-outline-dark">Upraviť</button>
                </form>
                <form action="./ad-delete.php" method="GET" class="ms-2">
                    <input type="hidden" name="back_to" value="admin-edit-ads.php">
                    <input type="hidden" name="listing_id" value="<?php echo htmlspecialchars($listing['listing_id']) ?>">
                    <button type="submit" class="btn btn-danger" onclick="return confirmDelete()">Zmazať</button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php require './footer.php' ?>

<script>
    function confirmDelete() {
        var r = confirm("Ste si istý že chcete zmazať inzerát?");
        if (r == true) {
            return true;
        } else {
            return false;
        }
    }
</script>