<?php

define("DB_FILE_PATH", __DIR__ . '/database.db');

function fetchUsers()
{
    $users_raw = file_get_contents(DB_FILE_PATH);
    $user_rows = explode(PHP_EOL, $users_raw);

    $users = [];

    foreach ($user_rows as $user) {
        $data = explode(";", $user);

        if (count($data) < 4)
            continue;

        switch ($data[3]) {
            case 'M':
                $gender = "Male";
                break;
            case 'F':
                $gender = "Female";
                break;
            default:
                $gender = "Other";
                break;
        }

        $users[] = [
            "email" => $data[0],
            "phone" => $data[1],
            "pass_hash" => $data[2],
            "gender" => $gender,
        ];
    }

    return $users;
}

function fetchUser($email)
{
    // Check if user exists
    $users_raw = file_get_contents(DB_FILE_PATH);
    $users = explode(PHP_EOL, $users_raw);

    foreach ($users as $user) {
        $data = explode(";", $user);
        $existing_email = $data[0];

        if ($existing_email === $email) {
            $user_data = [
                "email" => $data[0],
                "phone" => $data[1],
                "pass_hash" => $data[2],
                "gender" => $data[3],
            ];

            return $user_data;
        }
    }

    return null;
}

function registerNewUser($email, $phone, $password, $gender)
{
    $record = sprintf("%s;%s;%s;%s", $email, $phone, password_hash($password, PASSWORD_DEFAULT), $gender) . PHP_EOL;
    return file_put_contents(DB_FILE_PATH, $record, FILE_APPEND) !== false;
}