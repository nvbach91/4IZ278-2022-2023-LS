<?php
require_once __DIR__ . '/../../assets/config/db-access.php';

class Database {
    protected $pdo;
    public function __construct() {
        $this->pdo = new PDO(
            'mysql:host=' . DB_HOST . ';dbname=' . DB_DATABASE . ';charset=utf8mb4',
            DB_USERNAME,
            DB_PASSWORD
        );
        $this->pdo->setAttribute(
            PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION
        );
        $this->pdo->setAttribute(
            PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC
        );
    }
    public function queryGet($query,$params) {
        $statement = $this->pdo->prepare($query);
        $statement->execute($params);
        return $statement->fetchAll();
    }
    public function querySet($query,$params){
        $statement = $this->pdo->prepare($query);
        $statement->execute($params);
        
    }
}

?>
