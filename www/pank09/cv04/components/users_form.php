<?php
    require_once "../utils.php";

    $users = fetchUsers();
?>
<div class="container">
    <div class="form-wrapper">
        <h1>Users</h1>

        <table border="1" cellspacing="0" cellpadding="10">
            <?php if (empty($users)): ?>
            <tr>
                <td colspan="3">No users</td>
            </tr>
            <?php endif; ?>
            <?php foreach($users as $user): ?>
            <tr>
                <td><?php echo $user['email']; ?></td>
                <td><?php echo $user['phone']; ?></td>
                <td><?php echo $user['gender']; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>