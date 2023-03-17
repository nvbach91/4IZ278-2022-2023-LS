<?php

$avatarPlaceholder = "https://avataaars.io/?avatarStyle=Circle&topType=LongHairMiaWallace&accessoriesType=Round&hairColor=Brown&facialHairType=BeardMedium&facialHairColor=Brown&clotheType=ShirtVNeck&clotheColor=Blue03&eyeType=Default&eyebrowType=Angry&mouthType=Twinkle&skinColor=Tanned";

$errors = [];

if (!empty($_POST)) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $gender = trim($_POST['gender']);
    $avatar = trim($_POST['avatar']);


    if ($name == '') {
        $message = 'Your name is reqired.';
        array_push($errors, $message);
    }

    if ($email == '') {
        $message = 'Email is required.';
        array_push($errors, $message);
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Email is not valid';
        array_push($errors, $message);
    }

    if ($phone == '') {
        $message = 'Phone is required.';
        array_push($errors, $message);
    } elseif (strlen($phone) != 9) {
        $message = 'Phone length must be 9 numbers.';
        array_push($errors, $message);
    }

    if (!preg_match('/^[FMO]$/', $gender)) {
        $message = 'Your gender is not valid.';
        array_push($errors, $message);
    }

    if ($avatar == '') {
    } elseif (!filter_var($avatar, FILTER_VALIDATE_URL)) {
        $message = 'Avatar URL is not valid';
        array_push($errors, $message);
    }
} else {
    $message = 'Please fill the form.';
    array_push($errors, $message);
}

if (empty($errors)){
    $record = "$name;$email;$phone;$gender;$avatar" . PHP_EOL;
    file_put_contents('')
}

?>

<h1>Business card form with validation</h1>
<?php if (!empty($errors)) : ?>
    <div>
        <?php foreach ($errors as $error) : ?>
            <p><?php echo $error; ?></p>
        <?php endforeach; ?>
    </div>
<?php else : ?>
    <div>
        <p>
            Form submitted successfully
        </p>
    </div>
<?php endif; ?>

<form class="person" method="POST" action=".">
    <div class="card">
        <img class="avatar" src="<?php echo (isset($avatar) && strlen($avatar) != 0) ? $avatar : $avatarPlaceholder ?>" alt="avatar" />
        <div class="data-wrapper">
            <div class="form-group">
                <label for="name">Name*</label>
                <input id="name" class="form-control" name="name" placeholder="Name" value="<?php echo isset($name) ? $name : ""; ?>">
            </div>
            <div class="form-group">
                <label for"email">Email*</label>
                <input id="email" class="form-control" name="email" placeholder="E-mail" value="<?php echo isset($email) ? $email : ""; ?>">
            </div>
            <div class="form-group">
                <label for="phone">Phone*</label>
                <input id="phone" class="form-control" name="phone" placeholder="Phone number" value="<?php echo isset($phone) ? $phone : ""; ?>">
            </div>
        </div>
    </div>
    <div class="card">
        <img class="avatar" src="<?php echo (isset($avatar) && strlen($avatar) != 0) ? $avatar : $avatarPlaceholder ?>" alt="avatar" />
        <div class="data-wrapper">
            <div class="form-group">
                <label for="gender">Gender*</label>
                <select id="gender" name="gender">
                    <option value="F" <?php echo isset($gender) && $gender == "F" ? " selected" : ""; ?>>Female</option>
                    <option value="M" <?php echo isset($gender) && $gender == "M" ? " selected" : ""; ?>>Male</option>
                    <option value="O" <?php echo isset($gender) && $gender == "O" ? " selected" : ""; ?>>Other</option>
                    <option value="U">Unvalid</option>
                </select>
            </div>
            <div class="form-group">
                <label for="avatar">Avatar URL</label>
                <input id="avatar" class="form-control" name="avatar" placeholder="Avatar" value="<?php echo isset($avatar) ? $avatar : "" ?>">
            </div>
            <input type="submit" />
        </div>
    </div>
</form>