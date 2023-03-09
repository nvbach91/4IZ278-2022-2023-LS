<?php

$errors = [];

if (!empty($_POST)) {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $gender = htmlspecialchars(trim($_POST['gender']));
    $url = htmlspecialchars(trim($_POST['url']));

    if ($name == '') {
        array_push($errors, 'Name is empty');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, 'Email is not valid');
    }

    if ($phone == '') {
        array_push($errors, 'Phone is empty');
    }

    if (!preg_match('/^\d{9}$/', $phone)) {
        array_push($errors, 'Phone is not valid, it must have 9 numbers');
    }

    if (!preg_match('/^[FMO]$/', $gender)) {
        array_push($errors, "Gender is not valid, must be male, female or others");
    }

    if (!filter_var($url, FILTER_VALIDATE_URL)) {
        array_push($errors, "Please pick valid avatar image URL");
    }
}

?>


<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
    <?php if (empty($errors)) : ?>
        <p>Thank you for your registration</p>
    <?php endif ?>
    <?php foreach ($errors as $error) : ?>
        <div>
            <p><?php echo $error ?></p>
        </div>
    <?php endforeach; ?>
    <div>
        <label>Full name</label>
        <input value="<?php echo isset($name) ? $name : ''; ?>" name="name">
    </div>
    <div>
        <label>Email</label>
        <input value="<?php echo isset($email) ? $email : ''; ?>" name="email">
    </div>
    <div>
        <label>Phone</label>
        <input value="<?php echo isset($phone) ? $phone : ''; ?>" name="phone">
    </div>
    <div>
        <label>Gender</label>
        <select name="gender">
            <option value="F" <?php echo isset($gender) && $gender == "F" ? 'selected' : '' ?>>Female</option>
            <option value="M" <?php echo isset($gender) && $gender == "M" ? 'selected' : '' ?>>Male</option>
            <option value="O" <?php echo isset($gender) && $gender == "O" ? 'selected' : '' ?>>Others</option>
        </select>
    </div>
    <?php if (isset($url) && $url) : ?>
        <img src="<?php echo $url; ?>" alt="avatar">
    <?php endif; ?>
    <div>
        <label>Avatar</label>
        <input value="<?php echo isset($url) ? $url : ''; ?>" name="url">
    </div>
    <button>Submit</button>
</form>