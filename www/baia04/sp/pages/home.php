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
?>

<body id=<?php echo $theme; ?>>
    <a name = 'up'>
    <?php require realpath(__DIR__ . '/..') . '/includes/navbar.php'; ?>
    <main class='container'>
        <?php require realpath(__DIR__ . '/..') . '/includes/menu.php'; ?>

        <div class = 'goup'>
            <a href = '#up'><img src = '../images/icons/up.svg'></a>
        </div>
        <form 
            class = 'newPost<?php echo $theme; ?>' 
            method="POST" 
            action="../utils/uploadPhoto.php?userID=<?php echo $_COOKIE['userID']; ?>"
            enctype="multipart/form-data"
        >
            <textarea class = 'newPost_text<?php echo $theme; ?>' placeholder="<?php echo $messages['whatNews'][$language]; ?>" name = 'text'></textarea>
            <div class = 'photo'>
                <label for = 'fileToUpload'>
                    <img class = 'file_input_hover' src = '../images/icons/photo.svg'>
                </label>
                <input
                    type = 'file' 
                    class = 'input_photo' 
                    name = 'fileToUpload' 
                    id = 'fileToUpload' 
                    accept="image/png, image/gif, image/jpeg"
                > 
            </div>
            <input type = 'submit' value = 'Publish' class = 'publish_button'>
        </form>

        <div class = 'posts'>
            <?php 
                $posts = $db -> fetchAllPosts();
                foreach($posts as $post):
                    $user = $utils -> getUser($post['author_id']);
            ?>
                <a name = 'section<?php echo $post['post_id']; ?>'></a>
                <div class = 'post<?php echo $theme; ?>'>
                    <div class = 'post_header'>
                        <a href = '../utils/setSession.php?page=profile&profileID=<?php echo $post['author_id']; ?>'>
                        <div class = 'post_avatar'>
                            <img class = 'post_avatar' src = '<?php echo $user['avatar']; ?>' style = 'border-radius: 999px;'>
                        </div>
                        </a>
                        <div class = 'post_header_title'>
                            <h3><?php echo $user['name'] . ' ' . $user['surname']; ?></h3>
                            <p style = 'filter: opacity(70%)'><?php echo $utils -> getTime($post['date']); ?></p>
                        </div>
                        <div class = 'post_misc'>
                            <div class = 'like_div'>
                                <label for = 'like'></label>
                                    <a href = '../utils/like.php?userID=<?php echo $_COOKIE['userID'];?>&postID=<?php echo $post['post_id'] ?>'>
                                        <img 
                                            src = '../images/icons/<?php echo $utils -> isLiked($_COOKIE['userID'], $post['post_id']) ? 'liked' : 'like'?>.svg'
                                        >
                                    </a>
                                <input class = 'like' type = 'checkbox' id = 'like' style = 'display: none' checked>
                                <p><?php echo $db -> likeAmount($post['post_id']) ?></p>
                            </div>
                            <div class = 'comment_div'>
                                <label for = 'comment'>
                                    <a href = '../pages/comments.php?post=<?php echo $post['post_id']; ?>'>
                                        <img src = '../images/icons/comment.svg'>
                                    </a>
                                </label>
                                <input type = 'button' id = 'comment' style = 'display: none'>
                                <p style = 'margin-top: 8px'><?php echo $db -> commentAmount($post['post_id']) ?></p>
                            </div>
                        </div>
                    </div>
                    <div class = 'post_content'>
                        <p class = 'post_text'><?php echo $post['text']; ?></p>
                        <br><br>
                        <?php 
                            $file = $utils -> getPostImage($post['post_id']);
                            if ($file): 
                        ?>
                            <img class = 'post_image' src = '<?php echo $file; ?>'>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
    </main>
</body>

