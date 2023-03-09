<?php


$invalidInputs = [];
$alertMessages = [];

// check if form is submitted
$submittedForm = !empty($_POST);
if ($submittedForm) {
    $name = htmlspecialchars(trim($_POST['name']));
    $gender = htmlspecialchars(trim($_POST['gender']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $profileImage = htmlspecialchars(trim($_POST['profileImage']));

        // check for empty name
    if (!$name || !preg_match('/^[a-zA-Z]+(?:\s[a-zA-Z]+)+$/', $name)) {
        array_push($alertMessages, 'Please enter your name!');
        array_push($invalidInputs, 'name');
    }

    // check for bad gender
    if (!in_array($gender, ['N', 'F', 'M'])) {
        array_push($alertMessages, 'Please select a gender!');
        array_push($invalidInputs, 'gender');
    }

    // check for bad email
    if (!preg_match('/\b[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Z|a-z]{2,}\b/', $email)) {
        array_push($alertMessages, 'Please use a valid email!');
        array_push($invalidInputs, 'email');
    }

    // check for bad phone numbers
    if (!preg_match('/^\+?[0-9]{1,3}\s?\-?\(?\d{1,4}\)?[\s.\-]?\d{1,4}[\s.\-]?\d{1,4}$/', $phone)) {
        array_push($alertMessages, 'Please use a valid phone number!');
        array_push($invalidInputs, 'phone');
    }

    // check for profileImage URL
    if (!filter_var($profileImage, FILTER_VALIDATE_URL)) {
        array_push($alertMessages, 'Please use a valid URL for your profile image!');
        array_push($invalidInputs, 'profileImage');
    }

    // if no errors at all: display success
    if (!count($alertMessages)) {
        $alertType = 'alert-success';
        $alertMessages = ['Woohoo! You have successfully signed up!'];
    }
    else {
        $alertType = 'alert-danger';
    }
}

?>

<?php include './includes/head.php'; ?>
<main class="container mt-3">
    <h1 class="text-center">Poker Night</h1>
    <h2 class="text-center">Registration form</h2>
    <div class="container mt-3">
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <?php if ($submittedForm): ?>
            <div class="alert <?php echo $alertType; ?>">
            <?php echo implode('<br>', $alertMessages); ?>
            </div>
            <?php endif; ?>
            <div class="mb-3">
                <label for="InputEmail" class="form-label">Email address</label>
                <input class="form-control<?php echo in_array('email', $invalidInputs) ? ' is-invalid' : '' ?>" name="email" value="<?php echo isset($email) ? $email : '' ?>">
                <div id="emailHelp" class="form-text">Example: slash@mail.com</div>
            </div>
            <div class="mb-3">
                <label for="InputFullName" class="form-label">Name</label>
                <input class="form-control<?php echo in_array('name', $invalidInputs) ? ' is-invalid' : '' ?>" name="name" value="<?php echo isset($name) ? $name : '' ?>">
                <div id="nameHelp" class="form-text">Example: Ondrej Nagraver</div>
            </div>
            <div class="mb-3">
            <label>Gender</label>
                <select class="form-control mt-2" name="gender">
                    <option value="N"<?php echo isset($gender) && $gender === 'N' ? ' selected' : '' ?>>Not selected</option>
                    <option value="F"<?php echo isset($gender) && $gender === 'F' ? ' selected' : '' ?>>Female</option>
                    <option value="M"<?php echo isset($gender) && $gender === 'M' ? ' selected' : '' ?>>Male</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="InputPhone" class="form-label">Phone Number</label>
                <input class="form-control<?php echo in_array('name', $invalidInputs) ? ' is-invalid' : '' ?>" name="phone" value="<?php echo isset($phone) ? $phone : '' ?>">
                <div id="phoneHelp" class="form-text">Example: +420685909843</div>
            </div>
            <div class="mb-3">
                <label for="InputImage" class="form-label">Profile Image</label>
                <div>
                    <?php if (isset($profileImage) && $profileImage): ?>
                    <img class="profileImage" height="150px" src="<?php echo $profileImage; ?>" alt="profileImage">
                    <?php endif; ?>
                </div>
                <input class="form-control<?php echo in_array('profileImage', $invalidInputs) ? ' is-invalid' : '' ?>" name="profileImage" value="<?php echo isset($profileImage) ? $profileImage : ''; ?>">
                <div id="imageHelp" class="form-text">Example: https://upload.wikimedia.org/wikipedia/commons/0/07/Big_Floppa_1869.jpg</div>
            </div>
            <div class="d-grid gap-2">

            <button type="submit" class="btn btn-info">Submit</button>
            </div>

        </form>
    </div>
</main>