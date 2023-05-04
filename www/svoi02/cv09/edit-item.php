<?php require_once './ProductsDatabase.php'; ?>
<?php require './util.php'; ?>
<?php



$productDatabase = new ProductDatabase();
if (!empty($_GET)) {
    $id = $_GET['product_id'];
        
    $product = $productDatabase->fetchById([$id], '?');

    if (!$product) {
        exit;
    }
}

if ('POST' == $_SERVER['REQUEST_METHOD']) {

    var_dump($_POST['name']);
    
    $name = htmlspecialchars(trim($_POST['name']));
    $price = htmlspecialchars(trim($_POST['price']));
    $image = htmlspecialchars(trim($_POST['image']));
    $category = (int) htmlspecialchars(trim($_POST['category']));
    
    $errors = checkInputValidity($name, $price, $image, $category);
    var_dump("HERE");

    var_dump($productDatabase->editProduct($name, $price, $image, $category, $id));

    $message = urldecode('Product info successfully updated.');
    header('Location: ./index.php?msg='.$message);
}

?>
<form method="POST">
    <?php if (!empty($errors)): ?>
        <div>
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
