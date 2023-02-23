<?php 
// OPTIMISTIC UPDATE LOCK

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
    exit(404);
}

if ('POST' == $_SERVER['REQUEST_METHOD']) {

    $stmt = $db->prepare('SELECT last_updated_at FROM products WHERE id = :id');
    $stmt->execute([ 'id' => $_GET['id']]);
    $last_updated_at = $stmt->fetchColumn();

    if ($_SESSION[$_GET['id'] . '_last_updated_at'] != $last_updated_at) {
        # tady by idealne mel byt navrat na formular s oznacenymi daty, 
        # co se zmenilo a nabidnout prepis nebo ponechani dat, nebo zobrazit rozdily
        # pro zjednoduseni ted jen umiram
        die ("The product was updated by someone else in the meantime!");
    }
    $stmt = $db->prepare("
        UPDATE products SET name = :name, 
                            description = :description, 
                            price = :price, 
                            last_updated_at = now() 
                        WHERE id = :id");
    $stmt->execute([
        'name' => $_POST['name'], 
        'description' => $_POST['description'], 
        'price' => (float) $_POST['price'], 
        'id' => $_POST['id']
    ]);

    header('Location: index.php');
}

$_SESSION[$product['id'] . '_last_updated_at'] = $product['last_updated_at'];

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
        <!--input type="hidden" name="last_updated_at" value="<?php echo $product['last_updated_at']; ?>"-->
        <!--input name="last" value="<?php echo $_SESSION[$product['id'] . '_last_updated_at'];?>"-->
        <input type="hidden" name="id" value="<?php echo $product['id'];?>">
        <br>
        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Save</button> or <a href="index.php">Cancel</a>
    </form>
<div style="margin-bottom: 600px"></div>
<?php require __DIR__ . '/incl/footer.php' ?>

























<?php /*
// PESSIMISTIC UPDATE LOCK
// pripojeni do db
require 'db.php';

require 'user_required.php';

// pristup jen pro admina
require 'admin_required.php';

# vypocet zamku: sloupec edit_expired je boolean a je true, pokud uz zamek vyprsel (=je starsi vic nez 5 minut)
$stmt = $db->prepare("
SELECT 
    products.*, 
    users.email, 
    now() > last_update_started_at + INTERVAL 5 MINUTE AS edit_expired 
FROM 
    products LEFT JOIN users ON 
        users.id = products.last_update_started_by 
WHERE 
    products.id = :id");

$stmt->execute([
    'id' => $_GET['id']
]);
$product = $stmt->fetch();

if (!$product) {
    exit('Unable to find product!');
}
if (
    isset($product['last_update_started_by']) &&                  # zbozi je prave upravovano
    $product['last_update_started_by'] != $current_user['id'] &&  # jinym uzivatelem, nez jsem ja
    !$product['edit_expired']                                     # a zacatek upravy jeste neni 5 minut (zamek jeste nevyprsel)
) {
    exit('The product is currently edited by ' . $product['email'] . '. You must wait until they finish.');
}

# pokud zaznam neni zamknuty k uprave (nebo zamek vyprsel), nastavime novy zamek
$stmt = $db->prepare("UPDATE products SET last_update_started_at = now(), last_update_started_by = :user_id WHERE id = :id");
$stmt->execute([
    'user_id' => $current_user['id'], 
    'id' => $_GET['id']
]);

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $stmt = $db->prepare('
        UPDATE products 
        SET 
            name = :name, 
            description = :description, 
            price = :price, 
            last_update_started_by = NULL, 
            last_update_started_at = NULL
        WHERE id = :id');
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
        <input type="hidden" name="id" value="<?php echo $product['id'];?>">
        <input name="idu" value="<?php echo $current_user['id'];?>">
        <input name="ids" value="<?php echo $product['last_update_started_by'];?>">
        <br>
        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Save</button> or <a href="index.php">Cancel</a>
    </form>
<div style="margin-bottom: 600px"></div>
<?php require __DIR__ . '/incl/footer.php' ?>

*/ ?>