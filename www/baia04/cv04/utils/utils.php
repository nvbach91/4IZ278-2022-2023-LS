<?php 

require __DIR__ . '/../config/config.php';

class Utils {
    function chars($symbols) {
        return htmlspecialchars(trim($symbols));
    }
    
    function getNameSurname(string $nameSurname) {
        return explode(" ", $nameSurname);
    }

    function getData() {
        $data = [
            'email' => $this -> chars($_POST['email']),
            'pass1' => $this -> chars($_POST['password']),
        ];
        if (array_key_exists('name', $_POST)) {
            $data['fullname'] = $this -> chars($_POST['name']);
        }
        if (array_key_exists('name', $_POST)) { 
            $data['pass2'] = $this -> chars($_POST['passwordConfirmation']);
        }
        return $data;
    }

    function validateRegister(array $data) {
        $nameSurname = explode(" ", $data['fullname']);
        $errs = array();

        if (count($nameSurname) != 2) { array_push($errs, 0); }
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) { array_push($errs, 1); }
        if (strcmp($data['pass1'], $data['pass2']) !== 0) { array_push($errs, 2); }
        if (strlen($data['pass1']) < 8) { array_push($errs, 3); }

        return $errs;
    }

    function validateLogin(array $data) {
        $errs = array();
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) { array_push($errs, 1); }
        if (strlen($data['pass1']) < 8) { array_push($errs, 3); }
        return $errs;
    }

    function fetchUser($email) {
        $lines = file(DB_FILE_USERS);
        foreach($lines as $line) {
            $line = trim($line);
            if (!$line) continue;
            $fields = explode(DELIMITER, $line);
            if (!count($fields)) { return null; }
            if ($fields[1] === $email) {
                return [
                    'name' => $fields[0],
                    'email' => $fields[1],
                    'password' => $fields[2]
                ];
            }
        }
        return null;
    }

    function saveUser(string $name, string $email, string $password) {
        $infosString = $name. DELIMITER . $email . DELIMITER . $this -> getHash($password) . "\r\n";
        file_put_contents(DB_FILE_USERS, $infosString, FILE_APPEND);
    }

    function isUserExists($userEmail) {
        return ($this -> fetchUser($userEmail) === null ? false : true); 
    }

    function getHash(string $password) {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    function isPasswordCorrect(string $password, string $userEmail) {
        return password_verify(
            $password,
            $this -> fetchUser($userEmail)['password']
        );
    }


}
?>