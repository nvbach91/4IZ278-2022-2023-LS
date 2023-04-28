<?php

require_once __DIR__ . '/../classes/User.php';

use classes\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function generateIdToken(User $user): string {

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

function generateAccessToken(User $user): string {

	$timestamp = time();

	$payload = array(
		'aud' => ID_TOKEN_AUDIENCE,
		'iss' => $_SERVER['SERVER_NAME'],
		'iat' => $timestamp,
		'nbf' => $timestamp,
		'exp' => $timestamp + 86400,
		'jti' => bin2hex(random_bytes(8)),
		'mail' => $user->mail,
		'roles' => $user->roles
	);

	return JWT::encode($payload, AUTH_SALT, 'HS256');

}

function decodeToken(string $tokenName): ?array {

	if (!isset($_COOKIE[$tokenName])) return null;
	$decodedJWT = null;

	try {
		$decodedJWT = JWT::decode($_COOKIE[$tokenName], new Key(AUTH_SALT, 'HS256'));
	} catch (Exception $e) {
		unsetCustomCookie($tokenName);
	}
	return (array)$decodedJWT;

}

function isLoggedIn(): bool {

	if (!isset($_COOKIE['id_token'])) return false;
	if (!isset($_COOKIE['access_token'])) return false;

	$decodedJWT = decodeToken('id_token');
	if (!isset($decodedJWT['jti'])) return false;
	if ($decodedJWT['aud'] !== ID_TOKEN_AUDIENCE) return false;
	if ($decodedJWT['iss'] !== $_SERVER['SERVER_NAME']) return false;

	$decodedJWT = decodeToken('access_token');
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

	$token = decodeToken('id_token');
	return new User($token['mail'], '', $token['name'], $token['surname'], '', null);

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

function hasPermission(string $permissionName): bool {

	if (!isLoggedIn()) return false;
	$accessToken = decodeToken('access_token');
	return in_array($permissionName, $accessToken['roles']);

}