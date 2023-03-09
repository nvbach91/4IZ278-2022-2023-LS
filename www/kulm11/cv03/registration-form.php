<?php
$errors = [];
$success = False;
if(!empty($_POST)){
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $phone = htmlspecialchars(trim($_POST["phone"]));
    $gender = htmlspecialchars(trim($_POST["gender"]));
    $avatar = htmlspecialchars(trim($_POST["avatar"]));
    $deckName = htmlspecialchars(trim($_POST["deckName"]));
    $cardsAmount = htmlspecialchars(trim($_POST["cardsAmount"]));

    if($name == ""){
        array_push($errors, "Name is empty!");
    }

    if($email == ""){
        array_push($errors, "Email is empty!");
    }

    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
       array_push($errors, "Email is not valid!");
    }

    if($phone == ""){
        array_push($errors, "Phone is empty!");
    }
    else if(!preg_match('/^\d{9}$/',$phone)){
        array_push($errors, "Phone is not valid!");
    }
    if(!preg_match('/^[FMNO]$/', $gender)){
        array_push($errors, "Gender is not valid!");
    }

    if($avatar == ""){
        array_push($errors, "Avatar URL is empty!");
    }

    else if(!filter_var($avatar, FILTER_VALIDATE_DOMAIN)){
        array_push($errors, "Avatar URL is not valid!");
    }

    if($deckName == ""){
        array_push($errors, "Deck name is empty!");
    }

    if($cardsAmount == ""){
        array_push($errors, "Amount of cards is empty!");
    }

    else if(!filter_var($cardsAmount, FILTER_VALIDATE_INT)){
        array_push($errors, "Amount of cards is not valid!");
    }

    if (empty($errors)){
        $success = True;
    }
}
?>
<div class="content">
    <h1>PHP Form Validation</h1>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">

        <div class="success"<?php echo $success===True && !empty($_POST) && empty($errors) ? "" : " hidden"?>>
            <?php if ($success===True && !empty($_POST) && empty($errors)): ?>
                <p>Thank you for your registration!</p>
                <img height="100" src="<?php echo $avatar; ?>">
            <?php endif; ?>
        </div>
        <div class="errors" <?php echo empty($errors) ? " hidden" : ""?>>
            <?php foreach($errors as $error): ?>
                <p><?php echo $error; ?> </p>
            <?php endforeach; ?>
        </div>
        <div class="inputs">
            <label>Name</label>
            <input name="name" value="<?php echo isset($name) ? $name : ""; ?>">
        </div>
        <div class="inputs">
            <label>E-mail</label>
            <input name="email" value="<?php echo isset($email) ? $email : ""; ?>">
        </div>
        <div class="inputs">
            <label>Phone</label>
            <input name="phone" value="<?php echo isset($phone) ? $phone : ""; ?>">
        </div>
        <div class="inputs">
            <label>Gender</label>
            <select name="gender">
                <option value="F"<?php echo isset($gender) && $gender ==="F" ? " selected" : ""?>>Female</option>
                <option value="M"<?php echo isset($gender) && $gender ==="M" ? " selected" : ""?>>Male</option>
                <option value="N"<?php echo isset($gender) && $gender ==="N" ? " selected" : ""?>>Non-binary</option>
                <option value="O"<?php echo isset($gender) && $gender ==="O" ? " selected" : ""?>>Other/Prefer to not answer</option>
            </select>
        </div>
        <div class="inputs">
            <label>Avatar URL</label>
            <input name="avatar" value="<?php echo isset($avatar) ? $avatar : ""; ?>">
        </div>
        <div class="inputs">
            <label>Deck name</label>
            <input name="deckName" value="<?php echo isset($deckName) ? $deckName : ""; ?>">
        </div>
        <div class="inputs">
            <label>Amount of cards</label>
            <input name="cardsAmount" value="<?php echo isset($cardsAmount) ? $cardsAmount : ""; ?>">
        </div>

        <button>Submit</button>
    </form>
</div>