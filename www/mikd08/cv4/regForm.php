<?php 
    session_start();

    // var_dump($_POST);
    require "funcs.php";

    $errors = [];
    $errorMsg = " is empty";

    if (!empty($_POST)) {
        $password = htmlspecialchars(trim($_POST["password"]));
        $confPassword = htmlspecialchars(trim($_POST["confPassword"]));
        $phone = htmlspecialchars(trim($_POST["phone"]));
        $email = htmlspecialchars(trim($_POST["email"]));
        $gender = htmlspecialchars(trim($_POST["gender"]));
    
        if (!preg_match("/^Male|Female|Other$/", $gender)) {
            array_push($errors, "Invalid gender");
        }
        if ($password == "") {
            array_push($errors, "Password".$errorMsg);
        }
        if ($phone == "") {
            array_push($errors, "Phone".$errorMsg);  
        } else if (strlen($phone) != 9) {
            array_push($errors, "Phone has wrong amount of digits");
        } 
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Email not valid");
        }
        if ($confPassword != $password) {
            array_push($errors, "Password confirmation invalid");
        }
      
        $registeredUser = getUser($email);
        if ($registeredUser != null) {
            array_push($errors, "User exists already");
        }

        if (empty($errors)) {
            $databasePath = "users.db";
            $userRecord = "$email;$phone;$password;$gender\n";
            file_put_contents($databasePath, $userRecord, FILE_APPEND);
            // var_dump(file_get_contents($databasePath));
            header("Location: login.php");
            $_SESSION["registered"] = true;
            exit;
        }


    }

?>

<form action="index.php" method="POST">
    <h1>Sign in</h1>

    <div class="inputSection">
        <label for="gender">Gender</label>
        <br>
        <select name="gender" id="genderSelection">
            <option value="Male"<?php echo isset($gender) && $gender == "Male" ? " selected" : null; ?>>Male</option>
            <option value="Female"<?php echo isset($gender) && $gender == "Female" ?  " selected" : null; ?>>Female</option>
            <option value="Other"<?php echo isset($gender) && $gender == "Other" ?  " selected" : null; ?>>Other</option>
        </select>
    </div>
    <div class="inputSection">
        <label for="email">Email</label>
        <br>
        <input type="text" name="email" placeholder="email" value="<?php if (isset($email)) echo $email?>">
    </div>
    <div class="inputSection">
        <label for="phone">Phone</label>
        <br>
        <input type="number" name="phone" placeholder="phone" value="<?php if (isset($phone)) echo $phone?>">
    </div>
    <div class="inputSection">
        <label for="password">Password</label>
        <br>
        <input type="password" name="password" placeholder="password" value="<?php if (isset($password)) echo $password?>">
    </div>
    <div class="inputSection">
        <label for="confPassword">Confirm password</label>
        <br>
        <input type="password" name="confPassword" placeholder="confirm password" value="<?php if (isset($confPassword)) echo $confPassword?>">
    </div>
    <br>
    <button style="margin-top: 20px;">Submit</button>
</form>
<div>
<?php if(!empty($errors)):?>
    <?php foreach ($errors as $error): ?>
        <p><b><?php echo $error?></b></p>
    <?php endforeach?>
<?php elseif (!empty($_POST)):?>
    <h2>The form was succesfully sent</h2>
<?php endif ?>

</div>