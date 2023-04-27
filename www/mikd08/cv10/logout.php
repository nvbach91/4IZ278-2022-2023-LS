<?php 
    setcookie('user', '', time()-10000);
    session_destroy();
    header('Location: index.php');
    
?>