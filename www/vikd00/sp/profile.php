<?php if (!isset($_SESSION)) session_start(); ?>
<?php require_once './auth.php'; ?>
<?php if (requirePrivilege(1)) ?>
<?php require_once './UserDatabase.php' ?>
<?php require_once './AdDatabase.php' ?>
<?php
$userDatabase = new UserDatabase();
$adDatabase = new AdDatabase();

$user = $userDatabase->getUserById($_SESSION['user']['user_id']);
$listings = $adDatabase->getUserAdsById($_SESSION['user']['user_id']);

if (!$adDatabase) {
    header('Location: ./index.php');
}
?>

<?php require './header.php' ?>
<?php require './navbar.php'; ?>

<div class="p-5">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title"><?php echo $user['xname'] ?></h3>
            <h5 class="card-subtitle mb-2 text-muted"><?php echo $user['email'] ?></h5>
            <p class="card-text"><?php echo ($user['role'] == 2 ? 'Admin' : 'Užívateľ') ?></p>
            <form method="GET" action="./profile-edit.php">
                <button type="submit" class="btn btn-outline-dark">Upraviť profil</button>
            </form>
        </div>
    </div>
    <h3 class="mt-4">Moje inzeráty</h3>
    <?php foreach ($listings as $listing) : ?>
        <div class="card mt-4">
            <div class="row">
                <div class="col-md-4">
                    <img src="<?= $listing["images"][0]["image_data"] ?>" class="image-ad" alt="Vehicle Image">
                </div>
                <div class="col-md-3 p-2 d-flex align-items-center justify-content-center">
                    <div class="row">
                        <h4><?= $listing["manufacturer"] ?> <?= $listing["model"] ?></h4>
                    </div>
                </div>
                <div class="col-md-5 p-4">
                    <div class="row">
                        <div class="col-md-6">
                            <p>Cena: <?= number_format($listing["price"]) ?>€</p>
                            <p>Palivo: <?= $listing["fuel"] ?></p>
                            <p>Výkon: <?= $listing["power"] ?> KW</p>
                            <p>Rok: <?= $listing["year"] ?></p>
                        </div>
                        <div class="col-md-6">
                            <p>Prevodovka: <?= $listing["transmission"] ?></p>
                            <p>Farba: <?= $listing["color"] ?></p>
                            <p>Nájazd: <?= $listing["mileage"] ?> KM</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p>Popis: <?= $listing["description"] ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <form action="./ad-detail.php" method="GET" class="ms-2">
                    <input type="hidden" name="listing_id" value="<?php echo $listing['listing_id'] ?>">
                    <button type="submit" class="btn btn-primary">Detail</button>
                </form>
                <form action="./ad-edit.php" method="GET" class="ms-2">
                    <input type="hidden" name="listing_id" value="<?php echo $listing['listing_id'] ?>">
                    <button type="submit" class="btn btn-outline-dark">Upraviť</button>
                </form>
                <form action="./ad-delete.php" method="GET" class="ms-2">
                    <input type="hidden" name="listing_id" value="<?php echo $listing['listing_id'] ?>">
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