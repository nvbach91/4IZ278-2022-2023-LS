<?php require_once './CategoriesDatabase.php'; ?>
<?php require_once './ProductsDatabase.php'; ?>
<?php

// /index.php?category_id=21
// $_GET = ['category_id' => 21]
// $category_id = $_GET['category_id'];

$productsDatabase = new ProductsDatabase();

if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
    $products = $productsDatabase->fetchByCategory($category_id);
} else {
    $products = $productsDatabase->fetchAll();
}

$categoriesDatabase = new CategoriesDatabase();
$categories = $categoriesDatabase->fetchAll();
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
    <h1>fantastic-shop.cz</h1>
    <h2>Categories</h2>
    <div>
        <?php foreach ($categories as $category) : ?>
            <a href="?category_id=<?php echo $category['category_id']; ?>">
                <?php echo $category['name']; /* ... */ ?>
            </a>&nbsp;
        <?php endforeach; ?>
    </div>
    <h2>Products</h2>
    <div>
        <?php foreach ($products as $product) : ?>
                <?php echo $product['name']; /* ... */ ?>
        <?php endforeach; ?>
    </div>
</body>

</html>