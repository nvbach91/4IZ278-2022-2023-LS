<?php 
    // TITLE HANDLING ------
    ob_start();
    include("header.php");
    $buffer=ob_get_contents();
    ob_end_clean();

    $buffer=str_replace("%TITLE%","ESHOP BEEBZZ",$buffer);
    echo $buffer;


?>

<?php include './footer.php'; ?>