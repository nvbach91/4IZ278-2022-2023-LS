<?php
$_SESSION['access_token'] = '';
$_SESSION['user_id'] = '';

session_destroy();

header('Location: index.php');
exit();
