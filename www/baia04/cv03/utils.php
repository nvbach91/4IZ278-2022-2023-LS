<?php 

class Utils {
    function chars($symbols) {
        return htmlspecialchars(trim($symbols));
    }
    
    function getNameSurname(string $nameSurname) {
        return explode(" ", $nameSurname);
    }

    function validate(string $name, string $sex, string $email, string $phone, string $url) {
        $nameSurname = explode(" ", $name);
        $errs = array();

        if (count($nameSurname) != 2) { array_push($errs, 0); }
        if (!in_array($sex, ['Male', 'Female'])) { array_push($errs, 1); }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { array_push($errs, 2); }
        if (!preg_match('/^(\+\d{3} ?)?(\d{3} ?){3}$/', $phone)) { array_push($errs, 3); }
        if (!filter_var($url, FILTER_VALIDATE_URL)) { array_push($errs, 4); }

        return $errs;
    }
}
?>