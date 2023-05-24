<?php
// crossmile @ LXSX file:www-html/pages/users.php

$errors_arr = [];
$alert_class = 'alert-danger';

$errors_arr2 = [];
$alert_class2 = 'alert-danger';

// auth
$_page_protected = true;
$_required_acl = $app_acl['users_r'];
require_once(__DIR__ . '/../libs/login-check.php');
$logged_user_arr = $as->getUser();

require_once(__DIR__ . '/../../libs/clubs-cas.php');
$clubs_cas_arr = getClubsCAS();

require_once(__DIR__ . '/../classes/Format.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
	require_once(__DIR__ . '/../classes/Users.php');
	$usr = new Users($config, $db, $app_acl);
	$usr->loggedUserId = $logged_user_arr['user_id'];
	$usr->userId = (!empty($_POST['user_id']) ? $_POST['user_id'] : 0);
	
	$usr->userToSanitize_arr = $_POST;
	if (!empty($_POST['user_form']) && $_POST['user_form'] == 'delete') { // delete user
		if (!$usr->deleteUser())
			$errors_arr2 = $usr->getLastError();
		else {
			$errors_arr2 = ['user' => 'Úspěšně uloženo'];
			$alert_class2 = 'alert-success';
		}
	} else { // save user
		if (!$usr->satinizeUserData())
			$errors_arr = $usr->getLastError();
		else if (!$usr->validateUserData())
			$errors_arr2 = $usr->getLastError();
		else {
			if (!$usr->saveUser()) {
				$errors_arr = $usr->getLastError();
			} else {
				$errors_arr2 = ['user' => 'Úspěšně uloženo'];
				$alert_class2 = 'alert-success';
			}
		}
	}
}
?>
<main class="container">
	<div class="row">
		<div class="col-12">
			<h1 class="pb-2 mt-4 mb-4 border-bottom">Výpis uživatelů Krosové&nbsp;míle
				<small class="text-muted">od&nbsp;SK&nbsp;Míle</small>
			</h1>
		</div>
	</div><!-- /.row -->

	<!-- info -->
	<div class='row'>
		<div class='col-lg-9 order-lg-2'>
			<h3>Informace ke&nbsp;správě uživatelů</h3>
			<p>
				Užívejte ji&nbsp;s&nbsp;rozumem, napáchané škody je&nbsp;obtížné napravit.
				Myslelte na&nbsp;to&nbsp;a&nbsp;vždy dvakrát přemýšlejte a&nbsp;jednou editujte.
			</p>
			<h5>Základní pravidla</h5>
			<p>
				Uživatelé s&nbsp;právem zápisu mohou editovat mazat ostatní, ale&nbsp;jen administrátoři mohou měnit přístupová&nbsp;práva.
				Administrátory mohou mazat jen administrátoři a&nbsp;nikdo nemůže smazat sám&nbsp;sebe.
			</p>
		</div>
		<div class='col-lg-3 order-lg-1'>
			<img class='img-fluid border' src='/images/spikes.jpg' alt='Závody'>
		</div>
	</div><!-- /.row -->

	<hr>

	<form class="form" id="users-filter-form" method="post" action="#">
		<div class="row">
			<div class="col-md-3 text-end mb-2 order-md-4">
				<button class="btn btn-sm btn-success " type="button" id="show-logins" data-id="0" data-type="a">Zobrazit přihlášení</button>
			</div>
			<div class="col-md-3">
				<div class="form-group mb-2">
					<select class="form-select form-select-sm users-select-change" id="gender_search" name="gender_search">
						<option value="0" <?= (!isset($_POST['gender_search']) || $_POST['gender_search'] == '0' ? 'selected' : ''); ?>>vše</option>
						<option value="1" <?= (isset($_POST['gender_search']) && $_POST['gender_search'] == '1' ? 'selected' : ''); ?>>žena</option>
						<option value="2" <?= (isset($_POST['gender_search']) && $_POST['gender_search'] == '2' ? 'selected' : ''); ?>>muž</option>
					</select>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group mb-2">
					<input type="text" class="form-control form-control-sm users-input-change" id="year_search" name="year_search" value="<?= (isset($_POST['year_search']) ? $_POST['year_search'] : ''); ?>" placeholder="hledaný ročník, 1900–2100" pattern="^[1-2][0-9]{0,3}$">
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group mb-2">
					<input type="text" class="form-control form-control-sm users-input-change" id="text_search" name="search" value="<?= (isset($_POST['text_search']) ? $_POST['text_search'] : ''); ?>" placeholder="hledané jméno, e-mail, klub" maxLength="32">
				</div>
			</div>
		</div><!-- /.row -->
	</form>

	<div class="row">
		<div class="col-12">
			<?php if (!empty($errors_arr2)): ?>
			<div class="alert <?= $alert_class2; ?>"><?= implode('<br>', array_values((array)$errors_arr2)); ?></div>
			<?php endif; ?>
			<div class="table-responsive pre-scrollable" id="users-list-table" style="min-height:100px;">
				<table class="table table-sm table-condensed table-striped table-hover small">
					<thead style="background-color:white; position:sticky; top:0; z-index:1;">
						<tr>
							<th>Jméno</th>
							<th class="d-none d-md-table-cell">E-mail</th>
							<th class="d-lg-none">Ročník</th>
							<th class="d-none d-lg-table-cell">Narozen/a</th>
							<th class="d-none d-md-table-cell">Pohlaví</th>
							<th>ACL</th>
							<th>Sts</th>
							<th>Klub</th>
							<?php if ($as->aclCheck($app_acl['users_w'])): ?>
							<th>&nbsp;</th>
							<th>&nbsp;</th>
							<?php endif; ?>
						</tr>
					</thead>
					<tbody id="users-list-output">
					</tbody>
				</table>
			</div>		
		</div>
	</div><!-- /.row -->

	<!-- Modal user edit -->
	<div id="modal-user-admin" class="modal fade" tabindex="-1" aria-labelledby="modal-user-admin-title" aria-hidden="true">
		<div class="modal-dialog modal-md" role="document">
			<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="modal-user-admin-title">Editace uživatele</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<!-- user-form include -->
						<?php require_once(__DIR__ . '/user-form.php'); ?>
					</div>
			</div>
		</div>
	</div>
	
	<!-- logins modal include -->
	<?php require_once(__DIR__ . '/logins-modal.php'); ?>
</main>