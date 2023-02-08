<?php 

require __DIR__ . '/../config/config.php';

function sendEmail($recipient, $subject) {
    // access variables from outside using keyword global
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
        if (!$line) continue; // skip blank lines
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
        if (!$line) continue; // skip blank lines
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
    //echo $userRecord;
    file_put_contents(DB_FILE_USERS, $userRecord, FILE_APPEND);
    return ['success' => true, 'msg' => 'Registration was successful'];
};

function generateRandomPassword($length) {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%^&*()_-+=';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < $length; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
};

function authenticate($email, $password) {
    $user = fetchUser($email);
    if (!$user) {
        return ['success' => false, 'msg' => 'This account does not exist'];
    }
    //var_dump($user);
    //echo '***' . $password . '***<br>';
    //echo '***' . $user['password'] . '***<br>';
    //echo $password === $user['password'] ? 'TRUE' : 'FALSE';
    if ($user['password'] !== $password) {
        return ['success' => false, 'msg' => 'Wrong password'];
    }
    return ['success' => true, 'msg' => 'Login success'];
};

function getInputValidClass($key, $errors) {
    return array_key_exists($key, $errors) ? ' is-invalid' : '';
};

?>
