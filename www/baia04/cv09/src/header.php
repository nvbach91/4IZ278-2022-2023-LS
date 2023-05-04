<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='styles/style.css'>
    <link rel='icon' href='img/logo.png' type='image/x-icon'>
    <title>Tea Haven</title>
</head>

<body>
    <div class='header'>
        <div class='icon'><img src='img/logo.png' name='icon'></div>
        <div class='nav_bar'>
            <a href='index.php' name='nav'>Products</a>
            <a href='#' name='nav'>About</a>
            <a href='#' name='nav'>Contact</a>
            <?php if (isset($_COOKIE['name'])): ?>
            <a href='profile.php' name='nav'><?php echo $_COOKIE['name']; ?></a>
            <?php else: ?>
            <a href='login.php' name='nav'>Login</a>
            <?php endif; ?>
        </div>
        <div class='cart'>
            <a href = 'cart.php'><img src='img/cart.png' width="40px" height="40px"></a>
        </div>
    </div>
</body>