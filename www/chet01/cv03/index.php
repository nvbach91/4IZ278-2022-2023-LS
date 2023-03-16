<?php
$name = isset($_POST['name']) ? $_POST['name'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$phone = isset($_POST['phone']) ? $_POST['phone'] : '';
$photo = isset($_POST['photo']) ? $_POST['photo'] : '';

$nameErr = '';
$emailErr = '';
$phoneErr = '';
$photoErr = '';

$success = '';

if (!empty($_POST)) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $photo = $_POST['photo'];
    if (empty($name)) {
        $nameErr = 'Vyplňte jméno';
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
    if ($nameErr == '' && $emailErr == '' && $phoneErr == '' && $photoErr == '') {
        $success = 'Registrace proběhla úspešně';
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
    <form class="form-signup" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="form-group">
            <label>Name*</label>
            <input class="form-control" name="name" value="<?php isset($name) ? $name : '' ?>">
            <span class="error"><?= $nameErr; ?></span>
        </div>
        <div class="form-group">
            <label>Email*</label>
            <input class="form-control" name="email" value="<?php isset($email) ? $email : '' ?>">
            <span class="error"><?= $emailErr; ?></span>
        </div>
        <div class="form-group">
            <label>Phone*</label>
            <input class="form-control" name="phone" value="<?php isset($phone) ? $email : '' ?>">
            <span class="error"><?= $phoneErr; ?></span>
        </div>
        <div class="form-group">
            <label>Avatar URL*</label>
            <input class="form-control" name="photo" value="<?php isset($photo) ? $photo : '' ?>">
            <span class="error"><?= $photoErr; ?></span>
        </div>
        <p class="success"><?= $success; ?></p>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>
</body>

</html>