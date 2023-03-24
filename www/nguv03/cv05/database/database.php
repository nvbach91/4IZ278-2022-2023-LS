<?php require 'database-config.php'; ?>
<?php
interface DatabaseOperations {
    public function fetch($args);
    // other operations CRUD
}
abstract class Database implements DatabaseOperations {
    protected $connection;
    protected function query($query) {
        $result = $this->connection->query($query);
        if ($result) {
            return $result->fetch_assoc();
        }
        return [];
    }
    public function __construct() {
        $this->connection = new mysqli(
            DB_SERVER_URL, 
            DB_USERNAME, 
            DB_PASSWORD, 
            DB_DATABASE
        );
        if ($this->connection->connect_error) {
            exit("Connection to DB failed: " . $this->connection->connect_error);
        } 
    }
}
class UsersDB extends Database {
    public function fetch($args) {
        return $this->query(
            "SELECT * FROM cv05_users WHERE Email = '" . $args['email'] . "'"
        );
    }
}
?>