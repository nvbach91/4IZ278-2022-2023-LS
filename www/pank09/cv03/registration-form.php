<?php
$errors = [];

// Check if form is submitted
if (!empty($_POST)) {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $gender = htmlspecialchars(trim($_POST['gender']));
    $avatar = htmlspecialchars(trim($_POST['avatar']));
    $deck_name = htmlspecialchars(trim($_POST['deck_name']));
    $cards_num = htmlspecialchars(trim($_POST['cards_num']));

    // Check for bad name
    if ($name == '')
        array_push($errors, 'Name is empty');

    // Check for bad email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        array_push($errors, 'Email is not valid');

    // Check for bad phone
    if (strpos($phone, '+') !== 0)
        array_push($errors, 'Phone does not have leading + sign');

    if (strlen($phone) != 13)
        array_push($errors, 'Phone does not have 12 numbers');

    // Check for gender
    if (!preg_match('/^[FMO]$/', $gender))
        array_push($errors, 'Gender is not valid');

    // Check for bad avatar url
    if (!filter_var($avatar, FILTER_VALIDATE_URL)) {
        array_push($errors, 'Avatar URL is not valid');
        unset($avatar);
    }

    // Check for bad deck name
    if ($deck_name == '')
        array_push($errors, 'Deck name is empty');

    // Check for bad number of cards
    if (!filter_var($cards_num, FILTER_VALIDATE_INT))
        array_push($errors, 'Number of cards in deck is not valid');

    // insert data to DB
    // only after all successful validations
}
?>
<div class="container">
    <div class="form-wrapper">
        <h1>Registration</h1>

        <form action="." method="POST">

            <?php if (!empty($errors)): ?>
                <div class="message error">
                    <ul>
                        <?php foreach($errors as $error): ?>
                            <li><?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php elseif (!empty($_POST)): ?>
                <div class="message success">Form submitted successfully</div>
            <?php endif; ?>

            <div class="field">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="<?php echo $name ?? ''; ?>">
            </div>
            <div class="field">
                <label for="email">E-mail</label>
                <input type="text" name="email" id="email" value="<?php echo $email ?? ''; ?>">
            </div>
            <div class="field">
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" value="<?php echo $phone ?? '+420'; ?>">
            </div>
            <div class="field">
                <label for="gender">Gender</label>
                <select name="gender" id="gender">
                    <option <?php echo (isset($gender) && $gender === 'M') ? 'selected' : ''; ?> value="M">Male</option>
                    <option <?php echo (isset($gender) && $gender === 'F') ? 'selected' : ''; ?> value="F">Female</option>
                    <option <?php echo (isset($gender) && $gender === 'O') ? 'selected' : ''; ?> value="O">Other</option>
                </select>
            </div>
            <div class="field">
                <label for="avatar">Avatar URL*</label>
                <?php if (isset($avatar)): ?>
                    <img src="<?php echo $avatar; ?>" alt="" width="100" height="100"><br>
                <?php endif; ?>
                <input type="text" name="avatar" id="avatar" value="<?php echo $avatar ?? ''; ?>">
            </div>
            <div class="field">
                <label for="deck_name">Deck name</label>
                <input type="text" name="deck_name" id="deck_name" value="<?php echo $deck_name ?? ''; ?>">
            </div>
            <div class="field">
                <label for="cards_num">Number of cards in deck</label>
                <input type="text" name="cards_num" id="cards_num" value="<?php echo $cards_num ?? ''; ?>">
            </div>
            <button type="submit">Sign up</button>
        </form>
    </div>
</div>