<?php
session_start();
require realpath(__DIR__ . '/..') . '/messages.php';
require('../utils/Utils.php');
require_once ('../utils/Database.php');
require realpath(__DIR__ . '/..') . '/includes/header.php';
if (isset($_SESSION['logout']) || !isset($_COOKIE['userID'])) {
    setcookie('userID', '', time());
    unset($_SESSION['logout']);
    header('Location: ../utils/setSession.php?page=main');
}
$theme = isset($_SESSION['theme']) ? $_SESSION['theme'] : '';
$language = isset($_SESSION['language']) ? $_SESSION['language'] : 'CZ';
$utils = Utils::getInstance();
$db = $utils -> getDB();

$user = $utils -> getUser($_COOKIE['userID']);
$companion = $utils -> getUser($_GET['companionID']);
$users = [
    'user1ID' => $_COOKIE['userID'],
    'user2ID' => $_GET['companionID']
];
$messages = $utils -> getAllMessages($users);
?>

<body id=<?php echo $theme; ?>>
    <a name = 'up'>
    <?php require realpath(__DIR__ . '/..') . '/includes/navbar.php'; ?>
    <main class='container'>
        <?php require realpath(__DIR__ . '/..') . '/includes/menu.php'; ?>
    
        <div class = 'chat<?php echo $theme; ?>'>

            <div class = 'chat_header'>
                <img src = '<?php echo $companion['avatar']; ?>' style="max-height: 80px">
                <h2 class = 'chat_title'><?php echo $companion['name'] . ' ' . $companion['surname'] ?></h2>
            </div>

            <div class = 'chat_space'>
                <?php foreach($messages as $message):
                    $sender = $utils -> getUser($message['author_id']); 
                ?>
                <div class = '<?php echo ($message['author_id'] !== intval($_GET['companionID'])) ? 'right' : 'left'?>_message'>
                    <img src = '<?php echo $sender['avatar']; ?>' style="max-height: 40px">
                    <p class = 'message_text'><?php echo $message['message'] ?></p>
                </div>
                <?php endforeach; ?>
            </div>

            <form 
                class = 'chat_send' 
                method = 'POST' 
                action = '../utils/sendMessage.php?companionID=
                    <?php echo $_GET['companionID']; ?>&userID=<?php echo $_COOKIE['userID'];?>'
            >
                <textarea class = 'message_area' name = 'text'></textarea>
                <label for ='send_btn' class = 'send_btn'>
                    <img src = '../images/icons/send.svg'>
                </label>
                <input id = 'send_btn' type = 'submit' style = 'display: none'>
            </form>

        </div>
    </main>
</body>