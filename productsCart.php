<div class="containerOurProducts">
    <?php
    $cartAmount = 0;
    $totalCart = 0;
    if (isset($_SESSION['cart_list'])) : ?>
    <?php

   

        foreach (array_unique($_SESSION['cart_list'], SORT_REGULAR) as $productArray) :
            $productAmount = 0;
            foreach ($productArray as $product) {
                foreach ($_SESSION['cart_list'] as $value) {
                    foreach ($value as $value2) {
                        if ($value2 == $product) {
                            $productAmount++;
                        }
                    }
                }
            }
          
    ?>
            <div class="productBox">
                <div class="productImg">
                    <img src='<?php echo $product['img_link'] ?>'>
                </div>
                <div class='productTitle'>
                    <h2><?php echo $product['product_name'] ?></h2>
                </div>
                <div class='productPrice'>
                    <h2><?php if ($product['discount'] > 0) {
                    $product['price'] = (($product['price']) - ($product['price'] * $product['discount'] / 100));
                    echo 'SALE PRICE: ' .$product['price'];
                } else {
                    echo $product['price'];
                } 
                $totalProduct= $product['price']*$productAmount;
                ?> kČ</h2>
                </div>
                <div class='productDescription'>
                    <p>Lorem ipsum !Lorem ipsum !Lorem ipsum !Lorem ipsum !Lorem ipsum !Lorem ipsum !Lorem ipsum !Lorem ipsum !Lorem ipsum !Lorem ipsum !Lorem ipsum !</p>
                </div>
                <div class="buyButtonDiv">
                    <button><?php echo 'Amount:'.$productAmount.', Total:'.$totalProduct; ?></button>
                </div>
            
            </div>
    <?php
      
            $cartAmount += $productAmount;
            $totalCart += $totalProduct;
    endforeach;
endif;

    ?>
</div>
<div style="display: none" id="cartAmount">
    <?php 
    echo $cartAmount;
    $_SESSION['totalCart'] = $totalCart;
    $_SESSION['cartAmount'] = $cartAmount; 

    ?>
</div>