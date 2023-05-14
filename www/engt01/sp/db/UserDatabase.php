<?php
require_once "Database.php";

// TODO test
class UserDatabase extends Database {

    public function register(string $email, string $passHash): int {
        $checkEmail = "SELECT * FROM users WHERE email = :email";
        $statement = $this->pdo->prepare($checkEmail);
        $statement->execute(["email" => $email]);
        $isRegistered = $statement->fetchAll();
        if ($isRegistered) return 1;

        // TODO return user id?
        $query = "INSERT INTO users(email, password) VALUE (:email, :password)";
        $statement = $this->pdo->prepare($query);
        return $statement->execute(["email" => $email, "password" => $passHash]) ? 0 : -1;

    }

    public function login(string $email, string $passHash): int {
        $query = "SELECT password FROM users WHERE email = :email";
        $statement = $this->pdo->prepare($query);
        $statement->execute(["email" => $email]);
        $dbPass = $statement->fetch()["password"];

        if ($dbPass === $passHash) return 0;
        else return 1;
    }

    // TODO have either total debt only or debt per loan and calculate it on the fly
    public function getDebt(int $userId): int {
        $query = "SELECT debt FROM users WHERE id = :id";
        $statement = $this->pdo->prepare($query);
        $statement->execute(["id" => $userId]);
        return $statement->fetch()["debt"];
    }

    public function setDebt(int $userId, int $debt): void {
        $query = "UPDATE users SET debt = :debt WHERE id = :id";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue("debt", $debt);
        $statement->bindValue("id", $userId, PDO::PARAM_INT);
        $statement->execute();
    }

    public function addDebt(int $userId, int $debt): void {
        $query = "UPDATE users SET debt = :debt WHERE id = :id";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue("debt", $this->getDebt($userId) + $debt);
        $statement->bindValue("id", $userId, PDO::PARAM_INT);
        $statement->execute();
    }

//    public function getUsers(): false|array {
//        $query = "SELECT * FROM users";
//        $statement = $this->pdo->prepare($query);
//        $statement->execute();
//        return $statement->fetchAll();
//    }
//
//    public function getUserEmail(int $id): string {
//        $query = "SELECT email FROM users WHERE id = :id";
//        $statement = $this->pdo->prepare($query);
//        $statement->execute(["id" => $id]);
//        return $statement->fetch()["email"];
//    }
//
//    public function getUserId(int $email): string {
//        $query = "SELECT id FROM users WHERE email = :email";
//        $statement = $this->pdo->prepare($query);
//        $statement->execute(["email" => $email]);
//        return $statement->fetch()["id"];
//    }
//
//    public function getUserType(int $id): int {
//        $query = "SELECT type FROM users WHERE id = :id";
//        $statement = $this->pdo->prepare($query);
//        $statement->execute(["id" => $id]);
//        return $statement->fetch()["type"];
//    }
//
//    public function setUserType(int $id, int $type): void {
//        $query = "UPDATE users SET type = :type WHERE id = :id";
//        $statement = $this->pdo->prepare($query);
//        $statement->bindValue("type", $type, PDO::PARAM_INT);
//        $statement->bindValue("id", $id, PDO::PARAM_INT);
//        $statement->execute();
//    }
}
