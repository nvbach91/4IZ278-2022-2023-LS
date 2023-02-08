
<?php require './includes/head.php' ?>

<?php require './utils.php'; ?>
<?php
    $users = getUsers();
    // var_dump($users);
?>

<main>
    <?php foreach($users as $user) :?>
        <div class="user">
            <div class="name"><?php echo $user[0]; ?></div>
            <div class="gender"><?php echo $user[1]; ?></div>
            <div class="email"><?php echo $user[2]; ?></div>
            <div class="phone"><?php echo $user[3]; ?></div>
            <img class="avatar" src="<?php echo $user[4]; ?>">
        </div>
    <?php endforeach;?>

</main>

<?php require './includes/foot.php' ?>