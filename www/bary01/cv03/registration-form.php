<?php
$errors = [];

if (!empty($_POST)) {
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $name = htmlspecialchars(trim($_POST['name']));
    $gender = htmlspecialchars(trim($_POST['gender']));
    $avatar = htmlspecialchars(trim($_POST['avatar']));


    if(!preg_match('/^[FMO]$/', $gender)) {
        $message = 'Gender is invalid';
        array_push($errors, $message);
    }

    if (!preg_match('/^[a-zA-Z]+ [a-zA-Z]+$/', $name)) {
        $message = 'Full name is incorrect!';
        array_push($errors, $message);
    }

    if (!preg_match('/^\+[1-9][0-9]{7,14}$/', $phone)) {
        $message = 'Please enter a valid phone number'; 
        array_push($errors, $message);
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

    }

    if ($email === '') { $message = 'E-mail is empty. Plese enter your E-mail!'; array_push($errors, $message); }
    if ($phone === '') { $message = 'Phone is empty. Plese enter your phone number!'; array_push($errors, $message); }
    if ($name === '') { $message = 'Full name is empty. Plese enter your full name!'; array_push($errors, $message); }
    if (!filter_var($avatar, FILTER_VALIDATE_URL)) {
        $message ='Please use a valid URL for your avatar';
        array_push($errors, $message);
    }
}
?>


<form method="POST" action=".">
<?php if (!empty($errors)): ?>
    <div>
        <?php foreach($errors as $error):?>
            <p class="error-message"> <?php  echo $error?></p>
            <?php endforeach;?>
    </div>
    <?php else: ?>
        <div class="sucses">You have successfully signed up!</div>
    <?php endif; ?>
    <div class="form">
        <div class="form-group">
            <label>E-mail:</label>
            <br>
            <input name="email" placeholder="example: asas@gmail.com" type="email" value="<?php echo isset($email)? $email : ''; ?>">
        </div>
        <div class="form-group">
            <label>Phone:</label>
            <br>
            <input type="phone" name="phone" placeholder="example: +420829293943" value="<?php if (isset($phone)) echo $phone; ?>">
        </div>
        <div class="form-group">
            <label>Full name:</label>
            <br>
            <input type="name" name="name" placeholder="example: Yana Bareika" value="<?php if (isset($name)) echo $name; ?>">
        </div>
        <div class="form-group">
            <label>Gender:</label>
            <br>
            <select name="gender">
                <option value="F" <?php echo isset($gender) && $gender == 'F' ? 'selected' : '';?>>Female</option>
                <option value="M" <?php echo isset($gender) && $gender == 'M' ? 'selected' : '';?>>Male</option>
                <option value="O" <?php echo isset($gender) && $gender == 'O' ? 'selected' : '';?>>Other</option>
            </select>
        </div>
        <div class="form-group">
            <label>Avatar URL:</label>
            <br>
            <?php if (isset($avatar) && $avatar): ?>
            <img class="avatar" src="<?php echo $avatar; ?>" alt="avatar"> <br>
            <?php endif; ?>
            <input placeholder="example: https://pr.vse.cz/wp-content/uploads/page/58/VSE_logo_CZ_circle_blue.png" class="form-control <?php echo in_array('avatar', $errors) ? ' is-invalid' : '' ?>" name="avatar" value="<?php echo isset($avatar) ? $avatar : ''; ?>">
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
    </div>
</form>

