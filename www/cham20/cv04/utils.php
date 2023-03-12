<?php
function fetchUser($email){
    //check if user exists
    $users = fetchUsers();
    foreach ($users as $user) {
        $fields = explode(';', $user);
        /*$existingEmail = $fields[0];
        if ($existingEmail == $email) {
            array_push($errors, 'Email already exists.');
            break;
        }*/
        $user = [
            'email' => $fields[0],
            'phone' => $fields[1],
            'password' => $fields[2],
            'gender' => $fields[3]
        ];
        if($user['email'] == $email){
            return $user;       
        }
    }
    return null;
}
function fetchUsers(){
    $databaseFilePath = './database.db';
    $usersData = file_get_contents($databaseFilePath);
    $users = explode(PHP_EOL, $usersData); //rozdeli string podle znaku, dostaneme pole
    return $users;
}
function authenticate(){
    
}
?>