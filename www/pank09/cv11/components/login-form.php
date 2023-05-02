<?php if (isset($errorMessage)): ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $errorMessage; ?>
    </div>
<?php endif; ?>
<h1>Login</h1>
<p class="my-3">Are you a newbie? <a href="register.php">Register</a></p>
<form method="POST" style="min-height: calc(100vh - 230px);">
    <div class="form-group">
        <label for="email">Email</label>
        <input class="form-control" id="email" name="email" placeholder="Email" <?php echo $_POST['email'] ?? ''; ?>>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input class="form-control" id="password" name="password" type="password" placeholder="Password" <?php echo $_POST['password'] ?? ''; ?>>
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
    <span class="mx-3"> or </span>
    <a class="" href="<?php echo htmlspecialchars($loginUrl); ?>">Log in with Facebook!</a>
</form>