<?php include './includes/header.php' ?>
<?php include './includes/footer.php' ?>
<?php require './classes/utils.php' ?>
<?php
error_reporting(E_ERROR | E_PARSE);
$loginSuccess = isset($_GET['loginSuccess']) ? $_GET['loginSuccess'] : '';

$users = getUsers();

?>
<body>
<div class="container">
    <?php if ($loginSuccess) : ?>
        <p>Uspesne jste se prihlasili</p>
        <h1> Dalsi registrovani uzivatele</h1>
    <?php endif ?>
    <ul class="user-list">
        <?php foreach ($users as $user): ?>
        <?php if ($user[0] != '') : ?>
            <li class="user-card">
                <h2><?php echo $user[1]; ?></h2>
                <p><?php echo $user[0]; ?></p>
            </li>
        <?php endif; ?>
        <?php endforeach; ?>
    </ul>
</div>
</body>


