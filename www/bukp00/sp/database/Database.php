<?php

abstract class Database
{
  protected $pdo;
  public function __construct()
  {
    $this->pdo = new PDO(
      'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4',
      DB_USERNAME,
      DB_PASSWORD
    );

    $this->pdo->setAttribute(
      PDO::ATTR_ERRMODE,
      PDO::ERRMODE_EXCEPTION
    );

    $this->pdo->setAttribute(
      PDO::ATTR_DEFAULT_FETCH_MODE,
      PDO::FETCH_ASSOC
    );

    $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  }
}

interface CrudOperations
{
  public function get($limit, $offset);
  public function getBy($field, $value);
  public function create($args);
  public function updateBy($id_field, $id_value, $args);
  public function deleteBy($field, $value);
  public function getPages($conditions, $limit);
}

abstract class Resource extends Database implements CrudOperations
{
  protected $tableName;

  /** Fetch all records */
  public function get($limit = null, $offset = null)
  {
    $query = 'SELECT * FROM ' . $this->tableName;

    if ($limit !== null && $offset !== null) {
      // Limit the number of feedbacks
      $query .= ' LIMIT :limit OFFSET :offset';
    }

    $statement = $this->pdo->prepare($query);

    if ($limit !== null && $offset !== null) {
      // Bind limit values
      $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
      $statement->bindValue(':offset', $offset, PDO::PARAM_INT);
    }

    $statement->execute();
    return $statement->fetchAll();
  }

  /** Fetch by given attribute and value */
  public function getBy($field, $value, $limit = null, $offset = null)
  {
    $sql = 'SELECT * FROM ' . $this->tableName . ' WHERE ' . $field . ' = :value';

    if ($limit !== null && $offset !== null) {
      // Limit the number of feedbacks
      $sql .= ' LIMIT :limit OFFSET :offset';
    }
    $statement = $this->pdo->prepare($sql);

    if ($limit !== null && $offset !== null) {
      // Bind limit values
      $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
      $statement->bindValue(':offset', $offset, PDO::PARAM_INT);
    }

    $statement->bindValue(':value', $value, PDO::PARAM_STR);

    $statement->execute();

    return $statement->fetchAll();
  }

  public function create($args)
  {
    $sql = 'INSERT INTO ' . $this->tableName . ' (';

    // Define fields
    $fields = [];
    foreach ($args as $key => $value) {
      $fields[] = $key;
    }
    $sql .= implode(',', $fields);

    $sql .= ') VALUES (';

    // Define values
    $values = [];
    foreach ($args as $key => $value) {
      $values[] = ':' . $key;
    }
    $sql .= implode(', ', $values);
    $sql .= ')';

    $statement = $this->pdo->prepare($sql);

    foreach ($args as $key => $value) {
      $statement->bindValue(':' . $key, $value);
    }
    $statement->execute();
  }

  /** Update by given conditions */
  public function updateBy($id_field, $id_value, $args)
  {
    $sql = 'UPDATE ' . $this->tableName . ' SET ';
    // Define update fields
    $sets = [];
    foreach ($args as $key => $value) {
      $sets[] = $key . ' = :' . $key;
    }
    $sql .= implode(', ', $sets);
    $sql .= ' WHERE ' . $id_field . ' = :id_value';
    /*
    // Define conditions
    $wheres = [];
    foreach ($conditions as $key => $value) {
      $wheres[] = $key . ' = :' . $key;
    }
    $sql .= implode(' && ', $wheres);*/

    $statement = $this->pdo->prepare($sql);
    foreach ($args as $key => $value) {
      $statement->bindValue(':' . $key, $value);
    }
    /*
    foreach ($conditions as $key => $value) {
      $statement->bindValue(':' . $key, $value);
    }*/
    $statement->bindValue(':id_value', $id_value);

    $statement->execute();
  }

  public function deleteBy($field, $value)
  {
    $sql = 'DELETE FROM ' . $this->tableName . ' WHERE ' . $field . ' = :value';
    $statement = $this->pdo->prepare($sql);
    $statement->bindValue(':value', $value, PDO::PARAM_STR);
    $statement->execute();
  }

  public function getPages($limit, $conditions = null)
  {
    $query = 'SELECT COUNT(*) AS total FROM ' . $this->tableName;

    if ($conditions !== null) {
      $query .= ' WHERE ';
      // Define conditions
      $wheres = [];
      foreach ($conditions as $key => $value) {
        $wheres[] = $key . ' = :' . $key;
      }
      $query .= implode(' && ', $wheres);
    }

    $statement = $this->pdo->prepare($query);

    foreach ($conditions as $key => $value) {
      $statement->bindValue(':' . $key, $value);
    }

    $statement->execute();
    $total = $statement->fetchAll()[0]['total'];

    return ceil($total / $limit);
  }
}
