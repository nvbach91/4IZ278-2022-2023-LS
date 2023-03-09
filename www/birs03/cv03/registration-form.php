<?php
$errors = [];

//check if form is submitted
if(!empty($_POST)){
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $gender = htmlspecialchars(trim($_POST['gender']));
    $avatar = htmlspecialchars(trim($_POST['avatar']));
    
    //check the validity of string values
    if($name == ''){
        $message = 'Name is empty!';
        array_push($errors, $message);
    }

    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $message = 'Email is not valid!';
        array_push($errors, $message);
    }

    if(!preg_match('/^\d{10}$/',$phone)){
        $message = 'Phone is not valid, must have 10 numbers!';
        array_push($errors, $message);
    }

    if(!str_contains('FMO', $gender)){
        $message = 'Gender is not valid, must be Female, Male or Others';
        array_push($errors, $message);
    }

    if(!filter_var($avatar,FILTER_VALIDATE_URL)){
        $message = 'Avatar URL is not valid!';
        array_push($errors, $message);
    }
}

?>

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
        <label for="">Gender*</label>
        <select name="gender" id="">
            <option value="F" <?php echo isset($gender) && $gender =='F'? 'selected' : ''; ?>>Female</option>
            <option value="M" <?php echo isset($gender) && $gender =='M'? 'selected' : ''; ?>>Male</option>
            <option value="O" <?php echo isset($gender) && $gender =='O'? 'selected' : ''; ?>>Others</option>
        </select>
    </div>
    <div>
        <label for="">Email*</label>
        <input name='email' placeholder='example@gmail.com' value="<?php echo isset($email) ? $email : ''; ?>">
    </div>
    <div>
        <label for="">Phone*</label>
        <input name='phone' placeholder='0918292369' value="<?php echo isset($phone) ? $phone : ''; ?>">
    </div>
    <div>
        <label for="">Avatar URL*</label>
        <?php if(!empty($avatar)):?>
            <img src="<?php echo $avatar;?>" alt="Avatar" width="auto" height="128">
        <?php endif;?>
        <input name='avatar' placeholder='https://example.com/homer.jpg' value="<?php echo isset($avatar) ? $avatar : ''; ?>">
    </div>
    <button>Sumbit</button>
</form>