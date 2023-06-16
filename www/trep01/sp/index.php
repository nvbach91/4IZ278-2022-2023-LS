<?php
// Získání aktuální URL
$url = $_SERVER['REQUEST_URI'];

// Kontrola, zda URL obsahuje '/client'
if (strpos($url, '/ftpclient') !== false) {
    // Přesměrování na '/client/www'
    header('Location: /ftpclient/www/domains/ftpklient.patriktrejtnar.cz/index.html');
    exit;
}

