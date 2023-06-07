<?php
require '../session-check.php';
if ($sessionIsValid):
    header("Location: ../app", true, 301); 
    die;
endif;

require 'registration-form-check.php';
if ($registrationIsSuccesful):
    header("Location: ../?registration=success", true, 301); 
    die;
endif;

$cssFile = '../css/homepage.css';
require '../templates/html-start.php';
?>
<div>
    <div>
        <div class='logo'>
            <img src="../img/eye-logo.svg" alt="logo" width="240px" height="120px">
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