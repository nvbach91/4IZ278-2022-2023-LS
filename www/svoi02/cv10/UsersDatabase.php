<?php require_once './Database.php'; ?>

<?php

class UsersDatabase extends Database {

    public function getUserByEmail($email)
    {
        $query = "SELECT * FROM cv10_users WHERE email = :email LIMIT 1;";
        $statement = $this->pdo->prepare($query);
        $statement->execute([
            'email' => $email
        ]);
        
        $user = $statement->fetchAll();
        if (!empty($user)) {
            return $user[0];
        }
        return null;
    }

    public function createUser($email, $password)
    {
        $user = $this->getUserByEmail($email);
        if (!empty($user)) {
            return false;
        }
    
        $query = "INSERT INTO cv10_users(email, password, auth_level) VALUES (:email, :password, 1);";
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
        $statement = $this->pdo->prepare($query);
        $statement->execute([
            'email' => $email, 
            'password' => $hashedPassword
        ]);
    
        return true;
    }

    public function login($email, $password)
    {
        
        $user = $this->getUserByEmail($email);

        if (empty($user)) {
            return null;
        }

        if (!password_verify($password, $user['password'])) {
            return null;
        }

        return $user;
    }

    public function getUsers()
    {
        $query = "SELECT * FROM cv10_users ORDER BY email ASC;";
        $statement = $this->pdo->prepare($query);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function updateUserAuthLevel($id, $auth_level)
    {
        $query = "UPDATE cv10_users SET auth_level = :auth_level WHERE id = :id;";
        $statement = $this->pdo->prepare($query);
        $statement->execute([
            'auth_level' => $auth_level,
            'id' => $id
        ]);

        return 200;
    }

    // public function verifyAuthLevel($id)
    // {
    //     $query = "SELECT auth_level FROM cv10_users WHERE id = :id LIMIT 1;";
    //     $statement = $this->pdo->prepare($query);
    //     $statement->execute([
    //         'id' => $id
    //     ]);

    //     return (int) $statement->fetchColumn();
    // }


}
