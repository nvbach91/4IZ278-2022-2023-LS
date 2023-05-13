<?php
// crossmile @ LXSX file:www-html/pages/login.php

// auth
$_page_protected = false;
require_once(__DIR__ . '/../libs/login-check.php');

if (!empty($_SESSION['user_is_logged_in'])) {
	header('Location: /profile');
	exit();
}

// OAuth2 init
require_once(__DIR__ . '/../oauth2/oauth2-init.php');

if (!empty($_SESSION['errors_arr'])) {
	$errors_arr = $_SESSION['errors_arr'];
	unset($_SESSION['errors_arr']);
} else
	$errors_arr = [];
$alert_class = 'alert-danger';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
	$email = (isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL, array('flags' => FILTER_FLAG_EMAIL_UNICODE)) : '');
	$password = (isset($_POST['password']) ? $_POST['password'] : '');
	// e-mail
	if (!filter_var($email, FILTER_VALIDATE_EMAIL, array('flags' => FILTER_FLAG_EMAIL_UNICODE)))
		$errors_arr['email'] = 'Prosím zadejte platný e-mail';
	// password
	if (empty($password) || strlen($password) < 6 || strlen($password) > 32)
		$errors_arr['password'] = 'Prosím zadejte platné heslo';
	// check DB
	if (empty($errors_arr)) {
		$as->email = $email;
		$as->password = $password;
		if (!$as->login())
			$errors_arr = ['authentication' => $as->getLastError()];
	}
	// no errors => redirect
	if (empty($errors_arr)) {
		header('Location: /profile');
		exit();
	}
}
?>
<main class="container">
	<div class="row">
		<div class="col-12">
			<h1 class="pb-2 mt-4 mb-4 border-bottom">Přihlášení do&nbsp;systému Krosové&nbsp;míle
				<small class="text-muted">od&nbsp;SK&nbsp;Míle</small>
			</h1>
		</div>
	</div><!-- /.row -->

	<!-- login -->
	<div class="row d-flex justify-content-center">
		<div class="col-lg-6 col-xs-12">
			<form class="form" id="login-form" method="post" action="<?= $_SERVER['REQUEST_URI']; ?>">
				<?php if (!empty($errors_arr)): ?>
				<div class="alert <?= $alert_class; ?>"><?= implode('<br>', array_values($errors_arr)); ?></div>
				<?php endif; ?>
				<div class="form-group mb-3">
					<label for="email">E-mail</label>
					<input type="email" class="form-control <?= isInvalid($errors_arr, 'email'); ?>" id="email" name="email" value="<?= (isset($email) ? htmlspecialchars($email, ENT_QUOTES) : ''); ?>" placeholder="platný e-mail" required>
				</div>
				<div class="form-group mb-3">
					<label for="email">Password</label>&nbsp;<span class="cursor-pointer" id="passwd-toggle" title="Zobrazit/Skrýt heslo"><i class="far fa-eye"></i></span>
					<input type="password" class="form-control <?= isInvalid($errors_arr, 'password'); ?>" id="password" name="password" value="<?= (isset($password) ? htmlspecialchars($password, ENT_QUOTES) : ''); ?>" placeholder="heslo" minLength="6" maxLength="32" required>
				</div>
				<div class="text-center">
					<button class="btn btn-primary" type="submit">&nbsp;Login&nbsp;</button>
					&nbsp;
					<button class="btn btn-warning" type="reset">Reset</button>
				</div>
			</form>
		</div>

		<div class="col-12 d-lg-none">
			<br>
			<hr>
		</div>

		<div class="col-lg-6 col-xs-12 text-center">
			<div class="form-group mb-3">
				<a class="btn btn-success col-4" href="<?= $skmile_client->createAuthUrl(); ?>">Login jako člen SK Míle</a>
			</div>
			<div class="form-group mb-3">
				<a class="btn btn-primary col-4" href="<?= $google_client->createAuthUrl(); ?>">Login s Google účtem</a>
			</div>
			<div class="form-group mb-3">
				<a class="btn btn-dark col-4" href="<?= $github_client->createAuthUrl(); ?>">Login s Github účtem</a>
			</div>
		</div>
	</div><!-- /.row -->

	<hr>

	<div class="row d-flex justify-content-center">
		<div class="text-center">
			<p>Ještě nemáte vlastní účet? <a href="/signup">Zaregistrujte&nbsp;se!</a></p>
		</div>
	</div><!-- /.row -->
</main>