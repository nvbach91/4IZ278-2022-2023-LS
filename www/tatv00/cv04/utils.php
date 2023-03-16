<?php

function getUsers() {
  $dbFilePath = './database.db';

  $usersData = file_get_contents($dbFilePath);
  // Split string by user rows
  $users = explode(PHP_EOL, $usersData);

  $usersList = [];

  foreach ($users as $user) {
    if ($user) {
      $fields = explode(';', $user);

      // Create associative array
      $user = [
        'email' => $fields[0],
        'phone' => $fields[1],
        'gender' => $fields[2],
        'password' => $fields[3],
        'name' => $fields[4],
        'profileImage' => $fields[5]

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