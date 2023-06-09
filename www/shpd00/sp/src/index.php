<?php
  // HSTS hlavičku posíláme jen při použití protokolu HTTPS:
  if (isset( $_SERVER["HTTPS"] )|| $_SERVER['https'] == 'on' || $_SERVER['SERVER_PORT'] == 443) {
    header("Strict-Transport-Security: max-age=63072000; includeSubDomains; preload");
  }
?>

<?php
require 'session-check.php';
if ($sessionIsValid):
    header("Location: app", true, 301); 
    die;
endif;

require 'login-form-check.php';
if ($loginIsSuccesful):
    header("Location: app", true, 301); 
    die;
endif;

$cssFile = './css/homepage.css';
require 'templates/html-start.php';
?>
<div>
    <div>
        <div class='logo'>
            <img src="img/eye-logo.svg" alt="logo" width="240px" height="120px">
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