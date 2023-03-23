<?php

namespace classes;

require_once __DIR__ . '/Database.php';

class ProductsDB extends Database {

	protected string $dbName = 'products';

	public function create($args):string {

		return 'Product with ID '. $args['id']. ' was created successfully.' . PHP_EOL;

	}

	public function fetch($id):string {

		return 'Product with ID '. $id . ' was fetched successfully.' . PHP_EOL;

	}

	public function save($id, $args):string {

		return 'Product with ID '. $id . ' was updated successfully.' . PHP_EOL;

	}

	public function delete($id):string {

		return 'Product with ID '. $id . ' was deleted successfully.' . PHP_EOL;

	}

}