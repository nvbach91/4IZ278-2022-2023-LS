<?php include '../controller/signin_controller.php' ?>

<?php require __DIR__ . "/incl/header.php"; ?>
<h1>DiscShop</h1>
<h2>Sign in</h2>
<form class="form" method="POST">
    <div>
        <label for="email">Email address</label>
        <input type="email" name="email" placeholder="Email address" required autofocus>
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" name="password" placeholder="Password" required>
    </div>
    <br>
    <button type="submit">Sign in</button>
    <?php if (!empty($errors)) : ?>
        <div>
            <?php foreach ($errors as $error) : ?>
                <p><?php echo $error ?></p>
            <?php endforeach ?>
        </div>
    <?php endif ?>
</form>
<br>
<a href="signup.php">Don't have an account yet? Click here to register a new account.</a>


<?php require __DIR__ . "/incl/footer.php"; ?>