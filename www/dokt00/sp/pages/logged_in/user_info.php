<?php

require_once '../../db/Database.php';
require_once '../../db/UsersDB.php';


$usersDB = new UsersDB();
$info = $usersDB->getById($_SESSION['user_id']);

?>

<div>
    <h1>
        <?= htmlspecialchars($info['username']); ?> - Profile
    </h1>
    <div class="profile">
        <div class="profile-info-wrapper">
            <div class="profile-info">
                <h2>Personal information</h2>
                <p>First name:
                    <?= htmlspecialchars($info['first_name']); ?>
                </p>
                <p>Last name:
                    <?= htmlspecialchars($info['last_name']); ?>
                </p>
                <p>Email:
                    <?= htmlspecialchars($info['email']); ?>
                </p>
                <p>Phone number:
                    <?= htmlspecialchars($info['phone']); ?>
                </p>
            </div>
            <div class="profile-photo">
                <img src="../../img/profile-photo.jpg" alt="profilePhoto">
            </div>
        </div>

        <div class="profile-actions">
            <a class="profile-action" href="order_history_page.php">Order history</a>
            <a class="profile-action" href="password_change_page.php">Change password</a>
        </div>
    </div>
</div>