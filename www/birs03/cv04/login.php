<?php require './utils.php';?>
<?php include './head.php';?>
<?php
$errors = [];

$email = isset($_GET['email'])?$_GET['email']:'';

$fromIsSumbitted = !empty($_POST);
if($fromIsSumbitted){
    $password = trim($_POST['password']);
    $email = trim($_POST['email']);
    $existingUser = getUser($email);
    if($existingUser != null){
        if($existingUser['password'] == $password){
            echo 'Login success';
            header('Location: home.php?name='.$existingUser['name']);
            exit;
        } else{
            $message = 'Incorect password.';
            array_push($errors,$message);
            //echo 'Incorect password';
        }
    } else {
        $message = 'Nonexisting user.';
        array_push($errors,$message);
        //echo 'Nonexisting user';
    }
}

?>
<main>
    <h1>Login page</h1>
    <form action="login.php" method="POST">
        <?php if(isset($_GET['email'])):?>
            <div class="success"><p>Yeah! You have successfully signed up!</p></div>
        <?php endif; ?>
        <?php foreach($errors as $error):?>
            <div class="error"><p><?php echo $error; ?></p></div>
        <?php endforeach; ?>
        <div>
            <label for="">Email</label>
            <input name="email" value="<?php echo $email?>">
        </div>
        <div>
            <label for="">Password</label>
            <input name="password" type="password">
        </div>
        <button>Login</button>
    </form>
</main>