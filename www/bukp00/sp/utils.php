<?php

function getLoggedUserId() {
  session_start();
  return $_SESSION['user_id'];
}

function getEventCategoriesArray() {
  return array('sport', 'theatre', 'public', 'concert', 'others');
}

/** Check if the user is logged on protected page, if not, redirect to login page */
function requireLogin() {
  session_start();

  if (!isset($_SESSION['access_token'])) {
    header('Location: login.php');
    exit();
  }
}
