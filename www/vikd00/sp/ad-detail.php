<?php if (!isset($_SESSION)) session_start(); ?>
<?php require_once './auth.php'; ?>
<?php require_once './AdDatabase.php'; ?>
<?php

$db = new AdDatabase();
$listingId = 1;

if (!empty($_GET['listing_id'])) {
    $listingId = $_GET['listing_id'];
    $listing = $db->getListingById($listingId);
}

if (!$listing) {
    header('Location: /index.php');
}
?>

<?php require './header.php' ?>
<?php require './navbar.php'; ?>

<div class="p-5 m-3">
    <div class="w-100 pt-2 pb-5">
        <div class="bg-dark w-100 d-flex justify-content-center">
            <img src="<?= $listing["images"][0]["image_data"] ?>" class="image-large" alt="Vehicle Image">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <label class="form-label" for="manufacturer">Značka:</label>
            <input disabled class="form-control" type="text" id="manufacturer" name="manufacturer" value="<?php echo htmlspecialchars($listing['manufacturer']); ?>" readonly>
        </div>
        <div class="col">
            <label class="form-label" for="model">Model:</label>
            <input disabled class="form-control" type="text" id="model" name="model" value="<?php echo htmlspecialchars($listing['model']); ?>" readonly>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <label class="form-label" for="fuel">Palivo:</label>
            <select class="form-control" id="fuel" name="fuel" disabled readonly>
                <option value="Benzín" <?php if ($listing['fuel'] === 'Benzín') echo 'selected'; ?>>Benzín</option>
                <option value="Nafta" <?php if ($listing['fuel'] === 'Nafta') echo 'selected'; ?>>Nafta</option>
                <option value="Hybrid" <?php if ($listing['fuel'] === 'Hybrid') echo 'selected'; ?>>Hybrid</option>
                <option value="Elektro" <?php if ($listing['fuel'] === 'Elektro') echo 'selected'; ?>>Elektro</option>
            </select>
        </div>
        <div class="col">
            <label class="form-label" for="transmission">Prevodovka:</label>
            <select class="form-control" id="transmission" name="transmission" disabled readonly>
                <option value="Manuálna" <?php if ($listing['transmission'] === 'Manuálna') echo 'selected'; ?>>Manuálna</option>
                <option value="Automatická" <?php if ($listing['transmission'] === 'Automatická') echo 'selected'; ?>>Automatická</option>
            </select>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <label class="form-label" for="color">Farba:</label>
            <input disabled class="form-control" type="text" id="color" name="color" value="<?php echo htmlspecialchars($listing['color']); ?>" readonly>
        </div>
        <div class="col">
            <label class="form-label" for="mileage">Nájazd:</label>
            <input disabled class="form-control" type="text" id="mileage" name="mileage" value="<?php echo htmlspecialchars($listing['mileage']); ?>" readonly>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <label class="form-label" for="year">Rok:</label>
            <input disabled class="form-control" type="text" id="year" name="year" value="<?php echo htmlspecialchars($listing['year']); ?>" readonly>
        </div>
        <div class="col">
            <label class="form-label" for="power">Výkon:</label>
            <input disabled class="form-control" type="text" id="power" name="power" value="<?php echo htmlspecialchars($listing['power']); ?>" readonly>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <label class="form-label" for="description">Popis:</label>
            <textarea class="form-control" id="description" name="description" readonly><?php echo htmlspecialchars($listing['description']); ?></textarea>
        </div>
        <div class="col">
            <label class="form-label" for="price">Cena:</label>
            <input disabled class="form-control" type="text" id="price" name="price" value="<?php echo htmlspecialchars($listing['price']); ?>" readonly>
        </div>
    </div>
    <?php if (isLoggedIn() && $listing['user_id'] != $_SESSION['user']['user_id']) : ?>
        <div class="row mb-3 mt-5">
            <div class="col-md-12 d-flex justify-content-end">
                <form action="./chat.php" method="GET" id="chatForm">
                    <input type="hidden" name="reciever_id" value="<?= $listing['user_id'] ?>">
                    <input type="hidden" name="listing_id" value="<?= $listing['listing_id'] ?>">
                    <button type="submit" class="btn btn-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-left-dots" viewBox="0 0 16 16">
                            <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                            <path d="M5 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                        </svg>
                        Kontakt
                    </button>
                </form>
            </div>
        </div>
    <?php endif; ?>
    <?php if (isLoggedIn() && $listing['user_id'] == $_SESSION['user']['user_id']) : ?>
        <div class="d-flex justify-content-end">
            <form action="./ad-edit.php" method="GET" class="ms-2">
                <input type="hidden" name="listing_id" value="<?php echo $listing['listing_id'] ?>">
                <button type="submit" class="btn btn-outline-dark">Upraviť</button>
            </form>
            <form action="./ad-delete.php" method="GET" class="ms-2">
                <input type="hidden" name="listing_id" value="<?php echo $listing['listing_id'] ?>">
                <button type="submit" class="btn btn-danger" onclick="return confirmDelete()">Zmazať</button>
            </form>
        </div>
    <?php endif; ?>
</div>

<?php require './footer.php' ?>