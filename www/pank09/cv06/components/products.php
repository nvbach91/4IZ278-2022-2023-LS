<div class="row">
<?php if (!$products): ?>
    <h3>Category doesn't contain any product.</h3>
<?php endif; ?>
<?php foreach($products as $product): ?>
    <div class="col-lg-3 col-md-4 mb-3">
        <div class="card h-100 product">
            <a href="#">
                <img class="card-img-top product-image" src="<?php echo $product['img']; ?>" alt="mango-product-image">
            </a>
            <div class="card-body">
                <h4 class="card-title"><a href="#"><?php echo $product['name']; ?></a></h4>
                <h5><?php echo number_format($product['price'], 2), ' ', 'Kč'; ?></h5>
            </div>
        </div>
    </div>
<?php endforeach; ?>
</div>