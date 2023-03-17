<?php
function getUsers() {
    $dbFilePath = 'users.db';
  
    $usersData = file_get_contents($dbFilePath);
    // Split string by user rows
    $users = explode(PHP_EOL, $usersData);
  
    $usersList = [];
  
    foreach ($users as $user) {
      if ($user) {
        $fields = explode(';', $user);
  
        // Create associative array
        $user = [
            'firstName' => $fields[0],
            'lastName' => $fields[1],
            'email' => $fields[2],
            'password' => $fields[3],
            'phone' => $fields[4],
            'gender' => $fields[5],
            'avatar' => $fields[6]
        ];
  
        array_push($usersList, $user);
      }
    }
  
    return $usersList;
  }
  
  function getUser($email) {
    $users = getUsers();
  
    foreach ($users as $user) {
      // Check for duplicate
      if ($user['email'] == $email) {
        return $user;
      }
    }
    return null;
  }


?>