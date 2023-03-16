<?php

function getUser($email) {
    $databaseFilePath = './database.db';
    $usersData = file_get_contents($databaseFilePath);
    $users = explode(PHP_EOL, $usersData);
    foreach ($users as $user) {
        if (trim($user) == '') {
            continue;
        }
        $fields = explode(';', $user);
        $user = [
            'email' => $fields[0],
            'phone' => $fields[1],
            'password' => $fields[2],
            'gender' => $fields[3],
        ];
        if ($user['email'] == $email) {
            return $user;
        }
    }
    return null;
}

?>