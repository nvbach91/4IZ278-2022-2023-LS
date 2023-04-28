<?php

require_once __DIR__ . '/../../../classes/UsersDB.php';

use classes\UsersDB;

$htmlTitle = 'HW Shop | User | Roles';
if (!hasPermission('users.manage')) {
	require_once __DIR__ . '/../../../templates/403.php';
	exit();
}

$user = isset($_GET['user']) ? trim($_GET['user']) : null;
$UsersDB = new UsersDB();
$user = $UsersDB->fetchUser($user);
if(empty($user)) {
	require_once __DIR__ . '/../../../templates/400.php';
	exit();
}
$userRoles = $UsersDB->fetchUserRoles($user->mail, PDO::FETCH_ASSOC);

?>
<h4 class="mb-4">User: <?php echo $user->mail?></h4>
<h5 class="mb-2">Assigned roles:</h5>
<div class="row animation fade-in">
	<table class="table">
		<thead>
		<tr>
			<th scope="col" style="width:25%;">Role key</th>
			<th scope="col" style="width:75%;">Description</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($userRoles as $role): ?>
			<tr>
				<th scope="row"><?php echo $role['role_key']; ?></th>
				<td><?php echo $role['description']; ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>