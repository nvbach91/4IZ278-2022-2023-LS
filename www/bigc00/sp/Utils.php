<?php
require_once('../database/UsersDB.php');
require_once('../database/AccountsDB.php');
class Utils
{
    private UsersDB $userDB;
    private AccountsDB $accountDB;

    public function __construct()
    {
        $this->userDB = new UsersDB();
        $this->accountDB = new AccountsDB();
    }

    public function validate(array $userInfo)
    {
        $errors = [];

        if ($this->userDB->isUserExistsByEmail($userInfo['email'])) {
            $errors['exists'] = "User already exists. Go to Login";
            return $errors;
        }

        if (!$userInfo['name']) {
            $errors['name'] = "Please input name";
        }
        if (!$userInfo['surname']) {
            $errors['surname'] = "Please input surname";
        }
        if (!$userInfo['email']) {
            $errors['email'] = "Please input email";
        } else if (!filter_var($userInfo['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Please input correct email";
        }
        $phone = $userInfo['phone'];
        if (!$phone) {
            $errors['phone'] = "Please input phone";
        } else if (!is_numeric($phone)) {
            $errors['phone'] = "Please input correct phone";
        }
        $password = $userInfo['password'];
        if (!$password) {
            $errors['password'] = "Please input password";
        } else if (strlen($password) <= 8) {
            $errors['password'] = "Password Must Contain At Least 8 Characters!";
        } else if (!preg_match("#[0-9]+#", $password)) {
            $errors['password'] = "Password Must Contain At Least 1 Number!";
        } else if (!preg_match("#[A-Z]+#", $password)) {
            $errors['password'] = "Password Must Contain At Least 1 Capital Letter!";
        } else if (!preg_match("#[a-z]+#", $password)) {
            $errors['password'] = "Password Must Contain At Least 1 Lowercase Letter!";
        } else if ($password != $userInfo['confirm']) {
            $errors['password'] = "Password don't match";
        }
        if (!$userInfo['agreement']) {
            $errors['agreement'] = "Please accept user rules";
        }

        if (!count($errors)) {
            $this->userDB->addUser($userInfo);
        }

        return $errors;
    }

    public function checkLogin(array $info)
    {
        $user = $this->userDB->isUserExistsByEmail($info['email']);
        if (!$user) {
            return 'User is not found';
        } else if (!password_verify($info['password'], $user['password'])) {
            return 'Password is not correct';
        }
        session_start();
        $_SESSION['user'] = $user['user_id'];
        header('Location: ../includes/accounts.php');
        exit();
    }

    public function generateNumber()
    {
        $number = rand(10000000, 99999999);
        if ($this->accountDB->isAccountExists($number)) {
            $this->generateNumber();
        }
        return $number;
    }

    public function validatePayment()
    {
        $errors = [];
        $senderID = $_POST['sender'];
        $recipientStr = htmlspecialchars(trim($_POST['recipient']));
        $recipientID = str_contains($recipientStr, "/") ? substr($recipientStr, 0, 8) : $recipientStr;
        $amount = htmlspecialchars(trim($_POST['number']));

        if (!$recipientID) {
            $errors['recipient'] = 'Please input recipient';
        } else if (!$this->accountDB->isAccountExists($recipientID)) {
            $errors['recipient'] = "Recipient doesn't exist";
        } else if ($senderID == $recipientID) {
            $errors['recipient'] = "You may not send money to yourself";
        }

        if (!$amount) {
            $errors['amount'] = 'Please input amount';
        } else if ($amount <= 0) {
            $errors['amount'] = 'Amount must be more than 0';
        } else if ($this->accountDB->getMoney($senderID) < $amount) {
            $errors['amount'] = "You don't have enough money";
        }
        return $errors;
    }

    public function validateChanging()
    {
        $errors = [];
        $accountID = htmlspecialchars(trim($_POST['accountID']));
        $amount = htmlspecialchars(trim($_POST['amount']));
        $ownerID = htmlspecialchars(trim($_POST['owner']));

        if (!$accountID) {
            $errors['accountID'] = 'Input an account ID';
        } else if (!$this->accountDB->isAccountExists($accountID)) {
            $errors['accountID'] = "Account doesn't exist";
        }
        if ($amount < 0) {
            $errors['amount'] = 'Money amount must be more than 0';
        }

        if (!$ownerID) {
            $errors['owner'] = 'Input owner id';
        } else if (!$this->userDB->isUserExistsByID($ownerID)) {
            $errors['owner'] = "User doesn't exist";
        }
        return $errors;
    }
}
