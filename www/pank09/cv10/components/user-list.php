<?php
    if (!$authUser || !($authUser->privilege > 2)) {
        header('HTTP/1.0 403 Forbidden');
        exit('You are forbidden');
    }

    require_once __DIR__ . '/../classes/UsersDB.php';

    $usersDatabase = new UsersDB;

    if (isset($_GET['action'])) {
        switch($_GET['action']) {
            case 'promote':
                $usersDatabase->promote($_GET['user_id']);
                break;
            case 'demote':
                $usersDatabase->demote($_GET['user_id']);
                break;
        }

        header(sprintf('Location: %s', $_SERVER['HTTP_REFERER'] ?? 'users.php'));
        exit();
    }

    $users = $usersDatabase->fetchAll();
?>

<div style="min-height: calc(100vh - 180px);">
    <h1 class="mt-4 mb-5">Users (<?php echo count($users) ?>)</h1>

    <?php if (!$users): ?>
        <h3>Empty</h3>
    <?php endif; ?>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Email</th>
                <th scope="col">Name</th>
                <th scope="col">Role</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($users as $user): ?>
                <tr>
                    <th scope="row"><?php echo $user['email'] ?></th>
                    <td><?php echo $user['name'] ?></td>
                    <td>
                        <?php
                            switch($user['privilege']) {
                                case 1:
                                    $role = 'User';
                                    break;
                                case 2:
                                    $role = 'Manager';
                                    break;
                                case 3:
                                    $role = 'Admin';
                                    break;
                            }

                            echo $role;
                        ?>
                    </td>
                    <td>
                        <?php if ($user['user_id'] !== $authUser->user_id): ?>
                        <a href="<?php echo sprintf("users.php?action=promote&user_id=%d", $user['user_id']); ?>" class="btn btn-success <?php if ($user['privilege'] === 3) echo 'disabled'; ?>">Promote</a>
                        <a href="<?php echo sprintf("users.php?action=demote&user_id=%d", $user['user_id']); ?>" class="btn btn-danger <?php if ($user['privilege'] === 1) echo 'disabled'; ?>">Demote</a>
                        <?php else: ?>
                            This is you
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>