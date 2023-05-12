<?php
require './UsersDatabase.php';

// TITLE HANDLING ------
ob_start();
include("header.php");
$buffer = ob_get_contents();
ob_end_clean();

$buffer = str_replace("%TITLE%", "About us BEEBZZ", $buffer);
echo $buffer;


?>


<?php include './footer.php'; ?>

