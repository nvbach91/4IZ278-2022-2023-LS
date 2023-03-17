<?php
// file:cv04/controllers/login.php
require_once(__DIR__ . '/../models/users.php');

$errors_arr = [];
$alert_class = 'alert-danger';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['email'])) {
	$email = filter_var(trim($_GET['email']), FILTER_SANITIZE_EMAIL, array('flags' => FILTER_FLAG_EMAIL_UNICODE));

	// e-mail
	if (!filter_var($email, FILTER_VALIDATE_EMAIL, array('flags' => FILTER_FLAG_EMAIL_UNICODE)))
		$email = '';
	// no errors => display success
	if (empty($errors_arr)) {
		$alert_class = 'alert-success';
		$errors_arr['registered'] = 'You are successfully registered, now you could log-in';
	}
} else if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
	$email = (isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL, array('flags' => FILTER_FLAG_EMAIL_UNICODE)) : '');
	$password = (isset($_POST['password']) ? $_POST['password'] : '');

	// e-mail
	if (!filter_var($email, FILTER_VALIDATE_EMAIL, array('flags' => FILTER_FLAG_EMAIL_UNICODE)))
		$errors_arr['email'] = 'Please enter a valid e-mail';
	// password
	if (empty($password) || strlen($password) < 8)
		$errors_arr['password'] = 'Please enter valid password';
	// check DB
	if (empty($errors_arr)) {
		$auth_arr = authenticate($email, $password);
		if (!$auth_arr['ok'])
			$errors_arr['authentication'] = (!empty($auth_arr['msg']) ? $auth_arr['msg'] : 'Not authenticated');
	}
	// no errors => display success
	if (empty($errors_arr)) {
		$alert_class = 'alert-success';
		$errors_arr['login'] = 'You are logged-in';
	}
}
?>