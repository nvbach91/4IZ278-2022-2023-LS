<?php

function getLoggedUserId() {
  session_start();
  return $_SESSION['user_id'];
}

function getEventCategoriesArray() {
  return array('sport', 'theatre', 'public', 'concert', 'others');
}