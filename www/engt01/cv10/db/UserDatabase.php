<?php
require_once "Database.php";

class UserDatabase extends Database {

    public function register(string $email, string $passHash): int {
        $checkEmail = "SELECT * FROM users WHERE email = :email";
        $statement = $this->pdo->prepare($checkEmail);
        $statement->execute(["email" => $email]);
        $isRegistered = $statement->fetchAll();
        if ($isRegistered) return 1;

        $query = "INSERT INTO users(email, hash) VALUE (:email, :hash)";
        $statement = $this->pdo->prepare($query);
        return $statement->execute(["email" => $email, "hash" => $passHash]) ? 0 : -1;
    }

    public function login(string $email): false|array {
        $query = "SELECT hash FROM users WHERE email = :email";
        $statement = $this->pdo->prepare($query);
        $statement->execute(["email" => $email]);
        return $statement->fetchAll();
    }

    public function getUserType(string $email): int {
        $query = "SELECT type FROM users WHERE email = :email";
        $statement = $this->pdo->prepare($query);
        $statement->execute(["email" => $email]);
        return $statement->fetch()["type"] ?? 0;
    }

    public function getUsers(): false|array {
        $query = "SELECT user_id, email, type FROM users";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function updateUserType(int $userId, int $type): void {
        $query = "UPDATE users SET type = :type WHERE user_id = :user_id";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue("type", $type, PDO::PARAM_INT);
        $statement->bindValue("user_id", $userId, PDO::PARAM_INT);
        $statement->execute();
    }
}
