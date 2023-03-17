<?php

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/../classes/User.php';
require_once __DIR__ . '/../classes/StatusMessage.php';

use classes\statusMessage;
use classes\User;

function fetchUser($email): ?User {

	$users = file('database/users.db');
	if (empty($users)) return null;

	foreach ($users as $user) {

		$user = trim($user);
		if (empty($user)) continue;
		$user = explode(DELIMITER, $user);

		if ($user[0] === $email) {

			return new User($user[0], $user[1], $user[2], $user[3], $user[4], $user[5]);

		}

	}

	return null;

}

function fetchUsers(): ?array {

	$usersArray = [];
	$users = file('database/users.db');
	if (empty($users)) return null;

	foreach ($users as $user) {

		$user = trim($user);
		if (empty($user)) continue;
		$user = explode(DELIMITER, $user);
		$usersArray[$user[0]] = new User($user[0], $user[1], $user[2], $user[3], $user[4], $user[5]);

	}

	return $usersArray;

}


function registerUser(User $user): bool {

	if (!is_null(fetchUser($user->email))) return false;
	$record = $user->email . DELIMITER . $user->password . DELIMITER . $user->name . DELIMITER . $user->surname . DELIMITER . $user->gender . DELIMITER . $user->phone . PHP_EOL;
	file_put_contents(__DIR__ . '/../database/users.db', $record, FILE_APPEND);
	return true;

}

function authenticateUser($email, $password): array {

	$fieldStatuses = [];

	$user = fetchUser($email);
	if (is_null($user)) {

		$fieldStatuses['notExists'] = new statusMessage('Zadaný uživatel neexistuje! Můžete se <a href="registration.php?email=' . $email . '">zaregistrovat zde</a>!', 'error');

	} else {

		if (!password_verify($password, $user->password)) $fieldStatuses['wrongPassword'] = new statusMessage('Neplatné heslo!', 'error');
		if (empty($fieldStatuses)) header('Location: attendees.php?email=' . $user->email . '&pass=' . $user->password);

	}

	return $fieldStatuses;

}