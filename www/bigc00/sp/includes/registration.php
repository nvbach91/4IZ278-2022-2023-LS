<?php
require('../includes/header.php');
require('../Utils.php');
$submittedForm = !empty($_POST);
$errors = ['none'];
if ($submittedForm) {
    $utils = new Utils();
    $form = [
        'name' => htmlspecialchars(trim($_POST['name'])),
        'surname' => htmlspecialchars(trim($_POST['surname'])),
        'email' => htmlspecialchars(trim($_POST['email'])),
        'phone' => htmlspecialchars(trim($_POST['phone'])),
        'password' => htmlspecialchars(trim($_POST['password'])),
        'confirm' => htmlspecialchars(trim($_POST['confirm'])),
        'agreement' => isset($_POST['checkbox']) ? true : false,
    ];
    $errors = $utils->validate($form);
}
?>

<body>
    <main class='container'>
        <form class='blue-box' id='login' method='POST' action='../includes/registration.php'>
            <h2>Registration</h2>
            <a id='grey' href='../includes/registration.php'>Don't have an account? Create One</a>
            <div class='input-field'>
                <p>Name</p>
                <input type='text' class='input' name='name' placeholder="Input your name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>">
                <?php if (isset($errors['name'])) : ?>
                    <div class='error'>
                        <p><?php echo $errors['name']; ?></p>
                    </div>
                <?php endif; ?>
            </div>
            <div class='input-field'>
                <p>Surname</p>
                <input type='text' class='input' name='surname' placeholder="Input your surname" value="<?php echo isset($_POST['surname']) ? $_POST['surname'] : ''; ?>">
                <?php if (isset($errors['surname'])) : ?>
                    <div class='error'>
                        <p><?php echo $errors['surname']; ?></p>
                    </div>
                <?php endif; ?>
            </div>
            <div class='input-field'>
                <p>E-mail</p>
                <input type='text' class='input' name='email' placeholder="Input your e-mail" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                <?php if (isset($errors['email'])) : ?>
                    <div class='error'>
                        <p><?php echo $errors['email']; ?></p>
                    </div>
                <?php endif; ?>
            </div>
            <div class='input-field'>
                <p>Phone Number</p>
                <input type='text' class='input' name='phone' placeholder="Input your phone number" value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : ''; ?>">
                <?php if (isset($errors['phone'])) : ?>
                    <div class='error'>
                        <p><?php echo $errors['phone']; ?></p>
                    </div>
                <?php endif; ?>
            </div>
            <div class='input-field'>
                <p>Password</p>
                <input type='password' class='input' name='password' placeholder="Input your password" value="<?php echo isset($_POST['password']) ? $_POST['password'] : ''; ?>">
                <?php if (isset($errors['password'])) : ?>
                    <div class='error'>
                        <p><?php echo $errors['password']; ?></p>
                    </div>
                <?php endif; ?>
            </div>
            <div class='input-field'>
                <p>Confirm password</p>
                <input type='password' class='input' name='confirm' placeholder="Input your password again" value="<?php echo isset($_POST['confirm']) ? $_POST['confirm'] : ''; ?>">
            </div>
            <div class='input-field' id='checkbox<?php echo isset($errors['agreement']) ? '-error' : ''; ?>'>
                <input type='checkbox' id="terms-checkbox" name='checkbox' <?php echo isset($_POST['checkbox']) ? 'checked' : '' ?>>
                <p>I agree with user conditions </p>
            </div>
            <?php if (isset($errors['exists'])) : ?>
                <div class='error'>
                    <a class='grey' id='exists' href='./login.php'><?php echo $errors['exists']; ?></a>
                </div>
            <?php endif; ?>
            <?php if (!count($errors)) : ?>
                <div class='success'>
                    <a class='grey' id='success' href='./login.php'>You have successfully signed up!</a>
                </div>
            <?php endif; ?>
            <input type='submit' value='Sign up' id='submit'>
        </form>
    </main>
</body>