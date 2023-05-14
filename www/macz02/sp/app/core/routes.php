<?php
require_once '../controllers/AuthController.php';

$authController = new AuthController();

// Define routes
$router->get('/login', [$authController, 'showLogin']);
$router->post('/login', [$authController, 'login']);
$router->get('/register', [$authController, 'showRegistration']);
$router->post('/register', [$authController, 'register']);
?>