<?php 
    // TITLE HANDLING ------
    ob_start();
    include("header.php");
    $buffer=ob_get_contents();
    ob_end_clean();

    $buffer=str_replace("%TITLE%","YOUR PROFILE BEEBZZ",$buffer);
    echo $buffer;


?>
<?php include './header.php'; ?>
<?php include './footer.php'; ?>