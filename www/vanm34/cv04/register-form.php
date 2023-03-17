<?php
$errors = [];
require 'utils.php';

$formSubmitted = !empty($_POST);
if($formSubmitted){
    $firstName = htmlspecialchars(trim(empty( $_POST["firstname"] )? "" : $_POST['firstname']));
    $lastName = htmlspecialchars(trim(empty( $_POST["lastname"] )? "" : $_POST['lastname']));
    $email = htmlspecialchars(trim(empty( $_POST["email"] )? "" : $_POST['email']));
    $password = htmlspecialchars(trim(empty( $_POST["password"] )? "" : $_POST['password']));
    $confPassword = htmlspecialchars(trim(empty( $_POST["confPassword"] )? "" : $_POST['confPassword']));
    $phone = htmlspecialchars(trim(empty( $_POST["phone"] )? "" : $_POST['phone']));
    $gender = htmlspecialchars(trim(empty( $_POST["gender"] )? "" : $_POST['gender']));
    $avatar = htmlspecialchars(trim(empty( $_POST["avatar"] )? "" : $_POST['avatar']));


    if (!preg_match('/^[a-zA-Z]/', $firstName)) {
        $message = 'First name is incorrect!';
        array_push($errors, $message);
    }

    if (!preg_match('/^[a-zA-Z]/', $lastName)) {
        $message = 'Last name is incorrect!';
        array_push($errors, $message);
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $massage = 'Email is empty';
        array_push($errors, $massage);
    }

    if ($confPassword != $password) {
        $message = 'Passwords does not match';
        array_push($errors, $message);
    }    

    if(!preg_match('/^\d{9}$/', $phone)){
        $massage = 'phone is not in right format';
        array_push($errors, $massage);
    }

    if(!preg_match('/^[FMO]$/', $gender)){
        $massage = 'gender is not in right format';
        array_push($errors, $massage);
    }

    if(!filter_var($avatar, FILTER_VALIDATE_URL)){
        $massage = 'wrong format of URL';
        array_push($errors, $massage);
    }

    $existingUser = getUser($email);
    if ($existingUser != null) {
        array_push($errors, 'User with same email already exists');
    }

    if (empty($errors) && !empty($_POST)) {
        $databaseFilePath = './users.db';
        $userRecord = "$firstName;$lastName;$email;$password;$phone;$gender;$avatar" . PHP_EOL; //PHP_EOL ...end of line
        file_put_contents($databaseFilePath, $userRecord, FILE_APPEND);
        mail($email,'Registration','Thank you for your registration!');
        header("Location: login.php");
        exit;
    }
}

?>

<form method = "POST" action = ".">
    <h1 class = "h1">PHP form</h1>

    <?php if (!empty($errors)): ?>
    <div>
        <?php foreach($errors as $error):?>
            <p class="errorMessage"> <?php  echo $error?></p>
            <?php endforeach;?>
    </div>
    <?php else: ?>
        <div class="succsesText">You are signed in!</div>
    <?php endif; ?>

    <div class = "userInfo">
        <div>
            <input class = "inputNames" name = "firstname" placeholder = "First Name" value = "<?php echo isset($firstName) ? $firstName : "" ?>">
            <input class = "inputNames" name = "lastname" placeholder = "Last Name" value = "<?php echo isset($lastName) ? $lastName : "" ?>">
        <div>
            <input name = "email" placeholder = "Email" value = "<?php echo isset($email) ? $email : "" ?>">
        </div>
        <div>    
            <input name = "password" placeholder = "Password" value = "<?php echo isset($password) ? $password : "" ?>">
            <input name = "confPassword" placeholder = "Confirm Password" value = "<?php echo isset($confPassword) ? $confPassword : "" ?>">
        </div>
        <div>    
            <input name = "phone" placeholder = "Phone Number" value = "<?php echo isset($phone) ? $phone : "" ?>">
        </div>
        <div>    
            <input name = "avatar" placeholder = "Avatar URL" value = "<?php echo isset($avatar) ? $avatar : "" ?>">
            <img class="avatar" src="<?php echo $avatar ?>" alt="avatar">
        </div>
        <div>    
            <label> Gender </label>
            <select name = "gender">
                <option value="M" <?php echo isset($gender) && $gender == 'M' ? 'selected' : "" ?>>Male</option>
                <option value="F" <?php echo isset($gender) && $gender == 'F' ? 'selected' : "" ?>>Female</option>
                <option value="O" <?php echo isset($gender) && $gender == 'O' ? 'selected' : "" ?>>Other</option>
            </select>
        </div>
        <button>Submit</button>
    </div>
</form>