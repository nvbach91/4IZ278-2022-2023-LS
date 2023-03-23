<?php

if (!function_exists('fetchUser')) {
    function fetchUser($email){
        $users = fetchUsers();
        foreach ($users as $user) {
            $fields = explode(';', $user);
            $user = [
                'email' => $fields[0],   
                'password' => $fields[1],  
            ];
            if($user['email'] == $email){
                return $user;       
            }
        }
        return null;
    }
}

if (!function_exists('fetchUsers')) {
    function fetchUsers(){
        $databaseFilePath = 'users.db';
        $usersData = file_get_contents($databaseFilePath);
        $users = explode(PHP_EOL, $usersData);
        return $users;
    }
}

if (!function_exists('authenticate')) {
    function authenticate(){

    }
}

?>