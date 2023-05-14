<?php
interface CrudOperations
{
  public function list($limit, $offset);
  public function get($id);
  public function create($args);
  public function update($args);
  public function delete($id);
}

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
  }
}

abstract class CrudResource extends Database implements CrudOperations {}
