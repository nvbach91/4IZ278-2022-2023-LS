<?php

include '../config.php';
session_start();

if (isset($_POST['add_to_cart'])) {
    $message[] = 'To add book to cart you need to log in or register';
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <?php include 'header.php'; ?>

    <div class="heading">
        <h3>Search page</h3>
        <p><a href="../index.php">home</a> / search</p>
    </div>

    <section class="search-form">
        <form action="" method="post">
            <input type="text" name="search" placeholder="search book by it's name or author" class="box">
            <input type="submit" name="submit" value="search" class="button">
        </form>
    </section>

    <section class="products" style="padding-top: 0;">
        <div class="box-container">
            <div class="product_wrapper">
                <?php
                if (isset($_POST['submit'])) {
                    $search_item = $_POST['search'];

                    $query = "SELECT * FROM `products` WHERE name LIKE '%{$search_item}%' OR author LIKE '%{$search_item}%'";
                    $select_products = mysqli_query($connection, $query) or die('query failed');
                    if (mysqli_num_rows($select_products) > 0) {
                        while ($fetch_products = mysqli_fetch_assoc($select_products)) {

                ?>
                            <form action="" method="post" class="box">
                                <img src="../uploaded_img/<?php echo $fetch_products['image'] ?>">
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
                        echo '<p class="empty">No results found</p>';
                    }
                } else {
                    echo '<p class="empty">Search something!</p>';
                }
                ?>
            </div>
        </div>
    </section>



    <?php include 'footer.php'; ?>
    <script src="../js/script.js"></script>

</body>

</html>