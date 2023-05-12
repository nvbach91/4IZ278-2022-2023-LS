<?php
require_once('../config/config.php');
class Form {
    private string $email;
    private string $phoneNumber;
    private string $firstName;
    private string $lastName;
    private string $dateOfBirth;
    private string $password;
    private string $passwordConfirmation;
    private bool $accept;

    // GETTERS
    public function getEmail() { return $this -> email; }
    public function getPhoneNumber() { return $this -> phoneNumber; }
    public function getFirstName() { return $this -> firstName; }
    public function getLastName() { return $this -> lastName; }
    public function getDateOfBirth() { return $this -> dateOfBirth; }
    public function getPassword() { return $this -> password; }
    public function getPasswordConfirmation() { return $this -> passwordConfirmation; }
    public function getAccept() { return $this -> accept; }

    // SETTERS
    public function setEmail(string $email) { 
        $this -> email = $email; 
    }
    public function setPhoneNumber(string $phoneNumber) { 
        $this -> phoneNumber = $phoneNumber; 
    }
    public function setFirstName(string $name) {
        $this -> firstName = $name;
    }
    public function setLastName(string $lastName) {
        $this -> lastName = $lastName;
    }
    public function setDateOfBirth(string $dateOfBirth) {
        $this -> dateOfBirth = $dateOfBirth;
    }
    public function setPassword (string $password) {
        $this -> password = $password;
    }
    public function setPasswordConfirm(string $passwordConfirm) {
        $this -> password = $passwordConfirm;
    }
    public function setAccept(bool $accept) {
        $this -> accept = $accept;
    }

    // METHODS
    public function __construct() {
        $form = [];
        foreach($_POST as $key => $value) {
            $form[$key] = htmlspecialchars(trim($value));
        }
        !isset($_POST['terms']) ? $form['terms'] = false : $form['terms'] = true;

        $this -> email = $form['e-mail'];
        $this -> firstName = $form['firstName'];
        $this -> lastName = $form['lastName'];
        $this -> dateOfBirth = $form['dateOfBirth'];
        $this -> password = $form['password'];
        $this -> passwordConfirmation = $form['passwordConfirmation'];
        $this -> accept = $form['terms'];

        $countryCodesStr = file('../config/countryCodes.php');
        $this -> phoneNumber = preg_replace($countryCodesStr, '', $_POST['phoneNumber']);
    }

    public function validate(array $messages, string $language) {
        $errors = [];
        
        $email = $this -> email;
        if (!$email) {
            $errors['email'] = $messages['emptyEmail'][$language];
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = $messages['incorrectEmail'][$language];
        }

        $phoneNumber = $this -> phoneNumber;
        if (!$phoneNumber) {
            $errors['phoneNumber'] = $messages['emptyPhoneNumber'][$language];
        } else if (!is_numeric($phoneNumber)) {
            $errors['phoneNumber'] = $messages['incorrectPhoneNumber'][$language];
        }

        if (!$this -> firstName) {
            $errors['firstName'] = $messages['emptyFirstName'][$language];
        }
        if (!$this -> lastName) {
            $errors['lastName'] = $messages['emptyLastName'][$language];
        }

        $dateOfBirth = $this -> dateOfBirth;
        if (!$dateOfBirth) {
            $errors['dateOfBirth'] = $messages['emptyDate'][$language];
        } else {
            $date = new DateTime($dateOfBirth);
            $now = new DateTime();
            $difference = date_diff($date, $now) -> y;
            if ($now <= $date) {
                $errors['dateOfBirth'] = $messages['incorrectDate'][$language];
            } else if ($difference < 14) {
                $errors['dateOfBirth'] = $messages['tooYoung'][$language];
            }
        }

        $password = $this -> password;
        if (!$password) {
            $errors['password'] = $messages['emptyPassword'][$language];
        } else if (strlen($password) < 8) {
            $errors['password'] = $messages['tooShortPassword'][$language];
        }

        $confirm = $this -> passwordConfirmation;
        if ($password !== $confirm) {
            $errors['passwordConfirmation'] = $messages['notMatch'][$language];
        }

        $accept = $this -> accept;
        if (!$accept) {
            $errors['terms'] = $messages['notAccepted'][$language];
        }
        return $errors;
    }

    public function toString() {
        $email = 'E-mail: ' . $this -> email;
        $phone = 'Phone Number: ' . $this -> phoneNumber;
        $name = 'FirstName: ' . $this -> firstName;
        $lastName = 'LastName: ' . $this -> lastName;
        $dateOfBirth = 'Date of birth: ' . $this -> dateOfBirth;
        $password = 'Password: ' . $this -> password;
        $passwordConfirmation = 'Password confirmation: ' . $this -> passwordConfirmation;
        $agreement = 'Tems of use: ' . $this -> accept;
        return (
            $email . DELIMITER . 
            $phone . DELIMITER . 
            $name . DELIMITER . 
            $lastName . DELIMITER . 
            $dateOfBirth . DELIMITER . 
            $password . DELIMITER .
            $passwordConfirmation . DELIMITER .
            $agreement . DELIMITER
        );
    }
}
?>