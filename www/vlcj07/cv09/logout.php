<?php

setcookie('username', '', time());
header('Location: index.php');
exit();
?>