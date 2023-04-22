<?php

namespace classes;

require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/User.php';

use PDO;
use PDOException;

class UsersDB extends Database {

	protected string $tableName = 'cv09_users';

	function fetchUsers(): ?array {

		$usersArray = [];
		$users = $this->fetchAll();

		foreach ($users as $user) {

			$usersArray[$user['mail']] = new User(...$user);

		}

		return $usersArray;

	}

	public function registerUser(User $user): array {

		$usersDB = new UsersDB();
		if (!is_null($usersDB->fetchUser($user->mail))) {
			return [
				'status' => 400,
				'message' => new statusMessage('User exists! Please, <a href="login.php?mail=' . $user->mail . '">login here</a>!', 'error')
			];
		}

		try {

			$insertUserQuery = $usersDB->pdo->prepare('INSERT INTO ' . $this->tableName . ' VALUES (:mail, :pass, :name, :surname, :phone);');
			$insertUserQuery->execute([
				'mail' => $user->mail,
				'pass' => $user->password,
				'name' => $user->name,
				'surname' => $user->surname,
				'phone' => $user->phone
			]);

			return [
				'status' => 201,
				'message' => new statusMessage('Registration was successful. Please, <a href="login.php?mail=' . $user->mail . '">login here</a>.', 'success')
			];

		} catch (PDOException $e) {

			return [
				'status' => 500,
				'message' => new statusMessage('Customer account creation failed!', 'error')
			];

		}
	}

	public function fetchUser($mail): ?User {

		$userQuery = $this->pdo->prepare('SELECT * FROM ' . $this->tableName . ' WHERE mail = :mail LIMIT 1;');
		$userQuery->execute(['mail' => $mail]);
		$user = $userQuery->fetch(PDO::FETCH_ASSOC);

		if (empty($user)) {
			return null;
		} else {
			return new User(...$user);
		}
	}
}