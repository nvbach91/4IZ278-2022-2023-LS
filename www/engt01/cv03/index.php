<?php
$errors = [];
$email = "";
$name = "";
$gender = "";
$tel = "";
$avatar = "";
$packName = "";
$packSize = 1;

if (!empty($_POST)) {
    $email = htmlspecialchars(trim($_POST["email"]));
    $name = htmlspecialchars(trim($_POST["name"]));
    $gender = htmlspecialchars(trim($_POST["gender"]));
    $tel = htmlspecialchars(trim($_POST["tel"]));
    $avatar = htmlspecialchars(trim($_POST["avatar"]));
    $packName = htmlspecialchars(trim($_POST["packName"]));
    $packSize = htmlspecialchars(trim($_POST["packSize"]));

    if ($email == "") {
        $errors[] = "email is empty";
    }

    if ($name == "") {
        $errors[] = "name is empty";
    }

    if ($tel == "") {
        $errors[] = "phone is empty";
    }

    if ($avatar == "") {
        $errors[] = "profile picture is empty";
    }

    if ($packName == "") {
        $errors[] = "pack name is empty";
    }

    if ($packSize == 0) {
        $errors[] = "pack is empty";
    }
}

if (!empty($errors)) $success = true;

require "header.php";
?>
<h1>Registration form</h1>
<?php if (!empty($errors)): ?>
    <div>
        <?php foreach ($errors as $error): ?>
            <p><?php echo $error ?></p>
        <?php endforeach; ?>
    </div>
<?php elseif (!empty($_POST)): ?>
    <div>Úspěšně registrováno.</div><br>
    <img src="<?php echo $avatar ?>" alt="profile picture" width="200" height="200" style="object-fit: cover">
    <br>
<?php endif; ?>
<form action="." method="POST">
    <label for="name">Name*</label>
    <input id="name" name="name" type="text" value="<?php echo $name ?>">
    <br><br>
    <label for="gender">Gender*</label>
    <select name="gender" id="gender">
        <option value="male" <?php if ($gender == "male") echo "selected" ?>>Male</option>
        <option value="female" <?php if ($gender == "female") echo "selected" ?>>Female</option>
        <option value="other" <?php if ($gender == "other") echo "selected" ?>>Other</option>
    </select>
    <br><br>
    <label for="email">E-mail*</label>
    <input id="email" name="email" type="email" value="<?php echo $email ?>">
    <br><br>
    <label for="tel">Phone*</label>
    <input id="tel" name="tel" type="tel" value="<?php echo $tel ?>">
    <br><br>
    <label for="avatar">Profile picture*</label>
    <input id="avatar" name="avatar" type="url" value="<?php echo $avatar ?>">
    <br><br>
    <label for="packName">Pack name*</label>
    <input id="packName" name="packName" type="text" value="<?php echo $packName ?>">
    <br><br>
    <label for="packSize">Pack size *</label>
    <input id="packSize" name="packSize" type="number" min="1" value="<?php echo $packSize ?>">
    <br><br>
    <button>Send</button>
</form>
<?php require "footer.php" ?>
