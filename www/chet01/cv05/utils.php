<?php
define('DBPATH', './users.db');

function getUser($email)
{
    $users = file_get_contents(DBPATH);
    $users = explode(PHP_EOL, $users);
    // $emailValidation = true;
    foreach ($users as $user) {
        $fields = explode(';', $user);
        $user = [
            'name' => $fields[0],
            'email' => $fields[1],
            'password' => $fields[2],
            'phone' => $fields[3],
            'photo' => $fields[4],
        ];
        if ($email === $user["email"]) {
            return $user;
        }
    }
    return null;
}

function fetchUsers()
{
    $users = [];
    $lines = file(DBPATH);
    foreach ($lines as $line) {
        $line = trim($line);
        if (!$line) continue; // skip blank lines
        $fields = explode(';', $line);
        $users[$fields[1]] = [
            'name' => $fields[0],
            'email' => $fields[1],
            'password' => $fields[2],
            'phone' => $fields[3],
            'photo' => $fields[4],
        ];
    }
    return $users;
};

function registerNewUser($payload)
{
    $users = fetchUsers();
    if (array_key_exists($payload['email'], $users)) {
        return ['success' => false, 'msg' => 'Email already registered. Please use another email address.'];
    }
    $userRecord =
        $payload['name'] . ';' .
        $payload['email'] . ';' .
        $payload['password'] . "\r\n";
    //echo $userRecord;
    file_put_contents(DBPATH, $userRecord, FILE_APPEND);
    return ['success' => true, 'msg' => 'Registration was successful'];
};

function authenticate($email, $password)
{
    $user = getUser($email);
    if (!$user) {
        return ['success' => false, 'msg' => 'This account does not exist'];
    }
    if ($user['password'] !== $password) {
        return ['success' => false, 'msg' => 'Wrong password'];
    }
    return ['success' => true, 'msg' => 'Login success'];
};

function getInputValidClass($key, $errors)
{
    return array_key_exists($key, $errors) ? ' is-invalid' : '';
};
