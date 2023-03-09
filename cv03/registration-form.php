<?php
$errors = [];
if (!empty($_POST)) {

    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $gender = htmlspecialchars(trim($_POST['gender']));
    $name = htmlspecialchars(trim($_POST['name']));


    if (!preg_match('/^[FMO]$/', $gender)) {
        $message = "Invalid gender";
        array_push($errors, $message);
    }

    $name = $_POST['name'];
    if ($name == '') {
        $message = 'Name is empty!';
        array_push($errors, $message);
    }


    //check if form is submitted
    $email = $_POST['email'];
    // check for bad mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Email is not valid';
        array_push($errors, $message);
    }

    if ($email == '') {
        $message = 'Email is empty!';
        array_push($errors, $message);
    }


    $phone = $_POST['phone'];
    if ($phone == '') {
        $message = 'Phone is empty!';
        array_push($errors, $message);
    }
    if (strlen($phone) != 9) {
        $message = 'Phone doesn`t  have 9 numbers!';
        array_push($errors, $message);
    }

    $avatar = $_FILES['avatar'];
    if(!file_exists($_FILES['avatar']['tmp_name'])) {
        $message = "You didn't upload file";
        array_push($errors,$message);
    }{
        $tmp = $_FILES['avatar']['tmp_name'];
        $imgname = $_FILES['avatar']['name'];
        $path = "images/".$imgname;
        move_uploaded_file($tmp,$path);
    }
    // insert data to database
    //only after all successful validations
}

//if(){

//} else {

//}
// x ? a : b;
?>
<form method="POST" action="." enctype="multipart/form-data" >
    <?php if (!empty($errors)) : ?>
        <div>
            <?php foreach ($errors as $error) : ?>
                <p><?php echo $error ?></p>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <div class = "submitForm"><p> Form submitted successfully</p></div>
    <?php endif; ?>
    <div>
        <label>name</label>
        <input name='name' value="<?php echo isset($name) ? $name : ''; ?>">
    </div>
    <div>
        <label>e-mail</label>
        <input name="email" type="email" value="<?php echo isset($email) ? $email : ''; ?>">

    </div>
    <div>
        <label>Phone</label>
        <input name="phone" value="<?php echo isset($phone) ? $phone : ''; ?>">
    </div>
    <div>
        <label>Gender</label>
        <select name='gender'>
            <option value="F" <?php isset($gender) && $gender == 'F' ? ' selected' : '' ?>>Female</option>
            <option value="M" <?php isset($gender) && $gender == 'M' ? ' selected' : '' ?>>Male</option>
            <option value="O" <?php isset($gender) && $gender == 'O' ? ' selected' : '' ?>>Others</option>
        </select>
    </div>
    <div>
        <input name='avatar' type='file' value="<?php echo isset($avatar) ? $avatar : ''; ?>">
    </div>
    <div class="img">
    <img src="<?php echo $path ?>" width = "200px" alt = "<?php echo $imgname ?>" >
    </div>
    <button>Submit</button>
</form>