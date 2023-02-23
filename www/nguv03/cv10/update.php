<?php
// pripojeni do db
require 'db.php';

require 'user_required.php';

// pristup jen pro admina
require 'admin_required.php';

$stmt = $db->prepare('SELECT * FROM products WHERE id = :id');
$stmt->execute([
    'id' => $_GET['id']
]);
$product = $stmt->fetch();

if (!$product) {
    exit('Unable to find product!');
}

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $stmt = $db->prepare('UPDATE products SET name = :name, description = :description, price = :price WHERE id = :id');
    $stmt->execute([
        'name' => $_POST['name'], 
        'description' => $_POST['description'], 
        'price' => (float) $_POST['price'], 
        'id' => $_POST['id']
    ]);

    header('Location: index.php');
}

?>

<?php require __DIR__ . '/incl/header.php' ?>
<main class="container">
    
    <h1>Update product</h1>

    <form class="form-signin" method="POST">
        <div class="form-label-group">
            <label for="name">Product name</label>
            <input name="name" class="form-control" placeholder="Name" required autofocus value="<?php echo $product['name']; ?>">
        </div>

        <div class="form-label-group">
            <label for="price">Price</label>
            <input name="price" class="form-control" placeholder="Price" required value="<?php echo $product['price']; ?>">
        </div>

        <div class="form-label-group">
            <label for="description">Description</label>
            <input name="description" class="form-control" placeholder="Description" required value="<?php echo $product['description']; ?>">
        </div>
        <input type="hidden" name="id" value="<?php echo $product['id'];?>'">
        <br>
        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Save</button> or <a href="index.php">Cancel</a>
    </form>
<div style="margin-bottom: 600px"></div>
<?php require __DIR__ . '/incl/footer.php' ?>
