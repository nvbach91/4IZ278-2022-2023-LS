<?php

require './utils.php';

$allUsers = getAllUsers();

foreach ($allUsers as $user) {
    echo "$user <br>";
};

?>