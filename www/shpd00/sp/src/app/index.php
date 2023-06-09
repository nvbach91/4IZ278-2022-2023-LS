<?php
  // HSTS hlavičku posíláme jen při použití protokolu HTTPS:
  if (isset( $_SERVER["HTTPS"] )|| $_SERVER['https'] == 'on' || $_SERVER['SERVER_PORT'] == 443) {
    header("Strict-Transport-Security: max-age=63072000; includeSubDomains; preload");
  }
?>

<?php
    // header("Strict-Transport-Security: max-age=63072000; includeSubDomains; preload");
    // header("X-Frame-Options: DENY");

    require '../session-check.php';
    if (!$sessionIsValid){
        header('location: ../logout.php');
    }
    $cssFile = '../css/app.css';
    require '../templates/html-start.php';
    require_once '../DBConnection.php';
?>
<header>
    <div class = 'header-container'>
        <img class = 'header-content' src="../img/eye-logo.svg" alt="logo" width="60px" height="30px">
        <text class = 'header-content' >Doorkeeper</text>
        <text class = 'header-content right'><?php echo $_COOKIE['username']; ?></text>
        <a href="../logout.php">
            <button class = 'header-content' formaction = '../index.php' type='button'>log out</button>
        </a>
    </div>
</header>
<main class = 'app-main-container'>
    <!-- devices here -->
</main>
<script src='./main.js' type='module'></script>
<?php
    require '../templates/html-end.php';
?>