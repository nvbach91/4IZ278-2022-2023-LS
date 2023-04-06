<?php require 'utils.php' ?>

<?php

$errors = [];

$formIsSubmitted = !empty($_POST);
// check if form is submitted
if ($formIsSubmitted) {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));
    $repeatedPassword = htmlspecialchars(trim($_POST['repeat-password']));

    if ($name == '') {
        array_push($errors, 'Name is empty');
    }
    // check for bad email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Email is not valid';
        array_push($errors, $message);
    }


    if ($email == '') { $message = 'Email is empty'; array_push($errors, $message); }

    if ($password != $repeatedPassword) {
        array_push($errors, 'Passwords do not match');
    }
    if ($password == '' || $repeatedPassword == '') {
        array_push($errors, 'Password field is empty');
    }
    if (empty($errors)) {
        $registration = registerNewUser($name, $email, $password);

        if ($registration) {
            mail($email, "Registration", "Registration was successful");
            header('Location: login.php?email='.$email."&reg=".true);
            exit;
        }

        array_push($errors, 'This email already exists');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <div class="container">
        <h1 class="title">Registration</h1>
        <form method="POST" action=".">
            <?php if (!empty($errors)): ?>
                <div class="error-container">
                    <?php foreach($errors as $error): ?>
                        <p class="error-message"><?php echo $error; ?></p>
                    <?php endforeach; ?>
                </div>
            <?php elseif ($formIsSubmitted): ?>
                <div class="success-container">Form submitted successfully</div>
            <?php endif; ?>
            <div class="input-container">
                <div class="input-group">
                    <label class="label" for="name">Name</label>
                    <input class="input" type="text" name="name" id="name" value="<?php echo isset($name) ? $name : ''; ?>">
                </div>
                <div class="input-group">
                    <label class="label" for="email">E-mail</label>
                    <input class="input" type="email" name="email" id="email" value="<?php echo isset($email) ? $email : ''; ?>">
                </div>
                <div class="input-group">
                    <label class="label" for="password">Password</label>
                    <input class="input" type="password" name="password" id="password" value="<?php echo isset($password) ? $password : ''; ?>">
                </div>
                <div class="input-group">
                    <label class="label" for="repeat-password">Repeat password</label>
                    <input class="input" type="password" name="repeat-password" id="repeat-password" value="<?php echo isset($repeatedPassword) ? $repeatedPassword : ''; ?>">
                </div>
            </div>
            <button class="submit-button" type="submit">Submit</button>
        </form>
    </div>
</body>
</html>