<?php 
require_once '../utils/Utils.php';
$isAdmin = Utils::getInstance() -> isAdmin($_COOKIE['userID']);
?>

<div class='menu<?php echo $theme; ?>'>
    <a class='blue' href='../utils/setSession.php?page=home'>
        <div class="burger_button<?php echo ($_SESSION['page'] === 'home') ? '_active' : ''; ?>">
            <img class='burger_icon' src='../images/icons/home.svg'>
            <p class='burger_p'>Home</p>
        </div>
    </a>
    <a class='blue' href='../utils/setSession.php?page=profile&profileID=<?php echo $_COOKIE['userID']; ?>'>
        <div class="burger_button<?php echo ($_SESSION['page'] === 'profile') ? '_active' : ''; ?>">
            <img class='burger_icon' src='../images/icons/profile.svg'>
            <p class='burger_p'>Profile</p>
        </div>
    </a>
    <a class='blue' href='../utils/setSession.php?page=messenger'>
        <div class="burger_button<?php echo ($_SESSION['page'] === 'messenger') ? '_active' : ''; ?>">
            <img class='burger_icon' src='../images/icons/message.svg'>
            <p class='burger_p'>Messenger</p>
        </div>
    </a>
    <a class='blue' href='../utils/setSession.php?page=friends'>
        <div class="burger_button<?php echo ($_SESSION['page'] === 'friends') ? '_active' : ''; ?>">
            <img class='burger_icon' src='../images/icons/friends.svg'>
            <p class='burger_p'>Friends</p>
        </div>
    </a>
    <?php if ($isAdmin): ?>
        <a class='blue' href='../utils/setSession.php?page=admin'>
        <div class="burger_button<?php echo ($_SESSION['page'] === 'admin') ? '_active' : ''; ?>">
            <img class='burger_icon' src='../images/icons/admin.svg' style = 'filter: invert(100%)'>
            <p class='burger_p'>Admin Panel</p>
        </div>
        </a>
    <?php endif; ?>

    <a href='../utils/logout.php'>
    <div class='burger_button'>
            <img class='burger_icon' src='../images/icons/logout_.svg'>
            <p class='burger_p'>Logout</p>
    </div>
    </a>
</div>