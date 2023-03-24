<?php
// pripojeni do db
require 'db.php';

require 'user_required.php';

// pristup jen pro admina
require 'admin_required.php';

$stmt = $db->prepare('SELECT * FROM cv10_products WHERE product_id = :product_id');
$stmt->execute([
    'product_id' => $_GET['product_id']
]);
$product = $stmt->fetch();

if (!$product) {
    exit('Unable to find product!');
}

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    var_dump($_POST);
    $stmt = $db->prepare('UPDATE cv10_products SET name = :name, description = :description, price = :price WHERE product_id = :product_id');
    $stmt->execute([
        'name' => $_POST['name'], 
        'description' => $_POST['description'], 
        'price' => $_POST['price'], 
        'product_id' => $_POST['product_id']
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
        <div class="form-label-group">
            <label for="img">Image</label>
            <input name="img" class="form-control" placeholder="Image" required value="<?php echo $product['img']; ?>">
        </div>
        <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
        <br>
        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Save</button> or <a href="index.php">Cancel</a>
    </form>
<div style="margin-bottom: 600px"></div>
<?php require __DIR__ . '/incl/footer.php' ?>
