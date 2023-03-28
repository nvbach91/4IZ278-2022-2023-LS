
<?php 
    require_once "dbinfo.php";
    
    abstract class Database {
        protected $pdo;
        public function __construct() {
            $this->pdo = new PDO("mysql:host=".HOST."; dbname=".DB_NAME."; charset=utf8mb4",USERNAME,PASSWORD);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }
    }
?>