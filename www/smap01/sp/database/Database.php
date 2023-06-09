<?php
require_once(__DIR__ . '/config.php');

//Class Database uses singleton pattern and so it has private constructor and shares its instance only through a getDatabase method. Class creates pdo instance
class Database
{
    private $pdo;
    static $db;
    private final function __construct()
    {
        echo '<script>console.log("' . __CLASS__ . ' initializes only once")</script>';
        try {
            $pdo = new PDO(
                'mysql:host=' . DB_HOST .
                    ';dbname=' . DB_DATABASE .
                    ';charset=utf8mb4',
                DB_USERNAME,
                DB_PASSWORD
            );
            $this->pdo=$pdo;
            $this->pdo->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
            $this->pdo->setAttribute(
                PDO::ATTR_DEFAULT_FETCH_MODE,
                PDO::FETCH_ASSOC
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            exit("Couldn't connect to the database.");
        }
    }

    //Fuction that creates or just shares class instance depending whether it has already been initialized or not. Returns class instance.
    public static function getDatabase()
    {
        if (!isset(self::$db)) {
            self::$db = new Database();
        }
        return self::$db;
    }
    public function getPdo(){
        return $this->pdo;
    }
}
