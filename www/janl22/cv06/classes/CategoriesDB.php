<?php

namespace classes;

require_once __DIR__ . '/Database.php';

class CategoriesDB  extends Database {

	protected string $tableName = 'cv06_categories';

	public function getCategoryName ($id_category) {

		$query = $this->pdo->query('SELECT name FROM ' . $this->tableName . ' WHERE id_category = ' . $id_category . ';');
		return $query->fetchColumn();
	}

}