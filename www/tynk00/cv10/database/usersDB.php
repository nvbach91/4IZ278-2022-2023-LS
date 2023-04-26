<?php

require_once('database.php');

class UsersDatabase extends Database
{
  public function getLoggedUser($id)
  {
    $query = "SELECT * FROM `users` WHERE user_id = ? LIMIT 1";
    $statement = $this->pdo->prepare($query);
    $statement->execute([$id]);
    return $statement->fetchAll()[0];
  }

  public function registerUser($username, $email, $password, $avatar)
  {

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

  public function getAllUsers()
  {
    $query = "SELECT * FROM `users`";
    $statement = $this->pdo->prepare($query);
    $statement->execute();
    return $statement->fetchAll();
  }

  public function getUserById($user)
  {
    $query = "SELECT * FROM `users` WHERE user_id = $user LIMIT 1";
    $statement = $this->pdo->prepare($query);
    $statement->execute();
    return $statement->fetchAll()[0];
  }

  public function login($email, $password, $stayLogged)
  {
    $query = "SELECT * FROM `users` WHERE email = ?";
    $statement = $this->pdo->prepare($query);
    $statement->execute([$email]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);


    $key = uniqid();

    // Verify the password
    if ($user && password_verify($password, $user['password'])) {
      setcookie('user_id', $user['user_id'], time() + 60 * 5, '/');
      setcookie('username', $user['username'], time() + 60 * 5, '/');
      if ($stayLogged) {
        setcookie('session_key', $key, time() + 60 * 60 * 24 * 365, '/');
      } else {
        setcookie('session_key', $key, time() + 60*30, '/');
      }


      session_start();
      $_SESSION[$key] = $user['user_id'];
      
      

      return true;
    } else {
      return false;
    }



    
  }


  public function logout(){
    $_SESSION[$_COOKIE['session_key']] = null;
    $_COOKIE['session_key'] = null;
    header("Location: home.php");
  }

  public function isManager($user)
  {
    return $user['privilege'] > 1;
  }


  public function isAdmin($user)
  {
    return $user['privilege'] > 2;
  }


  public function getPrivilegeName($user)
  {
    $privilege = $user['privilege'];
    $query = "SELECT * FROM `privilegies` WHERE privilege_id = $privilege LIMIT 1";
    $statement = $this->pdo->prepare($query);
    $statement->execute();
    $row = [];
    $row = $statement->fetch();
    return $row["name"];
  }

  public function getPrivileges()
  {
    $query = "SELECT * FROM `privilegies`";
    $statement = $this->pdo->prepare($query);
    $statement->execute();
    return $statement->fetchAll();
  }

  public function setPrivilege($id, $privilege)
  {
    $sql = "UPDATE users SET privilege='$privilege' WHERE user_id = ?";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$id]);
  }


  public function deleteUser($id)
  {
    $sql = "DELETE FROM users WHERE user_id = ?";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$id]);
  }
}
