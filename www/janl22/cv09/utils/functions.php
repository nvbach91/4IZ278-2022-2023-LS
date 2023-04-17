<?php

require_once __DIR__ . '/../classes/User.php';

use classes\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function generateAuthJWT(User $user): string {

	$timestamp = time();

	$payload = array(
		'aud' => ID_TOKEN_AUDIENCE,
		'iss' => $_SERVER['SERVER_NAME'],
		'iat' => $timestamp,
		'nbf' => $timestamp,
		'exp' => $timestamp + 86400,
		'jti' => bin2hex(random_bytes(8)),
		'mail' => $user->mail,
		'name' => $user->name,
		'surname' => $user->surname
	);

	return JWT::encode($payload, AUTH_SALT, 'HS256');

}

function decodeAuthJWT(): ?array {

	if (!isset($_COOKIE['id_token'])) return null;
	$decodedJWT = null;

	try {
		$decodedJWT = JWT::decode($_COOKIE['id_token'], new Key(AUTH_SALT, 'HS256'));
	} catch (Exception $e) {
		unsetCustomCookie('id_token');
	}
	return (array)$decodedJWT;

}

function isLoggedIn(): bool {

	if (!isset($_COOKIE['id_token'])) return false;

	$decodedJWT = decodeAuthJWT();

	if (!isset($decodedJWT['jti'])) return false;
	if ($decodedJWT['aud'] !== ID_TOKEN_AUDIENCE) return false;
	if ($decodedJWT['iss'] !== $_SERVER['SERVER_NAME']) return false;

	return true;

}

function setCustomCookie(string $cookieName, mixed $data): void {

	if (!PRODUCTION && (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == 'off')) {
		setcookie($cookieName, $data, [
			'secure' => false,
			'httponly' => true,
			'samesite' => 'Lax',
			'path' => '/'
		]);
	} else {
		setcookie($cookieName, $data, [
			'secure' => true,
			'httponly' => true,
			'samesite' => 'Lax',
			'path' => '/'
		]);
	}

	if ($cookieName === 'id_token') {
		header('Location: home');
	} else {
		echo '<script>location.reload()</script>';
	}
}

/**
 * Function to unset Auth cookie.
 *
 * @param $cookieName
 *
 * @return void
 */
function unsetCustomCookie($cookieName): void {

	if (!PRODUCTION && (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == 'off')) {
		setcookie($cookieName, "", [
			'secure' => false,
			'httponly' => true,
			'samesite' => 'Lax',
			'path' => '/'
		]);
	} else {
		setcookie($cookieName, "", [
			'secure' => true,
			'httponly' => true,
			'samesite' => 'Lax',
			'path' => '/'
		]);
	}

	if ($cookieName === 'id_token') {
		header('Location: home');
	} else {
		echo '<script>location.reload()</script>';
	}

}

function getUser(): User {

	$token = decodeAuthJWT();
	return new User($token['mail'], '', $token['name'], $token['surname'], '');

}

function countItemsInCart(): int {

	$inCart = 0;
	foreach ($_SESSION['cart'] as $item) {
		$inCart += $item['count'];
	}
	return $inCart;

}

function sumItemsInCartPrice(): int {

	$price = 0;
	foreach ($_SESSION['cart'] as $item) {
		$price += ($item['count'] * $item['unitPrice']);
	}
	return $price;

}

function formatPrice(mixed $price): string {

	return number_format(intval($price), 0, '.', ' ') . ',- Kč';

}