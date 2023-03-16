<?php 

require './utils.php';

$errors = [];

$formIsSubmitted = !empty($_POST);

if($formIsSubmitted) {
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));

    $user = getUser($email);
    if ($user == null) {
        array_push($errors, 'User is not registered');
    } else if ($user['password'] != $password) {
        array_push($errors, 'Wrong password');
    } else {
        echo "Login was successful!";
    }
}

?>

<?php include './head.php';?>

<main>
    <h1>Login</h1>
    <?php if(!empty($errors)):?>
        <div class="errors">
            <?php foreach($errors as $error):?>
                <p><?php echo $error?></p>
            <?php endforeach; ?>
        </div>
    <?php endif;?>

    <form method="POST" action="./login.php">
        <div>
            <label>Email</label>
            <input name="email">        
        </div>
        <div>
            <label>Password</label>
            <input name="password">        
        </div>
        <button>Submit</button>
    </form>
</main>


<?php include './foot.php';?>