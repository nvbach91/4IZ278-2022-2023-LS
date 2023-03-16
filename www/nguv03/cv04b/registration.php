<?php require './utils.php'; ?>
<?php

// var_dump($_SERVER);
$errors = [];
// check if form is submitted
$formIsSubmitted = !empty($_POST);
if ($formIsSubmitted) {
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $gender = htmlspecialchars(trim($_POST['gender']));
    $password = htmlspecialchars(trim($_POST['password']));
    // $phone = htmlspecialchars(trim($_POST['phone']));
    // $phone = htmlspecialchars(trim($_POST['phone']));
    // $phone = htmlspecialchars(trim($_POST['phone']));

    // check the validity of string values
    // if ($email == '') {
    //     // tady je chyba
    //     $message = 'Email is empty';
    //     array_push($errors, $message);
    // }
    // check if email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Email is not valid (via FILTER)';
        array_push($errors, $message);
    }
    // if ($phone == '') {
    //     $message = 'Phone is empty';
    //     array_push($errors, $message);
    // }
    // if (strlen($phone) != 9) {
    //     $message = 'Phone is not valid, must have 9 characters';
    //     array_push($errors, $message);
    // }
    if (!preg_match('/^\d{9}$/', $phone)) {
        $message = 'Phone is not valid, must have 9 numbers';
        array_push($errors, $message);
    }
    // F M O
    // if ($gender != 'F' || $gender != 'M' || $gender != 'O') {
    // if (!preg_match('/^[FMO]$/', $phone)) {
    // if (!str_contains('FMO', $gender)) {
    if (!in_array($gender, ['F', 'M', 'O'])) {
        $message = 'Gender is not valid, must be F, M or O';
        array_push($errors, $message);
    }
    
    $existingUser = getUser($email);
    if ($existingUser != null) {
        array_push($errors, 'This email already exists');
    }

    
    if (empty($errors)) {
        // success;
        // save to database
        $record = "$email;$phone;$gender;$password" . PHP_EOL;
        file_put_contents(USERS_FILE_PATH, $record, FILE_APPEND);
        // redirect to login page
        header('Location: login.php?email=' . $email);
        exit;
    }
}

// ternarni operator
                                            // podminka ? pravdiva : nepravdiva;
?>
<?php include './head.php'; ?>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <?php if (empty($errors) && $formIsSubmitted): ?>
        <p>Thank you for your registration!</p>
    <?php endif; ?>

    <?php foreach($errors as $error): ?>
        <p><?php echo $error; ?></p>
    <?php endforeach; ?>

    <div>
        <label>Email</label>
        <input name="email" value="<?php echo isset($email) ? $email : ''; ?>">
    </div>
    <div>
        <label>Password</label>
        <input name="password" value="<?php echo isset($password) ? $password : ''; ?>">
    </div>
    <div>
        <label>Phone</label>
        <input name="phone" value="<?php echo isset($phone) ? $phone : ''; ?>">
    </div>
    <div>
        <label>Gender</label>
        <select name="gender">
            <option value="F"<?php echo isset($gender) && $gender == 'F' ? ' selected' : '' ?>>Female</option>
            <option value="M"<?php echo isset($gender) && $gender == 'M' ? ' selected' : '' ?>>Male</option>
            <option value="O"<?php echo isset($gender) && $gender == 'O' ? ' selected' : '' ?>>Others</option>
        </select>
    </div>
    <button>Submit</button>
</form>

<?php include './foot.php'; ?>