<?php if (isset($errors) && !empty($errors)) : ?>
    <div class="py-5 px-5 bg-[#9e3131]">
        <?php foreach ($errors as $error) : ?>
            <p><?php echo $error; ?></p>
        <?php endforeach; ?>
    </div>
<?php elseif (isset($_GET['login']) && $_GET['login'] === 'ok'): ?>
    <div class="py-5 px-5 bg-[#214b10]">
        <p>Login was successful!</p>
    </div>
<?php endif; ?>