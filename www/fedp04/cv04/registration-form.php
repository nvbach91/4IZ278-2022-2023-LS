<?php require './utils.php'; ?>
<?php include './head.php'?>


<?php

$errors = [];

$formSubmitted = !empty($_POST);



if ($formSubmitted) {
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $nickname = htmlspecialchars(trim($_POST['nickname']));
    $password = htmlspecialchars(trim($_POST['password']));
    $gender = htmlspecialchars(trim($_POST['gender']));
    $photo = htmlspecialchars($_POST['photo']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Email is not valid';
        array_push($errors, $message);
    }

    if (!preg_match("/^[FM]$/", $gender)) {
        $message = 'Invalid gender';
        array_push($errors, $message);
    }

    if ($email == '') {
        $message = 'Email is empty';
        array_push($errors, $message);
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Invalid email adress';
        array_push($errors, $message);
    }
    if ($phone == '') {
        $message = 'Phone is empty';
        array_push($errors, $message);
    }



    if ($nickname == '') {
        $message = 'Nickname is empty';
        array_push($errors, $message);
    }
    if ($password == '') {
        $message = 'Password is empty';
        array_push($errors, $message);
    }
    if (strlen($password <10 )) {
        $message = 'Passwordmust have atleast 10 symbols ';
        array_push($errors, $message);
    }

    if (strlen($phone) != 9) {
        $message = 'Phone does not have 9 numbers';
        array_push($errors, $message);
    }

    if (!filter_var($photo, FILTER_VALIDATE_URL)) {
        $message = 'Invalid photo';
        array_push($errors, $message);
    }

    $existingUser = getUser($nickname);
    if ($existingUser != null) {
        array_push($errors, 'Existing user');
    }

    if (empty($errors)) {

        $fileDatabasePath = './database.db';
        $userRecord = "$email;$phone;$nickname;$password;$gender" . PHP_EOL;
        file_put_contents($fileDatabasePath, $userRecord, FILE_APPEND);
        header('Location: login.php');
        exit;
    }
}



?>



<form action="./registration-form.php" method="POST">
    <?php if (!empty($errors) && $formSubmitted) : ?>
        <div>
            <?php foreach ($errors as $error) : ?>
                <p>
                    <?php echo $error; ?>
                </p>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <div>
            Form submitted successfully
        </div>
    <?php endif; ?>

    <form>

        <div>
            <label>Gender</label>
            <select name="gender">
                <option value="F">Female</option>
                <option value="M">Male</option>
            </select>
        </div>

        <div>
            <label>Email</label>
            <input name="email" type="email" value="<?php if (isset($email)) echo $email ?>">
        </div>


        <div>
            <label>Phone</label>
            <input name="phone" type="tel" value="<?php if (isset($phone)) echo $phone ?>">
        </div>

        <div>
            <label>Nickname</label>
            <input name="nickname" value="<?php if (isset($nickname)) echo $nickname ?>">
        </div>

        <div>
            <label>Password</label>
            <input name="password" type="password" value="<?php if (isset($password)) echo $password ?>">
        </div>

        <div>
            <label>Photo</label>
            <input name="photo" type="url" value="<?php if (isset($photo)) echo $photo ?>">
        </div>


        <div class="photo-container">
            <?php if (isset($photo)) : ?>
                <img src="<?php echo $photo ?>">

            <?php endif; ?>


            <button>Submit</button>

    </form>
    <?php include './tail.php'; ?>