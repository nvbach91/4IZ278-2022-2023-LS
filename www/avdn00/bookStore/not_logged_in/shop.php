<?php
include '../config.php';
include '../customer_php/utils.php';
include '../customer_php/script.php';
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
    <title>Shop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <?php include 'header.php'; ?>

    <div class="heading">
        <h3>Our shop</h3>
        <p><a href="../index.php">home</a> / shop</p>
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
                        <img src="../uploaded_img/<?php echo $book['image'] ?>">
                        <div class="name"><?php echo $book['name'] ?></div>
                        <div class="author"><?php echo $book['author'] ?></div>
                        <div class="genre"><?php echo $book['genre'] ?></div>
                        <div class="price">$<?php echo $book['price'] ?>/-</div>
                        <input type="number" min="1" name="product_quantity" value="1" class="quantity">
                        <input type="hidden" name="product_name" value="<?php echo $book['name'] ?>">
                        <input type="hidden" name="product_author" value="<?php echo $book['author'] ?>">
                        <input type="hidden" name="product_price" value="<?php echo $book['price'] ?>">
                        <input type="hidden" name="product_image" value="<?php echo $book['image'] ?>">
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