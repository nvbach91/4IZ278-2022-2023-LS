<?php

$sender = 'vlcj07@vse.cz';
$htmlFirstPart = '
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Fruitopia.com</title>
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
        return ($htmlFirstPart .
            '<h2>Potvrzení registrace</h2>
            <p>Děkujeme za registraci!</p>
            <h4>Přihlašovací email:</h4>
            <p><a href="mailto:' . $recipient . '">' . $recipient . '</a></p>
            <p>Nyní se můžete přihlásit <a href="https://esotemp.vse.cz/~vlcj07/sp/">zde</a>.</p>
            <hr>
            <p>Pokud máte nějaký problém nebo dotaz, neváhejte se na nás obrátit na adrese <a href="mailto:' . $sender . '">' . $sender . '</a></p>' .
            $htmlSecondPart
        );
    },
    'orderConfirmation' => function ($recipient) {
        global $sender;
        global $htmlFirstPart;
        global $htmlSecondPart;
        return ($htmlFirstPart .
            '<h2>Potvrzení objednávky</h2>
            <p>Děkujeme za objednávku!</p>
            <p>Nyní se můžete podívat na detaily objednávky na svém profilu na našich stránkách <a href="https://esotemp.vse.cz/~vlcj07/sp/">zde</a>.</p>
            <hr>
            <p>Pokud máte nějaký problém nebo dotaz, neváhejte se na nás obrátit na adrese <a href="mailto:' . $sender . '">' . $sender . '</a></p>' .
            $htmlSecondPart
        );
    }
];

function sendEmail($recipient, $subject)
{
    global $templates;
    $headers = implode("\r\n", $templates['headers']);
    $message = $templates[$subject]($recipient);
    return mail(
        $recipient,
        $subject,
        $message,
        $headers
    );
};
