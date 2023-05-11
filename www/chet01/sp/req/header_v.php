<?php
if (!isset($activePage))
    $activePage = "";
?>

<header>
    <div>
        <a href="<?= BASE_URL ?>">Home</a>
        <a class="<?= ($activePage == 'new') ? 'active' : '' ?>" href="<?= BASE_URL ?>/visit/arcive">My reservations</a>
        <a class="<?= ($activePage == 'signup') ? 'active' : '' ?>" href="<?= BASE_URL ?>/visit/profile">My profile</a>
        <a href="">Logout</a>
    </div>
</header>