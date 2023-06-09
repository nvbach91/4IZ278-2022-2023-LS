<?php

include '../config.php';
include 'utils.php';
include 'script.php';
session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:../login.php');
}

if (isset($_POST['add_to_cart'])) {
    $product_name = mysqli_real_escape_string($connection, $_POST['product_name']);
    $product_author = mysqli_real_escape_string($connection, $_POST['product_author']);
    $product_price = $_POST['product_price'];
    $product_image = mysqli_real_escape_string($connection, $_POST['product_image']);
    $product_quantity = $_POST['product_quantity'];

    $query = "SELECT * FROM `cart` WHERE name = ? AND user_id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("ss", $product_name, $user_id);
    $stmt->execute();
    $check_cart_numbers = $stmt->get_result();

    if ($check_cart_numbers->num_rows > 0) {
        $message[] = 'Already added to cart';
    } else {
        $query = "INSERT INTO `cart` (user_id, name, price, quantity, image, author) 
        VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("ssdiss", $user_id, $product_name, $product_price, $product_quantity, $product_image, $product_author);

        if ($stmt->execute()) {
            $message[] = 'Book was added to cart';
        } else {
            $message[] = 'Failed to add book to cart';
        }
    }
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <?php include 'header.php'; ?>

    <div class="heading">
        <h3>Our shop</h3>
        <p><a href="./home.php">home</a> / shop</p>
    </div>

    <section class="products">
        <h1 class="title">Our book collection</h1>
        <h3 class="title" style="font-size: 2.5rem;">Filter books by genre</h3>
        <div class="filter">
            <select id="filter" name="filter">
                <option value="">All products</option>
                <?php
                $query = "SELECT DISTINCT genre FROM `products`;";
                $select_genre = mysqli_query($connection, $query) or die('query failed');
                if (mysqli_num_rows($select_genre) > 0) {
                    while ($fetch_genres = mysqli_fetch_assoc($select_genre)) {
                ?>
                        <option value="<?php echo $fetch_genres['genre']; ?>"><?php echo $fetch_genres['genre']; ?></option>
                <?php
                    }
                } else {
                    echo '<p class="empty">No book categories added yet</p>';
                }
                ?>

            </select>
        </div>

        <div class="dynamic-header">
            <h3 class="title">All products</h3>
        </div>
        <div class="box-container">
            <div class="product_wrapper">
                <?php
                $books = getAllBooks($connection);
                foreach ($books as $book) {
                ?>
                    <form action="" method="post" class="box">
                        <img src="../uploaded_img/<?php echo htmlspecialchars($book['image']) ?>">
                        <div class="name"><?php echo htmlspecialchars($book['name']) ?></div>
                        <div class="author"><?php echo htmlspecialchars($book['author']) ?></div>
                        <div class="genre"><?php echo htmlspecialchars($book['genre']) ?></div>
                        <div class="price">$<?php echo htmlspecialchars($book['price']) ?>/-</div>
                        <input type="number" min="1" name="product_quantity" value="1" class="quantity">
                        <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($book['name']) ?>">
                        <input type="hidden" name="product_author" value="<?php echo htmlspecialchars($book['author']) ?>">
                        <input type="hidden" name="product_price" value="<?php echo htmlspecialchars($book['price']) ?>">
                        <input type="hidden" name="product_image" value="<?php echo htmlspecialchars($book['image']) ?>">
                        <input type="submit" value="add to cart" name="add_to_cart" class="button">
                    </form>
                <?php
                }
                ?>
            </div>
        </div>
    </section>

    <?php include 'footer.php'; ?>
    <script src="../js/script.js"></script>

</body>

</html>