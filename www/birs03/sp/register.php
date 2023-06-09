<?php require_once 'UsersDatabase.php';?>
<?php
$usersDatabase = new UsersDatabase();

$errors = [];

//check if form is submitted
if(!empty($_POST)){
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));
    $confirm = htmlspecialchars(trim($_POST['confirm']));
    $address = htmlspecialchars(trim($_POST['address']));
    
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
        $existingUser = $usersDatabase->getUser($email);
        if(!$existingUser==null){
            array_push($errors,'This email already exist');
        }
    }

    if($address == ''){
        $message = 'Address is empty!';
        array_push($errors, $message);
    }
    
    if(empty($errors)){
        $hash = password_hash($password,PASSWORD_DEFAULT);
        $usersDatabase->addUser($name,$email,$hash,$address,0);
        header('Location: login.php?email='.$email);
        exit;
    }
}

?>
<?php require 'header.php'; ?>
<section style="width: 40%;display: table;margin: auto;" class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
            <h1 style="text-align: center;">Registration form</h1>
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
                    <label for="">Address*</label>
                    <input name='address' placeholder='742 Evergreen Terrace, Springfield' value="<?php echo isset($address) ? $address : ''; ?>">
                </div>
                <div>
                    <label for="">Password* (Please use at least 8 characters)</label>
                    <input name='password' placeholder='********' type='password'>
                </div>
                <div>
                    <label for="">Confirm password*</label>
                    <input name='confirm' placeholder='********' type='password'>
                </div>
                <button>Sumbit</button>
    </div>
</section>
<?php require 'footer.php'; ?>