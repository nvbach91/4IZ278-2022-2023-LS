<?php
    $products = [];

    if (isset($_SESSION['cart']) && is_array($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        require_once __DIR__ . '/../classes/ProductsDB.php';
    
        $productsDatabase = new ProductsDB;
        $products = $productsDatabase->fetchByIds(array_keys($_SESSION['cart']));
    }
?>

<div style="min-height: calc(100vh - 180px);">
    <a href="index.php">Back to shopping</a>

    <h1 class="mt-4 mb-5">My shopping cart (<?php echo count($products) ?>)</h1>

    <?php if (!$products): ?>
        <h3>Empty</h3>
    <?php endif; ?>

    <div class="row">
    <?php foreach($products as $product): ?>
        <div class="col-lg-4 col-md-4 mb-3">
            <div class="card h-100 product">
                <a href="#">
                    <img class="card-img-top" src="<?php echo $product['img']; ?>" alt="mango-product-image">
                </a>
                <div class="card-body">
                    <h4 class="card-title"><a href="#"><?php echo $product['name']; ?></a></h4>
                    <p class="card-text"><?php echo $product['description']; ?></p>
                    <h5><?php echo number_format($product['price'], 2), ' ', 'Kč'; ?></h5>
                    <div class="row">
                        <div class="col">
                            <a class="btn btn-danger card-link" href="<?php echo sprintf('cart-remove-from.php?id=%s', $product['good_id']); ?>">Remove</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
</div>