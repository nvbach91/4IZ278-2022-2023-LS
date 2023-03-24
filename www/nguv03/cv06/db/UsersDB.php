<?php require_once __DIR__ . '/Database.php'; ?>
<?php

class UsersDB extends Database {
    protected $tableName = 'cv06_users';
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