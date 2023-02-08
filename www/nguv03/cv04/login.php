<?php 

require __DIR__ . '/utils/utils.php';

$errors = [];

// check if form is submitted
$submittedForm = !empty($_POST);
if ($submittedForm) {
    // get all fields while trimming them and converting any special chars to html entities
    $email = $_POST['email'];
    $password = $_POST['password'];
    $authentication = authenticate($email, $password);
    if (!$authentication['success']) {
        $errors['authentication'] = $authentication['msg'];
    } else {
        header('Location: profile.php?email=' . $email);
        exit();
    }
}

// set default email if specified in URL query string
if (isset($_GET['email'])) {
    $email = $_GET['email'];
} 

?>

<?php require __DIR__ . '/incl/header.php'; ?>

<main class="container">
    <br>
    <h1 class="text-center">Login</h1>
    <form class="form-registration" method="POST">
        <?php if (isset($_GET['email']) && @$_GET['ref'] === 'registration'): ?>
            <div class="alert alert-success">Woohoo! You have successfully signed up!</div>
        <?php endif; ?>
        <?php if ($submittedForm && !empty($errors)): ?>
            <div class="alert alert-danger">
                <?php echo implode('<br>', array_values($errors)); ?>
            </div>
        <?php endif; ?>
        <div class="form-group">
            <label>Email*</label>
            <input class="form-control<?php echo getInputValidClass('email', $errors); ?>" name="email" value="<?php echo @$email; ?>" type="email">
            <small class="text-muted">Example: homer@simpson.com</small>
        </div>
        <div class="form-group">
            <label>Password*</label>
            <input class="form-control<?php echo getInputValidClass('password', $errors); ?>" name="password" value="<?php echo @$password; ?>" type="password">
        </div>
        <button class="btn btn-primary" type="submit">Login</button>
    </form>
</main>

<?php require __DIR__ . '/incl/footer.php'; ?>