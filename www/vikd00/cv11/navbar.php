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
        <a class="navbar-brand" href="./">Best-eshop</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4 ml-auto">
                <li class="nav-item"><a class="nav-link <?php echo ($filename == 'index') ? 'active' : ''; ?>" aria-current="page" href="./index.php">Home</a></li>
                <?php if (isset($_SESSION['user'])) : ?>
                    <li class="nav-item"><a class="nav-link <?php echo ($filename == 'cart') ? 'active' : ''; ?>" href="./cart.php">Cart</a></li>
                    <?php if ($_SESSION['user']['privilege'] >= 2) : ?>
                        <li class="nav-item"><a class="nav-link <?php echo ($filename == 'create-item') ? 'active' : ''; ?>" href="./create-item.php">New item</a></li>
                    <?php endif; ?>
                    <?php if ($_SESSION['user']['privilege'] == 3) : ?>
                        <li class="nav-item"><a class="nav-link <?php echo ($filename == 'users') ? 'active' : ''; ?>" href="./users.php">Users</a></li>
                    <?php endif; ?>
                    <li class="nav-item"><a class="nav-link <?php echo ($filename == 'world-clock') ? 'active' : ''; ?>" href="./world-clock.php">World clock</a></li>
                    <li class="nav-item"><a class="nav-link" href="./logout.php">Log out</a></li>
                    <li class="nav-item"><a class="nav-link <?php echo ($filename == 'profile') ? 'active' : ''; ?>" href="./profile.php"><?php echo $username ?></a></li>
                <?php else : ?>
                    <li class="nav-item"><a class="nav-link <?php echo ($filename == 'login') ? 'active' : ''; ?>" href="./login.php">Login</a></li>
                    <li class="nav-item"><a class="nav-link <?php echo ($filename == 'register') ? 'active' : ''; ?>" href="./register.php">Register</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>