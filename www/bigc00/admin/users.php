<?php
require('../includes/header.php');
require('../config/config.php');
require_once ('../db/Database.php');
session_start();
if ($_SESSION['login'] != 3) {
    header('Location: ../index.php');
    exit();
}
$db = new Database();

$statement = $db -> pdo -> prepare("SELECT * FROM `cv10_users`");
$statement -> execute();
$users = $statement -> fetchAll();

$submittedForm = !empty($_POST);
if ($submittedForm) {
    $newType = $_POST['userType'];
    if ($newType >= 1 && $newType <= 3) {
        $statement = $db -> pdo -> 
            prepare("UPDATE `cv10_users` SET `user_type`= :userType WHERE `user_id` = :userID");
        $statement -> execute([
            'userType' => $newType,
            'userID' => $_GET['userID']
        ]); 
    }
}
?>

<body>
    <?php foreach($users as $user): ?>
        <form class = 'user' method = "POST" action = "users.php?userID=<?php echo $user['user_id']; ?>">
            <h4><?php echo $user['email']; ?> : <?php echo $user['user_type']; ?>
            <input type = 'text' placeholder="Set user type" name = 'userType'>
        </form>
    <?php endforeach; ?>
</body>
</html>