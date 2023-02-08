<?php
function getUsers () {
    $userRecords = explode(
        PHP_EOL,
        file_get_contents('users.db'),
    );
    $users = [];
    foreach($userRecords as $userRecord) {
        $user = explode(';', $userRecord);
        if (count($user) > 4) {
            array_push($users, $user);
        }
    }
    return $users;
}
function getUser($email) {
    $users = getUsers();
    foreach($users as $user) {
        if ($user[2] === $email) {
            return $user;
        }
    }
    return null;
}

?>