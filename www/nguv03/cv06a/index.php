<?php require './ProductsDatabase.php'; ?>
<?php require './CategoriesDatabase.php'; ?>
<?php


$productDatabase = new ProductsDatabase();
if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
    $products = $productDatabase->fetchByCategory($category_id);
} else {
    $products = $productDatabase->fetchAll();
}


$categoriesDatabase = new CategoriesDatabase();
$categories = $categoriesDatabase->fetchAll();


// var_dump($products);
// var_dump($categories);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>E-commerce site</h1>
    <h2>Categories</h2>
    <?php foreach($categories as $category): ?>
        <div class="product">
            <a href="./?category_id=<?php echo $category['category_id']?>">
                <?php echo $category['name']; ?>
            </a>
        </div>
    <?php endforeach; ?>
    <br>
    <h2>Products</h2>
    <?php foreach($products as $product): ?>
        <div class="product"><?php echo $product['name']; ?></div>
    <?php endforeach; ?>

    
</body>
</html>