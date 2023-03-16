<?php
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
function fetchUsers(){
    $databaseFilePath = './dtbase.db';
    $usersData = file_get_contents($databaseFilePath);
    $users = explode(PHP_EOL, $usersData);
    return $users;
}
function authenticate(){

}
?>