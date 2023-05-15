<?php
require 'login-form-check.php';
if ($loginIsSuccesful):
    header("Location: app", true, 301); 
    die;
endif;
    require 'templates/html-start.php';
?>
<div>
    <div>
        <div class='logo'>
            logo
        </div>
        <div class='welcome-title'>
            Welcome to Doorkeeper
        </div>
    </div>    
</div>
<div>
<?php require 'login-form.php' ?>
<div>
<?php
    require 'templates/html-end.php';
?>