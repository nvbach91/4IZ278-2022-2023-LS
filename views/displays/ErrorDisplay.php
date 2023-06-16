<?php if (!empty($errors)) : ?>
    <div class="flex flex-col text-center m-5 gap-2">
        <?php foreach ($errors as $error) : ?>
            <p><?php echo $error ?></p>
        <?php endforeach ?>
    </div>
<?php endif ?>