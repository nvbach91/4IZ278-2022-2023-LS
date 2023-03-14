<?php
require_once "./utils.php";

$errors = [];

// Check if form is submitted
if (!empty($_POST)) {
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));

    // Check for bad email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        array_push($errors, 'Email is not valid');

    $user = fetchUser($email);

    if (!$user)
        array_push($errors, "User with email $email doesn't exists. Please, <a href=\"./\">register</a>.");

    if ($user && !password_verify($password, $user['pass_hash']))
        array_push($errors, "Password is incorrect.");
}
?>
<div class="container">
    <div class="form-wrapper">
        <h1>Login</h1>

        <form action="./login.php" method="POST">
            <?php if (isset($_GET['afterReg']) && (int) $_GET['afterReg']): ?>
                <div class="message success">Register is successful! You can now login.</div>
            <?php endif; ?>
            <?php if (!empty($errors)): ?>
                <div class="message error">
                    <ul>
                        <?php foreach($errors as $error): ?>
                            <li><?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php elseif (!empty($_POST)): ?>
                <div class="message success">Login is successful! <a href="./admin/users.php">List of registered users</a></div>
            <?php endif; ?>

            <div class="field">
                <label for="email">E-mail</label>
                <input type="text" name="email" id="email" value="<?php echo $email ?? ''; ?>">
            </div>
            <div class="field">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" value="<?php echo $password ?? ''; ?>">
            </div>
            <button type="submit">Sign ip</button> or <a href="./index.php">register</a>
        </form>
    </div>
</div>