<?php

require_once __DIR__ . '/../functions.php';
require_once __DIR__ . '/../../../classes/StatusMessage.php';
require_once __DIR__ . '/../../../classes/User.php';
require_once __DIR__ . '/../../../classes/UsersDB.php';

use classes\StatusMessage;
use classes\User;
use classes\UsersDB;

$htmlTitle = 'HW Shop | Registration';
if(isLoggedIn()) Header('Location: home');

$formSubmitted = !empty($_POST);
$fieldStatuses = [];
$mail = isset($_GET['mail']) ? trim($_GET['mail']) : null;

if ($formSubmitted) {

	$name = trim($_POST['name']);
	$surname = trim($_POST['surname']);
	$mail = trim($_POST['mail']);
	$phone = trim($_POST['phone']);
	$pass = trim($_POST['pass']);
	$pass_again = trim($_POST['pass_again']);
	$gdpr = isset($_POST['gdpr']) ? trim($_POST['gdpr']) === 'on' : null;

	if (!$name) $fieldStatuses['name'] = new statusMessage('Please enter your name!', 'error');
	if (!$surname) $fieldStatuses['surname'] = new statusMessage('Please enter your surname!', 'error');
	if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) $fieldStatuses['mail'] = new statusMessage('Please enter your email in the correct format!', 'error');
	if (!preg_match("/^\+420 [0-9]{3} [0-9]{3} [0-9]{3}$/", $phone)) $fieldStatuses['phone'] = new statusMessage('Please enter your phone number in the correct format!', 'error');
	if (empty($pass)) $fieldStatuses['pass'] = new statusMessage('Please enter your password!', 'error');
	if ($pass !== $pass_again) $fieldStatuses['pass'] = new statusMessage('The entered passwords do not match!', 'error');
	if (!$gdpr) $fieldStatuses['gdpr'] = new statusMessage('You must agree to the Privacy Policy!', 'error');

	if (empty($fieldStatuses)) {

		$UsersDB = new UsersDB();
		$fieldStatuses['registration'] = $UsersDB->registerUser(new User($mail, password_hash($pass, PASSWORD_BCRYPT), $name, $surname, $phone, null))['message'];

	}
}

?>

<div class="d-flex justify-content-center align-items-center">
	<div class="container mt-4 mb-4">
		<div class="row animation fade-in">
			<div class="col-xl-3"></div>
			<div class="card col-xl-6">
				<div class="card-body">
					<h1 class="text-center mt-4">Customer registration</h1>
					<div class="mt-4 w-full justify-content-center">
						<form id="registration" method="POST"
							  action="<?php echo $GLOBALS['request'] . '?redirect=' . urlencode(base64_encode($GLOBALS['redirect'])); ?>">
							<?php if ($formSubmitted): ?>
								<div class="mb-4">
									<?php foreach ($fieldStatuses as $fieldStatus): ?>
										<div class="alert alert-<?php echo $fieldStatus->type ?> mt-2 mb-2"
											 role="alert"><?php echo $fieldStatus->message ?></div>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>

							<?php if (!isset($fieldStatuses['registration'])): ?>
								<div class="row mb-4">
									<div class="col">
										<div class="form-outline">
											<input type="text" id="name" name="name"
												   class="form-control <?php echo isset($fieldStatuses['name']) ? 'is-invalid' : '' ?>"
												   value="<?php echo $name ?? '' ?>" tabindex="1">
											<label class="form-label" for="name">Name *</label>
										</div>
									</div>
									<div class="col">
										<div class="form-outline">
											<input type="text" id="surname" name="surname"
												   class="form-control <?php echo isset($fieldStatuses['surname']) ? 'is-invalid' : '' ?>"
												   value="<?php echo $surname ?? '' ?>" tabindex="2">
											<label class="form-label" for="surname">Surname *</label>
										</div>
									</div>
								</div>

								<div class="form-outline mb-4">
									<input type="mail" id="mail" name="mail"
										   class="form-control <?php echo isset($fieldStatuses['mail']) ? 'is-invalid' : '' ?>"
										   placeholder="someone@vse.cz" value="<?php echo $mail ?? '' ?>"
										   tabindex="4">
									<label class="form-label" for="mail">E-mail *</label>
								</div>

								<div class="form-outline mb-4">
									<input type="tel" id="phone" name="phone"
										   class="form-control <?php echo isset($fieldStatuses['phone']) ? 'is-invalid' : '' ?>"
										   placeholder="+420 XXX XXX XXX" value="<?php echo $phone ?? '' ?>"
										   tabindex="5">
									<label class="form-label" for="phone">Phone *</label>
								</div>

								<div class="form-outline mb-4">
									<input type="password" id="pass" name="pass"
										   class="form-control <?php echo isset($fieldStatuses['pass']) ? 'is-invalid' : '' ?>"
										   value="<?php echo $pass ?? '' ?>" tabindex="7">
									<label class="form-label" for="pass">Password *</label>
								</div>

								<div class="form-outline mb-4">
									<input type="password" id="pass_again" name="pass_again"
										   class="form-control <?php echo isset($fieldStatuses['pass']) ? 'is-invalid' : '' ?>"
										   value="<?php echo $pass_again ?? '' ?>" tabindex="8">
									<label class="form-label" for="pass_again">Password again *</label>
								</div>

								<div class="form-check d-flex justify-content-center mb-4">
									<input type="checkbox" id="gdpr" name="gdpr"
										   class="form-check-input me-2 <?php echo isset($fieldStatuses['gdpr']) ? 'is-invalid' : '' ?>" <?php echo isset($gdpr) && $gdpr ? 'checked' : '' ?>
										   tabindex="9">
									<label class="form-check-label" for="gdpr">
										I Agree to Privacy Policy
									</label>
								</div>

								<button type="submit" class="btn btn-primary btn-block mb-4" tabindex="8">
									Register
								</button>

							<?php endif; ?>
						</form>

						<a href="login?mail=<?php echo $mail ?>&redirect=<?php echo urlencode(base64_encode($GLOBALS['redirect'])) ?>">
							<button class="btn btn-secondary btn-block mb-4" tabindex="9">Already customer? Login
								here!
							</button>
						</a>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>