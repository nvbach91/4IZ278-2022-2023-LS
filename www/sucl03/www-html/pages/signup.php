<?php
// crossmile @ LXSX file:www-html/pages/signup.php

if (!empty($_SESSION['errors_arr'])) {
	$errors_arr = $_SESSION['errors_arr'];
	unset($_SESSION['errors_arr']);
} else
	$errors_arr = [];
$alert_class = 'alert-danger';

// auth
$_page_protected = false;
require_once(__DIR__ . '/../libs/login-check.php');

require_once(__DIR__ . '/../../libs/clubs-cas.php');
$clubs_cas_arr = getClubsCAS();

require_once(__DIR__ . '/../classes/Users.php');
$usr = new Users($config, $db, $app_acl);

// OAuth2 init
require_once(__DIR__ . '/../oauth2/oauth2-init.php');

if (!empty($_SESSION['oauth2_email'])) {
	$user_arr['email'] = $_SESSION['oauth2_email'];
	$errors_arr = ['user' => 'Data načtena z '. $_SESSION['oauth2_type']];
	$alert_class = 'alert-success';
}
if (!empty($_SESSION['oauth2_last_name']))
	$user_arr['last_name'] = $_SESSION['oauth2_last_name'];
if (!empty($_SESSION['oauth2_first_name']))
	$user_arr['first_name'] = $_SESSION['oauth2_first_name'];
if (!empty($_SESSION['oauth2_gender']))
	$user_arr['gender'] = $_SESSION['oauth2_gender'];
if (!empty($_SESSION['oauth2_birthday']))
	$user_arr['birthday'] = $_SESSION['oauth2_birthday'];
if (!empty($_SESSION['oauth2_club']))
	$user_arr['club'] = $_SESSION['oauth2_club'];

// new user data processing
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
	unset($_SESSION['errors_arr']);
	$usr->userToSanitize_arr = $_POST;
	if (!empty($_SESSION['oauth2_email']))
		$usr->userToSanitize_arr['email'] = $_SESSION['oauth2_email'];
	$usr->userToSanitize_arr['serial'] = (!empty($_SESSION['oauth2_serial']) ? $_SESSION['oauth2_serial'] : '');
	$usr->userOAuth2 = (!empty($_SESSION['oauth2_email']) && !empty($_SESSION['oauth2_serial']) ? $_SESSION['oauth2_type'] : 0);
	if (!$usr->satinizeUserData()) {
		$errors_arr = $usr->getLastError();
	} else if (!$usr->validateUserData() || (empty($_SESSION['oauth2_email']) && !$usr->validateReCaptcha())) {
		$errors_arr = $usr->getLastError();
		$user_arr = $usr->userSanitized_arr;
	} else {
		if (!$usr->insertUser()) {
			$errors_arr = $usr->getLastError();
			$user_arr = $usr->userSanitized_arr;
		} else {
			if (!empty($_SESSION['oauth2_email'])) {
				$errors_arr += ['user' => 'Potvrzovací e-mail odeslán'];
				unset($_SESSION['oauth2_email']);
				unset($_SESSION['oauth2_serial']);
				unset($_SESSION['oauth2_type']);
				unset($_SESSION['oauth2_last_name']);
				unset($_SESSION['oauth2_first_name']);
			}
			$errors_arr = ['user' => 'Úspěšně uloženo'];
			$alert_class = 'alert-success';
			$hide_user_form = 1;
		}
	}
}
?>
<main class="container">
	<div class="row">
		<div class="col-12">
			<h1 class="pb-2 mt-4 mb-4 border-bottom">Vytvoření účtu v&nbsp;systému Krosové&nbsp;míle
				<small class="text-muted">od&nbsp;SK&nbsp;Míle</small>
			</h1>
		</div>
	</div><!-- /.row -->

	<div class="row">
		<!-- user-form -->
		<div class="col-md-6">
			<?php if (empty($hide_user_form)) require_once(__DIR__ . '/user-form.php'); ?>
			<?php if (!empty($hide_user_form) && !empty($errors_arr)): ?>
				<div class="alert <?= $alert_class; ?>"><?= implode('<br>', array_values((array)$errors_arr)); ?></div>
			<?php endif; ?>
			<br>
		</div>

		<div class="col-12 d-md-none">
			<hr>
		</div>

		<!-- account creation -->
		<div class="col-md-6">
			<div class="row justify-content-center <?= (!empty($hide_user_form) ? 'd-none' : ''); ?>">
					<div class="col-lg-6 col-xs-12 text-center">
						<div class="form-group mb-3">
							<label>SK Míle</label><br>
							<a class="btn btn-success col-10 col-lg-12" href="<?= $skmile_client->createAuthUrl(); ?>">Vytvořit účet pomocí SK Míle</a>
						</div>
						<div class="form-group mb-3">
							<label>Google</label><br>
							<a class="btn btn-primary col-10 col-lg-12" href="<?= $google_client->createAuthUrl(); ?>">Vytvořit účet pomocí Google</a>
						</div>
						<div class="form-group mb-3">
							<label>Github</label><br>
							<a class="btn btn-dark col-10 col-lg-12" href="<?= $github_client->createAuthUrl(); ?>">Vytvořit účet pomocí Githubu</a>
						</div>
					</div>
			</div><!-- /.row -->
		</div>
	</div><!-- /.row -->
</main>