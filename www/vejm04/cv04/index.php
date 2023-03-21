<?php require './utils.php'; ?>
<?php

$errors = [];

$formIsSubmitted = !empty($_POST);
if ($formIsSubmitted) {
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $password = htmlspecialchars(trim($_POST['password']));

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
        $databaseFilePath = './database.db';
        $userRecord = "$email;$phone;$password" . PHP_EOL;
        file_put_contents($databaseFilePath, $userRecord, FILE_APPEND);

        header('Location: login.php');
        exit;
    }
}
?>
<?php include './head.php'; ?>
<form method="POST" action="./index.php">
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
    <button>Submit</button>
</form>
<?php include './foot.php'; ?>