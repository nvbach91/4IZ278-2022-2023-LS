<?php
include '../config.php';

session_start();

// clears any previously set session data
session_unset();

//destroy the current session
session_destroy();

header('location:../index.php');
