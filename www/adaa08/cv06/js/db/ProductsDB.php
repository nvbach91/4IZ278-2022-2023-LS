<?php

class ProductsDB {
    private $pdo;

    public function __construct() {
        $host = 'localhost';
        $db   = 'adaa08';
        $user = 'adaa08';
        $pass = 'dahp7Eidien4iokoop';
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $this->pdo = new PDO($dsn, $user, $pass, $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function fetchAll() {
        $stmt = $this->pdo->query('SELECT * FROM cv06_products');
        return $stmt->fetchAll();
    }

    public function fetchByCategory($category_id) {
        $sql = "SELECT * FROM cv06_products WHERE category_id = :category_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['category_id' => $category_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }

      public function fetchAllCategories() {
        $sql = "SELECT * FROM cv06_categories";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }    
      
}
