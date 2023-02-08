<?php

$sender = 'nguv03@vse.cz';
$htmlFirstPart = '
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Awesome.com</title>
</head>
<body>';

$htmlSecondPart = '
</body>
</html>';
$templates = [
    'headers' => [
        'MIME-Version: 1.0',
        'Content-type: text/html; charset=utf-8',
        'From: ' . $sender,
        'Reply-To: ' . $sender,
        'X-Mailer: PHP/' . phpversion()
    ],
    'registrationConfirmation' => function ($recipient) {
        global $sender;
        global $htmlFirstPart;
        global $htmlSecondPart;
        return (
            $htmlFirstPart .
            '<h2>Registration confirmation</h2>
            <p>Thank you for signing up!</p>
            <h4>You registered email:</h4>
            <p><a href="mailto:' . $recipient. '">' . $recipient . '</a></p>
            <p>You can now sign in here: <a href="https://eso.vse.cz/~nguv03/">https://eso.vse.cz/~nguv03/</a></p>
            <hr>
            <p>If you need help, please contact <a href="mailto:' . $sender . '">' . $sender. '</a></p>' .
            $htmlSecondPart
        );
    },
];

function sendEmail($args) {
    global $templates;
    $headers = implode('\r\n', $templates['headers']);
    $message = $templates[$args['subject']]($args['to']);
    return mail(
        $args['to'], 
        $args['subject'], 
        $message, 
        $headers
    );
};

$sendStatus = sendEmail([
    'to' => 'nguv03@vse.cz', 
    'subject' => 'registrationConfirmation'
]);

echo '<h1>' . $sendStatus. '</h1>';

/*
define('ADRESA', 'nguv03@vse.cz');
$prijemce = ADRESA;
$predmet  = 'Ukázkový e-mail z PHP';
$zprava   = '<h2>Obsah ukázkového e-mailu</h2>';
$hlavicky = [
    'MIME-Version: 1.0',
    'Content-type: text/plain; charset=utf-8',
    'From: '.ADRESA,
    'Reply-To: '.ADRESA,
    'X-Mailer: PHP/'.phpversion()
];
$hlavicky = implode("\r\n", $hlavicky);//co dělá funkce implode?
if (mail($prijemce, $predmet, $zprava, $hlavicky)){
    echo 'E-mail byl odeslán.';
}else{
    echo 'E-mail nebyl odeslán.';
}*/