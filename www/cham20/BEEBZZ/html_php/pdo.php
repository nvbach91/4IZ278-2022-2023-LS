<?php
require_once './config.php';

abstract class Database{
    protected $pdo;
    public function __construct() //dát do abs tridy pac se provadi pro vsehny tabulky
    {
        $this->pdo = new PDO(
            'mysql:host=' . DB_HOST .
                ';dbname=' . DB_DATABASE .
                ';charset=utf8mb4',
            DB_USERNAME,
            DB_PASSWORD
        );
        $this->pdo->setAttribute(
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION
        );
        $this->pdo->setAttribute(
            PDO::ATTR_DEFAULT_FETCH_MODE,
            PDO::FETCH_ASSOC
        );
    }
}
