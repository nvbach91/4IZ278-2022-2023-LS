<?php

require __DIR__ . '/utils.php';


$avatarPlaceholder = "https://avataaars.io/?avatarStyle=Circle&topType=LongHairMiaWallace&accessoriesType=Round&hairColor=Brown&facialHairType=BeardMedium&facialHairColor=Brown&clotheType=ShirtVNeck&clotheColor=Blue03&eyeType=Default&eyebrowType=Angry&mouthType=Twinkle&skinColor=Tanned";

$errors = [];

if (!empty($_POST)) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $passwordCheck = trim($_POST['passwordCheck']);

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
    } elseif (getUser($email) != null) {
        $message = 'User already exists!';
        array_push($errors, $message);
    }

    if ($password == '') {
        $message = 'Please set your password.';
        array_push($errors, $message);
    } elseif (strlen($password) < 4) {
        $message = 'Password length must be at least 4.';
        array_push($errors, $message);
    }

    if ($passwordCheck != $password) {
        $message = 'Passwords are not the same.';
        array_push($errors, $message);
    }
} else {
    $message = 'Please fill the form.';
    array_push($errors, $message);
}

// Send to DB if no errors
if (empty($errors)) {
    $dbFilePath = './database.db';
    $userRecord = "$email;$name;$password" . PHP_EOL;
    file_put_contents($dbFilePath, $userRecord, FILE_APPEND);
    header("Location: login.php?email=$email");
    exit;
}

?>

<h1>Business card form with validation</h1>
<?php if (!empty($errors)) : ?>
    <div>
        <?php foreach ($errors as $error) : ?>
            <p><?php echo $error; ?></p>
        <?php endforeach; ?>
    </div>
<?php else : ?>
    <div>
        <p>
            Form submitted successfully
        </p>
    </div>
<?php endif; ?>

<form class="person" method="POST" action="." autocomplete="off">
    <div class="card">
        <img class="avatar" src="<?php echo (isset($avatar) && strlen($avatar) != 0) ? $avatar : $avatarPlaceholder ?>" alt="avatar" />
        <div class="data-wrapper">
            <div class="form-group">
                <label for="name">Name*</label>
                <input id="name" class="form-control" name="name" placeholder="Name" value="<?php echo isset($name) ? $name : ""; ?>">
            </div>
            <div class="form-group">
                <label for"email">Email*</label>
                <input id="email" class="form-control" name="email" placeholder="E-mail" value="<?php echo isset($email) ? $email : ""; ?>">
            </div>
        </div>
    </div>
    <div class="card">
        <img class="avatar" src="<?php echo $avatarPlaceholder ?>" alt="avatar" />
        <div class="data-wrapper">
            <div class="form-group">
                <label for="password">Password*</label>
                <input id="password" class="form-control" name="password" placeholder="****" type="password">
            </div>
            <div class="form-group">
                <label for="passwordCheck">Password check*</label>
                <input id="passwordCheck" class="form-control" name="passwordCheck" placeholder="Repeat password" type="password">
            </div>
            <input type="submit" />
        </div>
    </div>
</form>
