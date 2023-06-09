<?php

include '../config.php';
session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:../login.php');
}

if (isset($_POST['add_to_cart'])) {
    $product_name = $_POST['product_name'];
    $product_author = $_POST['product_author'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];
    $message = array();

    $query = "SELECT * FROM `cart` WHERE name = ? AND user_id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("ss", $product_name, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $message[] = 'Already added to cart';
    } else {
        $query = "INSERT INTO `cart` (user_id, name, price, quantity, image, author) 
        VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("ssdiss", $user_id, $product_name, $product_price, $product_quantity, $product_image, $product_author);
        $stmt->execute();
        $message[] = 'Book was added to cart';
    }
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
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <?php include 'header.php'; ?>

    <section class="home">
        <div class="content">
            <h3>Welcome to Bookworms</h3>
            <p>Embark on a literary journey with us and let the pages come alive. Start exploring our Book Eshop today and open the door to a world of captivating stories, knowledge, and endless possibilities. Happy reading!</p>
            <a href="./about.php" class="white-button">discover more</a>
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
                        <img src="../uploaded_img/<?php echo htmlspecialchars($fetch_products['image']) ?>">
                        <div class="name"><?php echo htmlspecialchars($fetch_products['name']) ?></div>
                        <div class="author"><?php echo htmlspecialchars($fetch_products['author']) ?></div>
                        <div class="genre"><?php echo htmlspecialchars($fetch_products['genre']) ?></div>
                        <div class="price">$<?php echo htmlspecialchars($fetch_products['price']) ?>/-</div>
                        <input type="number" min="1" name="product_quantity" value="1" class="quantity">
                        <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($fetch_products['name']) ?>">
                        <input type="hidden" name="product_author" value="<?php echo htmlspecialchars($fetch_products['author']) ?>">
                        <input type="hidden" name="product_price" value="<?php echo htmlspecialchars($fetch_products['price']) ?>">
                        <input type="hidden" name="product_image" value="<?php echo htmlspecialchars($fetch_products['image']) ?>">
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
            <a href="./shop.php" class="option-button">load more</a>
        </div>
    </section>

    <section class="about">
        <div class="flex">
            <div class="image">
                <img src="../img/about.jpg" alt="">
            </div>
            <div class="content">
                <h3>About us</h3>
                <p>At Bookworms, our mission is to ignite the love for reading and foster a vibrant community of book lovers. We believe in the power of books to educate, inspire, and entertain. Our goal is to provide a wide range of books that cater to diverse interests and age groups, ensuring that there's something for everyone.</p>
                <a href="./about.php" class="button">read more</a>
            </div>
        </div>
    </section>

    <section class="home-contact">
        <div class="content">
            <h3>Have any questions?</h3>
            <p>We value your feedback, questions, and concerns. At Bookworms, we strive to provide excellent customer service and ensure that your experience with us is smooth and enjoyable. If you have any inquiries or need assistance, please don't hesitate to reach out to us using the form provided below.</p>
            <a href="./contact.php" class="white-button">contact us</a>
        </div>
    </section>

    <?php include 'footer.php'; ?>
    <script src="../js/script.js"></script>

</body>

</html>