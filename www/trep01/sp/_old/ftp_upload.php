<?php

// nastavení serveru, uživatelského jména a hesla
$ftp_server = "";
$ftp_username = "";
$ftp_password = "";

// Připojení k FTP serveru
$conn_id = ftp_connect($ftp_server);

// Přihlášení
if (@ftp_login($conn_id, $ftp_username, $ftp_password)) {
    echo "Připojeno k $ftp_server jako $ftp_username\n<br>";

    // Zapnutí pasivního módu
    ftp_pasv($conn_id, true);

    // Získání nahrávaného souboru
    $file = $_FILES['fileToUpload']['tmp_name'];
    $remote_file = '/' . basename($_FILES['fileToUpload']['name']);

    // Nahrání souboru
    if (ftp_put($conn_id, $remote_file, $file, FTP_BINARY)) {
        echo "Soubor " . basename($_FILES['fileToUpload']['name']) . " byl úspěšně nahrán na $ftp_server\n<br>";
    } else {
        echo "Nepodařilo se nahrát soubor " . basename($_FILES['fileToUpload']['name']) . " na $ftp_server\n<br>";
    }

    // Odpojení od FTP serveru
    ftp_close($conn_id);
} else {
    echo "Nepodařilo se připojit jako $ftp_username\n<br>";
}
