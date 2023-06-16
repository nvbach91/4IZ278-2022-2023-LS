<?php
session_start();
setcookie('email', '', time() - 3600);
session_destroy();

header('Location: index.php');
