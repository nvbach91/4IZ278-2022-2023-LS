<?php
// crossmile @ LXSX file:www-html/registrations-list.php

require_once(__DIR__ . '/libs/init.php');

if ($_SERVER['REQUEST_METHOD'] != 'POST' || empty($_POST) || empty($_POST['race']) || !isInteger($_POST['race'])) {
	print 'no POST';
	exit();
}

// auth
$_page_protected = false;
require_once(__DIR__ . '/libs/login-check.php');
$logged_user_arr = $as->getUser();

require_once(__DIR__ . '/../libs/clubs-cas.php');
$clubs_cas_arr = getClubsCAS();

require_once(__DIR__ . '/classes/Format.php');

require_once(__DIR__ . '/classes/Emails.php');

require_once(__DIR__ . '/classes/Registrations.php');
$rs = new Registrations($config, $db, $app_acl);
$rs->raceId = (int)$_POST['race'];
$rs->loggedUserId = (!empty($logged_user_arr['user_id']) ? $logged_user_arr['user_id'] : 0);
$rs->userId = (!empty($logged_user_arr['user_id']) ? $logged_user_arr['user_id'] : 0);//TBD
$registrations_arr = $rs->fetchByRace($_POST);
?>
<?php if (!empty($registrations_arr)): ?>
	<?php foreach ($registrations_arr as $reg_arr): ?>
		<tr <?= (!empty($logged_user_arr['user_id']) && $reg_arr['user_id'] == $logged_user_arr['user_id'] ? 'class="table-success"' : ''); ?>>
			<td><?= Format::toFullNamePopover($reg_arr['last_name'], $reg_arr['first_name'], $reg_arr['registration_note'], Format::showPopover($reg_arr, $app_acl, $logged_user_arr)); ?></td>
			<td><?= $reg_arr['year']; ?></td>
			<td><?= Format::toClubPopover($reg_arr['club'], $clubs_cas_arr); ?></td>
			<td><?= Format::toFullDiscipline2($reg_arr); ?></td>
			<td class="d-none d-md-table-cell"><?= Format::toDate('d. m. Y H:i:s', $reg_arr['created']); ?></td>
			<?php if (!empty($_SESSION['user_is_logged_in']) && $as->aclCheck($app_acl['registrations_w'])): ?>
				<td class="text-center">
					<button class="btn btn-xs btn-danger unregister" type="button" data-reg="<?= $reg_arr['registration_id'] ?>" data-user="<?= $reg_arr['user_id'] ?>">Odregistrovat</button>
				</td>
			<?php endif; ?>
		</tr>
	<?php endforeach; ?>
<?php else: ?>
	<tr>
		<td colspan="<?= ($as->aclCheck($app_acl['registrations_w']) ? 6 : 5) ?>">Žádné registrace</td>
	</tr>
<?php endif; ?>