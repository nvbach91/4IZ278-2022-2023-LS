<?php

include '../config.php';
session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:../login.php');
}

if (isset($_POST['update_cart'])) {
    $cart_id = $_POST['cart_id'];
    $cart_quantity = $_POST['cart_quantity'];

    $query = "UPDATE `cart` SET quantity = '$cart_quantity' WHERE id = '$cart_id'";
    mysqli_query($connection, $query) or die('query failed');
    $message[] = 'Cart was updated successfully';
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $query = "DELETE FROM `cart` WHERE id = '$delete_id'";
    mysqli_query($connection, $query) or die('query failed');
    header('location:./cart.php');
}


if (isset($_GET['delete_all'])) {
    $query = "DELETE FROM `cart` WHERE user_id='$user_id'";
    mysqli_query($connection, $query) or die('query failed');
    header('location:./cart.php');
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <?php include 'header.php'; ?>

    <div class="heading">
        <h3>Your shopping cart</h3>
        <p><a href="./home.php">home</a> / cart</p>
    </div>

    <section class="shopping-cart">
        <h1 class="title">products added</h1>
        <div class="box-container">

            <?php
            $grand_total = 0;
            $query = "SELECT * FROM `cart` WHERE user_id = '$user_id'";
            $select_cart = mysqli_query($connection, $query) or die('query failed');

            if (mysqli_num_rows($select_cart) > 0) {
                while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
            ?>
                    <div class="box">
                        <a href="./cart.php?delete=<?php echo htmlspecialchars($fetch_cart['id']) ?>" class="fas fa-times" onclick="return confirm ('Delete this book from cart?');"></a>
                        <img src="../uploaded_img/<?php echo htmlspecialchars($fetch_cart['image']) ?>" alt="">
                        <div class="name"><?php echo htmlspecialchars($fetch_cart['name']) ?></div>
                        <div class="author"><?php echo htmlspecialchars($fetch_cart['author']) ?></div>
                        <div class="price">$<?php echo htmlspecialchars($fetch_cart['price']) ?>/-</div>
                        <form action="" method="post">
                            <input type="hidden" name="cart_id" value="<?php echo htmlspecialchars($fetch_cart['id']) ?>">
                            <input type="number" name="cart_quantity" min="1" value="<?php echo htmlspecialchars($fetch_cart['quantity']) ?>">
                            <input type="submit" name="update_cart" value="update" class="option-button">
                        </form>
                        <div class="sub-total">sub total: <span>$<?php echo $sub_total = ($fetch_cart['quantity'] * $fetch_cart['price']); ?>/-</span></div>
                    </div>
            <?php
                    $grand_total += $sub_total;
                }
            } else {
                echo '<p class="empty">No products in your cart yet</p>';
            }
            ?>
        </div>

        <div style="margin-top: 2rem; text-align:center;">
            <a href="./cart.php?delete_all" class="delete-button <?php echo ($grand_total > 1) ? '' : 'disabled'; ?>" onclick="return confirm ('Delete all books from cart?');">delete all</a>
        </div>

        <div class="cart_total">
            <p>grand total: <span>$<?php echo $grand_total ?>/-</span></p>
            <div class="flex">
                <a href="./shop.php" class="option-button">continue shopping</a>
                <a href="./checkout.php" class="button <?php echo ($grand_total > 1) ? '' : 'disabled'; ?>">proceed to checkout</a>
            </div>
        </div>

    </section>




    <?php include 'footer.php'; ?>
    <script src="../js/script.js"></script>

</body>

</html>