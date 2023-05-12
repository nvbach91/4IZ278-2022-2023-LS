<?php
session_start();
require realpath(__DIR__ . '/..') . '/includes/header.php';
require realpath(__DIR__ . '/..') . '/messages.php';
$theme = isset($_SESSION['theme']) ? $_SESSION['theme'] : '';
$language = isset($_SESSION['language']) ? $_SESSION['language'] : 'CZ';
?>

<body id=<?php echo $theme; ?>>
    <?php require realpath(__DIR__ . '/..') . '/includes/navbar.php'; ?>
    <main class='container'>
        <form class='registration<?php echo $theme ?>'>
            <h4 class='register_title'><?php echo $messages['termsOfUse'][$language]; ?></h4>
            <textarea class = 'terms_container' disabled>
                <?php foreach($messages['termsOfUseText'][$language] as $line) {
                    echo PHP_EOL . $line;
                }
                ?>
            </textarea>
            <div class='register_btn' style='left:370px; top:35px'>
                <a href = '../utils/setSession.php?page=registration'><inpute type='submit'>Go back</inpute></a>
            </div>
        </form>
    </main>
</body>