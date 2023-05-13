<?php
// crossmile @ LXSX file:www-html/pages/profile.php

if (!empty($_SESSION['errors_arr'])) {
	$errors_arr = $_SESSION['errors_arr'];
	unset($_SESSION['errors_arr']);
} else
	$errors_arr = [];
$alert_class = 'alert-danger';
$errors_arr2 = [];
$alert_class2 = 'alert-danger';
$_oauth2_state_salt = 'profile-';

// auth
$_page_protected = true;
$_required_acl = $app_acl['login'];
require_once(__DIR__ . '/../libs/login-check.php');
$logged_user_arr = $as->getUser();

require_once(__DIR__ . '/../../libs/clubs-cas.php');
$clubs_cas_arr = getClubsCAS();

require_once(__DIR__ . '/../classes/Format.php');

require_once(__DIR__ . '/../classes/Emails.php');

require_once(__DIR__ . '/../classes/Registrations.php');
$rs = new Registrations($config, $db, $app_acl);
$rs->loggedUserId = $logged_user_arr['user_id'];
$rs->userId = $logged_user_arr['user_id'];//TBD check

// read user data
require_once(__DIR__ . '/../classes/Users.php');
$usr = new Users($config, $db, $app_acl);
$usr->loggedUserId = $logged_user_arr['user_id'];
$usr->userId = $logged_user_arr['user_id'];
$user_arr = $usr->getUser();
if (!empty($user_arr)) {
	$usr->userToSanitize_arr = $user_arr;
	$usr->satinizeUserData();
	$user_arr = array_merge($user_arr, $usr->userSanitized_arr);
	$user_arr['confirm_password'] = (!empty($user_arr['password']) ? $user_arr['password'] : '');
} else
	$errors_arr['user'] = $usr->getLastError();

// check and update user data OR registration data
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
	if (!empty($_POST['user_form'])) {
		$usr->userToSanitize_arr = $_POST;
		if (!$usr->satinizeUserData()) {
			$errors_arr = $usr->getLastError();
		} else if (!$usr->validateUserData()) {
			$errors_arr = $usr->getLastError();
			$user_arr = array_merge($user_arr, $usr->userSanitized_arr);
		} else {
			if (!$usr->saveUser()) {
				$errors_arr = $usr->getLastError();
				$user_arr = array_merge($user_arr, $usr->userSanitized_arr);
			} else {
				$user_arr = $usr->getUser();
				if (!empty($user_arr)) {
					$usr->userToSanitize_arr = $user_arr;
					$usr->satinizeUserData();
					$user_arr = array_merge($user_arr, $usr->userSanitized_arr);
					$user_arr['confirm_password'] = (!empty($user_arr['password']) ? $user_arr['password'] : '');
					$errors_arr = ['user' => 'Úspěšně uloženo'];
					$alert_class = 'alert-success';
				} else
					$errors_arr['user'] = $usr->getLastError();
			}
		}
	} else if (!empty($_POST['registration_form']) && !empty($_POST['reg_id']) && is_numeric($_POST['reg_id'])) {
		$rs->userId = $logged_user_arr['user_id'];
		$rs->registrationId = (int)$_POST['reg_id'];
		if (!$rs->unregisterUser())
			$errors_arr2 = ['unregister' => $rs->getLastError()];
	}
}

$registrations_arr = $rs->fetchByUser();
?>
<main class="container">
	<div class="row">
		<div class="col-12">
			<h1 class="pb-2 mt-4 mb-4 border-bottom">Uživatelský profil v&nbsp;systému Krosové&nbsp;míle
				<small class="text-muted">od&nbsp;SK&nbsp;Míle</small>
			</h1>
		</div>
	</div><!-- /.row -->

	<div class="row">
		<!-- user-form -->
		<div class="col-md-6">
			<div class="row d-flex justify-content-center">
				<div class="col-xs-12">
					<h3 class="float-start">
						Uživatel <?= Format::toFullName($user_arr['first_name'], $user_arr['last_name']); ?>
					</h3>
					<div class="float-end">
						<button class="btn btn-xs btn-success mt-1" type="button" id="show-logins" data-id="<?= $user_arr['id']; ?>" data-type="u">Zobrazit přihlášení</button>
					</div>
				</div>
			</div><!-- /.row -->

			<!-- user-form include -->
			<?php require_once(__DIR__ . '/user-form.php'); ?>

			<br>
		</div>

		<div class="col-12 d-md-none">
			<hr>
		</div>

		<!-- user registrations -->
		<div class="col-md-6">
			<div class="row d-flex justify-content-center">
				<div class="col-xs-12">
					<h3 class="float-end">
						Výpis registrací uživatele
					</h3>
				</div>
			</div><!-- /.row -->

			<div class="row">
				<div class="col-12">
					<form class="form d-none" id="race-registration-form" method="post" action="<?= $_SERVER['REQUEST_URI']; ?>">
						<input type="hidden" id="registration_form" name="registration_form" value="1">
						<input type="hidden" id="reg_id" name="reg_id" value="0">
						<input type="hidden" id="reg_type" name="reg_type" value="">
						<input type="hidden" id="reg_note" name="reg_note" value="">
					</form>
					<?php if (!empty($registrations_arr)): ?>
						<?php if (!empty($errors_arr2)): ?>
						<div class="alert <?= $alert_class2; ?>"><?= implode('<br>', array_values((array)$errors_arr2)); ?></div>
						<?php endif; ?>
						<div class="table-responsive pre-scrollable" id="registrations-list-table" style="min-height:100px;">
							<table class="table table-sm table-condensed table-striped table-hover small">
								<thead style="background-color:white; position:sticky; top:0; z-index:1;">
									<tr>
										<th>Start</th>
										<th>Závod</th>
										<th class="d-none d-lg-table-cell">Disciplína</th>
										<th>&nbsp;</th>
										<th>&nbsp;</th>
									</tr>
								</thead>
								<tbody id="registrations-list-output">
								<?php foreach ($registrations_arr as $reg_arr): ?>
									<tr>
										<td><?= Format::toDate('d.m.Y H:i', $reg_arr['start']); ?></td>
										<td><?= Format::toRacePopover($reg_arr['race_name'], $reg_arr['registration_note']); ?></td>
										<td class="d-none d-lg-table-cell"><?= Format::toFullDiscipline2($reg_arr); ?></td>
										<td class="text-center"><a class="btn btn-xs btn-success" href="/race-details-<?= $reg_arr['race_id']; ?>">&nbsp;Detaily&nbsp;</a></td>
										<td class="text-center"><button class="btn btn-xs btn-danger unregister" type="button" data-id="<?= $reg_arr['registration_id']; ?>">Odregistrovat</button></td>
									</tr>
								<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					<?php else: ?>
					<p>Žádné registrace</p>
					<?php endif; ?>
				</div>
			</div><!-- /.row -->
		</div>
	</div><!-- /.row -->

	<!-- logins modal include -->
	<?php require_once(__DIR__ . '/logins-modal.php'); ?>
</main>