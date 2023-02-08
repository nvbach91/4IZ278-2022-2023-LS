<?php 

require __DIR__ . '/utils/utils.php';

$errors = [];

// check if form is submitted
$submittedForm = !empty($_POST);
if ($submittedForm) {
    //var_dump($_POST);
    // get all fields while trimming them and converting any special chars to html entities
    $name = trim(@$_POST['name']);
    $email = trim(@$_POST['email']);
    $password = @$_POST['password'];
    $confirm = @$_POST['confirm'];

    // check for empty name
    if (!$name) {
        $errors['name'] = 'Please enter your name';
    }

    // check for bad email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please use a valid email';
    }

    // check for invalid passwords
    if ($password !== $confirm || strlen($password) < 8 || strlen($confirm) < 8) {
        $errors['password'] = 'Please use a valid password';
        $errors['confirm'] = 'Please use a valid password';
    }

    // if no errors: insert the new user to db
    if (empty($errors)) {
        $registerNewUser = registerNewUser($_POST);
        if (!$registerNewUser['success']) {
            $errors['registration'] = $registerNewUser['msg'];
        }
    }

    // if no errors: send confirmation email
    if (empty($errors)) {
        sendEmail($email, 'Registration confirmation');
        header('Location: login.php?ref=registration&email=' . $email);
        exit();
    }
}

?>
<?php require __DIR__ . '/incl/header.php'; ?>
<main class="container">
    <br>
    <h1 class="text-center">Registration</h1>
    <div class="row justify-content-center">
        <form class="form-registration" method="POST">
            <?php if ($submittedForm && !empty($errors)): ?>
                <div class="alert alert-danger">
                    <?php echo implode('<br>', array_values($errors)); ?>
                </div>
            <?php endif; ?>
            <div class="form-group">
                <label>Name*</label>
                <input class="form-control<?php echo getInputValidClass('name', $errors); ?>" name="name" value="<?php echo @$name; ?>">
                <small class="text-muted">Example: Homer Simpson</small>
            </div>
            <div class="form-group">
                <label>Email*</label>
                <input class="form-control<?php echo getInputValidClass('email', $errors); ?>" name="email" value="<?php echo @$email; ?>" type="email">
                <small class="text-muted">Example: homer@simpson.com</small>
            </div>
            <div class="form-group">
                <label>Password* (Please use at least 8 characters)</label>
                <input class="form-control<?php echo getInputValidClass('password', $errors); ?>" name="password" value="<?php echo @$password; ?>" type="password">
                <label>Confirm password*</label>
                <input class="form-control<?php echo getInputValidClass('confirm', $errors); ?>" name="confirm" value="<?php echo @$confirm; ?>" type="password">
                <small class="text-muted">Example: <?php echo generateRandomPassword(10); ?></small>
            </div>
            <button class="btn btn-primary" type="submit">Submit</button>
        </form>
    </div>
</main>
<?php require __DIR__ . '/incl/footer.php'; ?>


