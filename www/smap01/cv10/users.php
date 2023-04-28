<?php require_once __DIR__ . '/incl/header.php'; ?>
<?php require_once __DIR__ . '/./database.php' ?>
<?php

$database = new Database();
if (empty($_COOKIE) || !isset($_COOKIE['user_email']) || $database->getUserPrivilege($_COOKIE['user_email']) < 3) {
    header('Location: index.php');
    exit;
}

if (!empty($_POST) && isset($_COOKIE['user_email']) && isset($_POST['user_email']) && isset($_POST['privilege']) && $_POST['privilege'] > 0) {
    if ($database->changePrivilege($_POST['user_email'], $_POST['privilege']) == null) {
        echo '<div style="background-color:green;text-align:center;color:white;">Privilege changed</div>';
    }
}

?>
<main>
    <h1 style="text-align:center;margin-bottom:50px;">All users</h1>
    <?php

    $users = $database->getUsers();
    foreach ($users as $user) {
        echo
        '<form style="width:60%;margin-left:auto;margin-right:auto;height: 40px;border:1px;border-style:solid;border-color:darkgray;border-radius:7px;margin-bottom:10px;display:flex;" action=' . $_SERVER['PHP_SELF'] . ' method="POST">
            <div style="width:80%;margin-top:auto;margin-bottom:auto;">
            <input value=' . $user['user_email'] . ' name="user_email" style="padding-left:2%;background-color:transparent;border:0px;" readonly>
            </div>
            <div style="width:20%; text-align:right;padding-right:5px;margin-top:auto;margin-bottom:auto;">
            <select name="privilege">
                <option value="1"';
        echo (!empty($user) && $user['user_privilege'] == 1) ? 'selected' : '';
        echo '>1</option>
                <option value="2"';
        echo (!empty($user) && $user['user_privilege'] == 2) ? 'selected' : '';
        echo '>2</option>
                <option value="3"';
        echo (!empty($user) && $user['user_privilege'] == 3) ? 'selected' : '';
        echo '>3</option>
            </select>
            <button>Change</button>
            </div>
        </form>';
    }

    ?>
</main>
<?php require_once __DIR__ . '/incl/footer.php'; ?>