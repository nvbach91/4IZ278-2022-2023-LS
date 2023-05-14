<?php if (isset($_SESSION['success'])) : ?>
    <div class="success">
        <p><?php 
            echo $_SESSION['success']; 
            unset($_SESSION['success']);
        ?></p>
    </div>
<?php endif ?>
