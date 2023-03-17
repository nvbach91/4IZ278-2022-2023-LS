<?php


function getUser($email)
{
    $usersFilePath = './users.db';
    $usersData = file_get_contents($usersFilePath);



    if ($usersData != "") {
        $users = explode(PHP_EOL, $usersData);
        foreach ($users as $line) {
            $fields = explode(';', $line);

            if ($fields[0] == $email) {

                $user = [
                    'email' => $fields[0],
                    'name' => $fields[1],
                    'avatar' => $fields[2],
                    'sex' => $fields[3],
                    'deckName' => $fields[4],
                    'tel' => $fields[5],
                    'cards' => $fields[6],
                    'password' => $fields[7]


                ];

                return $user;
            }
        }
    }
    return null;
}

function getUser2($email)
{
    $usersFilePath = './users.db';
    $usersData = file_get_contents($usersFilePath);


    if ($usersData != "") {
        $users = explode(PHP_EOL, $usersData);
        foreach ($users as $line) {
            $fields = explode(';', $line);

            if ($fields[0] == $email) {

                $user = new User($fields[0], $fields[1], $fields[2], $fields[3], $fields[4], $fields[5], $fields[6], $fields[7]);

                return $user;
            }
        }
    }
    return null;
}


function getAllUsers()
{
    $usersFilePath = './users.db';
    $usersData = file_get_contents($usersFilePath);
    $allUsers = [];

    $users = explode(PHP_EOL, $usersData);
    foreach ($users as $line) {
        $fields = explode(';', $line);
        array_push($allUsers, new User($fields[0], $fields[1], $fields[2], $fields[3], $fields[4], $fields[5], $fields[6], $fields[7]));
    }
    return $allUsers;
}



class User
{

    public function __construct(
        public $email,
        public $name,
        public $avatar,
        public $sex,
        public $deckName,
        public $tel,
        public $cards,
        public $password
    ) {
    }
}
