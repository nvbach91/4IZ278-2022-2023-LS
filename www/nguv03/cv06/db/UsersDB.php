<?php require __DIR__ . '/Database.php'; ?>
<?php

class UsersDB extends Database {
    protected $tableName = 'users';
    public function fetchAll() {
        $sql = 'SELECT * FROM ' . $this->tableName;
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function create($args) {
        $sql = 'INSERT INTO ' . $this->tableName . '(name, email, age) VALUES (:name, :email, :age)';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'name' => $args['name'], 
            'email' => $args['email'], 
            'age' => $args['age'],
        ]);
    }
}

?>