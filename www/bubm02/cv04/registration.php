<?php require './utils.php' ?>
<?php

$errors = [];

$formIsSubmitted = !empty($_POST);
if ($formIsSubmitted) {
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $username = htmlspecialchars(trim($_POST['username']));
    $name = htmlspecialchars(trim($_POST['name']));
    $password = htmlspecialchars(trim($_POST['password']));
    $gender = htmlspecialchars(trim($_POST['gender']));
    $avatar = htmlspecialchars(trim($_POST['avatar']));

    if (!preg_match('/^[FMO]$/', $gender)) {
        $message = 'Invalid gender';
        array_push($errors, $message);
    }

    if ($name == '') {
        $message = 'Name is empty';
        array_push($errors, $message);
    }

    if ($password == '') {
        $message = 'Name is empty';
        array_push($errors, $message);
    }

    if ($username == '') {
        $message = 'Username is empty';
        array_push($errors, $message);
    }

    if ($email == '') {
        $message = 'Email is empty';
        array_push($errors, $message);
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Email is not valid';
        array_push($errors, $message);
    }

    if ($phone == '') {
        $message = 'Phone is empty';
        array_push($errors, $message);
    } elseif (!preg_match('/^\+\d{6,12}$/i', $phone)) {
        $message = 'Phone is not valid';
        array_push($errors, $message);
    }

    if (!filter_var($avatar, FILTER_VALIDATE_URL)) {
        $message = 'Avatar link is not valid';
        array_push($errors, $message);
        $avatar = null;
    }

    $existingUser = getUser($username);
    if ($existingUser != null) {
        array_push($errors, 'Existing user');
    }

    $user = new User(
        $email,
        $phone,
        $username,
        $name,
        hash("sha256", $password, false),
        $gender,
        $avatar
    );

    if (empty($errors)) {
        saveUser($user);
        header('Location: login.php?username=' . $user->username);
        exit;
    }
}
?>

<?php include './head.php' ?>
<form action="./registration.php" method="POST">
    <?php if (!empty($errors) && $formIsSubmitted) : ?>
        <div class="fail">
            <?php foreach ($errors as $error) : ?>
                <p><?php echo $error; ?></p>
            <?php endforeach ?>
        </div>
    <?php elseif ($formIsSubmitted) : ?>
        <div class="success">
            <p>Form submitted successfully</p>
        </div>
    <?php endif ?>

    <div class="fields">
        <div class="form-container">
            <div>
                <label>Full name</label>
                <input name="name" value="<?php echo isset($name) ? $name : "" ?> " />
            </div>
            <div>
                <label>Username</label>
                <input name="username" value="<?php echo isset($username) ? $username : "" ?>" />
            </div>
            <div>
                <label>Password</label>
                <input name="password" type="password" value="<?php echo isset($password) ? $password : "" ?>" />
            </div>
            <div>
                <label>Gender</label>
                <select name="gender">
                    <option value="F" <?php echo isset($gender) && $gender == 'F' ? ' selected' : '' ?>> Female</option>
                    <option value="M" <?php echo isset($gender) && $gender == 'M' ? ' selected' : '' ?>> Male</option>
                    <option value="O" <?php echo isset($gender) && $gender == 'O' ? ' selected' : '' ?>> Others</option>
                </select>
            </div>
            <div>
                <label>E-mail</label>
                <input name="email" type="email" value="<?php echo isset($email) ? $email : "" ?> " />
            </div>
            <div>
                <label>Phone</label>
                <input name="phone" value="<?php echo isset($phone) ? $phone : "" ?>" />
            </div>
            <div>
                <label>Avatar link</label>
                <input name="avatar" value="<?php echo isset($avatar) ? $avatar : "" ?>" />
            </div>
            <div class="button-container">
                <button class="button-green">Register</button>
                <a href="./login.php" class="button-blue">Login</a>
            </div>
        </div>

        <div class="avatar-container">
            <?php if (isset($avatar)) : ?>
                <img src="<?php echo $avatar ?>" alt="Avatar" />
            <?php endif ?>
        </div>
    </div>
</form>
<?php include './foot.php' ?>