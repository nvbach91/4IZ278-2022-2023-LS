<?php
// Spustit session
session_start();

// Zrušit všechny session proměnné
$_SESSION = array();

// Zničit session
session_destroy();

// Přesměrovat uživatele na úvodní stránku
header("Location: /");
exit;
?>