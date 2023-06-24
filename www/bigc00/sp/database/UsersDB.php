<?php
require_once('../database/Database.php');
class UsersDB extends Database {
    protected $tableName = 'users';

    public function isUserExistsByEmail(string $email) {
        return $this -> fetchOne($this -> tableName, 'email', $email);
    }

    public function isUserExistsByID(int $userID) {
        return $this -> fetchOne($this -> tableName, 'user_id', $userID);
    }

    public function getOne(string $field, string $value) {
        return $this -> fetchOne($this -> tableName, $field, $value);
    }

    public function addUser(array $userInfo) {
        $sql = "INSERT INTO " . $this -> tableName . "(`name`, `surname`, `email`, `phone`, `password`, `permissions`) 
            VALUES (:name, :surname, :email, :phone, :password, :permissions)";
        $statement = $this -> pdo -> prepare($sql);
        $statement -> execute([
            'name' => $userInfo['name'],
            'surname' => $userInfo['surname'],
            'email' => $userInfo['email'],
            'phone' => $userInfo['phone'],
            'password' => password_hash($userInfo['password'], PASSWORD_DEFAULT),
            'permissions' => 0
        ]);
    }
}
?>