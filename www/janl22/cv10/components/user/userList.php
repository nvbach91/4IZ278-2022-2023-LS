<?php

require_once __DIR__ . '/../../classes/UsersDB.php';

use classes\UsersDB;

$htmlTitle = 'HW Shop | Users';
if (!hasPermission('users.manage')) {
	require_once __DIR__ . '/../../templates/403.php';
	exit();
}

$UsersDB = new UsersDB();
$users = $UsersDB->fetchUsers();



?>
<div class="row animation fade-in">
	<table class="table">
		<thead>
		<tr>
			<th scope="col" style="width:30%;">Mail</th>
			<th scope="col" style="width:10%;">Name</th>
			<th scope="col" style="width:10%;">Surname</th>
			<th scope="col" class="text-center" style="width:45%;">Roles</th>
			<th scope="col" class="text-center" style="width:5%;">Actions</th>

		</tr>
		</thead>
		<tbody>
		<?php foreach ($users as $user): ?>
			<tr>
				<th scope="row"><?php echo $user->mail; ?></th>
				<td><?php echo $user->name; ?></td>
				<td><?php echo $user->surname ?></td>
				<td class="text-center"><?php echo implode(', ', $user->roles)?></td>
				<td class="text-center">
					<a href="editRoles?user=<?php echo $user->mail; ?>"
					   class="text-black ms-2 me-2" style="text-decoration: none">
						<i class="bi bi-key-fill"></i>
					</a>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>