<?php require_once __DIR__ . '/Database.php'; ?>
<?php

class ProductsDB extends Database {
    protected $tableName = 'cv06_products';
    public function fetchByCategory($category_id) {
        return $this->fetchBy('category_id', $category_id);
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