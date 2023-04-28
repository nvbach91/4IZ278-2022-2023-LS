<?php

namespace classes;

use PDO;
use PDOException;

require_once __DIR__ . '/../config/database.php';

abstract class Database {
	protected PDO $pdo;
	protected string $tableName;

	public function __construct() {
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

	public function fetchPage(int $limit, int $offset): false|array {
		$query = $this->pdo->prepare('SELECT * FROM ' . $this->tableName . ' LIMIT :limit OFFSET :offset;');
		$query->bindValue('limit', $limit, PDO::PARAM_INT);
		$query->bindValue('offset', $offset, PDO::PARAM_INT);
		$query->execute();
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

	public function fetchAll(): false|array {
		$query = $this->pdo->query('SELECT * FROM ' . $this->tableName . ';');
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

	public function countAll(): false|int {
		$query = $this->pdo->query('SELECT COUNT(*) FROM ' . $this->tableName . ';');
		return $query->fetchColumn();
	}

}