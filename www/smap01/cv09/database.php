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
        $statement = $this->pdo->prepare("SELECT * FROM cv09_goods");
        $statement->execute();
        $result = $statement->fetchAll();
        return count($result);
    }

    function getItemByOffset($offset, $itemsCountPerPage)
    {
        $statement = $this->pdo->prepare("SELECT * FROM cv09_goods ORDER BY good_id ASC LIMIT ? OFFSET ?");
        $statement->bindParam(1, $itemsCountPerPage, PDO::PARAM_INT);
        $statement->bindParam(2, $offset, PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }

    function goodExists($good_id)
    {
        $statement = $this->pdo->prepare("SELECT * FROM cv09_goods WHERE good_id=?");
        $statement->bindParam(1, $good_id);
        $statement->execute();
        $result = $statement->fetchAll();
        if (count($result) != 0) return true;
        return false;
    }

    function getItem($good_id)
    {
        $statement = $this->pdo->prepare("SELECT * FROM cv09_goods WHERE good_id=?");
        $statement->bindParam(1, $good_id);
        $statement->execute();
        $result = $statement->fetch();
        return $result;
    }

    function insertItem($name, $description, $price)
    {
        try {
            $statement = $this->pdo->prepare("INSERT INTO cv09_goods (name,description,price) VALUES (?, ?, ?);");
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
            $statement = $this->pdo->prepare("DELETE FROM cv09_goods WHERE good_id=?;");
            $statement->bindParam(1, $good_id);
            $statement->execute();
        } catch (PDOException $e) {
            return $e;
        }
    }
    function updateItem($good_id, $name, $description, $price)
    {
        try {
            $statement = $this->pdo->prepare("UPDATE cv09_goods SET name = ?, description = ?, price=? WHERE good_id=?; ");
            $statement->bindParam(1, $name);
            $statement->bindParam(2, $description);
            $statement->bindParam(3, $price);
            $statement->bindParam(4, $good_id);
            $statement->execute();
        } catch (PDOException $e) {
            return $e;
        }
    }
}
