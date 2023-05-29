<?php include './components/header.php'; ?>

<?php

require_once './utils.php';

requireLogin();

error_reporting(E_ERROR | E_PARSE);

$url_array =  explode('/', $_SERVER['REQUEST_URI']);

$url = end($url_array);

?>

<main class="flex w-full flex-1 flex-col items-center justify-center px-20 text-center">
  <?php require './components/my-tickets.php'; ?>
</main>

<?php include './components/footer.php'; ?>