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
?>

<body id=<?php echo $theme; ?>>
    <a name='up'></a>
    <?php require realpath(__DIR__ . '/..') . '/includes/navbar.php'; ?>
    <main class='container'>
        <?php require realpath(__DIR__ . '/..') . '/includes/menu.php'; ?>

        <div class='goup'>
            <a href='#up'><img src='../images/icons/up.svg'></a>
        </div>

        <?php
        $post = $db->getPostByID($_GET['post']);
        $user = $utils->getUser($post['author_id']);
        ?>
        <div class='posts<?php echo $theme; ?>'>
            <div class='post<?php echo $theme; ?>'>
                <div class='post_header'>
                    <div class='post_avatar'>
                        <img class='post_avatar' src='<?php echo $user['avatar']; ?>' style='border-radius: 999px'>
                    </div>
                    <div class='post_header_title'>
                        <h3><?php echo $user['name'] . ' ' . $user['surname']; ?></h3>
                        <p style='filter: opacity(70%)'><?php echo $utils->getTime($post['date']); ?></p>
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
        </div>

        <div class='comments'>
            <?php
            $comments = $db->getComments($post['post_id']);
            foreach ($comments as $comment):
                $author = $utils -> getUser($comment['author_id']);
            ?>
                <div class='comment<?php echo $theme; ?>'>
                    <div class = 'comment_header'>
                        <img class = 'comment_avatar' src = '<?php echo $user['avatar']; ?>' style = 'border-radius: 999px'>
                        <h5 class = 'comment_title'><?php echo $author['name'] . ' ' . $author['surname']; ?></h5>
                    </div>
                    <div class = 'comment_content'>
                        <p class='comment_text'><?php echo htmlspecialchars($comment['text']); ?></p><br>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <form class='new_comment<?php echo $theme; ?>' method="POST" action="../utils/addComment.php?postID=<?php echo $post['post_id'] ?>&userID=<?php echo $_COOKIE['userID']; ?>" enctype="multipart/form-data">
                <textarea rows = 10 cols = 80 class='newPost_text<?php echo $theme; ?>' placeholder="<?php echo $messages[$language]['youthink']; ?>" name='text' ></textarea>
            <input type='submit' value='Comment' class='publish_button'>
        </form>
    </main>
</body>