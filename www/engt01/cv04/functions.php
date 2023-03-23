<?php
function fetchUsers(): array {
    $users = explode(PHP_EOL, file_get_contents("./users.csv"));
    $ret = [];

    foreach ($users as $user) {
        if (empty($user)) break;
        $user = trim($user);

        $userInfo = explode(";", $user);
        $ret[$userInfo[0]] = [
            "email" => $userInfo[0],
            "name" => $userInfo[1],
            "password" => $userInfo[2]
        ];
    }

    return $ret;
}

function fetchUser($userEmail): ?array {
    $users = explode(PHP_EOL, file_get_contents("./users.csv"));

    foreach ($users as $user) {
        if (empty($user)) break;
        $user = trim($user);
        $userInfo = explode(";", $user);

        if ($userInfo[0] === $userEmail) return [
            "email" => $userInfo[0],
            "name" => $userInfo[1],
            "password" => $userInfo[2]
        ];
    }

    return null;
}

function registerNewUser($newUser): int {
    var_dump($newUser);
    if (fetchUser($newUser["email"])) return 1;

    $entry = $newUser["email"] . ";" . $newUser["name"] . ";" . $newUser["password"] . PHP_EOL;
    file_put_contents("./users.csv", $entry, FILE_APPEND);

    return 0;
}

function auth($email, $password): int {
    $user = fetchUser($email);
    if (!$user) return 1;
    if ($user["password"] !== $password) return 2;
    return 0;
}
