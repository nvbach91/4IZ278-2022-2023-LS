<?php
// crossmile @ LXSX file:www-html/users-list.php

require_once(__DIR__ . '/libs/init.php');

// auth
$_page_protected = true;
$_required_acl = $app_acl['users_r'];
require_once(__DIR__ . '/libs/login-check.php');
$logged_user_arr = $as->getUser();

require_once(__DIR__ . '/../libs/clubs-cas.php');
$clubs_cas_arr = getClubsCAS();

require_once(__DIR__ . '/classes/Users.php');
$usr = new Users($config, $db, $app_acl);
$usr->loggedUserId = $logged_user_arr['user_id'];
$users_arr = $usr->fetchUsers((!empty($_POST) ? $_POST : ''));
?>
<?php if (!empty($users_arr)): ?>
	<?php foreach ($users_arr as $usr_arr): ?>
		<?php $_disabled_admin = (($usr_arr['acl'] & $app_acl['admin']) > 0 && !$as->aclCheck($app_acl['admin']) ? 'disabled' : '') ?>
		<tr <?= ($usr_arr['id'] == $logged_user_arr['user_id'] ? 'class="table-success"' : ''); ?>>
			<td><?= Format::toFullName($usr_arr['last_name'], $usr_arr['first_name']); ?></td>
			<td class="d-none d-md-table-cell"><?= $usr_arr['email']; ?></td>
			<td class="d-lg-none"><?= $usr_arr['year']; ?></td>
			<td class="d-none d-lg-table-cell"><?= Format::toDate('d. m. Y', $usr_arr['birthday']); ?></td>
			<td class="d-none d-md-table-cell"><?= $usr_arr['gender_name']; ?></td>
			<td class="text-center"><?= Format::toACLPopover($app_acl, $usr_arr['acl']); ?></td>
			<td class="text-center"><?= Format::toStatusPopover($usr_arr['status']); ?></td>
			<td><?= Format::toClubPopover($usr_arr['club'], $clubs_cas_arr); ?></td>
			<?php if ($as->aclCheck($app_acl['users_w'])): ?>
			<td class="text-center">
				<button class="btn btn-xs btn-warning edit-user" type="button" data-user="<?= $usr_arr['id'] ?>" <?= $_disabled_admin ?>>Editovat</button>
			</td>
			<td class="text-center">
				<button class="btn btn-xs btn-danger delete-user" type="button" data-user="<?= $usr_arr['id'] ?>" <?= $_disabled_admin ?>>Smazat</button>
			</td>
			<?php endif; ?>
		</tr>
	<?php endforeach; ?>
<?php else: ?>
	<tr>
		<td colspan="<?= ($as->aclCheck($app_acl['users_w']) ? 9 : 7) ?>">Žádní uživatelé</td>
	</tr>
<?php endif; ?>