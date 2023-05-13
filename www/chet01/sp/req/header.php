<?php
if (!isset($activePage))
    $activePage = "";
?>

<header>
    <div>
        <a href="<?= BASE_URL ?>">Home</a>
        <a class="<?= ($activePage == 'signin') ? 'active' : '' ?>" href="<?= BASE_URL ?>/signin">Sign In</a>
        <a class="<?= ($activePage == 'signup') ? 'active' : '' ?>" href="<?= BASE_URL ?>/signup">Sign Up</a>
    </div>
</header>