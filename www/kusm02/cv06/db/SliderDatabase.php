<?php require_once __DIR__ . '/Database.php'; ?>
<?php

class SliderDatabase extends Database {
    protected $tableName = 'slides';
    public function create($args) {
        $sql = 'INSERT INTO ' . $this->tableName . ' (img, alt) VALUES (:img, :alt)';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'name' => $args['name'],
            'alt' => $args['alt'],
        ]);
    }
}

?>