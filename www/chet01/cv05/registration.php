<?php
include './utils.php';

$name = isset($_POST['name']) ? $_POST['name'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$phone = isset($_POST['phone']) ? $_POST['phone'] : '';
$photo = isset($_POST['photo']) ? $_POST['photo'] : '';

$nameErr = '';
$emailErr = '';
$phoneErr = '';
$photoErr = '';
$passwordErr = '';

$success = '';
$dbPath = './users.db';

if (!empty($_POST)) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $photo = $_POST['photo'];
    if (empty($name)) {
        $nameErr = 'Vyplňte jméno';
    }
    if (empty($password)) {
        $passwordErr = 'Vyplňte heslo';
    }
    if (empty($email)) {
        $emailErr = 'Vyplňte email';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = 'Zadaný email má neplatný formát';
    }

    if (empty($phone)) {
        $phoneErr = 'Vyplňte tel. číslo';
    } elseif (!preg_match('/[+]?\d*/', $phone)) {
        $phoneErr = 'Zadané tel. číslo má neplatný formát';
    }
    if (empty($photo)) {
        $photoErr = 'Vyplňte url fotky';
    }
    if ($nameErr == '' && $emailErr == '' && $phoneErr == '' && $photoErr == '' && $passwordErr == '') {
        $existingUser = getUser($email);
        if ($existingUser === null) {
            $success = 'Registrace proběhla úspešně';
            $userData = "$name;$email;$password;$phone;$photo" . PHP_EOL;
            file_put_contents($dbPath, $userData, FILE_APPEND);
            header('Location: login.php');
        } else {
            $emailErr = 'Email jiz existuje';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form class="form-signup" method="POST" action="./registration.php">
        <div class="form-group">
            <label>Name*</label>
            <input class="form-control" name="name" value="<?php echo $name ?>">
            <span class="error"><?= $nameErr; ?></span>
        </div>
        <div class="form-group">
            <label>Email*</label>
            <input class="form-control" name="email" value="<?php echo $email ?>">
            <span class="error"><?= $emailErr; ?></span>
        </div>
        <div class="form-group">
            <label>Password*</label>
            <input class="form-control" name="password" value="<?php echo $password ?>">
            <span class="error"><?= $passwordErr; ?></span>
        </div>
        <div class="form-group">
            <label>Phone*</label>
            <input class="form-control" name="phone" value="<?php echo $phone ?>">
            <span class="error"><?= $phoneErr; ?></span>
        </div>
        <div class="form-group">
            <label>Avatar URL*</label>
            <input class="form-control" name="photo" value="<?php echo $photo ?>">
            <span class="error"><?= $photoErr; ?></span>
        </div>
        <p class="success"><?= $success; ?></p>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>
</body>

</html>