<?php require './User.php' ?>
<?php

$databaseFilePath = './database.db';

function getUser($username){
    global $databaseFilePath;
    $usersDatabase = file_get_contents($databaseFilePath);
    $usersDataArray = explode(PHP_EOL, $usersDatabase);
    foreach ($usersDataArray as $userData) {
        $user = User::deserialize($userData);
        if ($user->username == $username) {
            return $user;
        }
    }
    return null;
}

function saveUser(User $user){
    global $databaseFilePath;
    file_put_contents($databaseFilePath, $user->serialize(), FILE_APPEND);
}
?>