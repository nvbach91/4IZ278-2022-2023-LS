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
$sql = "SELECT * FROM `friends` WHERE `user1_id` = :userID OR `user2_id` = :userID ";
$friends = $db -> execute(
    $sql,
    ['userID' => $_COOKIE['userID']]
);
?>

<body id=<?php echo $theme; ?>>
    <a name='up'>
        <?php require realpath(__DIR__ . '/..') . '/includes/navbar.php'; ?>
        <main class='container'>
            <?php require realpath(__DIR__ . '/..') . '/includes/menu.php'; ?>

            <div class='chats'>
                <?php foreach ($friends as $friend) :
                    $friendID = $friend['user1_id'] === intval($_COOKIE['userID']) ? $friend['user2_id'] : $friend['user1_id'];
                    $user = $utils->getUser($friendID);
                ?>
                <div class = 'newPost<?php echo $theme ?>' id = 'chat'>
                    <img src='<?php echo $user['avatar']; ?>' style="max-height: 80px">
                    <h4 class='post_header' style="top: 26px"><?php echo $user['name'] . ' ' . $user['surname']; ?></h4>
                    <div class = 'additional_actions'>
                        <a href = '../utils/addChat.php/?user1ID=<?php echo $_COOKIE['userID']?>&user2ID=<?php echo $friendID; ?>'>
                            <b><?php echo $messages[$language]['sendMessage']; ?></b>
                        </a>
                        <a 
                            href = '../utils/deleteFriend.php/?user1ID=<?php echo $_COOKIE['userID']?>&user2ID=<?php echo $friendID; ?>'
                            style = 'color: #ff9f9f'
                        >
                            <?php echo $messages[$language]['deleteFriend']; ?>
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </main>
</body>