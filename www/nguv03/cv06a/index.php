<?php


DEFINE('DATABASE_URL', 'localhost');
DEFINE('DATABASE_NAME', 'nguv03');
DEFINE('DATABASE_USERNAME', 'nguv03');
DEFINE('DATABASE_PASSWORD', 'ny;W7pqYwamf(@&ufA');


$pdo = new PDO(
    'mysql:host=' . DATABASE_URL .
        ';dbname=' . DATABASE_NAME . ';charset=utf8mb4',
    DATABASE_USERNAME,
    DATABASE_PASSWORD
);

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$category_id = '';
if (!empty($_GET)) {
    $category_id = $_GET['category_id'];
}

$sql = "SELECT * FROM cv06_products 
        WHERE category_id = :category_id;";
$statement = $pdo->prepare($sql);
$statement->execute([
    'category_id' => $category_id,
]);
$products = $statement->fetchAll();


$sql = "SELECT * FROM cv06_categories;";
$statement = $pdo->prepare($sql);
$statement->execute();
$categories = $statement->fetchAll();

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
    <div class="menu">
        <?php foreach ($categories as $category) : ?>
            <a href="?category_id=<?php echo $category['category_id']; ?>">
                <?php echo $category['name'] . ' (' . $category['category_id'] . ')'; ?>
            </a>
        <?php endforeach; ?>
    </div>
    <div class="products">
        <?php foreach ($products as $product) : ?>
            <div class="product">
                <div class="product-name"><?php echo $product['name']; ?></div>
                <div class="product-price"><?php echo $product['price']; ?> CZK</div>
                <div class="product-price"><?php echo $product['category_id']; ?></div>
            </div>
        <?php endforeach; ?>

    </div>
</body>

</html>