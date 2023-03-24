<?php

function getUsers()
{
  $dbFile = './database.db';
  $usersData = file_get_contents($dbFile);
  $users = explode(PHP_EOL, $usersData);
  $usersList = [];

  foreach ($users as $user) {
    if ($user) {
      $fields = explode(';', $user);
      //$userRecord = "$mail;$password;$firstName;$lastName;$address;$occupation;$birthYear;$avatar";
      $user = [
        'mail' => $fields[0],
        'password' => $fields[1],
        'firstName' => $fields[2],
        'lastName' => $fields[3],
        'address' => $fields[4],
        'occupation' => $fields[5],
        'birthYear' => $fields[6],
        'avatar' => $fields[7]

      ];

      array_push($usersList, $user);
    }
  }

  return $usersList;
}

function getUser($mail)
{
  $users = getUsers();

  foreach ($users as $user) {
    if ($user['mail'] == $mail) {
      return $user;
    }
  }
  return null;
}

?>