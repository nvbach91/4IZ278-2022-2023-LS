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
        <a class="navbar-brand" href="https://esotemp.vse.cz/~jezf00/sp/code/index.php"><img src="https://esotemp.vse.cz/~jezf00/sp/code/img/logo.png" class="navlogo">TOPTECT</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4 ml-auto">
                <li class="nav-item"><a class="nav-link <?php echo ($filename == 'index') ? 'active' : ''; ?>" aria-current="page" href="https://esotemp.vse.cz/~jezf00/sp/code/index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="https://esotemp.vse.cz/~jezf00/sp/code/about.php">About</a></li>
                <li class="nav-item"><a class="nav-link" href="https://esotemp.vse.cz/~jezf00/sp/code/contact.php">Contact</a></li>
                <?php if (isset($_SESSION['user'])) : ?>

                    <?php if ($_SESSION['user']['privilege'] >= 2) : ?>
                        <li class="nav-item"><a class="nav-link <?php echo ($filename == 'create-item') ? 'active' : ''; ?>" href="https://esotemp.vse.cz/~jezf00/sp/code/admin/create-item.php">New item</a></li>
                    <?php endif; ?>
                    <li class="nav-item"><a class="nav-link <?php echo ($filename == 'cart') ? 'active' : ''; ?>" href="https://esotemp.vse.cz/~jezf00/sp/code/user/cart.php"><img src="https://esotemp.vse.cz/~jezf00/sp/code/img/cart.png" alt="Cart" class="register-icon"></a></li>
                    <li class="nav-item"><a class="nav-link <?php echo ($filename == 'profile') ? 'active' : ''; ?>" href="https://esotemp.vse.cz/~jezf00/sp/code/user/profile.php"><img src="https://esotemp.vse.cz/~jezf00/sp/code/img/register.png" alt="Profile" class="register-icon"></a></li>
                    <li class="nav-item"><a class="nav-link" href="https://esotemp.vse.cz/~jezf00/sp/code/user/logout.php"><img src="https://esotemp.vse.cz/~jezf00/sp/code/img/logout.png" alt="Logout" class="register-icon"></a></li>
                    <?php else : ?>
                    <li class="nav-item"><a class="nav-link <?php echo ($filename == 'register') ? 'active' : ''; ?>" href="https://esotemp.vse.cz/~jezf00/sp/code/user/register.php"><img src="https://esotemp.vse.cz/~jezf00/sp/code/img/register.png" alt="Register" class="register-icon"></a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>