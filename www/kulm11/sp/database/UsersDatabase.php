<?php

use Mockery\Generator\StringManipulation\Pass\Pass;

require_once "Database.php";

class UsersDatabase extends Database
{

    public function fetchAll()
    {
        $query = "SELECT * FROM User";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function fetch($id)
    {
        $query = "SELECT * FROM User where userid=?";
        $statement = $this->pdo->prepare($query);
        $statement->bindParam(1, $id);
        $statement->execute();
        return $statement->fetch();
    }

    public function checkEmail($email)
    {
        $query = "SELECT * FROM User WHERE username=?";
        $statement = $this->pdo->prepare($query);
        $statement->bindParam(1, $email);
        $statement->execute();
        $result = $statement->fetchAll();

        if (count($result) != 0) return true;
        return false;
    }

    public function addUser($email, $password, $firstName, $lastName, $city, $street, $buildingNo, $zipCode, $role)
    {
        $passwordHashed = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT User (username, password, firstname, lastname, city, street, buildingno, zipcode, role) VALUES(?,?,?,?,?,?,?,?,?);";
        $statement = $this->pdo->prepare($query);
        $statement->bindParam(1, $email);
        $statement->bindParam(2, $passwordHashed);
        $statement->bindParam(3, $firstName);
        $statement->bindParam(4, $lastName);
        $statement->bindParam(5, $city);
        $statement->bindParam(6, $street);
        $statement->bindParam(7, $buildingNo);
        $statement->bindParam(8, $zipCode);
        $statement->bindParam(9, $role);
        $statement->execute();
    }

    public function checkLogin($email, $password)
    {
        $query = "SELECT * FROM User WHERE username=?";
        $statement = $this->pdo->prepare($query);
        $statement->bindParam(1, $email);
        $statement->execute();
        $result = $statement->fetch();

        if (password_verify($password, $result["password"])) {
            return true;
        }
        return false;
    }

    public function isAdmin($email)
    {
        $query = "SELECT * FROM User WHERE username=?";
        $statement = $this->pdo->prepare($query);
        $statement->bindParam(1, $email);
        $statement->execute();
        $result = $statement->fetch();
        if (strcmp($result["role"], "admin") == 0) {
            return true;
        }
        return false;
    }

    public function changeUserInfo($id, $email, $firstName, $lastName, $city, $street, $buildingNo, $zipCode, $role)
    {
        $query = "UPDATE User
                SET username = ?, firstname= ?, lastname=?, city=?, street=?, buildingno=?, zipcode=?, role=?
                WHERE userid = ?;";
        $statement = $this->pdo->prepare($query);
        $statement->bindParam(1, $email);
        $statement->bindParam(2, $firstName);
        $statement->bindParam(3, $lastName);
        $statement->bindParam(4, $city);
        $statement->bindParam(5, $street);
        $statement->bindParam(6, $buildingNo);
        $statement->bindParam(7, $zipCode);
        $statement->bindParam(8, $role);
        $statement->bindParam(9, $id);
        $statement->execute();
    }

    public function removeUser($id)
    {
        $query = "DELETE FROM User WHERE userid=?";
        $statement = $this->pdo->prepare($query);
        $statement->bindParam(1, $id);
        $statement->execute();
    }

    public function containsUser($id)
    {
        $query = "SELECT * FROM User where userid=?";
        $statement = $this->pdo->prepare($query);
        $statement->bindParam(1, $id);
        $statement->execute();
        $result = $statement->fetch();
        if (count($result) == 0) return false;
        return true;
    }

    public function getUserViaEmail($email)
    {
        $query = "SELECT * FROM User where username=?";
        $statement = $this->pdo->prepare($query);
        $statement->bindParam(1, $email);
        $statement->execute();
        $result = $statement->fetch();
        return $result;
    }
}
