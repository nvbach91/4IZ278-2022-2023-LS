<?php require_once './ProductsDatabase.php'; ?>
<?php
session_start();
$productDatabase = new ProductDatabase();

if ($_SESSION) {
    $productIds = $_SESSION['selected_products'];
    if (is_array($productIds) && !empty($productIds)) {
        $questionMarks = str_repeat('?,', count($productIds) - 1) . '?';
    
        $cartProducts = $productDatabase->fetchById($productIds, $questionMarks);
        
    }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body>
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <h1>Cart</h1>
            <a href="./index.php" class="btn btn-outline-dark login">Home</a>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php if (!empty($cartProducts)) : ?>
                <?php foreach($cartProducts as $product): ?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 product">
                            <a href="#">
                                <img class="card-img-top product-image" src="<?php echo $product['img']; ?>" alt="mango-product-image">
                            </a>
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a href="#"><?php echo $product['name']; ?></a>
                                </h4>
                                <h5><?php echo number_format($product['price'], 2), ' ', "$"; ?></h5>
                                <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium, aliquam. Explicabo, iste eaque? Placeat libero quidem reprehenderit.</p>
                            </div>
                            <form class="d-flex" action="remove-item.php" method="POST">
                                <input class="d-none" name="product_id" value="<?php echo $product['product_id'] ?>">
                                <button class="btn btn-outline-dark login" type="submit">Remove from cart</button>
                            </form>
                            <div class="card-footer">
                                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div>The cart is empty</div>
                <?php endif; ?>
        </div>
        </div>
    </section>
</body>
</html>