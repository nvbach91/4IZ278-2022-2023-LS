<?php require_once __DIR__ . '/../config/global.php'; ?>
<?php require_once __DIR__ . '/DatabaseOperations.php'; ?>
<?php

abstract class Database implements DatabaseOperations {
    protected $pdo;
    protected $tableName; // $tableName will be specified in child classes
    public function __construct() {
        //try {
        $this->pdo = new PDO(
            /* DSN */ 'mysql:host=' . DB_HOST . ';dbname=' . DB_DATABASE . ';charset=utf8mb4',
            /* USR */ DB_USERNAME,
            /* PWD */ DB_PASSWORD
        );
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); // allows LIMIT
        //} catch (PDOException $e) {
        //    exit('Connection to DB failed: ' . $e->getMessage());
        //}
    }
    public function fetchAll() {
        $sql = 'SELECT * FROM ' . $this->tableName;
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function fetchBy($field, $value) {
        // PREPARED STATEMENT: POSITIONAL PARAMS
        // $sql = 'SELECT * FROM ' . $this->tableName . ' WHERE ' . $field . ' = ?';
        // $statement = $this->pdo->prepare($sql);
        // $statement->bindValue(1, $value);
        // $statement->execute();
        // return $statement->fetchAll();

        // $sql = 'SELECT * FROM ' . $this->tableName . ' WHERE ' . $field . ' = ?';
        // $statement = $this->pdo->prepare($sql);
        // $statement->execute([$value]);
        // return $statement->fetchAll();

        // PREPARED STATEMENT: NAMED PARAMS
        $sql = 'SELECT * FROM ' . $this->tableName . ' WHERE ' . $field . ' = :value';
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['value' => $value]);

        // ROW COUNT
        $rowCount = $statement->rowCount();

        return $statement->fetchAll();
    }
    public function updateBy($conditions, $args) {
        $sql = 'UPDATE ' . $this->tableName . ' SET ';
        $sets = [];
        foreach($args as $key => $value) {
            $sets[] = $key . ' = :' . $key;
        }
        $sql .= implode(', ', $sets);
        $sql .= ' WHERE ';
        $wheres = [];
        foreach($conditions as $key => $value) {
            $wheres[] = $key . ' = :' . $key;
        }
        $sql .= implode(' && ', $wheres);
        echo $sql;
        $statement = $this->pdo->prepare($sql);
        foreach($args as $key => $value) {
            $statement->bindValue(':' . $key, $value);
        }
        foreach($conditions as $key => $value) {
            $statement->bindValue(':' . $key, $value);
        }
        $statement->execute();
    }
    public function deleteBy($field, $value) {
        $sql = 'DELETE FROM ' . $this->tableName . ' WHERE ' . $field . ' = :value';
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['value' => $value]);
    }
}

?>