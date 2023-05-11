<?php

class UserModel
{
    function registerUser($api, $data)
    {
        $strErrorDesc = '';

        $firstname = $data['firstname'];
        $surname = $data['surname'];
        $email = $data['email'];
        $password = $data['password'];
        $phone = $data['phone'];

        if (!$firstname || !$surname || !$email || !$password || !$phone) {
            $strErrorDesc = 'Missing parameters';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        } else {

            $user = $this->getUserByEmail($api, $email);

            if (!$user) {
                $salt = bin2hex(random_bytes(16));
                $hashed_password = hash('sha256', $password . $salt);

                $query = "INSERT INTO users (firstname, surname, email, password, salt, phone, isAdmin) VALUES (?, ?, ?, ?, ?, ?, 0)";
                $api->executeQuery($query, [$firstname, $surname, $email, $hashed_password, $salt, $phone]);

                setcookie('token', $salt, time() + (86400 * 30), "/");
            } else {
                $strErrorDesc = 'User with this email already exists';
                $strErrorHeader = 'HTTP/1.1 403 Already Exists ';
            }
        }

        if (!$strErrorDesc) {
            $api->sendOutput(
                json_encode(array()),
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $api->sendOutput(
                json_encode(array('error' => $strErrorDesc)),
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }
    function getUserByEmail($api, $email)
    {
        $query = "SELECT * FROM users WHERE email = ?";
        $result = $api->executeQuery($query, [$email]);
        $user = $result->fetch(PDO::FETCH_ASSOC);
        return $user;
    }
    function getUserByToken($api, $token)
    {
        $query = "SELECT * FROM users WHERE salt = ?";
        $result = $api->executeQuery($query, [$token]);
        return $result->fetch(PDO::FETCH_ASSOC);
    }
    function isAuthenticated($api)
    {
        if (isset($_COOKIE['token'])) {
            $token = $_COOKIE['token'];
            $user = $this->getUserByToken($api, $token);
            if ($user) {
                return true;
            } else {
                // setcookie('token', '', time() - 3600, '/');
            }
        }
        return false;
    }
    function isAdmin($api)
    {
        if (isset($_COOKIE['token'])) {
            $token = $_COOKIE['token'];
            $user = $this->getUserByToken($api, $token);
            if ($user && $user['isAdmin'] === 1) {
                return true;
            }
        }
        return false;
    }
    function loginUser($api, $data)
    {
        $strErrorDesc = '';

        $email = $data['email'];
        $password = $data['password'];

        if (!$email || !$password) {
            $strErrorDesc = 'Missing parameters';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        } else {

            $user = $this->getUserByEmail($api, $email);

            if ($user) {
                $salt = $user['salt'];
                $hashed_password = hash('sha256', $password . $salt);

                if ($hashed_password == $user['password']) {

                    $newsalt = bin2hex(random_bytes(16));
                    $newpass = hash('sha256', $password . $newsalt);
                    $query = "UPDATE users SET salt = ?, password = ? WHERE id = ?";
                    $api->executeQuery($query, [$newsalt, $newpass, $user['id']]);

                    $isAdmin = $user['isAdmin'];

                    setcookie('token', $newsalt, time() + (86400 * 30), '/');
                } else {
                    $strErrorDesc = 'Invalid password';
                    $strErrorHeader = 'HTTP/1.1 401 Unauthorized ';
                }
            } else {
                $strErrorDesc = 'User not found';
                $strErrorHeader = 'HTTP/1.1 404 Not Found ';
            }
        }

        if (!$strErrorDesc) {
            $api->sendOutput(
                json_encode(array('perm' => $isAdmin)),
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $api->sendOutput(
                json_encode(array('error' => $strErrorDesc)),
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }
    function toggleAdmin($api, $email)
    {
        if ($api->isAdmin($api)) {
            $user = $this->getUserByEmail($api, $email);
            if ($user) {
                $query = "UPDATE users SET isAdmin = ? WHERE id = ?";
                $api->executeQuery($query, [$user['isAdmin'] === 1 ? 0 : 1, $user['id']]);
                echo 'User updated';
            } else {
                echo 'User not found';
            }
        } else {
            echo 'No permission';
        }
    }
    function logout()
    {
        setcookie('token', '', time() - 3600, '/');
        echo 'Logged out';
    }
}
