<?php
foreach ($products as $product) : ?>
    <div class="productBox">
        <div class="productImg">
            <img src='<?php echo $product['img_link'] ?>'>
        </div>
        <div class='productTitle'>
            <h2><?php echo $product['product_name'] ?></h2>
        </div>
        <div class='productPrice'>
            <h2><?php
                if ($product['discount'] > 0) {
                    $product['price'] = (($product['price']) - ($product['price'] * $product['discount'] / 100));
                    echo 'SALE PRICE: ' .$product['price'];
                } else {
                    echo $product['price'];
                } ?> kČ</h2>
        </div>
        <div class='productDescription'>
            <p>Lorem ipsum !Lorem ipsum !Lorem ipsum !Lorem ipsum !Lorem ipsum !Lorem ipsum !Lorem ipsum !Lorem ipsum !Lorem ipsum !Lorem ipsum !Lorem ipsum !</p>
        </div>
        <div class='buyButtonDiv'>
            <button class="buyButton" name="buyButton" data-id="<?php echo $product['product_id'] ?>">Buy</button>
        </div>
    </div>
<?php endforeach ?>