<?php



$errors = [];

if (!empty($_POST)) {
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $nickname = $_POST['nickname'];
    $gender = $_POST['gender'];
    $photo = $_POST['photo'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Email is not valid';
        array_push($errors, $message);
    }

    if(!preg_match("/^[FM]$/", $gender)) {
        $message = 'Invalid gender';
        array_push($errors, $message);
    }

    if ($email == '') {
        $message = 'Email is empty';
        array_push($errors, $message);
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Invalid email adress';
        array_push($errors, $message);
    }
    if ($phone == '') {
        $message = 'Phone is empty';
        array_push($errors, $message);
    }

    if ($nickname == '') {
        $message = 'Nickname is empty';
        array_push($errors, $message);
    }

    if (strlen($phone) != 9) {
        $message = 'Phone does not have 9 numbers';
        array_push($errors, $message);
    }

    if (!filter_var($photo, FILTER_VALIDATE_URL)) {
        $message = 'Invalid photo';
        array_push($errors, $message);
    }
}



?>



<form method="POST" action=".">
    <?php if (!empty($errors)) : ?>
        <div>
            <?php foreach ($errors as $error) : ?>
                <p>
                    <?php echo $error; ?>
                </p>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
            <div>
                Form submitted successfully
            </div>
    <?php endif; ?>

    <form>

    <div>
            <label>Gender</label>
            <select name="gender">
                <option value= "F">Female</option>
                <option value= "M">Male</option>
            </select>
         </div>

        <div>
            <label>Email</label>
            <input name="email" type="email" value="<?php if (isset($email)) echo $email ?>">
        </div>


        <div>
            <label>Phone</label>
            <input name="phone" type="tel" value="<?php if (isset($phone)) echo $phone ?>">
        </div>

        <div>
            <label>Nickname</label>
            <input name="nickname" value="<?php if (isset($nickname)) echo $nickname ?>">
        </div>

        <div>
            <label>Photo</label>
        <input name="photo" type="url" value="<?php if (isset($photo)) echo $photo ?>">
        </div>


        <div class="photo-container">
            <?php if(isset($photo)) : ?>
                <img src="<?php echo $photo ?>">

        <?php endif; ?>


        <button>Submit</button>

    </form>