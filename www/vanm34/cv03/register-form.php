<?php
$errors = [];

if(!empty($_POST)){
    $firstName = htmlspecialchars(trim(empty( $_POST["firstname"] )? "" : $_POST['firstname']));
    $lastName = htmlspecialchars(trim(empty( $_POST["lastname"] )? "" : $_POST['lastname']));
    $email = htmlspecialchars(trim(empty( $_POST["email"] )? "" : $_POST['email']));
    $phone = htmlspecialchars(trim(empty( $_POST["phone"] )? "" : $_POST['phone']));
    $gender = htmlspecialchars(trim(empty( $_POST["gender"] )? "" : $_POST['gender']));
    $avatar = htmlspecialchars(trim(empty( $_POST["avatar"] )? "" : $_POST['avatar']));
    $deckName = htmlspecialchars(trim(empty( $_POST["deckName"] )? "" : $_POST['deckName']));
    $cardsCount = htmlspecialchars(trim(empty( $_POST["cardsCount"] )? "" : $_POST['cardsCount']));


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

    if(!preg_match('/^\d{9}$/', $phone)){
        $massage = 'phone is not in right format';
        array_push($errors, $massage);
    }

    if(!preg_match('/^[FMO]$/', $gender)){
        $massage = 'phone is not in right format';
        array_push($errors, $massage);
    }

    if(!filter_var($avatar, FILTER_VALIDATE_URL)){
        $massage = 'wrong format of URL';
        array_push($errors, $massage);
    }

    if(!filter_var($avatar, FILTER_VALIDATE_URL)){
        $massage = 'wrong format of URL';
        array_push($errors, $massage);
    }

    if (!preg_match('/^[a-zA-Z]/', $deckName)) {
        $message = 'Number of cards is invalid';
        array_push($errors, $message);
    }

    if(!filter_var($cardsCount, FILTER_VALIDATE_INT) || $cardsCount < 0){
        $message = 'Number of cards is invalid';
        array_push($errors, $message);
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
            <input class = "inputNames" name = "firstname" placeholder = "Fist Name" value = "<?php echo isset($firstName) ? $firstName : "" ?>">
            <input class = "inputNames" name = "lastname" placeholder = "Last Name" value = "<?php echo isset($lastName) ? $lastName : "" ?>">
        <div>
            <input name = "email" placeholder = "Email" value = "<?php echo isset($email) ? $email : "" ?>">
        </div>
        <div>    
            <input name = "phone" placeholder = "Phone Number" value = "<?php echo isset($phone) ? $phone : "" ?>">
        </div>
        <div>    
            <input name = "avatar" placeholder = "Avatar URL" value = "<?php echo isset($avatar) ? $avatar : "" ?>">
            <img class="avatar" src="<?php echo $avatar ?>" alt="avatar">
        </div>
        <div>    
            <input name = "deckName" placeholder = "Name of the Deck" value = "<?php echo isset($deckName) ? $deckName : ""  ?>">
        </div>
        <div>    
            <input name = "cardsCount" placeholder = "Number of Cards" value = "<?php echo isset($cardsCount) ? $cardsCount : ""  ?>">
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