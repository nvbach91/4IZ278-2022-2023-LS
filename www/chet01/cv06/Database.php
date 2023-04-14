<?php
abstract class Database
{
    protected $pdo;

    public function __construct()
    {
        $this->pdo = new PDO(
            'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4',
            DB_USERNAME,
            DB_PASSWORD
        );
    }
}
