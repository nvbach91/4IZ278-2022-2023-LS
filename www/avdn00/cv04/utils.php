<?php 

 function getUsers(){
        $databaseFilePath = './database.db';
        //check if user exists
        $usersData = file_get_contents($databaseFilePath);
        $users = explode(PHP_EOL, $usersData);
        return $users;
    }

function getUser($email) {
    $users = getUsers();
    
    //slozitost O(n)
    foreach($users as $user) {
        $fields = explode(';', $user);

        // // $existingEmail = $fields[0];    
        // if( isset($fields[0]) && $fields[0] == $email){
        //     // array_push($errors, 'Email already exists');
        //     // break;
        
        $user = [
            'email' => $fields[0],
            'password' => $fields[1],
        ];
            if($user['email'] == $email) {
            return $user;       
        }
    }
    return null;
}

?>