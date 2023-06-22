<?php
require_once "Database.php";

const LOGIN_SUCCESS = 0;
const LOGIN_FAIL = 1;
const LOGIN_NO_ACC = 2;

class UserDatabase extends Database {
    private static ?UserDatabase $sInstance = null;

    private function __construct() {
        parent::__construct();
    }

    public static function getInstance(): UserDatabase {
        if (self::$sInstance === null) self::$sInstance = new UserDatabase();
        return self::$sInstance;
    }

    public function isEmailRegistered(string $email): bool {
        $checkEmail = "SELECT * FROM users WHERE email = :email";
        $statement = $this->pdo->prepare($checkEmail);
        $statement->execute(["email" => $email]);
        return (bool) $statement->fetchAll();
    }

    public function register(string $email, string $passHash): int {
        if ($this->isEmailRegistered($email)) return 1;

        $query = "INSERT INTO users(email, password) VALUE (:email, :password)";
        $statement = $this->pdo->prepare($query);
        return $statement->execute(["email" => $email, "password" => $passHash]) ? 0 : -1;
    }

    public function login(string $email, string $password): int {
        $query = "SELECT password FROM users WHERE email = :email";
        $statement = $this->pdo->prepare($query);
        $statement->execute(["email" => $email]);
        $ret = $statement->fetch();

        if (!$ret) return LOGIN_NO_ACC;
        elseif (password_verify($password, $ret["password"])) return LOGIN_SUCCESS;
        else return LOGIN_FAIL;
    }

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

    public function payDebt(int $userId, int $amount): bool {
        $currDebtQuery = "SELECT debt FROM users WHERE id = :userId";
        $statement = $this->pdo->prepare($currDebtQuery);
        $statement->bindValue("userId", $userId, PDO::PARAM_INT);
        $statement->execute();
        $currDebt = $statement->fetch()["debt"];

        if ($currDebt < $amount) return false;

        $this->setDebt($userId, $currDebt - $amount);
        return true;
    }

    public function getUsers(): false|array {
        $query = "SELECT * FROM users";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getUserEmail(int $id): string {
        $query = "SELECT email FROM users WHERE id = :id";
        $statement = $this->pdo->prepare($query);
        $statement->execute(["id" => $id]);
        return $statement->fetch()["email"];
    }

    public function getUserId(string $email): string {
        $query = "SELECT id FROM users WHERE email = :email";
        $statement = $this->pdo->prepare($query);
        $statement->execute(["email" => $email]);
        return $statement->fetch()["id"];
    }

    public function getUserType(int $id): int {
        $query = "SELECT type FROM users WHERE id = :id";
        $statement = $this->pdo->prepare($query);
        $statement->execute(["id" => $id]);
        return $statement->fetch()["type"];
    }

    public function setUserType(int $id, int $type): void {
        $query = "UPDATE users SET type = :type WHERE id = :id";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue("type", $type, PDO::PARAM_INT);
        $statement->bindValue("id", $id, PDO::PARAM_INT);
        $statement->execute();
    }
}
