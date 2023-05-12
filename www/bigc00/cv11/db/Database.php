<?php 
require_once 'config.php'; 

class Database {
    public $pdo;
    public function __construct() {
        $this->pdo = new PDO(
            'mysql:host=' . DB_HOST . ';dbname=' . DB_DATABASE . ';charset=utf8mb4',
            DB_USERNAME,
            DB_PASSWORD
        );
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); // allows LIMIT
    }

    public function pessimisticEdit($product_id, $user_id)
    {
        $sql = "UPDATE `cv06_products` SET last_edit = now(), last_edit_by = :user_id WHERE product_id = :product_id;";

        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'user_id' => $user_id,
            'product_id' => $product_id
        ]);

        return 200;
    }
}

?>