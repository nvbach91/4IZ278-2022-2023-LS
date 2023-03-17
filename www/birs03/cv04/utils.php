<?php
CONST USER_FILE_PATH = './users.db';

function getUser($id){
    $usersFilePath = './users.db';
    $usersData = file_get_contents($usersFilePath);
    $users = explode(PHP_EOL,$usersData);

    foreach($users as $line){
        $fields = explode(';',$line);
        if(isset($fields[1])&&$fields[1]==$id){
            if(isset($fields[0])&&isset($fields[2])){
                $user = [
                    'name' => $fields[0],
                    'email' => $fields[1],
                    'password' => $fields[2],
                ];
            }
            return $user;
        }
    }
    return null;
}

?>