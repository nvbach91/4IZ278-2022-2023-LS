<?php
require '../controller/user_required.php';
require '../controller/authorization.php';

authorize(1);

?>

<?php require __DIR__ . "/incl/header.php"; ?>

<div class="cart_products">
    <div class="cart_line">
        <p class="cart_line_item">Account email: <?php echo $user['email'] ?></p>
    </div>
    <div class="cart_line">
        <p class="cart_line_item">Account name: <?php echo $user['full_name'] ?></p>
    </div>
    <div class="cart_line">
        <p class="cart_line_item">Account level: 
            <?php if ($user['account_level'] == 1) : ?>
                <p class="cart_line_item">User account</p>
            <?php elseif ($user['account_level'] == 2) : ?>
                <p class="cart_line_item">Product Manager account</p>
            <?php elseif ($user['account_level'] == 3) : ?>
                <p class="cart_line_item">Administrator account</p>
            <?php else : ?>
                <p class="cart_line_item">Unidentified account</p>
            <?php endif ?>
        </p>
    </div>

</div>

<?php require __DIR__ . "/incl/footer.php"; ?>