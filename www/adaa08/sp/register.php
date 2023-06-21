<?php
session_start();

require_once 'classes/Database.php';
require_once 'classes/User.php';

$db = new Database();
$userObj = new User($db);

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $firstname = htmlspecialchars($_POST['first_name']);
    $lastname = htmlspecialchars($_POST['second_name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = 'user';

    if ($userObj->createUser($firstname, $lastname, $email, $phone, $role, $password)) {

        $to = $email;
        $subject = "Registrácia bola úspešná";
        $message = "Vážený " . $firstname . ",\n\nĎakujeme za registráciu na našej stránke.";
        $headers = "From: noreply@example.com" . "\r\n" .
            "Reply-To: noreply@example.com" . "\r\n" .
            "X-Mailer: PHP/" . phpversion();
        if(mail($to, $subject, $message, $headers)) {
            header("location: login.php");
        } else {
            echo "Email nemôže byť poslaný.";
        }
    } else {
        echo "Niečo nefungovalo, skúste to prosím neskôr.";
    }
}

?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <title>Register</title>
    <?php include 'meta.php'; ?>
</head>
<body>

<?php include 'header.php';?>

<form method="POST">
    <label for="first_name">Meno:</label>
    <input type="text" id="first_name" name="first_name" required>

    <label for="second_name">Priezvisko:</label>
    <input type="text" id="second_name" name="second_name" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" required>

    <label for="phone">Tel.č.:</label>
    <input type="text" id="phone" name="phone" pattern="[0-9+]+" required>

    <label for="password">Heslo:</label>
    <input type="password" id="password" name="password" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" required>
    <small>Heslo by malo obsahovať 8 znakov, jedno písmeno a jedno číslo.</small>

    <input type="submit" value="Register">
</form>


    <?php include 'footer.php';?>
</body>
</html>
