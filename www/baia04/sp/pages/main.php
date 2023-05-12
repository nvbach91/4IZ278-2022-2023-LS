<?php 
session_start();
require realpath(__DIR__ . '/..') . '/includes/header.php';
require realpath(__DIR__ . '/..') . '/messages.php';
require_once realpath(__DIR__ . '/..') . '/utils/Utils.php';
$theme = isset($_SESSION['theme']) ? $_SESSION['theme'] : '';
$language = isset($_SESSION['language']) ? $_SESSION['language'] : 'CZ';

$utils = Utils::getInstance();
$submittedForm = !empty($_POST);
if (isset($_COOKIE['userID'])) {
    header('Location: ../utils/setSession.php?page=home');
    exit();
}
if ($submittedForm) {
    $errors = $utils -> validateLogin($_POST);
    if (is_int($errors)) {
        setcookie("userID", $errors, time() + 3600);
        header('Location: ../pages/main.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<body id = '<?php echo $theme; ?>'>
    <main class = 'container'>
        <?php require realpath(__DIR__ . '/..') . '/includes/navbar.php'; ?>

        <div class = 'left_side'>
            <div class = 'welcome'>
                <h3 class = 'welcome_title<?php echo $theme ?>'>
                    <?php echo $messages['welcomeMessage'][$language]; ?>
                </h3>
                <div class = 'welcome_photos'>
                    <div class = 'welcome_photo_container'>
                        <img class = 'welcome_photo' src = '../images/person1.png'>
                    </div>
                    <div class = 'welcome_photo_container'>
                        <img class = 'welcome_photo' src = '../images/person2.png'>
                    </div>
                    <div class = 'welcome_photo_container'>
                        <img class = 'welcome_photo' src = '../images/person3.png'>
                    </div>
                    <div class = 'welcome_photo_container'>
                        <img class = 'welcome_photo' src = '../images/person4.png'>
                    </div>
                </div>
                <div class = 'arrow_container'>
                    <img class = 'arrow' src = '../images/arrow.svg'>
                </div>
            </div>
        </div>
        <div class = 'right_side'>
            <form class = 'login<?php echo $theme ?>' method = 'POST' action="main.php">
                <h4 class = 'login_title'><?php echo $messages['login'][$language]; ?></h4>
                <div class = 'field'>
                    <p class = 'field_p'><?php echo $messages['phoneNumberOrEmail'][$language]; ?></p>
                    <input 
                        type = 'text' 
                        id = 'login_field' 
                        placeholder="<?php echo $messages['inputPhoneNumberOrEmail'][$language]; ?>"
                        name = 'emailOrPhone'
                    >
                </div>
                <div class = 'field'>
                    <p class = 'field_p'><?php echo $messages['password'][$language]; ?></p>
                    <input 
                        type = 'password' 
                        id = 'login_field' 
                        placeholder="<?php echo $messages['inputPassword'][$language]; ?>"
                        name = 'password'
                    >
                </div>
                <label for = 'submit_btn_id' class = 'submit_btn'><?php echo $messages['loginButton'][$language]; ?></label>
                <input id = 'submit_btn_id' type = 'submit' style = 'display:none'></input>
                <?php if (isset($errors)): ?>
                    <div class = 'login_error'>
                        <p class = 'login_error_p'><?php echo $messages[$errors[0]][$language] ?></p>
                    </div>
                <?php endif; ?>
            </form>
            <div class = 'register<?php echo $theme ?>'>
                <div class = 'register_btn'>
                    <a href = '../utils/setSession.php?page=registration'>
                        <p><?php echo $messages['register'][$language]; ?></p>
                    </a>
                </div>
                <div class = 'register_text'>
                    <p class = 'register_text'><?php echo $messages['registerMessage'][$language]; ?></p>
                </div>
            </div>
        </div>
    </main>
</body>
</html>