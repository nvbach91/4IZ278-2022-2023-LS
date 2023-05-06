<?php require_once './UsersDatabase.php'; ?>
<?php
session_start();

if ($_SESSION['auth_level'] < 3) {
    header('Location: index.php');
}
$db = new UsersDatabase;

$users = $db->getUsers();
// var_dump($users);

if ('POST' == $_SERVER['REQUEST_METHOD']) {   
    $result = $db->updateUserAuthLevel($_POST['user_id'], $_POST['auth']);
    if ($result != 200) {
        header('HTTP/1.1 500 ');
        exit('Something went wrong');
    }
    $_SESSION['auth_level'] = $_POST['auth'];
    header("Refresh:0");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/users.css" rel="stylesheet" />
</head>
<body>
    <?php require './CategoryDisplay.php'; ?>
    <div class="users">
        <h2>Users list</h2>
        <ul>
        <?php foreach ($users as $user): ?>
            <li><?php echo $user['email']; ?>
            <form method="POST" action="./users.php">
                <label>Auth level: </label>
                <select name="auth">
                    <option value="1" <?php echo $user['auth_level'] == "1" ? ' selected' : ''; ?> >User</option>
                    <option value="2" <?php echo $user['auth_level']  == "2" ? ' selected' : ''; ?> >Manager</option>
                    <option value="3" <?php echo $user['auth_level']  == "3" ? ' selected' : ''; ?> >Admin</option>  
                </select>
                <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>"/>
                <button type="submit">Save</button>
            </form>
            </li>
        </ul>
        <?php endforeach; ?>
    </div>
</body>
</html>