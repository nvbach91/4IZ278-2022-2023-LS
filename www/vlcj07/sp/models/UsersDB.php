<?php require_once 'db.php' ?>
<?php

class UsersDatabase extends DB {
    public function fetchAll() {
        $query = "SELECT * FROM sp_users";
        $statement = $this->pdo->prepare($query);
        $statement->execute();    
        return $statement->fetchAll();
    }

    public function fetchbyEmail($email) {
        $query = 'SELECT * FROM sp_users WHERE email = :email LIMIT 1';
        $statement = $this->pdo->prepare($query); 
        $statement->execute(['email' => $email]);
        return $statement->fetchAll()[0];
    }

    public function fetchById($user_id){
        $query = 'SELECT * FROM sp_users WHERE user_id = :user_id LIMIT 1';
        $statement = $this->pdo->prepare($query); 
        $statement->execute(['user_id' => $user_id]);
        return $statement->fetchAll()[0];
    }

    public function registerUser($role, $email, $hashedPassword, $name, $country, $zipCode, $city, $adress, $phone){
        $query = 'INSERT INTO sp_users(role, email, password, name, country, zip_code, city, adress, phone) VALUES (:role, :email, :password, :name, :country, :zip_code, :city, :adress, :phone)';
        $statement = $this->pdo->prepare($query);
        $statement->execute(['role' => $role, 'email' => $email, 'password' => $hashedPassword, 'name' => $name, 'country' => $country, 'zip_code' => $zipCode, 'city' => $city, 'adress' => $adress, 'phone' => $phone]);
    }
}


?>