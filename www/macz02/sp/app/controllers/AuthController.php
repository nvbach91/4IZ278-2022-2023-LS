<?php
require_once '../models/User.php';

class AuthController {
    public function showLogin() {
        require_once '../views/login.php';
    }

    public function login() {
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            User::login($username, $password);
        }
    }

    public function showRegistration() {
        require_once '../views/register.php';
    }

    public function register() {
        if (isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password'])) {
            $email = $_POST['email'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            User::register($email, $username, $password);
        }
    }
}
?>