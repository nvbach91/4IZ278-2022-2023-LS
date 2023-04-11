
<body>
    <div class = 'first_page'>
        <div class = 'header'>
            <div class = 'icon'><img src = 'img/logo.png' name = 'icon'></div>
            <div class = 'nav_bar'>
                <a href = 'index.php' name = 'nav'>Products</a>
                <a href = '#' name = 'nav'>About</a>
                <a href = '#' name = 'nav'>Contact</a>
                <a href = '#' name = 'nav'>Help</a>
            </div>
        </div>
        <div class = 'main'>
            <div class="slider-container">
                <div class="menu">
                    <label for="slide-dot-1"></label>
                    <label for="slide-dot-2"></label>
                    <label for="slide-dot-3"></label>
                </div>
                <?php for ($i = 0; $i <= count($discountedProducts); $i++): ?>
                <input id="slide-dot-<?php echo $i;?>" type="radio" name="slides" checked>
                    <div class="slide slide-<?php echo $i;?>">
                        <p name = 'credo'> <?php echo $discountedProducts[$i][0]['name'];?> </p>
                    </div>
                <?php endfor; ?>
            </div>

            <div class = 'main_text'>
                <div class = 'main_title'>
                    <h4>Tea Haven <br> Premium Lose-Leaf Teas </h4>
                </div>
                <br>
                <div class = 'main_p'>
                    <p>
                        At Tea Haven, we believe that a good cup of tea should not only taste great, 
                        but also be good for you. That's why all of our teas are carefully selected and blended to provide a range 
                        of health benefits, from boosting immunity to aiding digestion and reducing stress.
                    </p>
                </div>
                <br><br>
                <div class = 'products_btn'>
                    <a href = '#section'>
                        <input type = 'button' value="Our Products" name = 'products'>
                    </a>
                </div>
            </div>
        </div>
        <img name = 'leaves' src = 'img/leaves.png'>
    </div>

    <div class = 'second_page'>
        <img name = 'leaves2' src = 'img/leaves.png'>
        <div class = 'main_menu'>
            <div class = 'menu_button'><a name = 'menu_text' href = '.#section'>All Tea</a></div>
            <?php foreach ($categories as $category): ?>
                <div class = 'menu_button'>
                    <a name = 'menu_text' href = '?category_id=<?php echo $category['category_id'];?>#section'>
                        <?php echo $category['name'] ?>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
        <div class = 'cards'>
            <?php foreach ($products as $product): ?>
            <div class = 'card'>
                <div class = 'card_image'>
                    <img name = 'card_image' src = 'img/product<?php echo $product['product_id']?>.png'>
                </div>
                <div class = 'card_title'>
                    <h5><?php echo $product['name'] ?></h5>
                </div>
                <div class = 'card_text'>
                    <?php echo $product['description'] ?>
                </div>
                <div class = 'card_rating'>
                    <img name = 'star' src = 'img/Star_1.svg'>
                    <img name = 'star' src = 'img/Star_1.svg'>
                    <img name = 'star' src = 'img/Star_1.svg'>
                    <img name = 'star' src = 'img/Star_1.svg'>
                    <img name = 'star' src = 'img/Star_0.svg'>
                </div>
                <div class = 'card_button'>
                    <input type = 'button' name = 'card_button' value = <?php echo $product['price'] ?>.00$>
                </div>
            </div>
            <?php endforeach; ?>
            <a name = 'section'>
    </div>
</body>
</html>