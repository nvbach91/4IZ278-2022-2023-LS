<?php

require_once __DIR__ . '/../functions.php';
require_once __DIR__ . '/../../../classes/StatusMessage.php';
require_once __DIR__ . '/../../../classes/UsersDB.php';

use classes\StatusMessage;
use classes\UsersDB;

$htmlTitle = 'HW Shop | Login';
if(isLoggedIn()) Header('Location: home');

$messageJSON = isset($_GET['message']) ? json_decode(base64_decode(trim($_GET['message']))): null;
!empty($messageJSON) ? $fieldStatuses['login'] = new StatusMessage($messageJSON->message, $messageJSON->type) : $fieldStatuses = [];
$formSubmitted = !empty($_POST);
$mail = isset($_GET['mail']) ? trim($_GET['mail']) : null;

if ($formSubmitted) {

	$mail = isset($_POST['mail']) ? trim($_POST['mail']) : null;
	$password = isset($_POST['pass']) ? trim($_POST['pass']) : null;

	if (empty($mail)) $fieldStatuses['mail'] = new StatusMessage('Please enter your e-mail address!', 'error');
	if (empty($password)) $fieldStatuses['pass'] = new StatusMessage('Please enter your password!', 'error');

	if (empty($fieldStatuses)) {

		$response = authenticateUser($mail, $password);
		if ($response['status'] === 200) {
			$UsersDB = new UsersDB();
			$user = $UsersDB->fetchUser($mail);
			setCustomCookie('id_token', generateIdToken($user));
			setCustomCookie('access_token', generateAccessToken($user));
			Header('Location: ' . $GLOBALS['redirect']);
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

					<p class="h3 text-center mb-4">Login</p>

					<form id="login" method="POST"
						  action="<?php echo $GLOBALS['request'] . '?redirect=' . urlencode(base64_encode($GLOBALS['redirect'])); ?>">

						<div class="mb-4">
							<?php foreach ($fieldStatuses as $fieldStatus): ?>
								<div class="alert alert-<?php echo $fieldStatus->type ?> mt-2 mb-2"
									 role="alert"><?php echo $fieldStatus->message ?></div>
							<?php endforeach; ?>
						</div>

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

						<button type="submit" class="btn btn-success btn-block mb-2" tabindex="3">Login</button>

					</form>

					<a href="facebookLogin">
						<button class="btn btn-primary btn-block mb-2" tabindex="4"><i class="bi bi-facebook me-2"></i>Login via Facebook</button>
					</a>

					<a href="registration?mail=<?php echo $mail ?>&redirect=<?php echo urlencode(base64_encode($GLOBALS['redirect'])) ?>">
						<button class="btn btn-secondary btn-block mb-2" tabindex="5">New? Register here!</button>
					</a>

				</div>
			</div>
		</div>
	</div>
</div>