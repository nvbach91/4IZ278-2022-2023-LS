<?php

$errors = [];


if (!empty($_POST)) {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $gender = htmlspecialchars(trim($_POST['gender']));
    $avatar = htmlspecialchars(trim($_POST['avatar']));
    
    if (!preg_match('/^[FMO]$/', $gender)) {$message = 'Invalid gender'; array_push($errors, $message);}
    if($name == '') {$message = 'name is empty'; array_push($errors, $message); }
    if($email == '') {$message = 'email is empty'; array_push($errors, $message); }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {$message = 'email is not valid'; array_push($errors, $message);}
    if($phone == '') {$message = 'phone is empty'; array_push($errors, $message); }
    if( strlen($phone)!=9) {$message = 'phone does not have 9 numbers'; array_push($errors, $message); }
    if($avatar == '') {$message = 'URL is empty'; array_push($errors, $message); }
    if(!filter_var($avatar, FILTER_VALIDATE_URL)) {$message = 'URL is not valid'; array_push($errors, $message); }
}
?>

<form class="form-signup" method="POST" action=".">
    <div class="alert alert-danger">
    <?php if(!empty($errors)):?>
        <div class="errors">
            <?php foreach($errors as $error):?>
                <div>Warning! <?php echo $error?></div>
            <?php endforeach; ?>
        </div>
    <?php endif;?>    

    </div>
    <div class="form-group">
        <label>Name*</label>
        <input class="form-control" name="name" value="<?php echo isset($name) ? $name : ''; ?>">
    </div>
    <div class="form-group">
        <label>Gender*</label><br>
        <select name="gender">
            <option value="F" <?php if (isset($gender) && $gender === "F") echo ' selected' ?>>Female</option>
            <option value="M" <?php if (isset($gender) && $gender === "M") echo ' selected' ?>>Male</option>
            <option value="O" <?php if (isset($gender) && $gender === "O") echo ' selected' ?>>Others</option>
        </select>
    </div>
    <div class="form-group">
        <label>Email*</label>
        <input class="form-control" name="email" value="<?php echo isset($email) ? $email : ''; ?>">
    </div>
    <div class="form-group">
        <label>Phone*</label>
        <input class="form-control" name="phone" value="<?php echo isset($phone) ? $phone : ''; ?>">
    </div>
    <div class="form-group">
        <label>Avatar URL*</label>
        <input class="form-control" name="avatar" value="<?php echo isset($avatar) ? $avatar : ''; ?>">
    </div>
    <?php if (empty($errors) && !empty($_POST)): ?>
        <div class="avatar"> <img src="<?php echo $avatar?>"></div>
        <div class = "success"> <?php echo 'You have successfully signed up!'; ?> </div>
    <?php endif; ?>

    <button class="btn btn-primary" type="submit">Submit</button>
</form>