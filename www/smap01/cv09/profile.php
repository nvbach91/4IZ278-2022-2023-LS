<?php require_once("./incl/header.php"); ?>

<h1>Profile</h1>
<?php

if(!empty($_COOKIE['name'])){
    echo "<h2>".$_COOKIE['name']."</h2>";
}else{
    echo "<h2>Not logged in</h2>";
}

?>

<?php require_once("./incl/footer.php"); ?>