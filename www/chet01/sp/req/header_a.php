<?php
if (!isset($activePage))
    $activePage = "";
?>

<header>
    <div>
        <a href="<?= BASE_URL ?>">Home</a>
        <a class="<?= ($activePage == 'reservations') ? 'active' : '' ?>" href="<?= BASE_URL ?>/admin">Reservations</a>
        <a class="<?= ($activePage == 'blocks') ? 'active' : '' ?>" href="<?= BASE_URL ?>/admin/blocks">Blocks</a>
        <a class="<?= ($activePage == 'tables') ? 'active' : '' ?>" href="<?= BASE_URL ?>/admin/tables">Tables</a>
        <a class="<?= ($activePage == 'cafe') ? 'active' : '' ?>" href="<?= BASE_URL ?>/admin/cafe">Cafe information</a>
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