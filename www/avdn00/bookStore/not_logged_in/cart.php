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
        <p><a href="../index.php">home</a> / cart</p>
    </div>
    <section class="shopping-cart">
        <h1 class="title">products added</h1>
        <div class="box-container">
            <?php
            echo '<p class="empty">You have nothing in cart!<br> To continue you need to log in or register</p>';
            ?>
        </div>
    </section>
    <?php include 'footer.php'; ?>
    <script src="../js/script.js"></script>
</body>

</html>