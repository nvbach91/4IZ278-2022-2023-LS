<?php


$errors = [];
$invalidInputs = [];

// check if form is submitted
if (!empty($_POST)) {

    $firstName = htmlspecialchars(trim($_POST['firstName']));
    $lastName = htmlspecialchars(trim($_POST['lastName']));
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
}
?>
<form method="POST" action=".">
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
        <button type="submit" class="btn btn-primary btn-lg">Submit</button>
    </div>

</form>