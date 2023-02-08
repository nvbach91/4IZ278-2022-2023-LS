<?php 
// session_start();
var_dump($_SESSION);
if (!isset($_SESSION['user_id'])) {
    exit();
}

if (!isset($_SESSION['user_privilege'])) {
    exit();
}

if ($_SESSION['user_privilege'] < 3) {
    exit();
}


?>