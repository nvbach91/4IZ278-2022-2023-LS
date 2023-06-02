<?php

include './config.php';



if (isset($_POST['add_to_cart'])) {
    header('location:./login.php');
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <?php
    if (isset($message)) {
        foreach ($message as $message) {
            echo '
            <div class="message">
                <span>' . htmlspecialchars($message) . '</span>
                <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
             </div>
            ';
        }
    }

    ?>

    <header class="header">
        <div class="header-1">
            <div class="flex">
                <div class="share">
                    <a href="https://www.facebook.com/" class="fab fa-facebook-f"></a>
                    <a href="https://twitter.com/i/flow/login" class="fab fa-twitter"></a>
                    <a href="https://www.instagram.com/?hl=cs" class="fab fa-instagram"></a>
                    <a href="https://www.linkedin.com/login/cs" class="fab fa-linkedin"></a>
                </div>
                <p><a href="./login.php">login</a> | <a href="./register.php">register</a></p>
            </div>
        </div>

        <div class="header-2">
            <div class="flex">

                <a href="index.php" class="logo-main">
                    <p>Book<span>Worms</span><img alt="logo" src="./img/open-book.png"></p>
                </a>
                <nav class="navbar">
                    <a href="index.php">Home</a>
                    <a href="not_logged_in/about.php">About</a>
                    <a href="not_logged_in/shop.php">Shop</a>
                    <a href="not_logged_in/contact.php">Contact</a>
                    <a href="not_logged_in/orders.php">Orders</a>
                </nav>

                <div class="icons">
                    <a href="not_logged_in/search.php" class="fas fa-search"></a>
                    <div id="user-button" class="fas fa-user"></div>
                    <a href="not_logged_in/cart.php"><i class="fas fa-shopping-cart"></i></a>
                </div>

                <div class="user-box">
                    <p>You are not logged in</span></p>
                    <a href="login.php" class="button">Log in</a>
                </div>
            </div>
        </div>

    </header>

    <section class="home">
        <div class="content">
            <h3>Welcome to Bookworms</h3>
            <p>Embark on a literary journey with us and let the pages come alive. Start exploring our Book Eshop today and open the door to a world of captivating stories, knowledge, and endless possibilities. Happy reading!</p>
            <a href="./not_logged_in/about.php" class="white-button">discover more</a>
        </div>
    </section>

    <section class="home-container">
        <h1 class="title">Latest products</h1>
        <div class="box-container">
            <?php
            $query = 'SELECT * FROM `products` LIMIT 6';
            $select_products = mysqli_query($connection, $query) or die('query failed');
            if (mysqli_num_rows($select_products) > 0) {
                while ($fetch_products = mysqli_fetch_assoc($select_products)) {
            ?>
                    <form action="" method="post" class="box">
                        <img src="./uploaded_img/<?php echo $fetch_products['image'] ?>">
                        <div class="name"><?php echo $fetch_products['name'] ?></div>
                        <div class="author"><?php echo $fetch_products['author'] ?></div>
                        <div class="genre"><?php echo $fetch_products['genre'] ?></div>
                        <div class="price">$<?php echo $fetch_products['price'] ?>/-</div>
                        <input type="number" min="1" name="product_quantity" value="1" class="quantity">
                        <input type="hidden" name="product_name" value="<?php echo $fetch_products['name'] ?>">
                        <input type="hidden" name="product_author" value="<?php echo $fetch_products['author'] ?>">
                        <input type="hidden" name="product_price" value="<?php echo $fetch_products['price'] ?>">
                        <input type="hidden" name="product_image" value="<?php echo $fetch_products['image'] ?>">
                        <input type="submit" value="add to cart" name="add_to_cart" class="button">
                    </form>
            <?php
                }
            } else {
                echo '<p class="empty">No products added</p>';
            }
            ?>
        </div>

        <div class="load-more" style="margin-top: 2rem; text-align:center;">
            <a href="./not_logged_in/shop.php" class="option-button">load more</a>
        </div>
    </section>

    <section class="about">
        <div class="flex">
            <div class="image">
                <img src="./img/about.jpg" alt="">
            </div>
            <div class="content">
                <h3>About us</h3>
                <p>At Bookworms, our mission is to ignite the love for reading and foster a vibrant community of book lovers. We believe in the power of books to educate, inspire, and entertain. Our goal is to provide a wide range of books that cater to diverse interests and age groups, ensuring that there's something for everyone.</p>
                <a href="not_logged_in/about.php" class="button">read more</a>
            </div>
        </div>
    </section>

    <section class="home-contact">
        <div class="content">
            <h3>Have any questions?</h3>
            <p>We value your feedback, questions, and concerns. At Bookworms, we strive to provide excellent customer service and ensure that your experience with us is smooth and enjoyable. If you have any inquiries or need assistance, please don't hesitate to reach out to us using the form provided below.</p>
            <a href="not_logged_in/contact.php" class="white-button">contact us</a>
        </div>
    </section>

    <section class="footer">
        <div class="box-container">
            <div class="box">
                <h3>quick links</h3>
                <a href="index.php">Home</a>
                <a href="not_logged_in/about.php">About</a>
                <a href="not_logged_in/shop.php">Shop</a>
                <a href="not_logged_in/contact.php">Contact</a>
                <a href="not_logged_in/orders.php">Orders</a>
            </div>

            <div class="box">
                <h3>extra links</h3>
                <a href="./login.php">Login</a>
                <a href="./register.php">Register</a>
                <a href="not_logged_in/cart.php">Cart</a>
                <a href="not_logged_in/orders.php">Orders</a>
            </div>

            <div class="box">
                <h3>contact information</h3>
                <p><i class="fas fa-phone"> +420 987 654 321</i></p>
                <p><i class="fas fa-phone"> +420 123 456 789</i></p>
                <p><i class="fas fa-envelope"> bookworms@gmail.com</i></p>
                <p><i class="fas fa-map-marker-alt"> Prague, Czechia</i></p>
            </div>

            <div class="box">
                <h3>follow us</h3>
                <a href="#"><i class="fab fa-facebook-f"> facebook</i></a>
                <a href="#"><i class="fab fa-twitter"> twitter</i></a>
                <a href="#"><i class="fab fa-instagram"> instagram</i></a>
                <a href="#"><i class="fab fa-linkedin"> linkedin</i></a>
            </div>
        </div>

        <p class="credit">Created for <span>4IZ278</span></p>

    </section>
    <script src="./js/script.js"></script>

</body>

</html>