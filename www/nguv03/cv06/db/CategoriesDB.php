<?php require_once __DIR__ . '/Database.php'; ?>
<?php

class CategoriesDB extends Database {
    protected $tableName = 'cv06_categories';
    public function create($args) {
        $sql = 'INSERT INTO ' . $this->tableName . ' (name) VALUES (:name)';
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['name' => $args['name']]);
    }
}

?>