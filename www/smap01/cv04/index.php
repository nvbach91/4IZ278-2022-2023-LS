<?php require './includes/header.php'; ?>
<?php require './validation.php'; ?>

<div class="col-form">
    <h1 class="title">Player registration</h1>
    <div class="messages_list" style="background-color:<?php echo empty($errors) ? 'green' : 'red' ?>;display:<?php echo isset($fullname) ? 'block' : 'none' ?>">
        <?php if (empty($errors) && !empty($_POST)) : ?>
            <p>Thank you for your registration!</p>
        <?php endif; ?>
        <?php foreach ($errors as $error) : ?>
            <p><?php echo $error; ?></p>
        <?php endforeach; ?>
    </div>
    <div class="body-form">
        <div class="avatar" style="display:<?php echo (empty($errors) && isset($fullname) && isset($package) && isset($avatar)) ? 'block;' : 'none;' ?>">
            <img src="<?php echo isset($avatar) ? $avatar : 'https://temank3.id/public/images/default.jpg' ?>" alt="avatar_image">
            <div class="info-col">
                <h3>Name: <?php echo isset($fullname) ? $fullname : '' ?></h3>
                <h3>Game: <?php echo isset($package) ? $package : '' ?></h3>
                <h3>Status: Ready</h3>
            </div>
        </div>
        <form class="signup_form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div>
                <label class="input_label required">Full name</label>
                <input name="fullname" class="input" type="text" value="<?php echo isset($fullname) ? $fullname : ''; ?>">
            </div>
            <div>
                <label class="input_label required">Gender</label>
                <select name="gender" class="input">
                    <option value="F" <?php echo isset($gender) && $gender == 'F' ? ' selected' : '' ?>>Female</option>
                    <option value="M" <?php echo isset($gender) && $gender == 'M' ? ' selected' : '' ?>>Male</option>
                    <option value="O" <?php echo isset($gender) && $gender == 'O' ? ' selected' : '' ?>>Other</option>
                </select>
            </div>
            <div>
                <label class="input_label required">E-mail</label>
                <input name="email" class="input" type="text" value="<?php echo isset($email) ? $email : ''; ?>">
            </div>
            <div>
                <label class="input_label required">Password</label>
                <input name="password" class="input" type="password" value="<?php echo isset($password) ? $password : ''; ?>">
            </div>
            <div>
                <label class="input_label required">Password confirmation</label>
                <input name="passwordVal" class="input" type="password" value="<?php echo isset($passwordVal) ? $passwordVal : ''; ?>">
            </div>
            <div>
                <label class="input_label required">Phone number</label>
                <input name="phone" class="input" type="text" value="<?php echo isset($phone) ? $phone : ''; ?>">
            </div>
            <div>
                <label class="input_label required">Profile picture URL</label>
                <input name="avatar" class="input" type="text" value="<?php echo isset($avatar) ? $avatar : ''; ?>">
            </div>
            <div>
                <label class="input_label required">Deck name</label>
                <input name="package" class="input" type="text" value="<?php echo isset($package) ? $package : ''; ?>">
            </div>
            <div>
                <label class="input_label required">Number of cards</label>
                <input name="cardNum" class="input" type="text" value="<?php echo isset($cardNum) ? $cardNum : ''; ?>">
                <label class="legend_label">Field is mandatory</label>
            </div>
            <button>Submit</button>
        </form>
    </div>
</div>
<?php require './includes/footer.php' ?>