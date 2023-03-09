<?php 
    // var_dump($_POST);

    $errors = [];
    $errorMsg = " is empty";

    if (!empty($_POST)) {
        $name = htmlspecialchars(trim($_POST["name"]));
        $phone = htmlspecialchars(trim($_POST["phone"]));
        $pic = htmlspecialchars(trim($_POST["pic"]));
        $email = htmlspecialchars(trim($_POST["email"]));
        $gender = htmlspecialchars(trim($_POST["gender"]));
        $deckName = htmlspecialchars(trim($_POST["deckName"]));
        $amountOfCards = htmlspecialchars(trim($_POST["amountOfCards"]));
    
        if (!preg_match("/^Male|Female|Other$/", $gender)) {
            array_push($errors, "Invalid gender");
        }
        if ($name == "") {
            array_push($errors, "Name".$errorMsg);
        }
        if ($phone == "") {
            array_push($errors, "Phone".$errorMsg);  
        } else if (strlen($phone) != 9) {
            array_push($errors, "Phone has wrong amount of digits");
        } 
        if (!filter_var($pic, FILTER_VALIDATE_URL)) {
            array_push($errors, "Picture URL not valid");
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Email not valid");
        }
        if ($deckName == "") {
            array_push($errors, "Deck name".$errorMsg);
        }        
        if ($amountOfCards == "") {
            array_push($errors, "Amount of cards".$errorMsg);
        }

    }

?>

<form action="index.php" method="POST">
    <h1>Sign in</h1>
    <div class="inputSection">
        <label for="name">Name</label>
        <br>
        <input type="text" name="name" placeholder="name" value="<?php if (isset($name)) echo $name?>">
    </div>
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
        <label for="pic">Picture URL</label>
        <br>
        <input type="text" name="pic" placeholder="picture url" value="<?php if (isset($pic)) echo $pic?>">
    </div>
    <div class="inputSection">
        <label for="deckName">Deck Name</label>
        <br>
        <input type="text" name="deckName" placeholder="deckName" value="<?php if (isset($deckName)) echo $deckName?>">
    </div>
    <div class="inputSection">
        <label for="amountOfCards">Amount of cards</label>
        <br>
        <input type="number" name="amountOfCards" placeholder="amountOfCards" value="<?php if (isset($amountOfCards)) echo $amountOfCards?>">
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
            <div id="avatar">
                <div id="imgContainer"><img src="<?php echo $pic?>" alt="profile picture"></div>
                <div><?php echo $name?></div>
                <div><?php echo $gender?></div>
                <div><?php echo $email?></div>
                <div><?php echo $phone?></div>
                <div><?php echo $deckName?></div>
                <div><?php echo $amountOfCards?></div>
            </div>
        <?php endif ?>        
    </div>