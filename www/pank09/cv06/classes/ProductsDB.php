<?php

require_once __DIR__ . '/AbstractClasses/AbstractDatabase.php';

class ProductsDB extends Database
{
    protected $db_table = 'products';
    protected $db_table_pk = 'product_id';

    public function fetchByCategory ($category_id) {
        $statement = $this->db_conn->prepare("SELECT * FROM `$this->db_table` WHERE `category_id` = :category_id");
        $statement->execute([
            'category_id' => $category_id
        ]);
        return $statement->fetchAll();
    }
    
    public function create($args) {}
    public function save() {}
    public function delete() {}
}