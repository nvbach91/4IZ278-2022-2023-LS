<?php


$errors = [];

if (!empty($_POST)) {
    $name = trim($_POST['name']);
     $email = htmlspecialchars(trim($_POST['email']));
      $phone = trim($_POST['phone']);
       $gender = htmlspecialchars(trim($_POST['gender']));
        $package = htmlspecialchars(trim($_POST['package']));
         $cards = htmlspecialchars(trim($_POST['cards']));
          $avatar = htmlspecialchars(trim($_POST['avatar']));


    if (!preg_match('/^[FMO]$/', $gender)) {
        $message = 'Invalid gender';
            array_push($errors, $message);
    }
    if ($email == '') {
        $message = 'Email is empty';
            array_push($errors, $message);
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Invalid email';
            array_push($errors, $message);
    }
    if ($phone == '') {
        $message = 'Phone is empty';
            array_push($errors, $message);
    }
    if (strlen($phone) != 12) {
        $message = 'Phone has invalid number of digits';
            array_push($errors, $message);
    }
    if (!filter_var($avatar, FILTER_VALIDATE_URL)) {
        $message = 'Avatar url is invalid';
            array_push($errors, $message);
    }
    if ($cards < 0) {
        $message = 'Number of cards is invalid';
            array_push($errors, $message);
    }
    

    
}
?>
<form action="." method="POST" class="form-signup">
    <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger">
            <?php foreach ($errors as $error) : ?>
                <p><?php echo $error ?></p>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <?php if (!empty($_POST)) : ?>
            <div class="alert alert-success">Registration was successful!!!</div>
        <?php endif; ?>
    <?php endif; ?>
    <br>
    <div class="form-group">
        <label for="">Name</label>
        <input name="name" value="<?php echo isset($name) ? $name : ''; ?>">

    </div>
    <div class="form-group">
        <label for="">E-mail</label>
        <input name="email" type="email" value="<?php echo isset($email) ? $email : ''; ?>">
    </div>
    <div class="form-group">
        <label for="">Phone</label>
        <input name="phone" value="<?php echo isset($phone) ? $phone : ''; ?>">

    </div>
    <div class="form-group">
        <label for="">Gender</label>
        <select name="gender" id="">
            <option value="F" <?php echo isset($gender) && $gender == 'F' ? 'selected' : '' ?>>Female</option>
            <option value="M" <?php echo isset($gender) && $gender == 'M' ? 'selected' : '' ?>>Male</option>
            <option value="O" <?php echo isset($gender) && $gender == 'O' ? 'selected' : '' ?>>Other</option>
        </select>
        </div>
    <div class="form-group">
        <label for="">Avatar url</label>
        <input name="avatar" value="<?php echo isset($avatar) ? $avatar : ''; ?>">
    </div>
    </div>
    <div class="form-group">
        <label for="">Package name</label>
        <input name="package" value="<?php echo isset($package) ? $package : ''; ?>">
    </div>
    <div class="form-group">
        <label for="">Number of cards in package</label>
        <input name="cards" value="<?php echo isset($cards) ? $cards : ''; ?>">

    
    <button class="btn btn-primary">Submit</button>
</form>
<img src="<?php echo $avatar ?>" alt="avatar">