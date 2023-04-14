<?php
require_once './db/Database.php'; 
class CategoriesDB extends Database {
    protected $tableName = 'categories';
    public function fetchByName($name) {
        return $this->fetchBy('name', $name);
    }
    public function create($args) {
        $sql = 'INSERT INTO ' . $this->tableName . '(category_id, name) VALUES (:category_id, :name)';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'category_id' => $args['category_id'],
            'name' => $args['name']
        ]);
    }
}

?>