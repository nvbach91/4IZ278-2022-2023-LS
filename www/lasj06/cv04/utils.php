<?php
const DATABASE = 'users.db';

function fetchUsers($mail) {
    
    $usersData = file_get_contents(DATABASE);
    $users = explode(PHP_EOL, $usersData);
    foreach ($users as $user) {
        if (trim($user) == '') {
            continue;
        }
        $fields = explode(';', $user);
        $user = [
            'mail' => $fields[0],
            'phone' => $fields[1],
            'password' => $fields[2],
        ];
        if ($user['mail'] == $mail) {
            return $user;
        }
    }
    return null;
}

function registerNewUser($mail, $name, $password) {
    $userRecord = "$mail;$name;$password" . PHP_EOL;
    file_put_contents(DATABASE, $userRecord, FILE_APPEND);
    mail($mail, 'Registration complete', 'You have succesfully registered');
}

function authenticate() {
    $mail = trim($_POST['mail']);
    $password = trim($_POST['password']);
    $existingUser = fetchUsers($mail);
    if ($existingUser != null) {
        if ($existingUser['password'] == $password) {
            echo 'Login successful';
        } else {
            echo 'Incorrect password';
        }
    } else {
        echo 'Nonexistent user';
    }
}

?>