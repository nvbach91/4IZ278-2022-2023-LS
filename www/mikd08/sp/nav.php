<nav class="nav nav-pills flex-column flex-sm-row" style="background-color: black; justify-content: space-between;">
    <div class="nav_div">
        <a class="flex-sm-fill text-sm-center nav-link" href="/www/mikd08/sp/index.php">Home</a>
    </div>
    <div class="nav_div">
        <?php if (isset($_COOKIE["user"]) && isset($_SESSION["cart"])): ?>
            <a class="flex-sm-fill text-sm-center nav-link" href="/www/mikd08/sp/cart.php"><span class="material-symbols-outlined">shopping_cart</span></a>
        <?php endif;?>
        <div class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="" role="button" aria-haspopup="true" aria-expanded="false"><span class="material-symbols-outlined">person</span></a>
            <div class="dropdown-menu" style="transform: translate3d(-100px, 46px, 0px);">
                <?php if (isset($_SESSION["user_id"])): ?>
                    <div class="dropdown-item" style="font-weight:bold;"><?php echo htmlentities($_SESSION["name"]); ?></div>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/www/mikd08/sp/profile.php">Profile</a>
                    <a class="dropdown-item" href="/www/mikd08/sp/logout.php">Log out</a>
                <?php else:?>
                    <span id="login-btn" class="dropdown-item pointer">Log In</span>
                    <span id="register-btn" class="dropdown-item pointer">Register</span>
                <?php endif;?>
            </div>
        </div>
    </div>    
</nav>