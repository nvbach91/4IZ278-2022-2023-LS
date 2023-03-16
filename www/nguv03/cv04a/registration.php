<?php require './utils.php'; ?>
<?php

$errors = [];

$formIsSubmitted = !empty($_POST);
// check if form is submitted
if ($formIsSubmitted) {
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $gender = htmlspecialchars(trim($_POST['gender']));
    $password = htmlspecialchars(trim($_POST['password']));

    if (!preg_match('/^[FMO]$/', $gender)) {
        $message = 'Invalid gender';
        array_push($errors, $message);
    }

    // check for bad email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Email is not valid';
        array_push($errors, $message);
    }
    if ($email == '') { $message = 'Email is empty'; array_push($errors, $message); }
    if ($phone == '') { $message = 'Phone is empty'; array_push($errors, $message); }
    if (strlen($phone) != 9) {
        $message = 'Phone does not have 9 numbers';
        array_push($errors, $message);
    }
    
    $existingUser = getUser($email);
    if ($existingUser != null) {
        array_push($errors, 'Existing user');
    }
    if (empty($errors)) {
        // insert data to database
        // only after all successful validations
        // WINDOWS \r\n
        // LINUX \n
        // PHP_EOL
        $databaseFilePath = './database.db';
        $userRecord = "$email;$phone;$password;$gender" . PHP_EOL;
        file_put_contents($databaseFilePath, $userRecord, FILE_APPEND);

        // user registered, now what?
        header('Location: login.php');
        exit;
    }
}
?>
<?php include './head.php'; ?>
<form method="POST" action="./registration.php">
    <?php if (!empty($errors)): ?>
        <div>
            <?php foreach($errors as $error): ?>
                <p><?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
    <?php elseif ($formIsSubmitted): ?>
        <div>Form submitted successfully</div>
    <?php endif; ?>
    <div>
        <label>E-mail</label>
        <!-- <input name="email" value="<?php if (isset($email)) echo $email; ?>"> -->
        <input name="email" value="<?php echo isset($email) ? $email : ''; ?>">
    </div>
    <div>
        <label>Phone</label>
        <!-- <input name="phone" value="<?php if (isset($phone)) echo $phone; ?>"> -->
        <input name="phone" value="<?php echo isset($phone) ? $phone : ''; ?>">
    </div>
    <div>
        <label>Password</label>
        <!-- <input name="phone" value="<?php if (isset($password)) echo $password; ?>"> -->
        <input name="password" value="<?php echo isset($password) ? $password : ''; ?>">
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