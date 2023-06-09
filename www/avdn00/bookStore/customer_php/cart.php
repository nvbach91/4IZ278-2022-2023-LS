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

    $query = "UPDATE `cart` SET quantity = ? WHERE id = ?";
    $statement = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($statement, "ii", $cart_quantity, $cart_id);
    mysqli_stmt_execute($statement);
    $affected_rows = mysqli_stmt_affected_rows($statement);
    mysqli_stmt_close($statement);

    if ($affected_rows > 0) {
        $message[] = 'Cart was updated successfully';
    } else {
        die('Update query failed');
    }
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];

    $query = "DELETE FROM `cart` WHERE id = ?";
    $statement = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($statement, "i", $delete_id);
    mysqli_stmt_execute($statement);
    $affected_rows = mysqli_stmt_affected_rows($statement);
    mysqli_stmt_close($statement);

    header('location: ./cart.php');
}

if (isset($_GET['delete_all'])) {
    $query = "DELETE FROM `cart` WHERE user_id = ?";
    $statement = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($statement, "i", $user_id);
    mysqli_stmt_execute($statement);
    $affected_rows = mysqli_stmt_affected_rows($statement);
    mysqli_stmt_close($statement);

    header('location: ./cart.php');
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
            $query = "SELECT * FROM `cart` WHERE user_id = ?";
            $stmt = $connection->prepare($query);
            $stmt->bind_param("s", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($fetch_cart = $result->fetch_assoc()) {
                    $cart_id = htmlspecialchars($fetch_cart['id']);
                    $image = htmlspecialchars($fetch_cart['image']);
                    $name = htmlspecialchars($fetch_cart['name']);
                    $author = htmlspecialchars($fetch_cart['author']);
                    $price = htmlspecialchars($fetch_cart['price']);
                    $quantity = htmlspecialchars($fetch_cart['quantity']);
                    $sub_total = ($quantity * $price);
                    $grand_total += $sub_total;
            ?>
                    <div class="box">
                        <a href="./cart.php?delete=<?php echo $cart_id; ?>" class="fas fa-times" onclick="return confirm ('Delete this book from cart?');"></a>
                        <img src="../uploaded_img/<?php echo $image; ?>" alt="">
                        <div class="name"><?php echo $name; ?></div>
                        <div class="author"><?php echo $author; ?></div>
                        <div class="price">$<?php echo $price; ?>/-</div>
                        <form action="" method="post">
                            <input type="hidden" name="cart_id" value="<?php echo $cart_id; ?>">
                            <input type="number" name="cart_quantity" min="1" value="<?php echo $quantity; ?>">
                            <input type="submit" name="update_cart" value="update" class="option-button">
                        </form>
                        <div class="sub-total">sub total: <span>$<?php echo $sub_total; ?>/-</span></div>
                    </div>
            <?php
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