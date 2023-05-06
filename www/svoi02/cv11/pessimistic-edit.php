<?php require_once './ProductsDatabase.php'; ?>
<?php require './util.php'; ?>
<?php
session_start();




$productDatabase = new ProductDatabase();
if (!empty($_GET)) {
    $id = $_GET['product_id'];
        
    $product = $productDatabase->fetchById([$id], '?');
    if (!$product) {
        exit();
    }

    if (isset($product[0]['last_edit_by']) && time() - strtotime($product[0]['last_edit']) < 60 * 5 && $_SESSION['user_id'] != $product[0]['last_edit_by']) {
        $message = urldecode('This product in currently being edited by someone else.');
        header('Location: ./index.php?delete=' . $message);
        exit();
    }

    $productDatabase->pessimisticEdit($id, $_SESSION['user_id']);
}

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    
    $name = htmlspecialchars(trim($_POST['name']));
    $price = htmlspecialchars(trim($_POST['price']));
    $image = htmlspecialchars(trim($_POST['image']));
    $category = (int) htmlspecialchars(trim($_POST['category']));
    
    $errors = checkInputValidity($name, $price, $image, $category);

    if (empty($errors)) {
        
        $productDatabase->editProduct($name, $price, $image, $category, $id);
        $message = urldecode('Product info successfully updated.');
        header('Location: ./index.php?msg=' . $message);
    }
    
}

$_SESSION[$product[0]['product_id'] . '_last_edit'] = $product[0]['last_edit'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body>
    <?php require './CategoryDisplay.php'; ?>
    <form method="POST">
    <?php if (!empty($errors)): ?>
        <div class="error-container">
            <?php foreach ($errors as $error): ?>
                <p><?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
    <?php endif; ?>
    <div>
        <div>
            <label>Book name</label>
            <input name="name" value="<?php echo isset($product[0]['name']) ? $product[0]['name'] : '' ?>">
        </div>
        <div>
            <label>Price</label>
            <input name="price" value="<?php echo isset($product[0]['price']) ? $product[0]['price'] : '' ?>"> $
        </div>
        <div>
            <label>Image</label>
            <input name="image" value="<?php echo isset($product[0]['img']) ? $product[0]['img'] : '' ?>">
        </div>

        <label>Category</label>
        <select name="category">
            <option value="1" <?php echo isset($product[0]['category']) && $product[0]['category_id'] == "1" ? ' selected' : ''; ?> >Fantasy</option>
            <option value="2" <?php echo isset($product[0]['category']) && $product[0]['category_id'] == "2" ? ' selected' : ''; ?> >Fiction</option>
            <option value="3" <?php echo isset($product[0]['category']) && $product[0]['category_id'] == "3" ? ' selected' : ''; ?> >Science Fiction</option>
        </select>
    </div>
    <input type="hidden" name="product_id" value="<?php echo $product[0]['product_id']; ?>">
    <br>
    <button>Edit</button>
</form>
</body>
</html>


