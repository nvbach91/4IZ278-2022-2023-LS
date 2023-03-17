<?php

const USERS_FILE_PATH = './resources/users.db';
function getUser($email): ?array
{
    $users = getUsers();

    foreach ($users as $user){
        if ($user[0] == $email) {
            return [
                'email' => $user[0],
                'name' => $user[1],
                'password' => $user[2]
            ];
        }
    }
    return null;
}

function userExist($email): bool
{
    $users = getUsers();

    foreach ($users as $user){
        if ($user[0] == $email) return true;
    }
    return false;
}

function getUsers(): array
{
    $usersData = file_get_contents(USERS_FILE_PATH);
    $usersDataProcessed = explode(PHP_EOL,$usersData);
    $i = 0;
    $users = [];

    foreach ($usersDataProcessed as $line){
        $users[$i] = explode(';',$line);
        $i++;
    }
    return $users;
}
?>