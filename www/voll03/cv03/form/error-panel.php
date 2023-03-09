<?php if (isset($errors) && !empty($errors)) : ?>
    <div class="py-5 px-5 bg-[#9e3131]">
        <?php foreach ($errors as $error) : ?>
            <p><?php echo $error; ?></p>
        <?php endforeach; ?>
    </div>
<?php elseif (isset($_POST) && !empty($_POST))/*if (isset($_GET['saved']) && $_GET['saved'] === 'ok') */: ?>
    <div class="py-5 px-5 bg-[#214b10]">
        <p>Registration was successfull. Thank you!</p>
        <!-- <img class="block m-auto mt-4 mb-4" src="<?php // echo $_SESSION['avatar_url']; ?>" alt="User avatar" width="256" height="256"> -->
        <img class="block m-auto mt-4 mb-4" src="<?php echo $avatar; ?>" alt="User avatar" width="256" height="256">
    </div>
<?php endif; ?>