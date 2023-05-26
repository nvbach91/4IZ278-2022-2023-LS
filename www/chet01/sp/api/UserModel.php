<?php

class UserModel
{
    function me($api)
    {
        $isAuth = $api->userModel->isAuthenticated($api);
        $isAdmin = $api->userModel->isAdmin($api);
        $response = array(
            "auth" => $isAuth,
            "admin" => $isAdmin,
        );
        $api->sendOutput(
            json_encode($response),
            array('Content-Type: application/json', 'HTTP/1.1 200 OK')
        );
    }
    function registerUser($api, $data)
    {
        $strErrorDesc = '';

        $firstname = trim($data['firstname']);
        $surname = trim($data['surname']);
        $email = trim($data['email']);
        $password = trim($data['password']);
        $phone = trim($data['phone']);

        if (!$firstname || !$surname || !$email || !$password || !$phone) {
            $strErrorDesc = 'Missing parameters';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        } else {

            $valid = preg_match("/^[a-zA-Z]*$/", $firstname) && preg_match("/^[a-zA-Z]*$/", $surname) && preg_match("/^[0-9]*$/", $phone) && preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $email);
            if (!$valid) {
                $strErrorDesc = 'Wrong input format';
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
    function getUserProfile($api)
    {
        $strErrorDesc = '';
        if ($api->userModel->isAuthenticated($api)) {
            $token = $_COOKIE['token'];
            $query = "SELECT firstname, surname, email, phone FROM users WHERE salt = ?";
            $result = $api->executeQuery($query, [$token]);
            $user = $result->fetch(PDO::FETCH_ASSOC);
        } else {
            $strErrorDesc = 'No permission';
            $strErrorHeader = 'HTTP/1.1 403 Forbidden ';
        }
        if (!$strErrorDesc) {
            $api->sendOutput(
                json_encode($user),
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $api->sendOutput(
                json_encode(array('error' => $strErrorDesc)),
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }
    function setUserProfile($api, $post)
    {
        $strErrorDesc = '';
        if ($api->userModel->isAuthenticated($api)) {
            $token = $_COOKIE['token'];
            $query = "UPDATE users SET firstname = ?, surname = ?, phone = ? WHERE salt = ?";
            $api->executeQuery($query, [$post['firstname'], $post['surname'], $post['phone'], $token]);
        } else {
            $strErrorDesc = 'No permission';
            $strErrorHeader = 'HTTP/1.1 403 Forbidden ';
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
    function changePassword($api, $post)
    {
        $strErrorDesc = '';
        if ($api->userModel->isAuthenticated($api)) {
            if (!$post['newPass'] || !$post['oldPass']) {
                $strErrorDesc = 'Missing parameters';
                $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
            } else {
                $token = $_COOKIE['token'];
                $user = $this->getUserByToken($api, $token);
                $hashed_password = hash('sha256', $post['oldPass'] . $token);

                if ($hashed_password == $user['password']) {

                    $newsalt = bin2hex(random_bytes(16));
                    $newpass = hash('sha256', $post['newPass'] . $newsalt);
                    $query = "UPDATE users SET salt = ?, password = ? WHERE id = ?";
                    $api->executeQuery($query, [$newsalt, $newpass, $user['id']]);
                    setcookie('token', $newsalt, time() + (86400 * 30), '/');
                } else {
                    $strErrorDesc = 'Invalid password';
                    $strErrorHeader = 'HTTP/1.1 401 Unauthorized ';
                }
            }
        } else {
            $strErrorDesc = 'No permission';
            $strErrorHeader = 'HTTP/1.1 403 Forbidden ';
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
    function isAuthenticated($api)
    {
        if (isset($_COOKIE['token'])) {
            $token = $_COOKIE['token'];
            $user = $this->getUserByToken($api, $token);
            if ($user) {
                return true;
            } else {
                setcookie('token', '', time() - 3600, '/');
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
        $strErrorDesc = '';
        if ($api->userModel->isAdmin($api)) {
            $user = $this->getUserByEmail($api, $email);
            if ($user) {
                $query = "UPDATE users SET isAdmin = ? WHERE id = ?";
                $api->executeQuery($query, [$user['isAdmin'] === 1 ? 0 : 1, $user['id']]);
            } else {
                $strErrorDesc = 'User not found';
                $strErrorHeader = 'HTTP/1.1 404 Not Found ';
            }
        } else {
            $strErrorDesc = 'No permission';
            $strErrorHeader = 'HTTP/1.1 403 Forbidden ';
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
    function getAllUsers($api)
    {
        $strErrorDesc = '';
        if ($api->userModel->isAdmin($api)) {
            $query = "SELECT id, firstname, surname, email, phone FROM users WHERE isAdmin = 0";
            $result = $api->executeQuery($query);
            $users = $result->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $strErrorDesc = 'No permission';
            $strErrorHeader = 'HTTP/1.1 403 Forbidden ';
        }
        if (!$strErrorDesc) {
            $api->sendOutput(
                json_encode($users),
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $api->sendOutput(
                json_encode(array('error' => $strErrorDesc)),
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }
    function logout($api)
    {
        setcookie('token', '', time() - 3600, '/');
        $api->sendOutput(
            json_encode(array()),
            array('Content-Type: application/json', 'HTTP/1.1 200 OK')
        );
    }
}
