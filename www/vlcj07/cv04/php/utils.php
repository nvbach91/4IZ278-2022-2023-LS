<?php 

    function fetchUser($email) {
        $databaseFilePath = '../db/users.db';
        $usersData = file_get_contents($databaseFilePath); 
        $users = explode(PHP_EOL, $usersData);

        foreach($users as $line){
            $fields = explode(';', $line);

            if ($fields[0] == $email) {
                $user = [
                    'email' => $fields[0],
                    'name' => $fields[1],
                    'password' => $fields[2],
                ];
                return $user;
            }
        }
        return null;
    }

    function fetchUsers() {
        $databaseFilePath = '../db/users.db';
        $usersData = file_get_contents($databaseFilePath); 
        $users = explode(PHP_EOL, $usersData);

        return $users;
    }

    function registerNewUser(array $userData)
    {
        $databaseFilePath = '../db/users.db';
        $userRecord = implode(';', $userData) . PHP_EOL;
        file_put_contents($databaseFilePath, $userRecord, FILE_APPEND);
    }
?>