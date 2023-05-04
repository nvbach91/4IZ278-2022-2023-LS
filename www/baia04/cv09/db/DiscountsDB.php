<?php
require_once './db/Database.php'; 
class DiscountsDB extends Database {
    protected $tableName = 'discounts';
    public function fetchByName($name) {
        return $this->fetchBy('name', $name);
    }
    public function create($args) {
        $sql = 'INSERT INTO ' . $this->tableName . '(product_id, discount) VALUES (:product_id, :discount)';
        $statement = $this -> pdo -> prepare($sql);
        $statement->execute([
            'product_id' => $args['product_id'],
            'discount' => $args['discount']
        ]);
    }
}

?>