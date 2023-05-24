<?php
// crossmile @ LXSX file:www-html/pages/race-details.php

// exit if empty Race ID
if (empty($_GET['race']) || !is_numeric($_GET['race'])) {
	header('Location: 404');
	exit();
}

$errors_arr = [];
$alert_class = 'alert-danger';

// auth
$_page_protected = false;
require_once(__DIR__ . '/../libs/login-check.php');
$logged_user_arr = $as->getUser();

require_once(__DIR__ . '/../../libs/clubs-cas.php');
$clubs_cas_arr = getClubsCAS();

require_once(__DIR__ . '/../classes/Format.php');

require_once(__DIR__ . '/../classes/Registrations.php');
$rs = new Registrations($config, $db, $app_acl);
$rs->raceId = (int)$_GET['race'];
$rs->loggedUserId = (!empty($logged_user_arr['user_id']) ? $logged_user_arr['user_id'] : 0);
$rs->userId = (!empty($logged_user_arr['user_id']) ? $logged_user_arr['user_id'] : 0);//TBD

require_once(__DIR__ . '/../classes/Races.php');
$rc = new Races($config, $db, $app_acl);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
	// registration / unregistration
	if (!empty($_POST['reg_id']) && is_numeric($_POST['reg_id'])
		&& !empty($_POST['reg_type']) && preg_match('/^(register|unregister)$/', $_POST['reg_type'])
		&& !empty($_SESSION['user_is_logged_in']))
	{
		// force logged user for registration
		if (!$as->loginCheck()) {
			header('Location: 403');
			exit(0);
		}
		$rs->loggedUserId = $logged_user_arr['user_id'];
		$rs->userId = (!empty($_POST['user_id']) && is_numeric($_POST['user_id']) ? $_POST['user_id'] : $logged_user_arr['user_id']);
		if ($_POST['reg_type'] == 'register') {
			$rs->disciplineId = $_POST['reg_id'];
			$rs->registrationNote = (!empty($_POST['reg_note']) ? htmlspecialchars($_POST['reg_note'], ENT_QUOTES) : '');
			if (!$rs->registerUser())
				$errors_arr = ['register' => $rs->getLastError()];
		} else { // unregister
			$rs->registrationId = $_POST['reg_id'];
			if (!$rs->unregisterUser())
				$errors_arr = ['unregister' => $rs->getLastError()];
		}
	}
}

