<?php require_once("./incl/header.php"); ?>

<?php
if (empty($_COOKIE) || !isset($_COOKIE['user_email'])) {
    header('Location: login.php');
    exit;
}
?>
<h1>Profile</h1>
<?php
if (!empty($_COOKIE['user_email'])) {
    echo "<h2>" . $_COOKIE['user_email'] . "</h2>";
} else {
    echo "<h2>Not logged in</h2>";
}

?>

<?php require_once("./incl/footer.php"); ?>