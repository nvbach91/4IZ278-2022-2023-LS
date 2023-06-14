<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$current_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$path = parse_url($current_url, PHP_URL_PATH);
$filename = pathinfo($path, PATHINFO_FILENAME);

$username = $_SESSION['user']['email'] ?? null;
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light mb-2">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="./index.php"><img src="./img/logo.png" class="navlogo">TOPTECT</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4 ml-auto">
                <li class="nav-item"><a class="nav-link <?php echo ($filename == 'index') ? 'active' : ''; ?>" aria-current="page" href="./index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="./about.php">About</a></li>
                <li class="nav-item"><a class="nav-link" href="./contact.php">Contact</a></li>
                <?php if (isset($_SESSION['user'])) : ?>

                    <?php if ($_SESSION['user']['privilege'] >= 2) : ?>
                        <li class="nav-item"><a class="nav-link <?php echo ($filename == 'create-item') ? 'active' : ''; ?>" href="./create-item.php">New item</a></li>
                    <?php endif; ?>
                    <li class="nav-item"><a class="nav-link <?php echo ($filename == 'cart') ? 'active' : ''; ?>" href="./cart.php"><img src="./img/cart.png" alt="Cart" class="register-icon"></a></li>
                    <li class="nav-item"><a class="nav-link <?php echo ($filename == 'profile') ? 'active' : ''; ?>" href="./profile.php"><img src="./img/register.png" alt="Profile" class="register-icon"></a></li>
                    <li class="nav-item"><a class="nav-link" href="./logout.php"><img src="./img/logout.png" alt="Logout" class="register-icon"></a></li>
                    <?php else : ?>
                    <li class="nav-item"><a class="nav-link <?php echo ($filename == 'register') ? 'active' : ''; ?>" href="./register.php"><img src="./img/register.png" alt="Register" class="register-icon"></a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>