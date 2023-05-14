<?php

require_once 'config.php';
require_once 'router.php';
require_once 'controllers/AuthController.php';
require_once 'models/User.php';
require_once 'models/Database.php';

// Vytvoření nové instance třídy Router
$router = new Router();

// Definování cest
$router->add('/', function() {
    // Zobrazí úvodní stránku
    require_once 'views/home.php';
});

$router->add('/login', function() {
    $controller = new AuthController();
    $controller->login();
});

$router->add('/register', function() {
    $controller = new AuthController();
    $controller->register();
});

// Spuštění směrovače
$router->run();
?>
