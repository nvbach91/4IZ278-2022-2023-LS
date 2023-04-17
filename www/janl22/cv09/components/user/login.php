<?php

require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/../../classes/StatusMessage.php';
require_once __DIR__ . '/../../classes/UsersDB.php';

use classes\StatusMessage;
use classes\UsersDB;

$htmlTitle = 'HW Shop | Login';
if (isLoggedIn()) header('Location: home');

$formSubmitted = !empty($_POST);
$fieldStatuses = [];
$mail = isset($_GET['mail']) ? trim($_GET['mail']) : null;

if ($formSubmitted) {

	$mail = isset($_POST['mail']) ? trim($_POST['mail']) : null;
	$password = isset($_POST['pass']) ? trim($_POST['pass']) : null;

	if (empty($mail)) $fieldStatuses['mail'] = new StatusMessage('Please enter your e-mail address!', 'error');
	if (empty($password)) $fieldStatuses['pass'] = new StatusMessage('Please enter your password!', 'error');

	if (empty($fieldStatuses)) {

		$response = authenticateUser($mail, $password);
		if ($response['status'] === 200) {
			$usersDB = new UsersDB();
			setCustomCookie('id_token', generateAuthJWT($usersDB->fetchUser($mail)));
		} else {
			$fieldStatuses['login'] = $response['message'];
		}
	}
}
?>
<div class="d-flex justify-content-center align-items-center">
	<div class="container">
		<div class="row animation fade-in">
			<div class="col-xl-3"></div>
			<div class="card col-xl-6 mt-4 mb-4">
				<div class="card-body">

					<p class="h3 text-center mb-4">Customer login</p>

					<form id="login" method="POST" action="<?php echo $GLOBALS['request']; ?>">

						<?php if ($formSubmitted): ?>
							<div class="mb-4">
								<?php foreach ($fieldStatuses as $fieldStatus): ?>
									<div class="alert alert-<?php echo $fieldStatus->type ?> mt-2 mb-2"
										 role="alert"><?php echo $fieldStatus->message ?></div>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>

						<div class="form-outline mb-4">
							<input type="email" id="mail" name="mail"
								   class="form-control <?php echo isset($fieldStatuses['mail']) ? 'is-invalid' : '' ?>"
								   placeholder="someone@vse.cz" value="<?php echo $mail ?? '' ?>" tabindex="1">
							<label class="form-label" for="mail">E-mail *</label>
						</div>

						<div class="form-outline mb-4">
							<input type="password" id="pass" name="pass"
								   class="form-control <?php echo isset($fieldStatuses['pass']) ? 'is-invalid' : '' ?>"
								   value="<?php echo $password ?? '' ?>" tabindex="2">
							<label class="form-label" for="pass">Password *</label>
						</div>

						<button type="submit" class="btn btn-primary btn-block mb-4" tabindex="3">Login</button>

					</form>

					<a href="registration?mail=<?php echo $mail ?>">
						<button class="btn btn-secondary btn-block mb-4" tabindex="4">New? Register here!</button>
					</a>

				</div>
			</div>
		</div>
	</div>
</div>