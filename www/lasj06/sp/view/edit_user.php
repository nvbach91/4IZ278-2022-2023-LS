<?php
require '../controller/user_required.php';
require '../controller/authorization.php';
require '../controller/user_controller.php';

authorize(3);

?>

<?php require __DIR__ . "/incl/header.php"; ?>
<form class="form" method="POST">
    <div>
        <label for="full_name">User full name</label>
        <input type="full_name" name="full_name" placeholder="user_full_name" value="<?php echo $user['full_name'] ?>" required>
    </div>
    <div>
        <!-- probably should change this to allow only a selection from 1 to 3 -->
        <label for="account_level">User account level</label>
        <input type="account_level" name="account_level" placeholder="user_account_level" value="<?php echo $user['account_level'] ?>" required>
    </div>
    <br>
    <button type="submit">Change user information</button>
    <!-- revalidate use access level on change of information (in case admin lowers own acc level) -->
    <?php if (!empty($errors)) : ?>
        <div>
            <?php foreach ($errors as $error) : ?>
                <p><?php echo $error ?></p>
            <?php endforeach ?>
        </div>
    <?php endif ?>
</form>


<?php require __DIR__ . "/incl/footer.php"; ?>