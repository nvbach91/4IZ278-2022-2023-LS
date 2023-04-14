<?php

namespace classes;

use PDO;

require_once __DIR__ . '/Database.php';

class ProductsDB extends Database {

	protected string $tableName = 'cv06_products';

	public function fetchByCategory($category) {

		$query = $this->pdo->query('SELECT * FROM ' . $this->tableName . ' WHERE id_category = ' . $category . ';');
		return $query->fetchAll(PDO::FETCH_ASSOC);

	}

}