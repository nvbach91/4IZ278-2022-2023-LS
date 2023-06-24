<?php
if (!isset($_SESSION)) {
	session_start();
}
require_once 'db.php';
require_once 'functions.php';
// Function to send order confirmation email

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    header("Location:pay.php");
}

mysqli_close($connection);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vzdělávací centrum</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .cart-link {
            display: block;
            text-align: center;
            margin-bottom: 20px;
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin-bottom: 20px;
        }

        ul li {
            margin-bottom: 5px;
        }

        .change-link {
            display: block;
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .order-info {
            text-align: center;
            margin-bottom: 20px;
        }

        input[type="submit"] {
            display: block;
            margin: 0 auto;
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }

        .login-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <a href="index.php" class="cart-link">Home</a>
    <h1>Objednávka</h1>

    <?php if (isset($_GET['nazev'])) : ?>
        <p>Objednáte si kurz: <?php echo $_GET['nazev']; ?></p>
    <?php elseif (isset($_SESSION['cart_list'])) : ?>
        <ul>
            <?php foreach ($_SESSION['cart_list'] as $course) : ?>
                <li><?php 
                   
                    echo $course['title']; ?> | <?php echo $course['price']; ?> CZK</li>
            <?php endforeach; ?>
        </ul>
        <p><a href="cart.php" class="change-link">Změnit objednávku</a></p>
    <?php endif; ?>

    <?php if (isset($_SESSION['username'])) : ?>
        <div class="order-info">
            <?php echo $_SESSION['userData']['name'] . ' ' . $_SESSION['userData']['surname'] . ', ' . 'Vaše číslo mobilu: ' . $_SESSION['userData']['phoneNumber']; ?>
        </div>

        <form method="POST">
            <input type="submit" value="Potvrďte objednávku">
        </form>

    <?php else : ?>
        <a href="./login.php" class="login-link">Přihlaste se</a>
    <?php endif; ?>
</body>

</html>