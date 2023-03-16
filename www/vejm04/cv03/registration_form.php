<?php

$errors = [];

if(!empty($_POST)) {
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $name = htmlspecialchars(trim($_POST['name']));
    $gender = htmlspecialchars(trim($_POST['gender']));
    $avatar = htmlspecialchars(trim($_POST['avatar']));

    if($email == '') {
        $message = 'Email is empty';
        array_push($errors, $message);
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Email is not valid';
        array_push($errors, $message);
    }

    if($phone == '') {
        $message = 'Phone is empty';
        array_push($errors, $message);
    }

    if(strlen($phone) != 9) {
        $message = 'Phone is not valid';
        array_push($errors, $message);
    }

    if($name == '') {
        $message = 'Name is empty';
        array_push($errors, $message);
    }

    if(!in_array($gender, ['F','M'])) {
        $message = 'Gender is not valid';
        array_push($errors, $message);
    }

    if($avatar == '') {
        $message = 'Avatar link is empty';
        array_push($errors, $message);
    }

    if(!filter_var($avatar, FILTER_VALIDATE_URL)) {
        $message = 'Avatar link is not valid';
        array_push($errors, $message);
        $avatar = null;
    }
}

?>

<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <?php if (empty($errors)) : ?>
        <p>Thank you!</p>
    <?php endif; ?>
    <?php foreach($errors as $error): ?>
        <p><?php echo $error; ?></p>
        <?php endforeach; ?>
    <div> <label>Name</label> <input name="name" value="<?php echo isset($name) ? $name : ''; ?>"> </div>
    <div> <label>Email</label> <input name="email" value="<?php echo isset($email) ? $email : ''; ?>"> </div>
    <div> <label>Phone</label> <input name="phone" value="<?php echo isset($phone) ? $phone : ''; ?>"> </div>
    <div> <label>Avatar link</label> <input name="avatar" value="<?php echo isset($avatar) ? $avatar : "" ?>"/></div>
    <div>
        <label>Gender</label>
        <select name="gender">
            <option value="F"<?php echo isset($gender) && $gender == 'F' ? ' selected' : '' ?>>Female</option>
            <option value="M"<?php echo isset($gender) && $gender == 'M' ? ' selected' : '' ?>>Male</option>
        </select>
    </div>

    <button>Submit</button>

    <div class="avatar-photo">
        <?php if (isset($avatar)) : ?>
            <img src="<?php echo $avatar ?>" alt="Avatar" />
        <?php endif ?>
    </div>
</form>