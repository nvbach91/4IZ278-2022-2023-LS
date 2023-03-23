<?php 

define('DELIMITER', ';');

define('DB_FILE_USERS', dirname(__FILE__) . '/../database/users.db');


define('SERVER_USER_NAME', 'jezf00');

$sender = SERVER_USER_NAME . '@vse.cz';

define('PAGE_LOGIN', './login.php');


$emailTemplates = [
    'headers' => [
        'MIME-Version: 1.0',
        'Content-type: text/html; charset=utf-8',
        'From: ' . $sender,
        'Reply-To: ' . $sender,
        'X-Mailer: PHP/'.phpversion()
    ],
    'Registration confirmation' => function ($recipient) {
        return (
            "<h2>Registration confirmation</h2>" .
            "<p>Thank you for signing up!</p>" .
            "<h4>You registered email:</h4>" .
            "<p><a href='mailto:$recipient'>$recipient</a></p>"

        );
    },
];

function sendEmail($recipient, $subject) {

    global $emailTemplates;
    $headers = implode("\r\n", $emailTemplates['headers']);
    $message = $emailTemplates[$subject]($recipient);
    return mail($recipient, $subject, $message, $headers);
};

function fetchUsers() {
    $users = [];
    $lines = file(DB_FILE_USERS);
    foreach ($lines as $line) {
        $line = trim($line);
        if (!$line) continue;
        $fields = explode(DELIMITER, $line);
        $users[$fields[1]] = [
            'name' => $fields[0],
            'email' => $fields[1],
            'password' => $fields[2],
        ];
    }
    return $users;
};

function fetchUser($email) {
    $lines = file(DB_FILE_USERS);
    foreach ($lines as $line) {
        $line = trim($line);
        if (!$line) continue; 
        $fields = explode(DELIMITER, $line);
        if ($fields[1] === $email) {
            return [
                'name' => $fields[0],
                'email' => $fields[1],
                'password' => $fields[2],
            ];
        }
    }
    return null;
};

function registerNewUser($payload) {
    $users = fetchUsers();
    if (array_key_exists($payload['email'], $users)) {
        return ['success' => false, 'msg' => 'Email already registered. Please use another email address.'];
    }
    $userRecord = 
        $payload['name'] . DELIMITER .
        $payload['email'] . DELIMITER .
        $payload['password'] . "\r\n";

    file_put_contents(DB_FILE_USERS, $userRecord, FILE_APPEND);
    return ['success' => true, 'msg' => 'Registration was successful'];
};

function authenticate($email, $password) {
    $user = fetchUser($email);
    if (!$user) {
        return ['success' => false, 'msg' => 'This account does not exist'];
    }

    if ($user['password'] !== $password) {
        return ['success' => false, 'msg' => 'Wrong password'];
    }
    return ['success' => true, 'msg' => 'Login success'];
};

function getInputValidClass($key, $errors) {
    return array_key_exists($key, $errors) ? ' is-invalid' : '';
};

?>
