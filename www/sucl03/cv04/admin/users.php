<?php
// file:cv04/admin/users.php
require_once(__DIR__ . '/../libs/init.php');
require_once(__DIR__ . '/../models/users.php');

$users_arr = fetchUsers();

require_once(__DIR__ . '/../libs/html-header.php');
?>

<main class="container">
    <br>
    <h1 class="text-center">Users</h1>
    <?php foreach ($users_arr as $user): ?>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo $user['name']; ?></h5>
                <h6 class="card-subtitle mb-2 text-muted">e-mail: <?php echo $user['email']; ?></h6>
				<h6 class="card-subtitle mb-2 text-muted">password: <?php echo hide_password($user['password']); ?></h6>
            </div>
        </div>
        <br>
    <?php endforeach; ?>
</main>

<?php
require(__DIR__ . '/../libs/html-footer.php');
?>