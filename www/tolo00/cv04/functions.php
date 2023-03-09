<?php

function getBaseUrl()
{
    return '//'.$_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
}

function fetchAllUsers()
{
    $users = [];

    if (($handle = fopen(__DIR__ . "/users.db", "r")) !== FALSE) {
        while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $users[] = $row;
        }

        fclose($handle);
    }

    return $users;
}

function fetchUser($email, $onlyCheckIfExists = true)
{
    $userExists = false;

    if (($handle = fopen(__DIR__ . "/users.db", "r")) !== FALSE) {
        while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
            if ($row[0] === $email) {
                if (!$onlyCheckIfExists) {
                    return $row;
                }

                $userExists = true;
                break;
            }
        }

        fclose($handle);
    }

    return $userExists;
}

function registerNewUser($email, $password, $name)
{
    if (($handle = fopen(__DIR__ . "/users.db", "a")) !== FALSE) {
        fputcsv($handle, [
            'email' => $email,
            'password' => $password,
            'name' => $name,
        ]);

        fclose($handle);
    }


    header("Location: " . getBaseUrl() . "/login.php?email=" . $email);
    exit;
}

function authenticate($email, $password)
{
    $user = fetchUser($email, false);

    if (!$user || $user[1] !== $password) {
        return false;
    }

    return true;
}
