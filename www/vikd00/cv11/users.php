<?php
session_start();
require_once 'dbconfig.php';
require_once 'auth.php';
requirePrivilege(3);

$pdo = new PDO(
    'mysql:host=' . DB_HOST .
        ';dbname=' . DB_NAME .
        ';charset=utf8mb4',
    DB_USERNAME,
    DB_PASSWORD
);

$statement = $pdo->prepare('SELECT * FROM cv10_users');
$statement->execute();
$users = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<?php require __DIR__ . '/header.php'; ?>

<body class="container">
    <?php require __DIR__ . '/navbar.php'; ?>
    <h3 class="mb-4">Users</h3>
    <table class="table">
        <tr>
            <th>Email</th>
            <th>Privilege</th>
            <th>Update</th>
        </tr>
        <?php foreach ($users as $user) : ?>
            <tr>
                <td><?php echo $user['email']; ?></td>
                <td>
                    <form method="post" action="update-privilege.php">
                        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                        <select name="privilege">
                            <option value="1" <?php echo ($user['privilege'] == 1) ? 'selected' : ''; ?>>Regular User</option>
                            <option value="2" <?php echo ($user['privilege'] == 2) ? 'selected' : ''; ?>>Manager</option>
                            <option value="3" <?php echo ($user['privilege'] == 3) ? 'selected' : ''; ?>>Administrator</option>
                        </select>
                </td>
                <td>
                    <input type="submit" value="Update">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

</body>

<?php require __DIR__ . '/footer.php'; ?>