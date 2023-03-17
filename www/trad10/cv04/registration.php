
<?php
require_once 'utils.php';

if (!empty($_POST)) {
$name =  htmlspecialchars(trim($_POST['name']));
$email = htmlspecialchars(trim($_POST['email']));
$password = htmlspecialchars(trim($_POST['password']));
$confirm_password = htmlspecialchars(trim($_POST['confirm_password']));

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

    if (empty($password)) {
        $message = 'Password is required';
        array_push($errors, $message);
    }
    
    if($password !== $confirm_password){
        $message = 'Passwords do not match';
        array_push($errors, $message);
    }

    if (!count($errors)) {
        $registerNewUser = registerNewUser($_POST);
        if (!$registerNewUser['success']) {
            array_push($errors, $registerNewUser['msg']);
        }

        if (!sendEmail($email, 'Registration confirmation')) {
            array_push($errors, 'There was a problem sending email');
        }
    }

    if(!count($errors)){
        header('Location: login.php?email=' . $email . '&ref=registration');
        exit();
    }
}
?>
<?php require './header.php'; ?>
<h1 class="text-center">Registration station</h1>
<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <?php echo implode('<br>', array_values($errors)); ?>
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
        <label>Password*</label>
        <input class="form-control" name="password" type="password">
    </div>
    <div class="form-group">
        <label>Confirm password*</label>
        <input class="form-control" name="confirm_password" type="password">
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</form>
<?php require './footer.php'; ?>