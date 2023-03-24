<?php 
// ./htaccess2/index.php
echo '<h1>./htaccess2/index.php<h1>';
echo '<h2>' . $_GET['path'] . '</h2>';
print_r(explode('/', $_GET['path']));
?>