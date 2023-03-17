<?php 

require __DIR__ . '/utils/utils.php';

$errors = [];
$logged = false;
$submittedForm = !empty($_POST);
if ($submittedForm) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $authentication = authenticate($email, $password);
    if (!$authentication['success']) {
        $errors['authentication'] = $authentication['msg'];
        $logged = false;
    } else {
        $logged = true;
    }
}


if (isset($_GET['email'])) {
    $email = $_GET['email'];
} 

?>

<?php require __DIR__ . '/incl/header.php'; ?>
<section>
        <div class="form-box">
            <div class="form-value">
                <main>
                <br>
                <h2 class="text-center">Login</h2>
                    <form class="form-registration" method="POST">
                        <?php if (isset($_GET['email']) && @$_GET['ref'] === 'registration'): ?>
                    <div class="alert alert-success">Woohoo! You have successfully signed up!</div>
                    <?php endif; ?>
                    <?php if($logged == true):?>
                        <div class="alert alert-success">Woohoo! You have successfully logged in!</div>
                        <?php endif;?>
                    <?php if ($submittedForm && !empty($errors)): ?>
                        <div class="alert alert-danger">
                            <?php echo implode('<br>', array_values($errors)); ?>
                        </div>
                    <?php endif; ?>
                    <div class="form-group"> 
                        <label class="white">Email*</label>
                        <input class="form-control<?php echo getInputValidClass('email', $errors); ?>" name="email" value="<?php echo @$email; ?>" type="email">
                        
                    </div>
                    <div class="form-group">
                    <label class="white">Password*</label>
                    <input class="form-control<?php echo getInputValidClass('password', $errors); ?>" name="password" value="<?php echo @$password; ?>" type="password">
                    
                </div>
        <button type="submit">Login</button>
                </form>
            <div class="register">
                 <p>Dont't have an account?</p>
                <p><a href="./registration.php">Go to registration</a></p>
            </div>
        </div>
    </div>
   </section>
</main>

<?php require __DIR__ . '/incl/footer.php'; ?>