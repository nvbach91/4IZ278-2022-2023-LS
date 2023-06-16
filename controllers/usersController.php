<?php
require 'authorization.php';
require 'admin-required.php';

$limit = 4;

if (isset($_GET['offset'])) {
    $offset = (int)$_GET['offset'];
} else {
    $offset = 0;
}

$users = $usersDatabase->fetchAllPagination($limit, $offset);
$count = $usersDatabase->getCount();
$paginationCount = ceil($count / $limit);
