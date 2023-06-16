<?php
require_once '../../db/Database.php';
require_once '../../db/UsersDB.php';

$userDB = new UsersDB();
$users = $userDB->getAll();
?>

<?php if (!empty($users)) : ?>
    <section class="users">
        <?php foreach ($users as $user) : ?>
            <div class="user">
                <p><span class="editable" contenteditable="true" data-user-id="<?= htmlspecialchars($user["user_id"]); ?>" data-column="username">Username: <?= htmlspecialchars($user["username"]); ?></span></p>
                <p><span class="editable" contenteditable="true" data-user-id="<?= htmlspecialchars($user["user_id"]); ?>" data-column="email">Email: <?= htmlspecialchars($user["email"]); ?></span></p>
                <p><span class="editable" contenteditable="true" data-user-id="<?= htmlspecialchars($user["user_id"]); ?>" data-column="first_name">First name: <?= htmlspecialchars($user["first_name"]); ?></span></p>
                <p><span class="editable" contenteditable="true" data-user-id="<?= htmlspecialchars($user["user_id"]); ?>" data-column="last_name">Last name: <?= htmlspecialchars($user["last_name"]); ?></span></p>
                <p><span class="editable" contenteditable="true" data-user-id="<?= htmlspecialchars($user["user_id"]); ?>" data-column="phone">Phone: <?= htmlspecialchars($user["phone"]); ?></span></p>
                <p><span class="editable" contenteditable="true" data-user-id="<?= htmlspecialchars($user["user_id"]); ?>" data-column="isAdmin">IsAdmin: <?= htmlspecialchars($user["isAdmin"]); ?></span></p>
                <form method="POST">
                    <input type="hidden" name="user_id" value="<?= htmlspecialchars($user["user_id"]); ?>">
                    <button class="delete-user" data-user-id="<?= htmlspecialchars($user["user_id"]); ?>" type="button">Delete user</button>
                </form>
            </div>
        <?php endforeach; ?>
    </section>
<?php else : ?>
    <p>No users found</p>
<?php endif; ?>
