
<?php
require_once 'MailSender.php';

if (!empty($_POST)) {
$name =  htmlspecialchars(trim($_POST['name']));
$email = htmlspecialchars(trim($_POST['email']));
$phone = htmlspecialchars(trim($_POST['phone']));
$avatar = htmlspecialchars(trim($_POST['avatar']));

$errors = [];
    // check the validity of string values
    if (empty($email)) {
        $message = 'Email is required';
        array_push($errors, $message);
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Email is invalid';
        array_push($errors, $message);
    }

    if (empty($name)) {
        $message = 'Name is required';
        array_push($errors, $message);

    } 
    
    if (empty($phone)) {
        $message = 'Phone is required';
        array_push($errors, $message);
        
    } elseif (!preg_match('/^[0-9]{9}$/', $phone)) {
        $message = 'Phone is invalid';
        array_push($errors, $message);
    }

    if (!count($errors)) {
        if (!sendEmail($email, 'Registration confirmation')) {
            array_push($errors, 'There was a problem sending email');
        }
    }
}
?>

<h1 class="text-center">Registration station</h1>
<?php if (!empty($errors)): ?>
    <div>
        <?php foreach ($errors as $error) : ?>
            <div class="alert alert-danger"><?php echo $error ?></div>
        <?php endforeach; ?>
    </div>
    <?php elseif(!empty($_POST)):?>
        <div class="alert alert-success">Registration stationed successfully</div>
<?php endif; ?>

<form class="form-signup" method="POST" action="<?php $_SERVER["PHP_SELF"]; ?>">
    <div class="form-group">
        <label>Name*</label>
        <input class="form-control" name="name" value="<?php echo $name ?? '' ?>">
    </div>
    <div class="form-group">
        <label>Email*</label>
        <input class="form-control" name="email" value="<?php echo $email ?? '' ?>">
    </div>
    <div class="form-group">
        <label>Phone*</label>
        <input class="form-control" name="phone" value="<?php echo $phone ?? '' ?>">
    </div>
    <div class="form-group">
        <label>Avatar URL*</label>
        <input class="form-control" name="avatar" value="<?php echo $avatar ?? '' ?>">
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</form>