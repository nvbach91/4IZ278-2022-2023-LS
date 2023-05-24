<?php
// crossmile @ LXSX file:www-html/pages/races.php

$errors_arr = [];
$alert_class = 'alert-danger';

// auth
$_page_protected = false;
require_once(__DIR__ . '/../libs/login-check.php');
$logged_user_arr = $as->getUser();

require_once(__DIR__ . '/../classes/Format.php');

require_once(__DIR__ . '/../classes/Races.php');
$rc = new Races($config, $db, $app_acl);
$rc->loggedUserId = (!empty($logged_user_arr['user_id']) ? $logged_user_arr['user_id'] : 0);

// check race data and duplicet
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
	$rc->raceToSanitize_arr = $_POST;
	if (!$rc->satinizeRaceData()) {
		$errors_arr = $rc->getLastError();
	} else {
		if (!$rc->validateRaceData($rc->raceSanitized_arr['form_type'])) {
			$errors_arr = $rc->getLastError();
		} else {
			if ($rc->raceSanitized_arr['form_type'] == 'duplicate') {
				if (!$rc->duplicateRace()) {
					$errors_arr = $rc->getLastError();
				} else {
					$errors_arr = ['user' => 'Úspěšně duplikováno'];
					$alert_class = 'alert-success';
				}
			} else if ($rc->raceSanitized_arr['form_type'] == 'delete') {
				if (!$rc->deleteRace()) {
					$errors_arr = $rc->getLastError();
				} else {
					$errors_arr = ['user' => 'Úspěšně smazáno'];
					$alert_class = 'alert-success';
				}
			}
		}
	}
}

if (!empty($_COOKIE['crossmile_show_old_races']) && $_COOKIE['crossmile_show_old_races'] == 1)
	$rc->showOldRaces = 1;
else
	$rc->showOldRaces = 0;

