<?php
const USERS_FILE_PATH = './users.db';

function getUser($email) {

    // nacist data do promenne a zkontrolovat existence emailu
    $usersData = file_get_contents(USERS_FILE_PATH);
    $users = explode(PHP_EOL, $usersData);

    // O(n)
    foreach ($users as $line) {
        $fields = explode(';', $line);
        if ($fields[0] == $email) {
            $user = [
                'email' => $fields[0],
                'phone' => $fields[1],
                'gender' => $fields[2],
                'password' => $fields[3],
            ];
            return $user;
        }
    }
    return null;
}

?>