<?php

$errors = [];

if (!empty($_POST)) {
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $username = $_POST['username'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $avatar = $_POST['avatar'];

    if (!preg_match('/^[FMO]$/', $gender)) {
        $message = 'Invalid gender';
        array_push($errors, $message);
    }

    if ($name == '') {
        $message = 'Name is empty';
        array_push($errors, $message);
    }

    if ($username == '') {
        $message = 'Username is empty';
        array_push($errors, $message);
    }

    if ($email == '') {
        $message = 'Email is empty';
        array_push($errors, $message);
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Email is not valid';
        array_push($errors, $message);
    }

    if ($phone == '') {
        $message = 'Phone is empty';
        array_push($errors, $message);
    } elseif (!preg_match('/^\+\d{6,12}$/i', $phone)) {
        $message = 'Phone is not valid';
        array_push($errors, $message);
    }

    if (!filter_var($avatar, FILTER_VALIDATE_URL)) {
        $message = 'Avatar link is not valid';
        array_push($errors, $message);
        $avatar = null;
    }
}
?>


<form action="." method="POST">
    <?php if (!empty($errors)) : ?>
        <div class="fail">
            <?php foreach ($errors as $error) : ?>
                <p><?php echo $error; ?></p>
            <?php endforeach ?>
        </div>
    <?php else : ?>
        <div class="success">
            <p>Form submitted successfully</p>
        </div>
    <?php endif ?>

    <div class="fields">
        <div class="form-container">
            <div>
                <label>Full name</label>
                <input name="name" value="<?php echo isset($name) ? $name : "" ?> " />
            </div>
            <div>
                <label>Username</label>
                <input name="username" value="<?php echo isset($username) ? $username : "" ?>" />
            </div>
            <div>
                <label>Gender</label>
                <select name="gender">
                    <option value="F" <?php echo isset($gender) && $gender == 'F' ? ' selected' : '' ?>> Female</option>
                    <option value="M" <?php echo isset($gender) && $gender == 'M' ? ' selected' : '' ?>> Male</option>
                    <option value="O" <?php echo isset($gender) && $gender == 'O' ? ' selected' : '' ?>> Others</option>
                </select>
            </div>
            <div>
                <label>E-mail</label>
                <input name="email" type="email" value="<?php echo isset($email) ? $email : "" ?> " />
            </div>
            <div>
                <label>Phone</label>
                <input name="phone" value="<?php echo isset($phone) ? $phone : "" ?>" />
            </div>
            <div>
                <label>Avatar link</label>
                <input name="avatar" value="<?php echo isset($avatar) ? $avatar : "" ?>" />
            </div>
            <button>Submit</button>
        </div>

        <div class="avatar-container">
            <?php if (isset($avatar)) : ?>
                <img src="<?php echo $avatar ?>" alt="Avatar" />
            <?php endif ?>
        </div>
    </div>
</form>