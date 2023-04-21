<?php
setcookie("session", "", time());
session_destroy();
header("Location: ./index.php");
