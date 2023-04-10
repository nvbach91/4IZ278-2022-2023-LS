<?php
interface DatabaseOperations
{
  public function fetchAll();
  //public function create($args);
  //public function save($args);
  //public function delete();
}

abstract class Database implements DatabaseOperations
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
