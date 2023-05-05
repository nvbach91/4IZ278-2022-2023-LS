<?php
session_start();
if (!isset($_SESSION["userType"])) header("Location: login.php");
if (empty($_SESSION["userType"]) || $_SESSION["userType"] < 2) {
    http_response_code(403);
    die();
}

require "db/ProductsDatabase.php";

$errors = [];
$desc = "";
$name = "";
$price = "";
$img = "";

if (!empty($_POST)) {
    $desc = htmlspecialchars(trim($_POST["desc"]));
    $name = htmlspecialchars(trim($_POST["name"]));
    $price = htmlspecialchars(trim($_POST["price"]));
    $img = htmlspecialchars(trim($_POST["img"]));

    if ($desc == "") $errors[] = "desc is empty";

    if ($name == "") $errors[] = "name is empty";

    if ($price == "") $errors[] = "price is empty";

    if (empty($errors)) {
        $productsDb = new ProductsDatabase();
        $productsDb->add($name, $desc, $price, $img);
    }
}

include "components/header.php";
?>
<main class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <?php if (!empty($errors)): ?>
                <div>
                    <?php foreach ($errors as $error): ?>
                        <p><?php echo $error ?></p>
                    <?php endforeach; ?>
                </div>
            <?php elseif (!empty($_POST)): ?>
                <div>Úspěšně přidáno.</div><br>
            <?php endif; ?>
            <form action="./create-item.php" method="POST">
                <label for="name">Název</label>
                <input id="name" name="name" type="text" value="<?php echo $name ?>">
                <br><br>
                <label for="desc">Popisek</label>
                <input id="desc" name="desc" type="text" value="<?php echo $desc ?>">
                <br><br>
                <label for="price">Cena</label>
                <input id="price" name="price" type="text" value="<?php echo $price ?>">
                <br><br>
                <label for="img">Obrázek (URL)</label>
                <input id="img" name="img" type="url" value="<?php echo $img ?>">
                <br><br>
                <button class="btn btn-outline-dark mt-auto">Přidat</button>
            </form>
        </div>
    </div>
</main>
<?php include "components/footer.php" ?>
