<?php
require_once "functions.php";

$users = fetchUsers();

require "header.php"; ?>
    <h1>Administration</h1>
    <table border="1">
        <thead>
        <tr>
            <th>User</th>
            <th>Email</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user):?>
            <tr>
                <td><?php echo $user["name"]; ?></td>
                <td><?php echo $user["email"]; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

<?php require "footer.php";
