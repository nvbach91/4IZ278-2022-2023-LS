<?php
require 'libs/send-emails-utf8.php';

//consts
$from = 'lucie@skmile.cz';

$invalid_inputs_arr = array();
$cause_arr = array();
$alert_class = 'alert-danger';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
	$name = (isset($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : '');
	$gender = (isset($_POST['gender']) ? htmlspecialchars(trim($_POST['gender'])) : '');
	$email = (isset($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : '');
	$phone = (isset($_POST['phone']) ? htmlspecialchars(trim($_POST['phone'])) : '');
	$avatar = (isset($_POST['avatar']) ? htmlspecialchars(trim($_POST['avatar'])) : '');
	$cards_deck_name = (isset($_POST['cards_deck_name']) ? htmlspecialchars(trim($_POST['cards_deck_name'])) : '');
	$cards_deck_count = (isset($_POST['cards_deck_count']) ? htmlspecialchars(trim($_POST['cards_deck_count'])) : '');

	// name
	if (empty($name)) {
		array_push($cause_arr, 'Please enter your name');
		array_push($invalid_inputs_arr, 'name');
	}
	// gender
	if (!in_array($gender, ['F', 'M'])) {
		array_push($cause_arr, 'Please select a gender');
		array_push($invalid_inputs_arr, 'gender');
	}
	// e-mail
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		array_push($cause_arr, 'Please enter a valid e-mail');
		array_push($invalid_inputs_arr, 'email');
	}
	// phone number
	if (!preg_match('/^(\+|00|0)?[1-9][ 0-9]{1,18}$/', $phone)) {
		array_push($cause_arr, 'Please enter a valid phone number');
		array_push($invalid_inputs_arr, 'phone');
	}
	// avatar URL
	if (!filter_var($avatar, FILTER_VALIDATE_URL)) {
		array_push($cause_arr, 'Please enter a valid URL for your avatar');
		array_push($invalid_inputs_arr, 'avatar');
	}
	// cards deck name
	if (empty($cards_deck_name)) {
		array_push($cause_arr, 'Please enter a valid cards deck name');
		array_push($invalid_inputs_arr, 'cards_deck_name');
	}
	// cards deck counts
	if (!filter_var($cards_deck_count, FILTER_VALIDATE_INT) || $cards_deck_count < 0) {
		array_push($cause_arr, 'Please enter a valid cards count');
		array_push($invalid_inputs_arr, 'cards_deck_count');
	}
	// no errors => send confirmation e-mail
	if (empty($cause_arr)) {
		$body = "Thank you, " . $name . ", for registration!" . "\r\n" .
		"Your registerred e-mail is: " . $email . "\r\n" .
		"Now you could login at: https://login.company.tld" . "\r\n" .
		"\r\n" .
		"Yours LXSX automat";
		//send_emails($from, $to_arr, $cc_arr, $bcc_arr, $subject, $body, $text_html = 'text')
		if (!send_emails($from, (array)$email, '', '', 'Registration confirmation', $body, 'text'))
			array_push($cause_arr, 'There was a problem sending e-mail');
	}
	// no errors => display success
	if (empty($cause_arr)) {
		$alert_class = 'alert-success';
		$cause_arr = ['You have successfully signed-up, e-mail sent.'];
	}
}
?>
