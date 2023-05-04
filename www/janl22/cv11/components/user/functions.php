<?php

require_once __DIR__ . '/../../classes/StatusMessage.php';
require_once __DIR__ . '/../../classes/UsersDB.php';

use classes\StatusMessage;
use classes\UsersDB;

function authenticateUser($mail, $password): array {

	$UsersDB = new UsersDB();
	$user = $UsersDB->fetchUser($mail);

	if (empty($user)) {

		return [
			'status' => 404,
			'message' => new StatusMessage('User does not exists! You can <a href="registration?mail=' . $mail . '&redirect=' . urlencode(base64_encode($GLOBALS['redirect'])) . '">register here</a>!', 'error')
		];

	} else if (!password_verify($password, $user->password)) {

		return [
			'status' => 404,
			'message' => new StatusMessage('Wrong password!', 'error')
		];

	} else {

		return [
			'status' => 200,
			'message' => new StatusMessage('Login successful!', 'success')
		];

	}
}