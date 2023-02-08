<?php require './Database.php'; ?>
<?php
class UsersDB extends Database {
    protected $tableName = 'users';

    public function fetchAll() {
        $statement = $this->pdo->prepare("SELECT * FROM " . $this->tableName);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function fetchById($id) {
    }
    public function create($args) {
    }
    public function deleteById($id) {
    }
    public function updateById($id, $field, $newValue) {
    }
}
?>