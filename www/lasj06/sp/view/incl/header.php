<?php require "../controller/search_controller.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Jiří Láska">
    <title>DiskShop</title>
    <link rel="icon" type="image/x-icon" href="./../favicon.ico">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="page">
        <div class="menu_bar">
            <a href="home.php" class="logo"><img src="./../img/logo.png" alt="website logo" width="180" height="65"></a>
            <form class="search_bar sb" method="POST">
                <input name="search" type="search" class="search_bar" placeholder="Search Game Titles">
            </form>
            <nav class="navigation_container">
            <?php if (($_SESSION['user_email'] != "visitor")) : ?>
                <a href="user_desc.php"><p>Account: <?php echo $_SESSION['user_email'] ?></p></a>
                <?php endif ?>
                <ul class="navigation_menu">
                    <li class="navigation_item">
                        <a href="home.php">Home</a>
                    </li>
                    <li class="navigation_item">
                        <a href='about.php'>About</a>
                    </li>
                    <?php if (isset($_SESSION['account_level']) && $_SESSION['account_level'] > 0) : ?>
                        <li class="navigation_item">
                            <a href="cart.php">Shopping Cart</a>
                        </li>
                    <?php endif ?>
                    <?php if (isset($_SESSION['account_level']) && $_SESSION['account_level'] > 2) : ?>
                        <li class="navigation_item">
                            <a href="add_product.php">Add product</a>
                        </li>
                    <?php endif ?>
                    <?php if (isset($_SESSION['account_level']) && $_SESSION['account_level'] == 3) : ?>
                        <li class="navigation_item">
                            <a href="user.php">User Administration</a>
                        </li>
                    <?php endif ?>
                    <?php if (isset($_SESSION['user_email']) && $_SESSION['user_email'] != 'visitor') : ?>
                        <li class="navigation_item">
                            <a href="../controller/signout_controller.php">logout</a>
                        </li>
                    <?php else : ?>
                        <li class="navigation_item">
                            <a href="signin.php">Login</a>
                        </li>
                    <?php endif ?>
                </ul>
            </nav>
        </div>
        <?php if (!$error == "") : ?>
            <p><?php echo $error; ?></p>
        <?php endif ?>