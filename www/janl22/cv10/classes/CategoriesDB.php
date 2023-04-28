<?php

namespace classes;

use PDO;

require_once __DIR__ . '/Database.php';

class CategoriesDB extends Database {

	protected string $tableName = 'cv10_categories';

	public function getCategoryName($id_category) {

		$query = $this->pdo->query('SELECT name FROM ' . $this->tableName . ' WHERE id_category = ' . $id_category . ';');
		return $query->fetchColumn();
	}

	public function categoryExists(int $id): bool {

		$categoryQuery = $this->pdo->prepare('SELECT true FROM ' . $this->tableName . ' WHERE id_category = :category;');
		$categoryQuery->bindParam('category', $id, PDO::PARAM_INT);
		$categoryQuery->execute();
		return $categoryQuery->fetchColumn();

	}

}