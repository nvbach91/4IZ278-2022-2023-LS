<?php 

$errors = [];

if (!empty($_POST)) {

    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $name = htmlspecialchars(trim($_POST['name']));
    $gender = htmlspecialchars(trim($_POST['gender']));
    $avatar = htmlspecialchars(trim($_POST['avatar']));
    $deck = htmlspecialchars(trim($_POST['deck']));
    $cards = htmlspecialchars(trim($_POST['cards']));


    if (!preg_match('/^[FMO]$/', $gender)) {
        $message = 'Invalid gender';
        array_push($errors, $message);
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Email is invalid';
        array_push($errors, $message);
    }
    if (strlen($email) == 0) {
        $message = 'Email is empty';
        array_push($errors, $message);
    }

   
    if (strlen($phone) == 0) {
        $message = 'Phone field is empty';
        array_push($errors, $message);
    }
    if (strlen($phone) != 9) {
        $message = 'Phone number is invalid';
        array_push($errors, $message);
    }
    

    //name
    if (strlen($name) == 0) {
        $message = 'Name field is empty';
        array_push($errors, $message);
    }

    //URL
    if (strlen($avatar) == 0) {
        $message = 'Avatar URL not submitted';
        array_push($errors, $message);
    }
    if (!filter_var($avatar, FILTER_VALIDATE_URL)) {
        $message = 'Atarar URL is invalid';
        array_push($errors, $message);
    }


    if (strlen($deck) == 0) {
        $message = 'Deck name is empty';
        array_push($errors, $message);
    }

    if ($cards <= 0) {
        $message = 'Invalid number of cards';
        array_push($errors, $message);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <form class="form-signup" method="POST" action=".">
        <h1>Registration form</h1>
        <?php if (!empty($errors)): ?>
            <div class="errors">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
            <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
                <p id="success">Form successfully submitted.</p>
            <?php endif; ?>
        <div class="form-group">
            <label>Name: </label>
            <input class="form-control" name="name" value="<?php echo isset($name) ? $name : ""; ?>">
        </div>
        <div class="form-group">
            <label>Gender: </label>
            <select name="gender">
                <option value="M" <?php echo isset($gender) && $gender == "M" ? ' selected' : ''; ?>>Male</option>
                <option value="F" <?php echo isset($gender) && $gender == "F" ? ' selected' : ''; ?>>Female</option>
                <option value="O" <?php echo isset($gender) && $gender == "O" ? ' selected' : ''; ?>>Other</option>
            </select>
        </div>
        <div class="form-group">
            <label>Email: </label>
            <input class="form-control" name="email" type="email" value="<?php echo isset($email) ? $email : ""; ?>">
        </div>
        <div class="form-group">
            <label>Phone: </label>
            <input class="form-control" name="phone" value="<?php echo isset($phone) ? $phone : ""; ?>">
        </div>
        <div class="form-group">
            <label>Avatar URL: </label>
            <input class="form-control" name="avatar" value="<?php echo isset($avatar) ? $avatar : ""; ?>">
        </div>
        <div class="form-group">
            <label>Deck name: </label>
            <input class="form-control" name="deck" value="<?php echo isset($deck) ? $deck : ""; ?>">
        </div>
        <div class="form-group">
            <label>Number of cards in the deck: </label>
            <input class="form-control" name="cards" type="number" value="<?php 
            echo isset($cards) ? $cards : ""; ?>">
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
        </form>
        <div class="image">
        <?php if (isset($avatar) && filter_var($avatar, FILTER_VALIDATE_URL)): ?>
            <img src="<?php echo $avatar ?>" alt="Avatar" class="avatar">
        <?php endif; ?>
        </div>
    </div>
</body>
</html>