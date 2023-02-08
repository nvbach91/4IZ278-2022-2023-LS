<?php require __DIR__ . '/vendor/autoload.php'; ?>

<?php

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$logger = new Logger('MY LOGGER');
$handler = new StreamHandler('log.txt', Logger::WARNING);
$logger->pushHandler($handler);

$logger->warning('warning this one');
$logger->error('error two');




?>