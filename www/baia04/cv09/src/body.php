<body>
    <div class='first_page'>
        <div class='main'>
            <div class="slider-container">
                <div class="menu">
                    <label for="slide-dot-1"></label>
                    <label for="slide-dot-2"></label>
                    <label for="slide-dot-3"></label>
                </div>
                <?php for ($i = 0; $i <= count($discountedProducts); $i++) : ?>
                    <input id="slide-dot-<?php echo $i; ?>" type="radio" name="slides" checked>
                    <div class="slide slide-<?php echo $i; ?>">
                        <p name='credo'> <?php echo $discountedProducts[$i][0]['name']; ?> </p>
                    </div>
                <?php endfor; ?>
            </div>

            <div class='main_text'>
                <div class='main_title'>
                    <h4>Tea Haven <br> Premium Lose-Leaf Teas </h4>
                </div>
                <br>
                <div class='main_p'>
                    <p>
                        At Tea Haven, we believe that a good cup of tea should not only taste great,
                        but also be good for you. That's why all of our teas are carefully selected and blended to provide a range
                        of health benefits, from boosting immunity to aiding digestion and reducing stress.
                    </p>
                </div>
                <br><br>
                <div class='products_btn'>
                    <a href='#section'>
                        <input type='button' value="Our Products" name='products'>
                    </a>
                </div>
            </div>
        </div>
        <img name='leaves' src='img/leaves.png'>
    </div>

    <div class='second_page'>
        <img name='leaves2' src='img/leaves.png'>
        <div class='pages'>
            <?php for ($i = 1; $i <= ceil($count / $itemsPerPage); $i++) { ?>
                <a class='page' ; href="./index.php?offset=<?php echo ($i - 1) * $itemsPerPage; ?>#section">
                    <?php echo $i; ?>
                </a>
            <?php } ?>
        </div>
        <a name='section'>
            <div class='main_menu'>
                <div class='menu_button'><a name='menu_text' href='.#section'>All Tea</a></div>
                <?php foreach ($categories as $category) : ?>
                    <div class='menu_button'>
                        <a name='menu_text' href='?category_id=<?php echo $category['category_id']; ?>#section'>
                            <?php echo $category['name'] ?>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class='cards'>
                <?php foreach ($products as $product) : ?>
                    <div class='card'>
                        <div class='card_image'>
                            <img name='card_image' src='img/product<?php echo $product['product_id'] ?>.png' width="217px">
                        </div>
                        <div class='card_title'>
                            <h5><?php echo $product['name'] ?></h5>
                        </div>
                        <div class='card_text'>
                            <?php echo $product['description'] ?>
                        </div>
                        <div class='price'>
                            <p><?php echo $product['price']; ?>.00$ </p>
                        </div>
                        <div class='card_button'>
                            <a href = './add.php?id=<?php echo $product['product_id'] ?>'>
                                <input type='button' name='card_button' value='Add to Cart'>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
</body>

</html>