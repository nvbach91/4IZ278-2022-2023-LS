<?php
require('./config/config.php');
function saveUser($name, $email, $password) {
    $infoString = $name . DELIMITER . $email . DELIMITER . $password . DELIMITER . "\r\n";
    file_put_contents(DB_FILE_USERS, $infoString, FILE_APPEND);
}

function fetchUser($email) {
    $lines = file(DB_FILE_USERS);
    foreach($lines as $line) {
        $line = trim($line);
        if (!$line) continue;
        $fields = explode(DELIMITER, $line);
        if (!count($fields)) { return null; }
        if ($fields[1] === $email) {
            return [
                'name' => $fields[0],
                'email' => $fields[1],
                'password' => $fields[2]
            ];
        }
    }
    return null;
}
?>