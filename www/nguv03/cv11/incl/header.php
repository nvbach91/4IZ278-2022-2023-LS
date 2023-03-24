<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="mangomaniac, mango, mango, mango">
    <meta name="author" content="Nguyen Viet Bach">
    <title>Mango Shop | Mangomaniac Inc.</title>
    <link rel="shortcut icon" href="https://cdn.iconscout.com/icon/free/png-256/mango-fruit-vitamin-healthy-summer-food-31184.png">
    <link rel="stylesheet" href="https://bootswatch.com/4/journal/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
    <div class="container">
        <img class="logo" src="./img/logo.png" alt="logo">
        <a class="navbar-brand" href="index.php">Mangomaniac</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item<?php echo strpos($_SERVER['REQUEST_URI'], 'index') || preg_match('/\/$/', $_SERVER['REQUEST_URI']) ? ' active' : '' ?>">
                    <a class="nav-link" href="index.php">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item<?php echo strpos($_SERVER['REQUEST_URI'], 'cart') ? ' active' : '' ?>">
                        <a class="nav-link" href="cart.php">Cart</a>
                    </li>
                    <li class="nav-item<?php echo strpos($_SERVER['REQUEST_URI'], 'profile') ? ' active' : '' ?>">
                        <a class="nav-link" href="#"><i class="fas fa-user"></i> <?php echo isset($_SESSION['user_email']) ? $_SESSION['user_email'] : ''; ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="signout.php"><i class="fas fa-sign-out-alt"></i></a>
                    </li>
                    <?php else: ?>
                    <li class="nav-item<?php echo strpos($_SERVER['REQUEST_URI'], 'signin') ? ' active' : '' ?>">
                        <a class="nav-link" href="signin.php">Sign in</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>