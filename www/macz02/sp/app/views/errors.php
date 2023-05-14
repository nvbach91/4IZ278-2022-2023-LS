<?php if (isset($_SESSION['errors']) && count($_SESSION['errors']) > 0) : ?>
    <div class="error">
        <?php foreach ($_SESSION['errors'] as $error) : ?>
            <p><?php echo $error ?></p>
        <?php endforeach ?>
    </div>
<?php  endif ?>
