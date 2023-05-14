<?php
require_once(__DIR__.'/Database.php');
class UsersDB extends Database{
    function registerUser($user_email, $password)
    {
        try {
            $statement = $this->pdo->prepare("INSERT cv10_users (user_email, password, user_privilege) VALUES(?, ?, 1);");
            $statement->bindParam(1, $user_email);
            $statement->bindParam(2, $password);
            $statement->execute();
        } catch (PDOException $e) {
            return $e;
        }
    }
    function userExists($user_email)
    {
        $statement = $this->pdo->prepare("SELECT * FROM cv10_users WHERE user_email=?");
        $statement->bindParam(1, $user_email);
        $statement->execute();
        $result = $statement->fetchAll();
        if (count($result) != 0) return true;
        return false;
    }
    function verifyLogin($user_email, $password)
    {
        try {
            $statement = $this->pdo->prepare("SELECT * FROM cv10_users WHERE user_email=?");
            $statement->bindParam(1, $user_email);
            $statement->execute();
            $result = $statement->fetch();
            if (password_verify($password, $result['password'])) {
                return 1;
            } else {
                return 0;
            }
        } catch (PDOException $e) {
            return $e;
        }
    }
    function getUserPrivilege($user_email)
    {
        try {
            $statement = $this->pdo->prepare("SELECT * FROM cv10_users WHERE user_email=?");
            $statement->bindParam(1, $user_email);
            $statement->execute();
            $result = $statement->fetch();
            return $result['user_privilege'];
        } catch (PDOException $e) {
            echo $e;
        }
    }
    function getUsers()
    {
        try {
            $statement = $this->pdo->prepare("SELECT * FROM cv10_users");
            $statement->execute();
            $result = $statement->fetchAll();
            return $result;
        } catch (PDOException $e) {
            echo $e;
        }
    }
    function changePrivilege($user_email, $privilege)
    {
        try {
            $statement = $this->pdo->prepare("UPDATE cv10_users SET user_privilege=? WHERE user_email=?;");
            $statement->bindParam(1, $privilege);
            $statement->bindParam(2, $user_email);
            $statement->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }
}


?>