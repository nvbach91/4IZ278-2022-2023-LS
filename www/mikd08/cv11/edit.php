<?php
session_start();
require_once 'db.php';

if (!empty($_GET['good_id']) && empty($_POST)) {
    $statement = $pdo->prepare('SELECT * FROM cv09_goods WHERE good_id = :good_id');
    $statement->execute(['good_id' => $_GET['good_id']]);
    $item = $statement->fetch(PDO::FETCH_ASSOC);
    $_SESSION["last_update"] = $item["last_update"];
}



if (!empty($_POST) && !empty($_GET['good_id'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $good_id = $_GET['good_id'];

    $statement = $pdo->prepare("SELECT last_update FROM cv09_goods WHERE good_id = :good_id");
    $statement->execute(['good_id' => $good_id]);
    $last_update_verify = $statement->fetch(PDO::FETCH_ASSOC)["last_update"];

    if ($last_update_verify == $_SESSION["last_update"]) {
        $currTime = date('Y-m-d H:i:s', time());

        $statement = $pdo->prepare('UPDATE cv09_goods SET name = :name, price = :price, description = :description, last_update=:last_update WHERE good_id = :good_id');
        $statement->execute(['name' => $name, 'price' => $price, 'description' => $description, 'good_id' => $good_id, 'last_update' => $currTime]);

        unset($_SESSION["name"]);
        unset($_SESSION["price"]);
        unset($_SESSION["description"]);

        header('Location: eshop.php');
        exit;
    } else {
        $_SESSION["error"] = "Error: Your changes were not uploaded because the product was modified";
        
        $_SESSION["name"] = $_POST['name'];
        $_SESSION["price"] = $_POST['price'];
        $_SESSION["description"] = $_POST['description'];
        
        header("Location: $_SERVER[REQUEST_URI]");
        exit;
    }
}

?>


<?php require 'header.php'; ?>

    <?php if(isset($_SESSION["error"])): ?>
        <h2 style="color: red"><?php echo $_SESSION["error"]; unset($_SESSION["error"]); ?></h2>
    <?php endif; ?>

    <h1>Edit</h1>
    <?php if (isset($item)) : ?>
        <form action="./edit.php?good_id=<?php echo $item['good_id']; ?>" method="post">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="<?php echo isset($_SESSION["name"]) ? $_SESSION["name"] : $item['name']; ?>" required>
            <br>
            <label for="price">Price:</label>
            <input type="text" name="price" id="price" value="<?php echo isset($_SESSION["price"]) ? $_SESSION["price"] : $item['price']; ?>" required>
            <br>
            <label for="description">Description:</label>
            <textarea name="description" id="description" required><?php echo isset($_SESSION["description"]) ? $_SESSION["description"] : $item['description']; ?></textarea>
            <br>
            <button class="btn btn-outline-primary" type="submit">Update Item</button>
        </form>
    <?php else : ?>
        <p style="color:red; font-size: 3em;">Unknown item.</p>
    <?php endif ?>
</body>

<?php require 'footer.php'; ?>