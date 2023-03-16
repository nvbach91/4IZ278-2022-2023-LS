<?php require './utils.php';?>
<?php include './head.php';?>
<?php
$errors = [];

//check if form is submitted
if(!empty($_POST)){
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));
    $confirm = htmlspecialchars(trim($_POST['confirm']));
    
    //check the validity of string values
    if($name == ''){
        $message = 'Name is empty!';
        array_push($errors, $message);
    }

    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $message = 'Email is not valid!';
        array_push($errors, $message);
    }

    if(strlen($password) < 8){
        $message = 'Password is not valid!';
        array_push($errors, $message);
    }

    if($password != $confirm){
        $message = 'Passwords do not match!';
        array_push($errors,$message);
    }

    if(isset($email)){
        $existingUser = getUser($email);
        if(!$existingUser==null){
            array_push($errors,'This email already exist');
        }
    }
    
    if(empty($errors)){
        $record = "$name;$email;$password" . PHP_EOL;
        $usersFilePath = './users.db';
        file_put_contents($usersFilePath,$record,FILE_APPEND);
        //redirect
        header('Location: login.php?email='.$email);
        exit;
    }
}

?>
<main>
    <h1>Registration form</h1>
    <form method='POST' action="<?php echo $_SERVER['PHP_SELF'];?>">
        <?php if(empty($errors)&&!empty($_POST)):?>
            <div class="success"><p>Yeah! You have successfully signed up!</p></div>
        <?php endif; ?>
        <?php foreach($errors as $error):?>
            <div class="error"><p><?php echo $error; ?></p></div>
        <?php endforeach; ?>
        <div>
            <label for="">Name*</label>
            <input name='name' placeholder='Homer Simpson' value="<?php echo isset($name) ? $name : ''; ?>">
        </div>
        <div>
            <label for="">Email*</label>
            <input name='email' placeholder='example@gmail.com' value="<?php echo isset($email) ? $email : ''; ?>">
        </div>
        <div>
            <label for="">Password* (Please use at least 8 characters)</label>
            <input name='password' type='password'>
        </div>
        <div>
            <label for="">Confirm password*</label>
            <input name='confirm' type='password'>
        </div>
        <button>Sumbit</button>
    </form>
</main>