<?php if (!isset($_SESSION)) session_start(); ?>
<?php require_once './auth.php'; ?>
<?php if (requirePrivilege(1)) ?>
<?php require_once './AdDatabase.php'; ?>
<?php

$db = new AdDatabase();

if (!empty($_POST)) {
    $vehicleId = $db->createVehicle(
        $_POST['manufacturer'],
        $_POST['model'],
        $_POST['fuel'],
        $_POST['transmission'],
        $_POST['color'],
        $_POST['mileage'],
        $_POST['year'],
        $_POST['power'],
        $_POST['description']
    );

    $listingId = $db->createListing(
        $_SESSION['user']['user_id'],
        $vehicleId,
        $_POST['price'],
        0
    );

    if (!empty($_FILES['image']['tmp_name'])) {
        $imageData = file_get_contents($_FILES['image']['tmp_name']);
        $db->createImage($listingId, $imageData);
    }

    header('Location: ./ad-detail.php?listing_id=' . $listingId);
}

function uploadImage($file)
{
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($file["name"]);
    move_uploaded_file($file["tmp_name"], $targetFile);
    return $targetFile;
}
?>

<?php require './header.php' ?>
<?php require './navbar.php'; ?>

<form class="p-5 m-3" action="./ad-create.php" method="POST" enctype="multipart/form-data">
    <h4>Informácie o inzeráte</h4>
    <div class="row mb-3">
        <div class="col">
            <label class="form-label" for="manufacturer">Značka:</label>
            <input class="form-control" type="text" id="manufacturer" name="manufacturer">
        </div>
        <div class="col">
            <label class="form-label" for="model">Model:</label>
            <input class="form-control" type="text" id="model" name="model">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <label class="form-label" for="fuel">Palivo:</label>
            <input class="form-control" type="text" id="fuel" name="fuel">
        </div>
        <div class="col">
            <label class="form-label" for="transmission">Prevodovka:</label>
            <input class="form-control" type="text" id="transmission" name="transmission">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <label class="form-label" for="color">Farba:</label>
            <input class="form-control" type="text" id="color" name="color">
        </div>
        <div class="col">
            <label class="form-label" for="mileage">Nájazd:</label>
            <input class="form-control" type="text" id="mileage" name="mileage">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <label class="form-label" for="year">Rok:</label>
            <input class="form-control" type="text" id="year" name="year">
        </div>
        <div class="col">
            <label class="form-label" for="power">Výkon:</label>
            <input class="form-control" type="text" id="power" name="power">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <label class="form-label" for="description">Popis:</label>
            <textarea class="form-control" ea id="description" name="description"></textarea>
        </div>
        <div class="col">
            <label class="form-label" for="price">Cena:</label>
            <input class="form-control" type="text" id="price" name="price">
        </div>
    </div>
    <div class="row mb-3 px-2">
        <label class="form-label" for="image">Obrázok:</label>
        <input class="form-control" type="file" id="image" name="image">
    </div>
    <div class="row mb-3 mt-5">
        <input class="btn btn-primary" type="submit" value="Pridať inzerát">
    </div>
</form>


<?php require './footer.php' ?>