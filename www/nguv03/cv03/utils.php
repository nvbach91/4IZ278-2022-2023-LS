<?php 
// create an object with key value pairs
$xname = 'nguv03';
$sender = $xname . '@vse.cz';
$loginPageUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/~' . $xname . '/login.php';

// associative array to keep templates
$emailTemplates = [
    'headers' => [
        'MIME-Version: 1.0',
        'Content-type: text/html; charset=utf-8',
        'From: ' . $sender,
        'Reply-To: ' . $sender,
        'X-Mailer: PHP/'.phpversion()
    ],
    'Registration confirmation' => function ($recipient) {
        return ("
            <h2>Registration confirmation</h2>
            <p>Thank you for signing up!</p>
            <h4>You registered email:</h4>
            <p><a href='mailto:$recipient'>$recipient</a></p>
            <p>You can now sign in here: <a href='$loginPageUrl'>$loginPageUrl</a></p>
        ");
    },
];

function sendEmail($recipient, $subject) {
    // access variables from outside using keyword global
    global $emailTemplates;
    $headers = implode('\r\n', $emailTemplates['headers']);
    $message = $emailTemplates[$subject]($recipient);
    return mail($recipient, $subject, $message, $headers);
};

?>