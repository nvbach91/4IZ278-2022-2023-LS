<?php
    require_once __DIR__ . '/../classes/ProductsDB.php';

    $limit = 6;
    $offset = $_GET['offset'] ?? 0;

    $productsDatabase = new ProductsDB;
    $products = $productsDatabase->fetchAll($offset, $limit);
    $productsPages = $productsDatabase->getTotalPages($limit);
?>

<?php if ($authUser && $authUser->privilege > 1): ?>
    <a class="btn btn-primary card-link my-3" href="item-create.php">Add new good</a>
<?php endif; ?>

<div class="row">
<?php if (!$products): ?>
    <h3>No products.</h3>
<?php endif; ?>
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
                        <a class="btn btn-primary btn-block card-link" href="<?php echo sprintf('cart-add-to.php?id=%s', $product['good_id']); ?>">Buy</a>
                    </div>
                    <?php if ($authUser && $authUser->privilege > 1): ?>
                    <div class="col">
                        <a class="btn btn-info btn-block card-link" href="<?php echo sprintf('item-edit.php?id=%s', $product['good_id']); ?>">Edit</a>
                    </div>
                    <div class="col">
                        <a class="btn btn-danger btn-block card-link" href="<?php echo sprintf('item-delete.php?id=%s', $product['good_id']); ?>">Delete</a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
</div>

<nav aria-label="Page navigation example">
    <ul class="pagination">
    <?php for($i = 0; $i < $productsPages; $i++): ?>
        <li class=" page-item <?php echo ($offset == $limit * $i) ? 'active' : ''; ?>">
            <a class="page-link" href="<?php echo sprintf("./?offset=%d", $limit * $i); ?>">
            <?php echo $i + 1; ?>
            </a>
        </li>
    <?php endfor; ?>
    </ul>
</nav>