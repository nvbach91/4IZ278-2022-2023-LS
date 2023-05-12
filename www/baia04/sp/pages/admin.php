<?php
session_start();
require realpath(__DIR__ . '/..') . '/includes/header.php';
require realpath(__DIR__ . '/..') . '/messages.php';
require('../utils/Utils.php');
require_once('../utils/Database.php');
if (isset($_SESSION['logout']) || !isset($_COOKIE['userID'])) {
    setcookie('userID', '', time());
    unset($_SESSION['logout']);
    header('Location: ../utils/setSession.php?page=main');
}
$theme = isset($_SESSION['theme']) ? $_SESSION['theme'] : '';
$language = isset($_SESSION['language']) ? $_SESSION['language'] : 'CZ';

$utils = Utils::getInstance();
$db = $utils -> getDB();
$sql = "SELECT * FROM `users` LEFT JOIN `profiles` USING (user_id)";
$users = $db -> execute($sql, []);
?>

<body id=<?php echo $theme; ?>>
    <a name='up'>
        <?php require realpath(__DIR__ . '/..') . '/includes/navbar.php'; ?>
        <main class='container'>
            <?php require realpath(__DIR__ . '/..') . '/includes/menu.php'; ?>

            <table class = 'admin_table<?php echo $theme; ?>'>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Description</th>
                    <th>Date of birth</th>
                    <th>Is Admin</th>
                    <th></th>
                </tr>
                <?php foreach($users as $user): ?>
                <tr>
                    <td><?php echo $user['user_id']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo $user['phoneNumber']; ?></td>
                    <td><?php echo $user['name']; ?></td>
                    <td><?php echo $user['surname']; ?></td>
                    <td><?php echo $user['description']; ?></td>
                    <td><?php echo $user['date_birth']; ?></td>
                    <td><?php echo $user['is_admin']; ?></td>
                    <?php if ($_COOKIE['userID'] !== $user['user_id']): ?>
                    <td><a href = '../utils/removeUser.php?userID=<?php echo $user['user_id'];?>' class = 'blue'>Remove User</a>
                    <?php endif; ?>
                </tr>
                <?php endforeach; ?>
            </table>
        </main>
</body>