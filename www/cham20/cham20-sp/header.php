<?php
session_start();
if (isset($_SESSION['cart'])) {
    $objectCount = count($_SESSION['cart']);
} else {
    $objectCount = 0;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">



    <!--INTERNAL LINKS-->
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="icon" type="image/x-icon" href="../pictures/bee_logo.png">

    <!--BOOTSTRAP? FONTAWESOME AND OTHER EXTERNAL-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/5354246f11.js" crossorigin="anonymous"></script>
    <title>%TITLE%</title>
</head>
<?php
if (isset($_GET['page-nr'])) {
    $id = $_GET['page-nr'];
} else {
    $id = 1;
}
?>

<body id=<?php echo $id ?>>
    <header>
        <nav class="navbar navbar-expand-lg  bg-#f0ad4e justify-content-between upper stroke">
            <div>
                <a href="./index.php" class="navbar-brand d-inline-block align-top"><img src="../pictures/bee_logo.png" alt="logo" class="logo ">
                    BEEBZZ
                </a>
            </div>
            <div class="nav navbar-nav ml-auto" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item btn text-center">
                        <a class="nav-link navbar-brand" href="./index.php">About us</a>
                    </li>
                    <li class="nav-item btn text-center">
                        <a class="nav-link navbar-brand" href="./cart.php"><i class="fa-solid fa-cart-shopping" style="color: #0d090a;"></i> Cart <span class="cart-counter"><?php echo $objectCount; ?></span></a>
                    </li>
                    <li class="nav-item btn text-center">
                        <a class="nav-link navbar-brand" href="./profile.php"><i class="fa-solid fa-user" style="color: #0d090a;"></i> My account</a>
                    </li>
                </ul>
            </div>
        </nav>
        <nav class="navbar navbar-expand-lg bg-light justify-content-center bottom nav-pills nav-fill shift">
            <ul class="navbar-nav nav-fill w-100">
                <li class="nav-item text-center font-weight-bold">
                    <a class="nav-link navbar-brand" href="./eshop.php?category=1">Honey</a>
                </li>
                <li class="nav-item text-center">
                    <a class="nav-link navbar-brand" href="./eshop.php?category=2">Candles</a>
                </li>
                <li class="nav-item text-center">
                    <a class="nav-link navbar-brand" href="./eshop.php?category=3">Wax papers</a>
                </li>
                <li class="nav-item text-center">
                    <a class="nav-link navbar-brand" href="./eshop.php?category=4">For skin</a>
                </li>
                <li class="nav-item flex-sm-fill text-center">
                    <a class="nav-link navbar-brand" href="./eshop.php?category=5">Beekeeping</a>
                </li>
            </ul>

        </nav>
    </header>