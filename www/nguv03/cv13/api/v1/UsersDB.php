<?php
class UsersDB {
    private $pdo;
    public function __construct() {
        $this->$pdo = new PDO('mysql:host=localhost;dbname=test;charset=utf8mb4', 'root', 'root');
    }
    public function fetchAll() {
        $sql = 'SELECT * FROM users';
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function create($user) {
        $sql = 'INSERT INTO users (name, age) VALUES (:name, :age)';
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['name' => $user['name'], 'age' => $user['age']]);
        return $pdo->lastInsertId();
    }
    public function update($id, $user) {
        $sql = 'UPDATE TABLE users SET name = :name, age = :age WHERE id = :id';
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['id' => $id, 'name' => $user['name'], 'age' => $user['age']]);
    }
    public function delete($id) {
        $sql = 'DELETE FROM users WHERE id = :id';
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['id' => $id]);
    }
}