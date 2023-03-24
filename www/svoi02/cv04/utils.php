<?php

$databaseFilePath = './users.db';

function fetchUsers($filePath) {
    $usersData = file_get_contents($filePath);

    $users = explode(PHP_EOL, $usersData);
    $usersList = [];

    foreach($users as $user) {
        if (trim($user) == '') {
            continue;
        }
        $fields = explode(',', $user);


        $usersList[$fields[1]] = array(
            'name' => $fields[0],
            'password' => $fields[2]
        );

        // $user = [
        //     $fields[1] => $fields[0], $fields[2]
        // ];

        // array_push($usersList, $user);
    }
    return $usersList;

}


function fetchUser($email) {
    $usersData = file_get_contents($GLOBALS['databaseFilePath']);

    //rozdeli string na zaklade separatoru na pole
    $users = explode(PHP_EOL, $usersData);
    
    foreach($users as $user) {
        if (trim($user) == '') {
            continue;
        }
        $fields = explode(',', $user);

        $user = [
            'name' => $fields[0],
            'email' => $fields[1],
            'password' => $fields[2],
        ];

        if ($user['email'] == $email) {
            return $user;
        }
    }
    return null;
}


function registerNewUser($name, $email, $password) {
    $users = fetchUsers('./users.db');
    if (isset($users[$email])) {
        return false;
    }

    $userRecord = "$name,$email,$password" . PHP_EOL;
    file_put_contents($GLOBALS['databaseFilePath'], $userRecord, FILE_APPEND);

    return true;

}


function authenticate($email, $password) {
    $user = fetchUser($email);

    if ($user == null) {
        return "User doesn't exist";
    } else if ($password != $user['password']) {
        return "Wrong password";
    }

    return "Login successful";
}
?>