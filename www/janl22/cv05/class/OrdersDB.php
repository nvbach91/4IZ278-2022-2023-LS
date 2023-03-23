<?php

namespace classes;

require_once __DIR__ . '/Database.php';

class OrdersDB extends Database {

	protected string $dbName = 'orders';

	public function create($args):string {

		return 'Order with ID '. $args['id']. ' was created successfully.' . PHP_EOL;

	}

	public function fetch($id):string {

		return 'Order with ID '. $id . ' was fetched successfully.' . PHP_EOL;

	}

	public function save($id, $args):string {

		return 'Order with ID '. $id . ' was updated successfully.' . PHP_EOL;

	}

	public function delete($id):string {

		return 'Order with ID '. $id . ' was deleted successfully.' . PHP_EOL;

	}

}