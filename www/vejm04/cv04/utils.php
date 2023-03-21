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
            'password' => $fields[2]
        ];
        if ($user['email'] == $email) {
            return $user;
        }
    }
    return null;
}

function getAllUsers() {
    $databaseFilePath = './database.db';
    $usersData = file_get_contents($databaseFilePath);
    $users = explode(PHP_EOL, $usersData);
    $usersField = [];
    foreach ($users as $user) {
        $fields = explode(';', $user);
        $email = $fields[0];
        array_push($usersField, $email);
    }
    return $usersField;
}

?>