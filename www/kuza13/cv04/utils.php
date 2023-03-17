<?php
function getUser($email){
    $databaseFilePath='./database.db';
    $userData=file_get_contents($databaseFilePath);
    $users=explode (PHP_EOL,$userData);
    foreach($users as $user){
        $fields = explode(';',$user);
        $user = [
            'email' => $fields[0],
            'name' => $fields[2],
            'password'=>$fields[1],
            'gender'=>$fields[3],
        ];
        if($user['email']==$email){
            return $user;
        }
    }
}
?>