<?php

namespace classes;

use function MongoDB\BSON\toJSON;

require_once __DIR__ . '/Database.php';

class UsersDB extends Database {

	protected string $dbName = 'users';

	public function create($args):string {
		$record = $args['id'] . $this->dbDelimiter . $args['name'] . $this->dbDelimiter . $args['surname'] . PHP_EOL;
		file_put_contents(__DIR__ . '/../' . $this->dbPath . $this->dbName . $this->dbExtension, $record, FILE_APPEND);
		return 'User with ID '. $args['id']. ' was created successfully.' . PHP_EOL;
	}

	public function fetch($id):?string {

		$users = file(__DIR__ . '/../' . $this->dbPath . $this->dbName . $this->dbExtension);
		if (empty($users)) return 'User with ID '. $id . ' was not found!' . PHP_EOL;

		foreach ($users as $user) {

			$user = trim($user);
			if (empty($user)) continue;
			$user = explode($this->dbDelimiter, $user);
			if($user[0] == $id) {

				return 'User with ID ' . $id . ' was fetched successfully: ' . json_encode(['id' => $user[0], 'name' => $user[1], 'surname' => $user[2]]) . PHP_EOL;

			}
		}

		return 'User with ID '. $id . ' was not found!' . PHP_EOL;

	}

	public function save($id, $args) {

		$users = file(__DIR__ . '/../' . $this->dbPath . $this->dbName . $this->dbExtension);
		if (empty($users)) return null;

		foreach ($users as $user) {

			$user = trim($user);
			if (empty($user)) continue;
			$userExploded = explode($this->dbDelimiter, $user);
			if($userExploded[0] == $id) {

				$updatedRecord = $id . $this->dbDelimiter . $args['name'] . $this->dbDelimiter . $args['surname'] . PHP_EOL;
				$contents = str_replace($user, $updatedRecord, $users);
				$contents = array_values(array_filter($contents, "trim"));
				file_put_contents(__DIR__ . '/../' . $this->dbPath . $this->dbName . $this->dbExtension, $contents);
				return 'User with ID '. $id . ' was updated successfully.' . PHP_EOL;

			}
		}

		return 'User with ID '. $id . ' was not found!' . PHP_EOL;

	}

	public function delete($id):?string {

		$users = file(__DIR__ . '/../' . $this->dbPath . $this->dbName . $this->dbExtension);
		if (empty($users)) return 'User with ID '. $id . ' was not found!' . PHP_EOL;

		foreach ($users as $user) {

			$user = trim($user);
			if (empty($user)) continue;
			$userExploded = explode($this->dbDelimiter, $user);
			if($userExploded[0] == $id) {

				$contents = str_replace($user, '', $users);
				$contents = array_values(array_filter($contents, "trim"));
				file_put_contents(__DIR__ . '/../' . $this->dbPath . $this->dbName . $this->dbExtension, $contents);
				return 'User with ID '. $id . ' was deleted successfully.' . PHP_EOL;

			}
		}

		return 'User with ID '. $id . ' was not found!' . PHP_EOL;

	}

}