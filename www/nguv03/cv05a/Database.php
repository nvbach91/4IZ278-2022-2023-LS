<?php require './config.php'; ?>
<?php require './DatabaseOperations.php'; ?>
<?php

abstract class Database implements DatabaseOperations {
    protected $pdo;
    public function __construct() {
        $connectionString = "mysql:host=" . DATABASE_URL . ";dbname=" . DATABASE_NAME;
        $this->pdo = new PDO(
            $connectionString,
            DATABASE_USERNAME,
            DATABASE_PASSWORD
        );
    }
}


// $db = new Database(/*...*/);
// $db->pdo->prepare();

// $usersDB = new UsersDB();
// $users = $usersDB->fetchAll();
// class ProductsDB extends Database {

// }
?>