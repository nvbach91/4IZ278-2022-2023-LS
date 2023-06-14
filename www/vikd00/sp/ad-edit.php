<?php if (!isset($_SESSION)) session_start(); ?>
<?php require_once './auth.php'; ?>
<?php if (requirePrivilege(1)) ?>
<?php require_once './AdDatabase.php'; ?>
<?php

$db = new AdDatabase();

if (isset($_POST['update'])) {
    if (isset($_POST['listing_id'])) {
        $listingId = $_POST['listing_id'];
        $db->unlockAd($listingId);
        $db->updateVehicle(
            $_POST['manufacturer'],
            $_POST['model'],
            $_POST['fuel'],
            $_POST['transmission'],
            $_POST['color'],
            $_POST['mileage'],
            $_POST['year'],
            $_POST['power'],
            $_POST['description'],
            $listingId
        );
        $db->updateAd(
            $listingId,
            $_POST['price'],
            isset($_POST['spotlight']) ? 1 : 0
        );

        if (!empty($_FILES['image']['tmp_name'])) {
            $imageData = file_get_contents($_FILES['image']['tmp_name']);
            $db->updateImage($listingId, $imageData);
        }
        header('Location: ./ad-detail.php?listing_id=' . $listingId);
        exit();
    }
}

if (isset($_GET['listing_id'])) {
    $listingId = $_GET['listing_id'];
    $lock = $db->checkLock($listingId);
    $lock = $db->checkLock($listingId);
    if ($lock) {
        if ($lock['edit_user_id'] != $_SESSION['user']['user_id']) {
            echo "This record is currently being edited by another user. Please try again later.";
            exit();
        }
    } else {
        $db->lockAd($listingId, $_SESSION['user']['user_id']);
    }

    $listing = $db->getListingById($listingId);
}
?>

<?php require './header.php' ?>
<?php require './navbar.php'; ?>

<form class="p-5 m-3" action="./ad-edit.php" method="POST" enctype="multipart/form-data">
    <div class="w-100 pt-2 pb-5">
        <div class="bg-dark w-100 d-flex justify-content-center">
            <img src="<?= htmlspecialchars($listing["images"][0]["image_data"]) ?>" class="image-large" alt="Vehicle Image">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <label class="form-label" for="manufacturer">Značka:</label>
            <input class="form-control" type="text" id="manufacturer" name="manufacturer" value="<?php echo htmlspecialchars($listing['manufacturer']); ?>">
        </div>
        <div class="col">
            <label class="form-label" for="model">Model:</label>
            <input class="form-control" type="text" id="model" name="model" value="<?php echo htmlspecialchars($listing['model']); ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <label class="form-label" for="fuel">Palivo:</label>
            <select class="form-control" id="fuel" name="fuel">
                <option value="">Vyberte druh paliva</option>
                <option value="Benzín" <?php if ($listing['fuel'] === 'Benzín') echo 'selected'; ?>>Benzín</option>
                <option value="Nafta" <?php if ($listing['fuel'] === 'Nafta') echo 'selected'; ?>>Nafta</option>
                <option value="Hybrid" <?php if ($listing['fuel'] === 'Hybrid') echo 'selected'; ?>>Hybrid</option>
                <option value="Elektro" <?php if ($listing['fuel'] === 'Elektro') echo 'selected'; ?>>Elektro</option>
            </select>
        </div>
        <div class="col">
            <label class="form-label" for="transmission">Prevodovka:</label>
            <select class="form-control" id="transmission" name="transmission">
                <option value="">Vyberte typ prevodovky</option>
                <option value="Manuálna" <?php if ($listing['transmission'] === 'Manuálna') echo 'selected'; ?>>Manuálna</option>
                <option value="Automatická" <?php if ($listing['transmission'] === 'Automatická') echo 'selected'; ?>>Automatická</option>
            </select>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <label class="form-label" for="color">Farba:</label>
            <input class="form-control" type="text" id="color" name="color" value="<?php echo htmlspecialchars($listing['color']); ?>">
        </div>
        <div class="col">
            <label class="form-label" for="mileage">Nájazd:</label>
            <input class="form-control" type="text" id="mileage" name="mileage" value="<?php echo htmlspecialchars($listing['mileage']); ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <label class="form-label" for="year">Rok:</label>
            <input class="form-control" type="text" id="year" name="year" value="<?php echo htmlspecialchars($listing['year']); ?>">
        </div>
        <div class="col">
            <label class="form-label" for="power">Výkon:</label>
            <input class="form-control" type="text" id="power" name="power" value="<?php echo htmlspecialchars($listing['power']); ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <label class="form-label" for="description">Popis:</label>
            <textarea class="form-control" id="description" name="description"><?php echo htmlspecialchars($listing['description']); ?></textarea>
        </div>
        <div class="col">
            <label class="form-label" for="price">Cena:</label>
            <input class="form-control" type="text" id="price" name="price" value="<?php echo htmlspecialchars($listing['price']); ?>">
        </div>
    </div>
    <?php if (isAdmin()) : ?>
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="spotlight" name="spotlight" value="1" <?php if ($listing['spotlight']) echo 'checked'; ?>>
            <label class="form-check-label" for="spotlight">Spotlight</label>
        </div>
    <?php endif; ?>
    <div class="row mb-3 px-2">
        <label class="form-label" for="image">Obrázok:</label>
        <input class="form-control" type="file" id="image" name="image" onchange="previewImage(this);" </div>
        <button type="submit" class="btn btn-primary mt-2" name="update">Uložiť</button>
        <input hidden class="btn btn-primary" name="listing_id" value="<?php echo $listingId ?>">
</form>

<?php require './footer.php' ?>

<script>
    function previewImage(input) {
        var preview = document.querySelector('.image-large');
        var file = input.files[0];
        var reader = new FileReader();

        reader.onloadend = function() {
            preview.src = reader.result;
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = "placeholder-image.jpg";
        }
    }
</script>