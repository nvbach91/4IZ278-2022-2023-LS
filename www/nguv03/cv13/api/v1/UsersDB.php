<?php
const DB_HOST = 'localhost';
const DB_DATABASE = 'test';
const DB_USERNAME = 'root';
const DB_PASSWORD = 'root';

class UsersDB {
    private $pdo;
    public function __construct() {
        $this->pdo = new PDO(
            'mysql:host=' . DB_HOST . ';dbname=' . DB_DATABASE . ';charset=utf8mb4',
            DB_USERNAME,
            DB_PASSWORD
        );
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
        return $this->pdo->lastInsertId();
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