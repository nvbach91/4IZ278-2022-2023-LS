<?php
require './UsersDatabase.php';
// TITLE HANDLING ------
ob_start();
include("header.php");
$buffer = ob_get_contents();
ob_end_clean();

$buffer = str_replace("%TITLE%", "REGISTRATION PAGE BEEBZZ", $buffer);
echo $buffer;

//REGISTRATION LOGIC
$errors = [];

if (!empty($_POST)) {
    //ALL INPUTS
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $first_name = htmlspecialchars(trim($_POST['first_name']));
    $second_name = htmlspecialchars(trim($_POST['second_name']));
    $confirmPassword = htmlspecialchars(trim($_POST['password_check']));
    $password = htmlspecialchars(trim($_POST['password']));
    $country = htmlspecialchars(trim($_POST['country']));
    $city = htmlspecialchars(trim($_POST['city']));
    $street = htmlspecialchars(trim($_POST['street']));
    $postal_code = htmlspecialchars(trim($_POST['postal_code']));

    //CHECKING DATABASE
    $usersDatabase = new UsersDatabase();
    $result = $usersDatabase->checkUserExistence($email);

    //INPUT VALIDATION
    if ($email == '') {
        //nevalidní vstup
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
    if (strlen($phone) != 9) {
        $message = 'Phone has invalid number of digits';
        array_push($errors, $message);
    }
    if ($confirmPassword != $password) {
        $message = 'Passwords are not the same';
        array_push($errors, $message);
    }
    if ($first_name == '') {
        $message = 'First name is empty';
        array_push($errors, $message);
    }
    if ($second_name == '') {
        $message = 'Second name is empty';
        array_push($errors, $message);
    }
    if ($country == '') {
        $message = 'Country is empty';
        array_push($errors, $message);
    }
    if ($city == '') {
        $message = 'City is empty';
        array_push($errors, $message);
    }
    if ($street == '') {
        $message = 'Street is empty';
        array_push($errors, $message);
    }
    if ($postal_code == '') {
        $message = 'Postal code is empty';
        array_push($errors, $message);
    }
    //if number of found rows in database is > 0
    if ($result > 0) {
        array_push($errors, 'User already exists.');
    }
    if (empty($errors) && !empty($_POST)) {
        //INSERT USER INTO DATABASE AND REDIRECT TO ANOTHER PAGE

        $usersDatabase = new UsersDatabase();
        $result = $usersDatabase->insertUser($first_name, $second_name, $email, $password, $phone, $city, $postal_code, $street, $country);
        if ($result) {
            mail($email, 'Registration at BEEBZZ', 'Thank you for your registration on BEEBZZ! Happy shopping!');
            header("Location: login.php?email");
        } else {
            array_push($errors, 'Something went wrong, not registered');
        }
        exit;
    }
}



?>
<div class="text-center registration-form">
    <form action="./registration.php" method="POST">

        <?php if (!empty($errors)) : ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error) : ?>
                    <p><?php echo $error ?></p>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <?php if (!empty($_POST)) : ?>
                <div class="alert alert-success">Registration was successful!</div>
            <?php endif; ?>
        <?php endif; ?>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">First name:</label>
            <div class="col-sm-10">
                <input type="name" class="form-control" name="first_name" placeholder="Your name">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Second name:</label>
            <div class="col-sm-9">
                <input type="name" class="form-control" name="second_name" placeholder="Your surname">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Email:</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" name="email" placeholder="e.g. adress@email.com">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Phone number:</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="phone" placeholder="Enter nine digits: XXXXXXXXX">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Password:</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" name="password" placeholder="Enter your password">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Passwor again:</label>
            <div class="col-sm-9">
                <input type="password" class="form-control" name="password_check" placeholder="Confirm your password">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Country:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="country" placeholder="Enter your country name">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">City:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="city" placeholder="Enter your city name">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label">Street plus house number:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="street" placeholder="Enter your street and home number">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Postal code:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="postal_code" placeholder="Enter your postal code">
            </div>
        </div>
        <div>
            <button class="btn btn-info">SUBMIT</button>
        </div>
    </form>
</div>
<?php include './footer.php'; ?>