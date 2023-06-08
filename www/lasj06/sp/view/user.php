<?php
require '../controller/user_required.php';
require '../controller/authorization.php';
require '../controller/user_controller.php';

authorize(3);

?>

<?php require __DIR__ . "/incl/header.php"; ?>
<div class="products">
    <?php foreach ($users as $user) : ?>
        <div class="product">
            <p><?php echo $user['email'] ?></p>
            <p><?php echo $user['full_name'] ?></p>
            <p><?php echo $user['account_level'] ?></p>
            <a href="edit_user.php?email=<?php echo $user['email'] ?>">Edit user information.</a>
            <br>
        </div>
    <?php endforeach ?>
</div>
<?php require __DIR__ . "/incl/footer.php"; ?>