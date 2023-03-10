<?php if (!empty($errors)):?>
        <div class="error-message">
            <?php foreach($errors as $error): ?>
                <p><?php echo $error?></p>
                <?php endforeach?>
        </div>
    <?php elseif (isset($_POST) && empty($errors) && !empty($_POST)): ?>
        <div class="success">
            <p>Form submitted succesfully!</p> 

            <?php if (isset($avatar) && $avatar): ?>
                <div class="avatar-container">
                    <img class="avatar" src="<?php echo $avatar; ?>" alt="avatar" width="200px">
                </div>
             <?php endif; ?>
        </div>   
    <?php endif?>       