<?php 

function validateUser($email) {
    $databasePath = "users.db";
    $usersData = file_get_contents($databasePath);
    $users = explode("\n", $usersData);
    // var_dump($users);
    foreach ($users as $user) {
        $fields = explode(";", $user);
        // var_dump($fields);
        // $existingMail = $fields[0];
        // if ($existingMail == $email ) {
        //     array_push($errors, "Email already registered");
        //     break;
        // }
        if ($user != "") {
            $userObj = [
                "email" => $fields[0],
                "phone" => $fields[1],
                "password" => $fields[2],
                "gender" => $fields[3],
            ] ;
        }


        // var_dump($userObj);
        if ($userObj["email"] == $email) {
            return $userObj;  
        }
    }  
    return null;
}

?>