<?php

namespace classes;

require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/User.php';

use PDO;
use PDOException;

class UsersDB extends Database {

	protected string $tableName = 'cv11_users';
	protected string $rolesTableName = 'cv11_roles';
	protected string $rolesAssignTableName = 'cv11_role_assignments';

	function fetchUsers(): ?array {

		$usersArray = [];
		$users = $this->fetchAll();

		foreach ($users as $user) {

			$userRolesQuery = $this->pdo->prepare('SELECT ro.role_key FROM ' . $this->rolesAssignTableName . ' ra INNER JOIN ' . $this->rolesTableName . ' ro USING (id_role) WHERE ra.user = :mail;');
			$userRolesQuery->execute(['mail' => $user['mail']]);
			$user['roles'] = $userRolesQuery->fetchAll(PDO::FETCH_COLUMN);
			$usersArray[$user['mail']] = new User(...$user);

		}

		return $usersArray;

	}

	public function registerUser(User $user): array {

		$UsersDB = new UsersDB();
		if (!is_null($UsersDB->fetchUser($user->mail))) {
			return [
				'status' => 400,
				'message' => new statusMessage('User exists! Please, <a href="login?mail=' . $user->mail . '&redirect=' . urlencode(base64_encode($GLOBALS['redirect'])) . '">login here</a>!', 'error')
			];
		}

		try {

			$insertUserQuery = $UsersDB->pdo->prepare('INSERT INTO ' . $this->tableName . ' VALUES (:mail, :pass, :name, :surname, :phone);');
			$insertUserQuery->execute([
				'mail' => $user->mail,
				'pass' => $user->password,
				'name' => $user->name,
				'surname' => $user->surname,
				'phone' => $user->phone
			]);

			$roleIdQuery = $UsersDB->pdo->query("SELECT id_role FROM " . $this->rolesTableName . " WHERE role_key = 'store.customer' LIMIT 1;");
			$roleId = $roleIdQuery->fetchColumn();

			$insertRoleQuery = $UsersDB->pdo->prepare('INSERT INTO ' . $this->rolesAssignTableName . ' VALUES (:user, :role);');
			$insertRoleQuery->execute([
				'user' => $user->mail,
				'role' => $roleId
			]);

			return [
				'status' => 201,
				'message' => new statusMessage('Registration was successful. Please, <a href="login?mail=' . $user->mail . '&redirect=' . urlencode(base64_encode($GLOBALS['redirect'])) . '">login here</a>.', 'success')
			];

		} catch (PDOException $e) {

			return [
				'status' => 500,
				'message' => new statusMessage('Customer account creation failed!', 'error')
			];

		}
	}

	public function fetchUser(string $mail): ?User {

		$userQuery = $this->pdo->prepare('SELECT * FROM ' . $this->tableName . ' WHERE mail = :mail LIMIT 1;');
		$userQuery->execute(['mail' => $mail]);
		$user = $userQuery->fetch(PDO::FETCH_ASSOC);

		$userRolesQuery = $this->pdo->prepare('SELECT ro.role_key FROM ' . $this->rolesAssignTableName . ' ra INNER JOIN ' . $this->rolesTableName . ' ro USING (id_role) WHERE ra.user = :mail;');
		$userRolesQuery->execute(['mail' => $mail]);
		$userRoles = $userRolesQuery->fetchAll(PDO::FETCH_COLUMN);

		$user['roles'] = $userRoles;

		if (empty($user['mail'])) {
			return null;
		} else {
			return new User(...$user);
		}
	}

	public function fetchUserRoles(string $mail): ?array {

		$userRolesQuery = $this->pdo->prepare('SELECT * FROM ' . $this->rolesAssignTableName . ' ra INNER JOIN ' . $this->rolesTableName . ' ro USING (id_role) WHERE ra.user = :mail;');
		$userRolesQuery->execute(['mail' => $mail]);
		return $userRolesQuery->fetchAll(PDO::FETCH_ASSOC);

	}

}