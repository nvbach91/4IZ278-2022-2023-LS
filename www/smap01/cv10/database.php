<?php
require_once('./config.php');
class Database
{
    private $pdo;
    function __construct()
    {
        try {
            $this->pdo = new PDO(
                'mysql:host=' . DB_HOST .
                    ';dbname=' . DB_DATABASE .
                    ';charset=utf8mb4',
                DB_USERNAME,
                DB_PASSWORD
            );
            $this->pdo->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
            $this->pdo->setAttribute(
                PDO::ATTR_DEFAULT_FETCH_MODE,
                PDO::FETCH_ASSOC
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            exit("Couldn't connect to the database.");
        }
    }

    function getCountOfTotalRecord()
    {
        $statement = $this->pdo->prepare("SELECT * FROM cv10_goods");
        $statement->execute();
        $result = $statement->fetchAll();
        return count($result);
    }

    function getItemByOffset($offset, $itemsCountPerPage)
    {
        $statement = $this->pdo->prepare("SELECT * FROM cv10_goods ORDER BY good_id ASC LIMIT ? OFFSET ?");
        $statement->bindParam(1, $itemsCountPerPage, PDO::PARAM_INT);
        $statement->bindParam(2, $offset, PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }

    function goodExists($good_id)
    {
        $statement = $this->pdo->prepare("SELECT * FROM cv10_goods WHERE good_id=?");
        $statement->bindParam(1, $good_id);
        $statement->execute();
        $result = $statement->fetchAll();
        if (count($result) != 0) return true;
        return false;
    }

    function getItem($good_id)
    {
        $statement = $this->pdo->prepare("SELECT * FROM cv10_goods WHERE good_id=?");
        $statement->bindParam(1, $good_id);
        $statement->execute();
        $result = $statement->fetch();
        return $result;
    }

    function insertItem($name, $description, $price)
    {
        try {
            $statement = $this->pdo->prepare("INSERT INTO cv10_goods (name,description,price) VALUES (?, ?, ?);");
            $statement->bindParam(1, $name);
            $statement->bindParam(2, $description);
            $statement->bindParam(3, $price);
            $statement->execute();
        } catch (PDOException $e) {
            return $e;
        }
    }
    function deleteItem($good_id)
    {
        try {
            $statement = $this->pdo->prepare("DELETE FROM cv10_goods WHERE good_id=?;");
            $statement->bindParam(1, $good_id);
            $statement->execute();
        } catch (PDOException $e) {
            return $e;
        }
    }
    function updateItem($good_id, $name, $description, $price)
    {
        try {
            $statement = $this->pdo->prepare("UPDATE cv10_goods SET name = ?, description = ?, price=? WHERE good_id=?; ");
            $statement->bindParam(1, $name);
            $statement->bindParam(2, $description);
            $statement->bindParam(3, $price);
            $statement->bindParam(4, $good_id);
            $statement->execute();
        } catch (PDOException $e) {
            return $e;
        }
    }
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
