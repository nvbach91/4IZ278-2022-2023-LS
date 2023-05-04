<?php require_once './ProductsDatabase.php'; ?>
<?php require './util.php'; ?>
<?php 
// var_dump($_POST)
$productDatabase = new ProductDatabase();


if (!empty($_POST)) {

    $name = htmlspecialchars(trim($_POST['name']));
    $price = htmlspecialchars(trim($_POST['price']));
    $image = htmlspecialchars(trim($_POST['image']));
    $category = (int) htmlspecialchars(trim($_POST['category']));
    
    $errors = checkInputValidity($name, $price, $image, $category);

    //insert to DB
    $productDatabase->createNewProduct($name, $price, $image, $category);
    // var_dump($productDatabase->createNewProduct("test", "13.48", "www.test.cz", 1));
    $message = urldecode('Product  successfully added.');
    header('Location: ./index.php?msg='.$message);
}
?>

<form method="POST" action="./create-item.php">
    <?php if (!empty($errors)): ?>
        <div>
            <?php foreach ($errors as $error): ?>
                <p><?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>Item successfully added.</p>
    <?php endif; ?>
    <div>
        <div>
            <label>Book name</label>
            <input name="name" value="<?php echo isset($name) ? $name : ""; ?>">
        </div>
        <div>
            <label>Price</label>
            <input name="price" value="<?php echo isset($price) ? $price : ""; ?>"> $
        </div>
        <div>
            <label>Image</label>
            <input name="image" value="<?php echo isset($image) ? $image : ""; ?>">
        </div>

        <label>Category</label>
        <select name="category">
            <option value="1" <?php echo isset($category) && $category == "1" ? ' selected' : ''; ?> >Fantasy</option>
            <option value="2" <?php echo isset($category) && $category == "2" ? ' selected' : ''; ?> >Fiction</option>
            <option value="3" <?php echo isset($category) && $category == "3" ? ' selected' : ''; ?> >Science Fiction</option>
        </select>
    </div>
    <button>Submit</button>
</form>