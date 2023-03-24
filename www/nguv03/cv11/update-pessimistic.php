<?php
// pripojeni do db
require 'db.php';

require 'user_required.php';

// pristup jen pro admina
require 'admin_required.php';

$stmt = $db->prepare('SELECT * FROM cv11_products WHERE product_id = :product_id');
$stmt->execute([
    'product_id' => $_GET['product_id']
]);
$product = $stmt->fetch();

if (!$product) {
    exit('Unable to find product!');
}

$pessimisticLockTime = 30;

// pokud nekdo zrovna edituje (otevrel editacni stranku pred nami)
//      pokud to nejsem ja
//          pokud je stale aktivni
//              neotevreme editacni stranku
// pokud nic neplati tak otevru editaci

if ($product['edit_by']) {
    if ($product['edit_by'] != $_COOKIE['user_id']) {
        if (time() - time($product['opened_at']) < 30 * 60) {
            exit("Some else is still editing this record");
        }
    }
}


$sql = "UPDATE cv11_products SET edited_by = :user_id, opened_at = now() WHERE product_id = :product_id;";
$stmt = $db->prepare($sql);
$stmt ->execute([
    'user_id' => $_COOKIE['user_id'],
    'product_id' => $_GET['product_id'],
]);





if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $stmt = $db->prepare('UPDATE cv11_products SET name = :name, description = :description, price = :price WHERE product_id = :product_id');
    $stmt->execute([
        'name' => $_POST['name'], 
        'description' => $_POST['description'], 
        'price' => (float) $_POST['price'], 
        'product_id' => $_POST['product_id']
    ]);
    
    

    $sql = "UPDATE cv11_products SET edited_by = :user_id, opened_at = :opened_at WHERE product_id = :product_id;";
    $stmt = $db->prepare($sql);
    $stmt ->execute([
        'user_id' => null,
        'opened_at' => null,
        'product_id' => $_GET['product_id'],
    ]);


    header('Location: index.php');
}

// table users 
//  id      name    privilege
//  10      nguv03          3

// table products
//  id   name   price   img    edited_by    opened_at
//   1   Abc    10.00   url                          


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
        <input type="hidden" name="product_id" value="<?php echo $product['product_id'];?>'">
        <br>
        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Save</button> or <a href="index.php">Cancel</a>
    </form>
<div style="margin-bottom: 600px"></div>
<?php require __DIR__ . '/incl/footer.php' ?>
