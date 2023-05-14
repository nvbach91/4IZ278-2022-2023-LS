<?php
namespace Lib;

use PDO;
use PDOException;

require_once __DIR__ . '/../config/db.php';

abstract class Database
{
    protected PDO $pdo;
    protected string $tableName;

    public function __construct($tableName)
    {
        $this->tableName = $tableName;

        try {
            $this->pdo = new PDO(
                'mysql:host=' . HOST . ';dbname=' . DATABASE . ';charset=utf8mb4',
                USERNAME,
                PASSWORD
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            exit('Connection to DB failed: ' . $e->getMessage());
        }
    }

    public function fetchAll($page = 1, $limit = 30): false|array
    {
        $skip = ($page - 1) * $limit;
        $query = $this->pdo->prepare('SELECT * FROM ' . $this->tableName . ' OFFSET :offset LIMIT :limit' . ';');
        $query->execute(['offset' => $skip, 'limit' => $limit]);
        return $query->fetchAll();
    }

    public function 

    public function fetchRaw($sql, $params): false|array
    {
        $query = $this->pdo->prepare($sql);
        $query->execute($params);
        return $query->fetchAll();
    }

}