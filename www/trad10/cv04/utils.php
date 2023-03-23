<?php 
    define('DELIMITER', ';');
    define('DB_FILE_USERS', dirname(__FILE__) . '/users.db');

    $xname = 'trad10';
    $sender = $xname . '@vse.cz';
    $loginPageUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/~' . $xname . '/login.php';
    $emailTemplates = [
        'headers' => [
            'MIME-Version: 1.0',
            'Content-type: text/html; charset=utf-8',
            'From: ' . $sender,
            'Reply-To: ' . $sender,
            'X-Mailer: PHP/'.phpversion()
        ],
        'Registration confirmation' => function ($recipient, $loginPageUrl) {
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
        global $loginPageUrl;
        $headers = implode("\r\n", $emailTemplates['headers']);
        $message = $emailTemplates[$subject]($recipient, $loginPageUrl);
        return mail($recipient, $subject, $message, $headers);
    };

    function fetchUsers(){
        $users = [];
        $file = fopen(DB_FILE_USERS, 'r');
        while(!feof($file)){
            $line = fgets($file);
            $user = explode(DELIMITER, $line);
            if(count($user) > 1){
                $users[$user[1]] = [
                    'name' => $user[0],
                    'email' => $user[1],
                    'password' => $user[2]
                ];
            }
        }

        fclose($file);
        return $users;
    }

    function fetchUser($email){
        $file = fopen(DB_FILE_USERS, 'r');
        while(!feof($file)){
            $line = fgets($file);
            $user = explode(DELIMITER, $line);
            if($user[1] === $email){
                fclose($file);
                return [
                    'name' => $user[0],
                    'email' => $user[1],
                    'password' => $user[2]
                ];
            }
        }

        return null;
    }

    function registerNewUser($payload){
        $userInDb = fetchUser($payload['email']);
        if($userInDb){
            return ['success' => false, 'msg' => 'Email already registered. Please use another email address.'];
        }

        $userRecord = 
            $payload['name'] . DELIMITER . 
            $payload['email'] . DELIMITER . 
            $payload['password'];

        file_put_contents(DB_FILE_USERS, PHP_EOL. $userRecord, FILE_APPEND);
        return ['success' => true, 'msg' => 'Registration successful.'];
    }

    function authenticate($email, $password){
        $userInDb = fetchUser($email);
        if(!$userInDb){
            return ['success' => false, 'msg' => 'Email not registered. Please register first.'];
        }

        if($userInDb['password'] !== $password){
            return ['success' => false, 'msg' => 'Password is incorrect.'];
        }

        return ['success' => true, 'msg' => 'Authentication successful.'];
    }

    function getInputValidClass($key, $errors) {
        return array_key_exists($key, $errors) ? ' is-invalid' : '';
    };
?>