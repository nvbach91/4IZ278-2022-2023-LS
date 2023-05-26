<?php
if (!isset($activePage))
    $activePage = "";
?>

<header>
    <div>
        <a href="<?= BASE_URL ?>">Home</a>
        <a class="<?= ($activePage == 'new') ? 'active' : '' ?>" href="<?= BASE_URL ?>/visit">New reservation</a>
        <a class="<?= ($activePage == 'all') ? 'active' : '' ?>" href="<?= BASE_URL ?>/visit/all">My reservations</a>
        <a class="<?= ($activePage == 'aval') ? 'active' : '' ?>" href="<?= BASE_URL ?>/visit/availability">Tables</a>
        <a class="<?= ($activePage == 'profile') ? 'active' : '' ?>" href="<?= BASE_URL ?>/visit/profile">My profile</a>
        <a id='logout'>Logout</a>
    </div>
</header>

<script>
    document.getElementById('logout').addEventListener('click', () => {
        axios.get(API_URL + '/logout').then(resp => {
            window.location = BASE_URL;
        });
    })
</script>