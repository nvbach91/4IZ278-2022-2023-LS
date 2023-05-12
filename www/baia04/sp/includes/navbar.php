<?php 
?>
<div class='navbar<?php echo $theme;?>'>
    <div class='brand'>
        <a href='../utils/setSession.php?page=main'>
            <img class='logo' src='../images/logo.png'>
            <h2 class='logo_title'>Pulse Point</h2>
        </a>
    </div>
    <div class='settings'>
        <a href = '../utils/setSession.php?theme=<?php echo (!isset($_SESSION['theme']) || $_SESSION['theme'] === '') ? '_dark' : ''?>'>
            <img class='dark_theme<?php echo $theme; ?>' src='../images/icons/moon.svg'>
        </a>
        <a class = 'blue' href = '../utils/setSession.php?language=<?php echo (!isset($_SESSION['language']) || $_SESSION['language'] === 'ENG') ? 'CZ' : 'ENG' ?>'>
            <h2 class='language'><?php echo $language === 'ENG' ? 'CZ' : 'ENG' ?></h2>
        </a>
    </div>
</div>