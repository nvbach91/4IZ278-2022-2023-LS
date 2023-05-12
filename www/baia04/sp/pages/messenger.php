<?php
session_start();
require realpath(__DIR__ . '/..') . '/includes/header.php';
require realpath(__DIR__ . '/..') . '/messages.php';
require('../utils/Utils.php');
require_once ('../utils/Database.php');
if (isset($_SESSION['logout']) || !isset($_COOKIE['userID'])) {
    setcookie('userID', '', time());
    unset($_SESSION['logout']);
    header('Location: ../utils/setSession.php?page=main');
}
$theme = isset($_SESSION['theme']) ? $_SESSION['theme'] : '';
$language = isset($_SESSION['language']) ? $_SESSION['language'] : 'CZ';

$utils = Utils::getInstance();
$db = $utils -> getDB();
$sql = 'SELECT * FROM `chats` WHERE `user1_ID` = :userID OR `user2_ID` = :userID';
$chats = $db -> execute(
    $sql,
    ['userID' => $_COOKIE['userID']]
);
?>

<body id=<?php echo $theme; ?>>
    <a name = 'up'>
    <?php require realpath(__DIR__ . '/..') . '/includes/navbar.php'; ?>
    <main class='container'>
        <?php require realpath(__DIR__ . '/..') . '/includes/menu.php'; ?>
    
        <div class = 'chats'>   
            <?php foreach ($chats as $chat): 
                $companionID = $chat['user1_id'] === intval($_COOKIE['userID']) ? $chat['user2_id'] : $chat['user1_id'];
                $user = $utils -> getUser($companionID);
            ?>
                <a href = '../pages/chat.php?companionID=<?php echo $companionID; ?>' class = 'newPost<?php echo $theme ?>' id = 'chat'>
                    <img src = '<?php echo $user['avatar']; ?>' style="max-height: 80px">
                    <h4 class = 'post_header' style = "top: 26px"><?php echo $user['name'] . ' ' . $user['surname']; ?></h4>
                </a>
            <?php endforeach; ?>
        </div>
    </main>
</body>