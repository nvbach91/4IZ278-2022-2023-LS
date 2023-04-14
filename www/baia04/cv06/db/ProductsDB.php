<?php
require_once './db/Database.php'; 
class ProductsDB extends Database {
    protected $tableName = 'products';
    public function fetchByCategory($category_id) {
        return $this->fetchBy('category_id', $category_id);
    }
    public function fetchByID($id) {
        return $this->fetchBy('product_id', $id);
    }
    public function create($args) {
        $sql = 'INSERT INTO ' . $this->tableName . '(name, price, img) VALUES (:name, :price, :img)';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'name' => $args['name'], 
            'price' => $args['price'], 
            'img' => $args['img'],
        ]);
    }
}

?>