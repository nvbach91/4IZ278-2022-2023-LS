<?php
if (!isset($activePage)) {
    $activePage = "";
};

if (isset($_COOKIE['token'])) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, API_URL . '/me');
    curl_setopt($curl, CURLOPT_COOKIE, 'token=' . $_COOKIE['token']);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    $response = json_decode($response, true);
    curl_close($curl);
} else {
    $response = array(
        "auth" => false,
        "admin" => false,
    );
}
?>

<?php if ($response['admin']) : ?>
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

<?php elseif ($response['auth']) : ?>
    <header>
        <div>
            <a href="<?= BASE_URL ?>">Home</a>
            <a class="<?= ($activePage == 'new') ? 'active' : '' ?>" href="<?= BASE_URL ?>/visit">New reservation</a>
            <a class="<?= ($activePage == 'all') ? 'active' : '' ?>" href="<?= BASE_URL ?>/visit/all">My reservations</a>
            <a class="<?= ($activePage == 'profile') ? 'active' : '' ?>" href="<?= BASE_URL ?>/visit/profile">My profile</a>
            <a id='logout'>Logout</a>
        </div>
    </header>

<?php else : ?>
    <header>
        <div>
            <a href="<?= BASE_URL ?>">Home</a>
            <a class="<?= ($activePage == 'signin') ? 'active' : '' ?>" href="<?= BASE_URL ?>/signin">Sign In</a>
            <a class="<?= ($activePage == 'signup') ? 'active' : '' ?>" href="<?= BASE_URL ?>/signup">Sign Up</a>
        </div>
    </header>
<?php endif; ?>

<script>
    if (document.getElementById('logout')) {
        document.getElementById('logout').addEventListener('click', () => {
            axios.get(API_URL + '/logout').then(resp => {
                window.location = BASE_URL;
            });
        })
    }
</script>