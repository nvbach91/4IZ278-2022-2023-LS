<?php require './utils.php';

$errors = [];

//check if form is submitted
if (!empty($_POST)) {
    //trim pro ignorovani bilych znaku
    //htmlspecialchars prevede specialni znaku do html entit
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));
    $confirmPassword = htmlspecialchars(trim($_POST['confirmPassword']));


    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {$message = 'email is not valid'; array_push($errors, $message);}
    if($email == '') {$message = 'email is empty'; array_push($errors, $message); }
    if ($confirmPassword != $password) {
        $message = 'Passwords are not the same';
        array_push($errors, $message);
    }    


    $existingUser = getUser($email);
   
    if($existingUser != null) {
        array_push($errors, 'Existing user');
    }

    if(empty($errors)){
        $databaseFilePath = './database.db';
        // insert data to database
        //only after all successful validations
        $userRecord = "$email;$password" . PHP_EOL;
        
        file_put_contents($databaseFilePath, $userRecord, FILE_APPEND);

        //user registered
        header('Location: login.php');
        exit;
    }
}
?>

<?php include './head.php'?>

<h1>Registration form</h1>

<form method="POST" action="./registration.php">
    <?php if(!empty($errors)):?>
        <div>
            <?php foreach($errors as $error):?>
                <p><?php echo $error?></p>
            <?php endforeach; ?>
        </div>
    <?php endif;?>
    <div>
        <label>E-mail</label>
        <input name="email" placeholder="example: example@gmail.com" type="email" value="<?php echo isset($email) ? $email : ''; ?>">
        
    </div>
    <div>
        <label>Password</label>
        <input name="password" placeholder="example: password" value="<?php echo isset($password) ? $password : ''; ?>">
    </div>
    <div>
        <label>Confirm password</label>
        <input name="confirmPassword" value="<?php echo isset($confirmPassword) ? $confirmPassword : ''; ?>">
    </div>
      <?php if (empty($errors) && !empty($_POST)): ?>
        <div class = "success"> <?php echo 'You have successfully signed up!'; ?> </div>
    <?php endif; ?>
    <button>Submit</button>
</form>


<?php include './foot.php'?>
