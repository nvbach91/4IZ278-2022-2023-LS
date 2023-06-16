<?php
require './UsersDatabase.php';
// TITLE HANDLING ------
ob_start();
include("header.php");
$buffer = ob_get_contents();
ob_end_clean();

$buffer = str_replace("%TITLE%", "SUCCESSFUL LOGIN", $buffer);
echo $buffer;
?>
<div class="alert alert-success text-center" style="height: 500px;">
    <h1 style="margin-top: 150px;">You are logged in!</h1>
</div>

<?php include './footer.php'; ?>