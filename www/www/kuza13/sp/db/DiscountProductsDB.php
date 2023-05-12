<?php
class DiscountProductsDB extends Database {
    
protected $tableName = 'discounts';

public function fetchByID($id) {
    return $this->fetchBy('product_id', $id);
}

public function create($args) {
    $sql = 'INSERT INTO ' . $this->tableName . '(product_id, discount) VALUES (:product_id, :discount)';
    $statement = $this->pdo->prepare($sql);
    $statement->execute([
        'product_id' => $args['product_id'],
        'discount' => $args['discount']
    ]);
}
}
?>