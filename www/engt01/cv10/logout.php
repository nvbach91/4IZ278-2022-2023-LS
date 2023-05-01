<?php
session_start();
setcookie("session", "", time() - 60, "/");
session_destroy();
header("Location: ./index.php");
