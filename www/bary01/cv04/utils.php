<?php 

function getUser($email) {
    $usersFilePath = './users.db';
    $usersData = file_get_contents($usersFilePath);

    $users = explode(PHP_EOL, $usersData);

    foreach($users as $line){
        $fields = explode(';', $line);

        if(isset($fields[1]) && $fields[1] == $email){
           $user = [
                'name' => $fields[0],
                'email' => $fields[1],
                'phone' => $fields[3],
                'password' => $fields[2],
                'avatar' => $fields[4],
           ];
           return $user;
        }
    }

    return null;
};



?>