$all_races_arr = $rc->fetchAll();
?>
<main class="container">
	<div class="row">
		<div class="col-12">
			<h1 class="pb-2 mt-4 mb-4 border-bottom">Seznam závodů Krosové&nbsp;míle
				<small class="text-muted">od&nbsp;SK&nbsp;Míle</small>
			</h1>
		</div>
	</div><!-- /.row -->

	<!-- info -->
	<div class='row'>
		<div class='col-lg-9 order-lg-2'>
			<h3>Informace k&nbsp;závodům</h3>
			<p <?= (!empty($_SESSION['user_is_logged_in']) ? ' class="d-none"' : '') ?>>
				Pro&nbsp;registraci do&nbsp;závodu musíte být <a href="/login">přihlášeni</a> do&nbsp;systému.
			</p>
			<p>
				Po&nbsp;kliknutí na&nbsp;tlačítko <button class="btn btn-xs btn-success" disabled>Registrovat</button>
				se&nbsp;dostanete na&nbsp;stránku s&nbsp;detaily vybraného závodu a&nbsp;tam se&nbsp;bude moci registrovat na&nbsp;vhodné a&nbsp;neobsazené disciplíny.
				Dozvíte se&nbsp;jak věkové rozpětí, pro&nbsp;které jsou jednotlivé disciplíny určeny, tak&nbsp;i&nbsp;výši startovného a&nbsp;počet již registrovaných.
				<br>
				Těšíme se&nbsp;na&nbsp;vás!
			</p>
		</div>
		<div class='col-lg-3 order-lg-1'>
			<img class='img-fluid border' src='/images/racers.jpg' alt='Závody'>
		</div>
	</div><!-- /.row -->

	<hr>

	<!-- races -->
	<div class='row'>
		<div class='col-12'>
			<h4 class="float-start">Výpis závodů</h4>
			<div class="float-start ms-3">
				<button class="btn btn-xs btn-light mt-1" id="old-races-toggle" data-id="<?= ($rc->showOldRaces ? 0 : 1); ?>"><?= ($rc->showOldRaces ? 'Skrýt' : 'Zobrazit'); ?> minulé</button>
			</div>
		</div>
	</div><!-- /.row -->

	<div class="row">
		<div class="col-12">
			<?php if (!empty($errors_arr)): ?>
			<div class="alert <?= $alert_class; ?>"><?= implode('<br>', array_values((array)$errors_arr)); ?></div>
			<?php endif; ?>
			<div class="table-responsive pre-scrollable" id="races-list-table" style="min-height:120px;">
				<table class="table table-sm table-condensed table-striped table-hover small">
					<thead style="background-color:white; position:sticky; top:0; z-index:1;">
						<tr>
							<th>Datum</th>
							<th>Jméno</th>
							<th class="d-none d-sm-table-cell">Registrace od</th>
							<th>Registrace do</th>
							<th class="d-none d-lg-table-cell">Odregistrace do</th>
							<th>Startovné</th>
							<th class="d-none d-md-table-cell">Registrováno</th>
							<th>&nbsp;</th>
							<?php if ($as->aclCheck($app_acl['races_w'])): ?>
							<th>&nbsp;</th>
							<th>&nbsp;</th>
							<?php endif; ?>
						</tr>
					</thead>
					<tbody id="races-list-output">
					<?php foreach ($all_races_arr as $race_arr): ?>
						<tr>
							<td><?= Format::toDate('d. m. Y', $race_arr['race_date']); ?></td>
							<td><?= $race_arr['race_name']; ?></td>
							<td class="d-none d-sm-table-cell"><?= Format::toDate('d. m. Y H:i', $race_arr['registration_open']); ?></td>
							<td><?= Format::toDate('d. m. Y H:i', $race_arr['registration_close']); ?></td>
							<td class="d-none d-lg-table-cell"><?= (!empty($race_arr['unregistration_close']) ? Format::toDate('d. m. Y H:i', $race_arr['unregistration_close']) : 'nepovolena'); ?></td>
							<td><?= $race_arr['min_fee'] . '–' . $race_arr['max_fee']; ?> Kč</td>
							<td class="text-center d-none d-md-table-cell"><?= $race_arr['registered_count']; ?></td>
							<td><a class="btn btn-xs btn-success" href="/race-details-<?= $race_arr['race_id']; ?>"><?= ($rc->isRaceRegisterable($race_arr) ? 'Registrovat' : 'Zobrazit') ?></a></td>
							<?php if ($as->aclCheck($app_acl['races_w'])): ?>
							<td><button class="btn btn-xs btn-warning race-duplicate" type="button"
								data-id="<?= $race_arr['race_id']; ?>"
								data-name="<?= $race_arr['race_name']; ?>"
								data-date="<?= Format::toDate('Y-m-d', $race_arr['race_date']); ?>"
								>
									Duplikovat
								</button>
							</td>
							<td><button class="btn btn-xs btn-danger race-delete" type="button"
								data-id="<?= $race_arr['race_id']; ?>"
								data-name="<?= $race_arr['race_name']; ?>"
								data-date="<?= Format::toDate('Y-m-d', $race_arr['race_date']); ?>"
								>
									Smazat
								</button>
							</td>
							<?php endif; ?>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div><!-- /.row -->

	<!-- Modal duplicate race -->
	<div id="modal-races" class="modal fade" tabindex="-1" aria-labelledby="modal-races-title" aria-hidden="true">
		<div class="modal-dialog modal-md" role="document">
			<div class="modal-content">
				<form class="form" id="race-form" method="post" action="<?= $_SERVER['REQUEST_URI']; ?>">
				<input type="hidden" id="form_type" name="form_type" value="">
				<input type="hidden" id="race_id" name="race_id" value="0">
					<div class="modal-header">
						<h4 class="modal-title" id="modal-races-title">Duplikovat závod</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group mb-3">
									<label for="race_name">Jméno závodu</label>
									<input type="text" class="form-control" id="race_name" name="race_name" value="" placeholder="jméno závodu, 3–128 znaků" minLength="3" maxLength="128" required>
								</div>
								<div class="form-group mb-3">
									<label for="race_date">Datum závodu</label>
									<input type="date" class="form-control" id="race_date" name="race_date" value="" min="2023-01-01" max="2100-01-01" required>
								</div>
							</div>
						</div><!-- /.row -->
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary btn-sm" id="btn-race-duplicate">Duplikovat</button>
						&nbsp;
						<button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</main>