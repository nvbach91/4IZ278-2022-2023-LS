<?php

require __DIR__ . '/vendor/autoload.php';
use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$log = new Logger('index.php');
$log->pushHandler(new StreamHandler('warning.log', Level::Warning));

$log->warning('warning'); // error, debug, info

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Composer tutorial</title>
</head>
<body>
    <h1>Composer tutorial</h1>
</body>
</html>