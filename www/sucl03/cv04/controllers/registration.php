<?php
// file:cv04/controllers/registration.php
require_once(__DIR__ . '/../models/users.php');
require_once(__DIR__ . '/../libs/send-emails-utf8.php');

$errors_arr = [];
$alert_class = 'alert-danger';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
	$name = (isset($_POST['name']) ? htmlspecialchars(trim($_POST['name']), ENT_QUOTES) : '');
	$gender = (isset($_POST['gender']) ? htmlspecialchars(trim($_POST['gender']), ENT_QUOTES) : '');
	$email = (isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL, array('flags' => FILTER_FLAG_EMAIL_UNICODE)) : '');
	$password = (isset($_POST['password']) ? $_POST['password'] : '');
	$confirm_password = (isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '');

	// name
	if (empty($name))
		$errors_arr['name'] = 'Please enter your name';
	// gender
	if (!in_array($gender, ['F', 'M']))
		$errors_arr['gender'] = 'Please select a gender';
	// e-mail
	if (!filter_var($email, FILTER_VALIDATE_EMAIL, array('flags' => FILTER_FLAG_EMAIL_UNICODE)))
		$errors_arr['email'] = 'Please enter a valid e-mail';
	// password
	if (empty($password) || strlen($password) < 8)
		$errors_arr['password'] = 'Please enter valid password';
	// confirm password
	if (empty($confirm_password) || $password != $confirm_password)
		$errors_arr['confirm_password'] = 'Please enter valid password confirmation';
	// Store to DB
	if (empty($errors_arr)) {
		$newUser = registerNewUser(['name' => $name, 'email' => $email, 'password' => $password]);
		if (!$newUser['ok'])
			$errors_arr['registration'] = (!empty($newUser['msg']) ? $newUser['msg'] : 'There was a problem with registration');
	}
	// no errors => send confirmation e-mail
	if (empty($errors_arr)) {
		$body = "Thank you, " . $name . ", for registration!" . "\r\n" .
		"Your registerred e-mail is: " . $email . "\r\n" .
		"Now you could login at: https://www.lxsx.cz/cv04/login.php" . "\r\n" .
		"\r\n" .
		"Yours LXSX automat";
		//send_emails($from, $to_arr, $cc_arr, $bcc_arr, $subject, $body, $text_html = 'text')
		if (!send_emails($config['EMAIL_FROM'], (array)$email, '', '', 'Registration confirmation', $body, 'text'))
			$errors_arr['sendemail'] = 'There was a problem sending e-mail';
	}
	// no errors => redirect
	if (empty($errors_arr)) {
		header('Location: login.php?email=' . $email);
		exit(0);
	}
}
?>