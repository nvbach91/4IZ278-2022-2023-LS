<?php declare(strict_types=1);

$config = [
    'passiveMode' => true,
    'local' => '../../',
    'allowDelete' => true,
    'preprocess' => false,
    'deploymentFile' => '.deployment',
    'ignore' => '
        /.htaccess
        /www/.htaccess
        /config/local.neon
        /config/deploy/*
        /temp
        /log
        /composer.json
        /composer.lock
        /sql/*
    ',
];

$USERNAME = 'js-semestralka_incolorstudio.cz';
$PASSWORD = 'WvE7VV79SbjoX5lDzP1Z';
$URL = 'ftp.incolorstudio.cz';

$credentials = [
    'remote' => "ftp://$USERNAME:$PASSWORD@$URL/"
];

return array_merge($config, $credentials);
