<?php
require 'registration-form-check.php';
    if ($registrationIsSuccesful):
        header("Location: ../?registration=success", true, 301); 
        die;
    endif;
    require '../templates/html-start.php';
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
<?php require 'registration-form.php' ?>
<div>
<?php
    require '../templates/html-end.php';
?>