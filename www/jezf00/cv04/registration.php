<?php 

require __DIR__ . '/utils/utils.php';

$errors = [];


$submittedForm = !empty($_POST);
if ($submittedForm) {

    $name = trim(@$_POST['name']);
    $email = trim(@$_POST['email']);
    $password = @$_POST['password'];
    $confirm = @$_POST['confirm'];


    if (!$name) {
        $errors['name'] = 'Please enter your name';
    }


    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please use a valid email';
    }
    if ($password !== $confirm || strlen($password) < 8 || strlen($confirm) < 8) {
        $errors['password'] = 'Please use a valid password';
        $errors['confirm'] = 'Please use a valid password';
    }


    if (empty($errors)) {
        $registerNewUser = registerNewUser($_POST);
        if (!$registerNewUser['success']) {
            $errors['registration'] = $registerNewUser['msg'];
        }
    }

    if (empty($errors)) {
        sendEmail($email, 'Registration confirmation');
        header('Location: login.php?ref=registration&email=' . $email);
        exit();
    }
}

?>
<?php require __DIR__ . '/incl/header.php'; ?>
<section>
        <div class="form-boxreg">
            <div class="form-value">
                <main >
                    <br>
                    <h1 class="text-center white">Registration</h1>
                    <div class="row justify-content-center">
                        <form class="form-registration" method="POST">
                            <?php if ($submittedForm && !empty($errors)): ?>
                                <div class="alert alert-danger">
                                    <?php echo implode('<br>', array_values($errors)); ?>
                                </div>
                            <?php endif; ?>
                            <div class="form-group">
                                <label class="white">Name*</label>
                                <input class="form-control<?php echo getInputValidClass('name', $errors); ?>" name="name" value="<?php echo @$name; ?>">
                                <small class="text-muted">Example: Frank Wild</small>
                            </div>
                            <div class="form-group">
                                <label class="white">Email*</label>
                                <input class="form-control<?php echo getInputValidClass('email', $errors); ?>" name="email" value="<?php echo @$email; ?>" type="email">
                                <small class="text-muted">Example: FrankWild@gmail.com</small>
                            </div>
                            <div class="form-group">
                                <label class="white">Password* (Please use at least 8 characters)</label>
                                <input class="form-control<?php echo getInputValidClass('password', $errors); ?>" name="password" value="<?php echo @$password; ?>" type="password">
                                <label class="white">Confirm password*</label>
                                <input class="form-control<?php echo getInputValidClass('confirm', $errors); ?>" name="confirm" value="<?php echo @$confirm; ?>" type="password">
                            </div>
                            <button type="submit">Submit</button>
                        </form>
                    </div>
                </main>
            </div>
        </div>
    </section>               
<?php require __DIR__ . '/incl/footer.php'; ?>


