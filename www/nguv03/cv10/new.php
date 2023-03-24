<?php
// pripojeni do db
require 'db.php';

// pristup jen pro prihlaseneho uzivatele
require 'user_required.php';

// pristup jen pro admina
require 'admin_required.php';

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $stmt = $db->prepare('INSERT INTO cv10_products(name, description, price, img) VALUES (?, ?, ?, ?)');
    $stmt->execute([$_POST['name'], $_POST['description'], $_POST['price'], $_POST['img']]);

    header('Location: index.php');
}

?>

<?php require __DIR__ . '/incl/header.php' ?>
<main class="container">
    <h1>Create new product</h1>
    
    <form class="form-signin" method="POST">
        <div class="form-label-group">
            <label for="name">Product name</label>
            <input name="name" class="form-control" placeholder="Name" required autofocus>
        </div>

        <div class="form-label-group">
            <label for="price">Price</label>
            <input type="number" name="price" class="form-control" placeholder="Price" required>
        </div>

        <div class="form-label-group">
            <label for="description">Description</label>
            <input name="description" class="form-control" placeholder="Description" required>
        </div>
        <div class="form-label-group">
            <label for="img">Img</label>
            <input name="img" class="form-control" placeholder="Image URL" required>
        </div>
        <br>
        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Save</button> or <a href="index.php">Cancel</a>
    </form>
</main>
<div style="margin-bottom: 600px"></div>
<?php require __DIR__ . '/incl/footer.php' ?>
