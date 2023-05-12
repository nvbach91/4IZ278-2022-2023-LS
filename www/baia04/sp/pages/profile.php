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
$profileID = $_SESSION['profileID'];
$user = $utils->getUser($profileID);
?>

<body id=<?php echo $theme; ?>>
    <a name='up'>
        <?php require realpath(__DIR__ . '/..') . '/includes/navbar.php'; ?>
        <main class='container'>
            <?php require realpath(__DIR__ . '/..') . '/includes/menu.php'; ?>
            <div class='portfolio<?php echo $theme ?>'>
                <form class='portfolio_header' method="POST" action="../utils/changeProfile.php?userID=<?php echo $_COOKIE['userID']; ?>" enctype="multipart/form-data">
                    <div class='portfolio_titles_and_photo'>
                        <div class='portfolio_titles'>
                            <input type='text' class='portfolio_title' value=<?php echo $user['name'] ?> placeholder="Name" name='name' <?php echo ($profileID === $_COOKIE['userID']) ? '' : 'readonly' ?>>
                            <input type='text' class='portfolio_title' value=<?php echo $user['surname']; ?> placeholder="Last Name" name='surname' <?php echo ($profileID === $_COOKIE['userID']) ? '' : 'readonly' ?>>
                            <input type='date' class='portfolio_title' value=<?php echo $user['dateOfBirth']; ?> placeholder="date of birth" name='dateOfBirth' <?php echo ($profileID === $_COOKIE['userID']) ? '' : 'readonly' ?>>
                            <br><br>
                            <?php if ($profileID === $_COOKIE['userID']) : ?>
                                <label for='submit_changes' class='file_input_hover'>
                                    <img src='../images/icons/submit.svg'>
                                </label>
                            <?php endif; ?>
                            <input id='submit_changes' type='submit' style='display: none'>
                        </div>
                        <div class='portfolio_photo'>
                            <img src=<?php echo $user['avatar']; ?> style='border-radius: 999px; width: 249px;'>
                            <?php if ($profileID === $_COOKIE['userID']) : ?>
                                <label for='fileToUpload'>
                                    <img class='file_input_hover' src='../images/icons/photo.svg'>
                                </label>
                            <?php endif; ?>
                            <input class='input_photo' type='file' name='fileToUpload' id='fileToUpload' accept="image/png, image/gif, image/jpeg">
                            <div class='portfolio_actions'>
                                <div class='portfolio_action'>
                                    <a href='../utils/addChat.php?user1ID=<?php echo $_COOKIE['userID'] ?>&user2ID=<?php echo $profileID; ?>'>
                                        <?php if ($profileID !== $_COOKIE['userID']) : ?>
                                            <label for='addChat'>
                                                <img class='file_input_hover' src='../images/icons/chat.svg'>
                                            </label>
                                            <input class='input_photo' type='button' name='addChat' id='addChat'>
                                        <?php endif; ?>
                                    </a>
                                </div>
                                <div class='portfolio_action'>
                                    <a href='../utils/addFriend.php?user1ID=<?php echo $_COOKIE['userID'] ?>&user2ID=<?php echo $profileID; ?>'>
                                        <?php if ($profileID !== $_COOKIE['userID']) : ?>
                                            <label for='addFriend'>
                                                <img class='file_input_hover' src='../images/icons/addFriend.svg'>
                                            </label>
                                            <input class='input_photo' type='button' name='addFriend' id='addFriend'>
                                        <?php endif; ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='portfolio_description'>
                        <textarea 
                            class='portfolio_title' 
                            placeholder="description" 
                            name='description' <?php echo ($profileID === $_COOKIE['userID']) ? '' : 'readonly' ?>
                        ><?php echo !empty($user['description']) ? $user['description'] : '' ?></textarea>
                    </div>
                </form>
            </div>

            <div class='portfolio_posts'>
                <?php
                $posts = $db->fetchAllPostsFromUser($profileID);
                foreach ($posts as $post) :
                    $user = $utils->getUser($post['author_id']);
                ?>
                    <a name='section<?php echo $post['post_id']; ?>'></a>
                    <div class='post<?php echo $theme; ?>'>
                        <div class='post_header'>
                            <div class='post_avatar'>
                                <img class='post_avatar' src='<?php echo $user['avatar']; ?>' style='border-radius: 999px;'>
                            </div>
                            <div class='post_header_title'>
                                <h3><?php echo $user['name'] . ' ' . $user['surname']; ?></h3>
                                <p style='filter: opacity(70%)'><?php echo $utils->getTime($post['date']); ?></p>
                            </div>
                            <div class='post_misc'>
                                <div class='like_div'>
                                    <label for='like'></label>
                                    <img src='../images/icons/<?php echo $utils->isLiked($_COOKIE['userID'], $post['post_id']) ? 'liked' : 'like' ?>.svg'>
                                    <input class='like' type='checkbox' id='like' style='display: none' checked>
                                    <p><?php echo $db->likeAmount($post['post_id']) ?></p>
                                </div>
                                <div class='comment_div'>
                                    <label for='comment'>
                                        <a href='../pages/comments.php?post=<?php echo $post['post_id']; ?>'>
                                            <img src='../images/icons/comment.svg'>
                                        </a>
                                    </label>
                                    <input type='button' id='comment' style='display: none'>
                                    <p style='margin-top: 8px'><?php echo $db->commentAmount($post['post_id']) ?></p>
                                </div>
                            </div>
                        </div>
                        <div class='post_content'>
                            <p class='post_text'><?php echo $post['text']; ?></p>
                            <br><br>
                            <?php
                            $file = $utils->getPostImage($post['post_id']);
                            if ($file) :
                            ?>
                                <img class='post_image' src='<?php echo $file; ?>'>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>

        </main>
</body>