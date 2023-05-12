<body>
    <h1>Login Form</h1>
    <form class='form' method='POST' action='<?php echo $_SERVER['PHP_SELF']; ?>'>
        <div class='errors'>
            <?php foreach ($errors as $error) : ?>
                <a><?php echo $error; ?></a><br>
            <?php endforeach; ?>
        </div>
        <div class='successfull'>
            <?php foreach ($successes as $success) : ?>
                <a><?php echo $success; ?></a><br>
            <?php endforeach; ?>
        </div>

        <div class='input'>
            <label>E-mail*</label>
            <br><input type='text' name='email' placeholder="Example: J.Johnson@gmail.com" value=<?php echo isset($email) ? $_POST['email'] : '' ?>>
        </div>
        <div class='input'>
            <label>Password*</label>
            <br><input type='password' name='password' value=<?php echo isset($password) ? $_POST['password'] : '' ?>>
        </div>
        <div class='submit-button'>
            <input type='submit' value='Log in'>
        </div>
    </form>
</body>

</html>