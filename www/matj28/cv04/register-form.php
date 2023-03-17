<?php include './includes/header.php' ?>
<?php include './includes/footer.php' ?>
<?php require './classes/utils.php' ?>
<?php
error_reporting(E_ERROR | E_PARSE);
$errors = [];
$subject = "Uspesna registrace";


if (!empty($_POST)) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $comPassword = trim($_POST['comPassword']);


    if ($name == '') {
        $message = 'Your name is reqired.';
        array_push($errors, $message);
    }
    if ($email == '') {
        $message = 'Email is required.';
        array_push($errors, $message);
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Email is not valid';
        array_push($errors, $message);
    } elseif (userExist($email)){
        $message = 'This email is already registered';
        array_push($errors, $message);
    }
    if ($password == '') {
        $message = 'Password is reqired.';
        array_push($errors, $message);
    }
    if ($comPassword != $password) {
        $message = 'Passwords do NOT match';
        array_push($errors, $message);
    }

} else {
    $message = 'Please fill the form.';
    array_push($errors, $message);
}


if (empty($errors)){
    $record = "$email;$name;$password" . PHP_EOL;
    file_put_contents(USERS_FILE_PATH,$record,8);
    //mail the success
    $message =  "Ahoj " . $name .",". PHP_EOL .
                "Prave jste se uspesne zaregistrovali na webu Lepsi Nez ISIC" . PHP_EOL .
                "Díky!" . PHP_EOL . PHP_EOL .
                "S pozdravem" . PHP_EOL .
                "Team Lespi nez ISIC";
    mail($email,$subject,$message);
    //redirect to login page
    header('Location: login.php?email=' . $email ."&afterLogin=true");
    exit;
}

?>
<h1>Register here</h1>
<?php if (!empty($errors)) : ?>
    <div>
        <?php foreach ($errors as $error) : ?>
            <p><?php echo $error; ?></p>
        <?php endforeach; ?>
    </div>
<?php else : ?>
    <div>
        <p>
            Registration successful!
        </p>
    </div>
<?php endif; ?>

<form class="person" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <div>
        <div>
            <div>
                <label for="name">Name*</label>
                <input id="name" class="form-control" name="name" placeholder="Name" value="<?php echo isset($name) ? $name : ""; ?>">
            </div>
            <div>
                <label for"email">Email*</label>
                <input id="email" class="form-control" name="email" placeholder="E-mail" value="<?php echo isset($email) ? $email : ""; ?>">
            </div>
            <div>
                <label for="password">Password*</label>
                <input id="password" class="form-control" name="password" placeholder="Password" value="<?php echo isset($password) ? $password : ""; ?>">
            </div>
            <div>
                <label for="password">Confirm Password*</label>
                <input id="comPassword" class="form-control" name="comPassword" placeholder="comPassword" value="<?php echo isset($comPassword) ? $comPassword : ""; ?>">
            </div>
        </div>
    </div>
    <div>
        <div>
            <input type="submit" />
        </div>
    </div>
    <div>
        <a href="login.php">Already registered?</a>
    </div>
</form>