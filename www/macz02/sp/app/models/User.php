<?php
require_once __DIR__ . '/../core/Database.php';

class User {
    private $userId;
    private $email;
    private $password;
    private $username;
    private $createdAt;
    private $updatedAt;

    public function __construct($userId, $email, $password, $username, $createdAt, $updatedAt) {
        $this->userId = $userId;
        $this->email = $email;
        $this->password = $password;
        $this->username = $username;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    // Getter and setter methods
    public function getUserId() { return $this->userId; }
    public function setUserId($userId) { $this->userId = $userId; }

    public function getEmail() { return $this->email; }
    public function setEmail($email) { $this->email = $email; }

    public function getPassword() { return $this->password; }
    public function setPassword($password) { $this->password = $password; }

    public function getUsername() { return $this->username; }
    public function setUsername($username) { $this->username = $username; }

    public function getCreatedAt() { return $this->createdAt; }
    public function setCreatedAt($createdAt) { $this->createdAt = $createdAt; }

    public function getUpdatedAt() { return $this->updatedAt; }
    public function setUpdatedAt($updatedAt) { $this->updatedAt = $updatedAt; }

    // Registration method with input validation and password hashing
    public static function register($email, $username, $password) {
        // Validate inputs
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format");
        }
        if (strlen($username) < 3 || strlen($username) > 20) {
            throw new Exception("Username must be between 3 and 20 characters long");
        }
        if (strlen($password) < 8) {
            throw new Exception("Password must be at least 8 characters long");
        }

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        if ($hashedPassword === false) {
            throw new Exception("Password hashing failed");
        }

        // Insert the new user into the database
        $query = "INSERT INTO users (email, username, password) VALUES (:email, :username, :password)";
        $params = [
            ':email' => $email,
            ':username' => $username,
            ':password' => $hashedPassword,
        ];

        $db = Database::getConnection();
        $db->execute($query, $params);
    }

    // Login method with session management
    public static function login($username, $password) {
        // Query the database for the user
        $query = "SELECT * FROM users WHERE username = :username";
        $params = [':username' => $username];

        $db = Database::getConnection();
        $user = $db->fetchOne($query, $params);

        // Verify the password and start a session
        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user'] = $user;
            return true;
        }

        return false;
    }

    // Method to check if the user is logged in
    public static function isLoggedIn() {
        return isset($_SESSION['user']);
    }

    // Method to log out the user
    public static function logout() {
        session_start();
        unset($_SESSION['user']);
        session_destroy();
    }
}
?>
