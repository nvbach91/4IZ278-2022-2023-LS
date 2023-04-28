<?php

require __DIR__ . '/vendor/autoload.php';

use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;

$logger = new Logger('index.php');
$logger->pushHandler(new StreamHandler('logs.log'), Level::Warning);

// info, warning, error, debug

$logger->warning('This is a warning message');
$logger->error('This is a error message');
$logger->info('This is a info message');
$logger->debug('This is a debug message');
