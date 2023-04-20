<?php

require_once('database.php');

class UsersDatabase extends Database {
    public function getLogedUser(){
        $user = $_COOKIE['user'];
        $query = "SELECT * FROM `users` WHERE user_id = $user LIMIT 1";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll()[0];
    }

    public function registerUser($username, $email, $password, $avatar){

        $sql = "INSERT INTO users (username, email, password, avatar) VALUES (:username, :email, :password, :avatar)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':avatar', $avatar);
        $stmt->execute();
        return $this->pdo->lastInsertId();
    
    }

    public function getAllUsers(){
        $query = "SELECT * FROM `users`";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getUserById($user){
        $query = "SELECT * FROM `users` WHERE user_id = $user LIMIT 1";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll()[0];
    }

    function login($email, $password) {
        $query = "SELECT * FROM `users` WHERE email = ?";
        $statement = $this->pdo->prepare($query);
        $statement->execute([$email]);
        $user = $statement->fetch(PDO::FETCH_ASSOC);
              
        // Verify the password
        if ($user && password_verify($password, $user['password'])) {
          setcookie('user', $user['user_id'], time() + 60 * 30, '/');
          return true;
        } else {
          return false;
        }
      }

    
}

?>