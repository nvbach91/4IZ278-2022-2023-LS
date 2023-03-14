<?php

require_once "./utils.php";

$errors = [];

// Check if form is submitted
if (!empty($_POST)) {
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $gender = htmlspecialchars(trim($_POST['gender']));
    $password = htmlspecialchars(trim($_POST['password']));

    // Check for bad email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        array_push($errors, 'Email is not valid');

    // Check for bad phone
    if (strpos($phone, '+') !== 0)
        array_push($errors, 'Phone does not have leading + sign');

    if (strlen($phone) != 13)
        array_push($errors, 'Phone does not have 12 numbers');

    // Check for gender
    if (!preg_match('/^[FMO]$/', $gender))
        array_push($errors, 'Gender is not valid');

    $user = fetchUser($email);

    if ($user)
        array_push($errors, "User with email $email already exists.");

    // insert data to DB
    // only after all successful validations
    if (empty($errors)) {
        if (registerNewUser($email, $phone, $password, $gender)) {
            header("Location: ./login.php?afterReg=1");
            exit;
        }
    }
}
?>
<div class="container">
    <div class="form-wrapper">
        <h1>Registration</h1>

        <form action="." method="POST">

            <?php if (!empty($errors)): ?>
                <div class="message error">
                    <ul>
                        <?php foreach($errors as $error): ?>
                            <li><?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php elseif (!empty($_POST)): ?>
                <div class="message success">Form submitted successfully</div>
            <?php endif; ?>
            <div class="field">
                <label for="email">E-mail</label>
                <input type="text" name="email" id="email" value="<?php echo $email ?? ''; ?>">
            </div>
            <div class="field">
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" value="<?php echo $phone ?? '+420'; ?>">
            </div>
            <div class="field">
                <label for="gender">Gender</label>
                <select name="gender" id="gender">
                    <option <?php echo (isset($gender) && $gender === 'M') ? 'selected' : ''; ?> value="M">Male</option>
                    <option <?php echo (isset($gender) && $gender === 'F') ? 'selected' : ''; ?> value="F">Female</option>
                    <option <?php echo (isset($gender) && $gender === 'O') ? 'selected' : ''; ?> value="O">Other</option>
                </select>
            </div>
            <div class="field">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" value="<?php echo $password ?? ''; ?>">
            </div>
            <button type="submit">Sign up</button> or <a href="./login.php">login</a>
        </form>
    </div>
</div>