<?php 

require './utils.php';

$invalidInputs = [];
$alertMessages = [];
$alertType = 'alert-danger';

// check if form is submitted
$submittedForm = !empty($_POST);
if ($submittedForm) {
    //var_dump($_POST);
    // get all fields while trimming them and converting any special chars to html entities
    $name = htmlspecialchars(trim($_POST['name']));
    $gender = htmlspecialchars(trim($_POST['gender']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $avatar = htmlspecialchars(trim($_POST['avatar']));

    // check for empty name
    if (!$name) {
        array_push($alertMessages, 'Please enter your name');
        array_push($invalidInputs, 'name');
    }

    // check for bad gender
    if (!in_array($gender, ['N', 'F', 'M'])) {
        array_push($alertMessages, 'Please select a gender');
        array_push($invalidInputs, 'gender');
    }

    // check for bad email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($alertMessages, 'Please use a valid email');
        array_push($invalidInputs, 'email');
    }

    // check for bad phone numbers
    if (!preg_match('/^(\+\d{3} ?)?(\d{3} ?){3}$/', $phone)) {
        array_push($alertMessages, 'Please use a valid phone number');
        array_push($invalidInputs, 'phone');
    }

    // check for avatar URL
    if (!filter_var($avatar, FILTER_VALIDATE_URL)) {
        array_push($alertMessages, 'Please use a valid URL for your avatar');
        array_push($invalidInputs, 'avatar');
    }

    // if no errors: send an confirmation email
    if (!count($alertMessages)) {
        if (!sendEmail($email, 'Registration confirmation')) {
            array_push($alertMessages, 'There was a problem sending email');
        }
    }

    // if no errors at all: display success
    if (!count($alertMessages)) {
        $alertType = 'alert-success';
        $alertMessages = ['Woohoo! You have successfully signed up!'];
    }
}

?>
<?php include './includes/header.php'; ?>
<main class="container">
    <br>
    <h1 class="text-center">Form validation example</h1>
    <h2 class="text-center">Registration form</h2>
    <div class="row justify-content-center">
        <form class="form-signup" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <?php if ($submittedForm): ?>
            <div class="alert <?php echo $alertType; ?>"><?php echo implode('<br>', $alertMessages); ?></div>
            <?php endif; ?>
            <div class="form-group">
                <label>Name*</label>
                <input class="form-control<?php echo in_array('name', $invalidInputs) ? ' is-invalid' : '' ?>" name="name" value="<?php echo isset($name) ? $name : '' ?>">
                <small class="text-muted">Example: Homer Simpson</small>
            </div>
            <div class="form-group">
                <label>Gender*</label>
                <select class="form-control" name="gender">
                    <option value="N"<?php echo isset($gender) && $gender === 'N' ? ' selected' : '' ?>>Neutral</option>
                    <option value="F"<?php echo isset($gender) && $gender === 'F' ? ' selected' : '' ?>>Female</option>
                    <option value="M"<?php echo isset($gender) && $gender === 'M' ? ' selected' : '' ?>>Male</option>
                </select>
            </div>
            <div class="form-group">
                <label>Email*</label>
                <input class="form-control<?php echo in_array('email', $invalidInputs) ? ' is-invalid' : '' ?>" name="email" value="<?php echo isset($name) ? $email : '' ?>">
                <small class="text-muted">Example: example@gmail.com</small>
            </div>
            <div class="form-group">
                <label>Phone*</label>
                <input class="form-control<?php echo in_array('phone', $invalidInputs) ? ' is-invalid' : '' ?>" name="phone" value="<?php echo isset($phone) ? $phone : '' ?>">
                <small class="text-muted">Example: +421 841 147 239</small>
            </div>
            <div class="form-group">
                <label>Avatar URL*</label>
                <?php if (isset($avatar) && $avatar): ?>
                <img class="avatar" src="<?php echo $avatar; ?>" alt="avatar">
                <?php endif; ?>
                <input class="form-control<?php echo in_array('avatar', $invalidInputs) ? ' is-invalid' : '' ?>" name="avatar" value="<?php echo isset($avatar) ? $avatar : ''; ?>">
                <small class="text-muted">Example: https://eso.vse.cz/~nguv03/cv03/img/homer.jpg</small>
            </div>
            <button class="btn btn-primary" type="submit">Submit</button>
        </form>
    </div>
</main>
<?php include './includes/footer.php'; ?>