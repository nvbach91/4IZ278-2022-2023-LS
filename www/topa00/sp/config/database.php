<?php
require 'constants.php';

//connecting to db via mysqli
$db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if(mysqli_errno($db)) {
  die(mysqli_error($db));
}