$rc->raceId = (int)$_GET['race'];
$rc->loggedUserId = (!empty($logged_user_arr['user_id']) ? $logged_user_arr['user_id'] : 0);
$rc->userId = (!empty($logged_user_arr['user_id']) ? $logged_user_arr['user_id'] : 0);
$all_disciplines_arr = $rc->fetchRaceDisciplines();
?>
<main class="container">
	<div class="row">
		<div class="col-12">
			<h1 class="pb-2 mt-4 mb-4 border-bottom">Detaily závodu Krosové&nbsp;míle
				<small class="text-muted">od&nbsp;SK&nbsp;Míle</small>
			</h1>
		</div>
	</div><!-- /.row -->

	<!-- info -->
	<div class='row'>
		<div class='col-lg-9 order-lg-2'>
			<h3>Informace k&nbsp;závodu <?= $all_disciplines_arr[0]['race_name']; ?></h3>
			<p>
				Závod se koná <?= Format::toDate('d.m.Y', $all_disciplines_arr[0]['race_date']); ?><br>
				Registrace začíná <?= Format::toDate('d.m.Y H:i', $all_disciplines_arr[0]['registration_open']); ?><br>
				Registrace končí <?= Format::toDate('d.m.Y H:i', $all_disciplines_arr[0]['registration_close']); ?><br>
				Odregistrace <?= (!empty($all_disciplines_arr[0]['unregistration_close']) ? 'končí ' . Format::toDate('d. m. Y H:i', $all_disciplines_arr[0]['unregistration_close']) : 'není možná'); ?><br>
			</p>
		</div>
		<div class='col-lg-3 order-lg-1'>
			<img class='img-fluid border' src='/images/track.jpg' alt='Závody'>
		</div>
	</div><!-- /.row -->

	<hr>

	<div class='row'>
		<div class='col-12'>
			<h4><?= $all_disciplines_arr[0]['race_name']; ?>, seznam disciplín</h4>
		</div>
	</div><!-- /.row -->

	<!-- race - disciplines -->
	<div class="row">
		<div class="col-12">
			<?php if (!empty($errors_arr)): ?>
			<div class="alert <?= $alert_class; ?>"><?= implode('<br>', array_values($errors_arr)); ?></div>
			<?php endif; ?>
			<div class="table-responsive pre-scrollable" id="races-list-table" style="min-height:400px;">
				<table class="table table-sm table-condensed table-striped table-hover small">
					<thead style="background-color:white; position:sticky; top:0; z-index:1;">
						<tr>
							<th>Start</th>
							<th>Jméno</th>
							<th>Popis</th>
							<th>Ročníky</th>
							<th>Pohlaví</th>
							<th>Startovné</th>
							<th class="d-none d-md-table-cell">Limit</th>
							<th class="d-none d-md-table-cell">Registrováno</th>
							<th>&nbsp;</th>
						</tr>
					</thead>
					<tbody id="races-list-output">
					<?php $registered = 0; ?>
					<?php foreach ($all_disciplines_arr as $discipline_arr): $rs->disciplineId = $discipline_arr['id']; ?>
						<tr <?= ($rs->isUserRegistered() ? 'class="table-success"' : ''); ?>>
							<td><?= Format::toDate('d.m.Y H:i', $discipline_arr['start']); ?></td>
							<td><?= $discipline_arr['name']; ?></td>
							<td><?= $discipline_arr['description']; ?></td>
							<td><?= $discipline_arr['year_from'] . '–' . $discipline_arr['year_to']; ?></td>
							<td><?= $discipline_arr['gender_name']; ?></td>
							<td><?= $discipline_arr['fee']; ?> Kč</td>
							<td class="text-center d-none d-md-table-cell"><?= $discipline_arr['max_count']; ?></td>
							<td class="text-center d-none d-md-table-cell"><?= $discipline_arr['registered_count']; $registered += $discipline_arr['registered_count']; ?></td>
							<td class="text-center"><?= Format::registerButton($rs, $discipline_arr, $logged_user_arr); ?></td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div><!-- /.row -->

	<hr>

	<!-- registrations -->
	<div class="row">
		<div class="col-12">
			<h4><?= $all_disciplines_arr[0]['race_name']; ?>, výpis registrovaných
				<small class="text-muted d-none d-md-inline">
					(celkem <?= $registered; ?>, max <?= $config['MAX_REGISTRATIONS_LIST']; ?>)
				</small>
			</h4>
		</div>
	</div><!-- /.row -->

	<form class="form" id="registrations-filter-form" method="post" action="#">
	<input type="hidden" id="race" name="race" value="<?= $_GET['race']; ?>">
		<div class="row">
			<?php if ($as->aclCheck($app_acl['registrations_r']) && !empty($registered)): ?>
			<div class="col-md-4 text-end order-md-3 mb-2">
				<a class="btn btn-sm btn-success" href="/registrations-export-<?= $all_disciplines_arr[0]['race_id']; ?>">Export</a>
				&nbsp;
				<a class="btn btn-sm btn-success" href="/registrations-export-ak-<?= $all_disciplines_arr[0]['race_id']; ?>">Export do AK</a>
			</div>
			<?php endif; ?>
			<div class="col-md-4">
				<div class="form-group mb-2">
					<select class="form-select form-select-sm registrations-select-change" id="discipline" name="discipline">
						<option value="0" <?= (!isset($_POST['discipline']) || $_POST['discipline'] == '0' ? 'selected' : ''); ?>>vše</option>
						<?php foreach ($all_disciplines_arr as $discipline_arr): ?>
						<option value="<?= $discipline_arr['id']; ?>" <?= (isset($_POST['discipline']) && $_POST['discipline'] == $discipline_arr['id'] ? 'selected' : ''); ?>><?= Format::toFullDiscipline2($discipline_arr); ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group mb-2">
					<input type="text" class="form-control form-control-sm registrations-input-change" id="search" name="search" value="<?= (isset($_POST['search']) ? $_POST['search'] : ''); ?>" placeholder="hledaný text" maxLength="32">
				</div>
			</div>
		</div><!-- /.row -->
	</form>

	<div class="row">
		<div class="col-12">
			<div class="table-responsive pre-scrollable" id="registrations-list-table" style="min-height:100px;">
				<table class="table table-sm table-condensed table-striped table-hover small">
					<thead style="background-color:white; position:sticky; top:0; z-index:1;">
						<tr>
							<th>Jméno</th>
							<th>Ročník</th>
							<th>Klub</th>
							<th>Disciplína</th>
							<th class="d-none d-md-table-cell">Registrace</th>
							<?php if ($as->aclCheck($app_acl['registrations_w'])): ?>
							<th>&nbsp;</th>
							<?php endif; ?>
						</tr>
					</thead>
					<tbody id="registrations-list-output">
					</tbody>
				</table>
			</div>		
		</div>
	</div><!-- /.row -->

	<!-- Modal register -->
	<div id="modal-register" class="modal fade" tabindex="-1" aria-labelledby="modal-register-title" aria-hidden="true">
		<div class="modal-dialog modal-md" role="document">
			<div class="modal-content">
				<form class="form" id="register-form" method="post" action="<?= $_SERVER['REQUEST_URI']; ?>">
				<input type="hidden" id="reg_type" name="reg_type" value="">
				<input type="hidden" id="reg_id" name="reg_id" value="0">
				<input type="hidden" id="user_id" name="user_id" value="0">
					<div class="modal-header">
						<h4 class="modal-title" id="modal-register-title">Registrace závod</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="reg_note">Poznámka pro pořadatele</label>
									<input type="text" class="form-control" id="reg_note" name="reg_note" value="" placeholder="poznámka pro pořadatele, 3–128 znaků" minLength="3" maxLength="128">
								</div>
							</div>
						</div><!-- /.row -->
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-success btn-sm" id="btn-race-duplicate">Registrovat</button>
						&nbsp;
						<button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</main>