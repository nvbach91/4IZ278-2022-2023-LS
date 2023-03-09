<?php include "head.php"; ?>
<?php

$errors = [];

if (!empty($_POST)) {
    $name = htmlspecialchars(trim($_POST['name']));
    $gender = htmlspecialchars(trim($_POST['gender']));
    $mail = htmlspecialchars(trim($_POST['mail']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $pfp = htmlspecialchars(trim($_POST['pfp']));
    $deckname = htmlspecialchars(trim($_POST['deckname']));
    $decksize = htmlspecialchars(trim($_POST['decksize']));

    if (!$name) {
        $message = 'Please enter a valid full name/nickname';
        array_push($errors, $message);
    }

    if (!in_array($gender, ['M', 'F', 'O'])) {
        $message = 'Please choose a gender';
        array_push($errors, $message);
    }

    if (!$mail) {
        $message = 'Please enter a valid e-mail address';
        array_push($errors, $message);
    }

    if (!$phone) {
        $message = 'Please enter a valid phone number';
        array_push($errors, $message);
    }
    
    if (!$pfp) {
        $message = 'Please enter a valid profile picture link';
        array_push($errors, $message);
    }

    if (!$deckname) {
        $message = 'Please enter a valid deckname';
        array_push($errors, $message);
    }

    if (!$decksize) {
        $message = 'Please enter a valid decksize';
        array_push($errors, $message);
    }
}


?>


<form class="form-signup" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <?php if (!empty($errors)): ?>
        <div>
            <?php foreach($errors as $error): ?>
                <p><?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
    <?php elseif (!empty($_POST)): ?>
        <p>Thank you for registering!</p>
    <?php endif; ?>
    <div>
        <label>Name</label>
        <input type="text" name="name" value="<?php echo isset($name) ? $name : ''; ?>">
    </div>
    <div>
        <label>Gender</label>
        <select name="gender">
            <option value="M"<?php echo isset($gender) && $gender == 'M' ? ' selected' : '' ?>>Male</option>
            <option value="F"<?php echo isset($gender) && $gender == 'F' ? ' selected' : '' ?>>Female</option>
            <option value="O"<?php echo isset($gender) && $gender == 'O' ? ' selected' : '' ?>>Others</option>
        </select>
    </div>
    <div>
        <label>E-mail</label>
        <input type="email" name="mail" value="<?php echo isset($mail) ? $mail : ''; ?>">
    </div>
    <div>
        <label>Phone</label>
        <input type="tel" name="phone" value="<?php echo isset($phone) ? $phone : ''; ?>">
    </div>
    <div>
        <label class="pfp">Profile picture</label>
        <?php if (isset($pfp) && $pfp != ""): ?>
            <img class="pfp" src="<?php echo $pfp ?>" alt="profile picture">
        <?php endif; ?>
        <input type="url" name="pfp" value="<?php echo isset($pfp) ? $pfp : ''; ?>">
    </div>
    <div>
        <label>Deckname</label>
        <input type="text" name="deckname" value="<?php echo isset($deckname) ? $deckname : ''; ?>">
    </div>
    <div>
        <label>Deck size</label>
        <input type="decksize" name="decksize" value="<?php echo isset($decksize) ? $decksize : ''; ?>">
    </div>
    <button>Submit</button>
</form>
<?php include "foot.php"; ?>