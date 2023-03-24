<?php

require("./utils.php");

$errors = [];
$invalidInputs = [];

// check if form is submitted
if (!empty($_POST)) {

    $firstName = htmlspecialchars(trim($_POST['firstName']));
    $lastName = htmlspecialchars(trim($_POST['lastName']));
    $mail =  htmlspecialchars(trim($_POST['mail']));
    $password =  htmlspecialchars($_POST['password']);
    $address = htmlspecialchars(trim($_POST['address']));
    $occupation = htmlspecialchars(trim($_POST['occupation']));
    $birthYear = ($_POST['birthYear']);
    $avatar = htmlspecialchars(trim($_POST['avatar']));



    if ($firstName == '') {
        $message = "What's your name? It's empty.";
        array_push($errors, $message);
        array_push($invalidInputs, 'firstName');
    }
    if ($lastName == '') {
        $message = "What's your lastname? It's empty.";
        array_push($errors, $message);
        array_push($invalidInputs, 'lastName');
    }
    if ($mail == '') {
        $message = "What's your mail? I wanna spam you :)";
        array_push($errors, $message);
        array_push($invalidInputs, 'mail');
        
    } /*
    
    This one hates vse mails...
    
    else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $message = "Invalid email format";
            array_push($errors, $message);
            array_push($invalidInputs, 'mail_invalid');
            
        }
       
    } */
    
    if ($password == '') {
        $message = "Pls enter password";
        array_push($errors, $message);
        array_push($invalidInputs, 'password');
    } else {
        if (strlen($password) < 8) {
            $message = "Your password is too short. Hmm....";
            array_push($errors, $message);
            array_push($invalidInputs, 'password_short');
        }
    }
    if ($address == '') {
        $message = 'Address is empty';
        array_push($errors, $message);
        array_push($invalidInputs, 'address');
    }
    if ($occupation == '') {
        $message = 'Are u unemployed? You are not.';
        array_push($errors, $message);
        array_push($invalidInputs, 'occupation');
    }
    if ($birthYear == '') {
        $message = 'When were you born? Tell me';
        array_push($errors, $message);
        array_push($invalidInputs, 'birthYear');
    }
    if ($avatar == '') {
        $message = 'Avatar is empty. Make sure you choose a unique one...';
        array_push($errors, $message);
        array_push($invalidInputs, 'avatar');
    }

   

    $users = getUsers();
    foreach ($users as $user) {
        $fields = explode(';', $user["mail"]);
        $existingMail = $fields[0];
        if ($existingMail == $mail) {
            array_push($errors, 'mail already exists');
            break;
        }
    }
    //insert
    if (empty($errors)) {
        $dbFile = './database.db';
        //$userRecord = "$email;$password;" . PHP_EOL;
        $userRecord = "$mail;$password;$firstName;$lastName;$address;$occupation;$birthYear" . "\r\n";
        file_put_contents($dbFile, $userRecord, FILE_APPEND);
        //reg complete co next
        header('Location: login.php');
        exit;
    }
}

?>

<?php require_once("./head.php") ?>
<div class="container w-50">
<form method="POST" >
    <?php if (!empty($errors)) : ?>

        <ul class="list-group">
            <?php foreach ($errors as $error) : ?>
                <li class="list-group-item list-group-item-danger m-2"><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <div class="text-center m-5">Form submitted successfully</div>
    <?php endif; ?>

    <div class="form-group row">
        <div class="col-sm">
            <label for="name">Name</label>
            <input name="firstName" class="form-control <?php echo in_array('firstName', $invalidInputs) ? ' is-invalid' : '' ?>" id="firstname" placeholder="Enter your name" value="<?php echo isset($firstName) ? $firstName : ''; ?>">
        </div>
        <div class="col-sm">
            <label>Lastname</label>
            <input name="lastName" class="form-control <?php echo in_array('lastName', $invalidInputs) ? ' is-invalid' : '' ?>" id="lastname" placeholder="Enter your lastname" value="<?php echo isset($lastName) ? $lastName : ''; ?>">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-l">
            <label>Mail</label>
            <input name="mail" type="mail" class="form-control <?php echo in_array('mail', $invalidInputs) ? ' is-invalid' : '' ?>" placeholder="Enter your mail" value="<?php echo isset($mail) ? $mail : ''; ?>">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-l">
            <label>Password</label>
            <input name="password" type="password" class="form-control <?php echo in_array('password', $invalidInputs) ? ' is-invalid' : '' ?>" placeholder="Enter your password" value="<?php echo isset($password) ? $password : ''; ?>">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-l">
            <label>Address</label>
            <input name="address" class="form-control <?php echo in_array('address', $invalidInputs) ? ' is-invalid' : '' ?>" placeholder="Enter your address" value="<?php echo isset($address) ? $address : ''; ?>">
        </div>
    </div>

    <div class="form-group row">
        <div class="col-l">
            <label>Occupation</label>
            <input name="occupation" class="form-control <?php echo in_array('occupation', $invalidInputs) ? ' is-invalid' : '' ?>" placeholder="Enter your occupation" value="<?php echo isset($occupation) ? $occupation : ''; ?>">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-l">
            <label>Birth Year</label>
            <input type="number" name="birthYear" class="form-control <?php echo in_array('birthYear', $invalidInputs) ? ' is-invalid' : '' ?>" value="<?php echo isset($birthYear) ? $birthYear : ''; ?>">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-l">
            <label>Avatar</label>
            <input type="file" name="avatar" class="form-control <?php echo in_array('avatar', $invalidInputs) ? ' is-invalid' : '' ?>" value="<?php echo isset($avatar) ? $avatar : ''; ?>">
        </div>
    </div>
    <div class="text-center pt-3">
        <button class="btn btn-primary btn-lg">Submit</button>
    </div>

</form>
</div>
<?php include './foot.php'; ?>
