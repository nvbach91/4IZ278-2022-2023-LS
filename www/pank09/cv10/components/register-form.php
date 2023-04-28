<?php if (isset($errorMessage)): ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $errorMessage; ?>
    </div>
<?php endif; ?>
<h1>Register</h1>
<p class="my-3">Already have an account? <a href="login.php">Login</a></p>
<form method="POST" style="min-height: calc(100vh - 230px);">
    <div class="form-group">
        <label for="name">Name</label>
        <input class="form-control" id="name" name="name" placeholder="Name" value="<?php echo $_POST['name'] ?? ''; ?>">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $_POST['email'] ?? ''; ?>">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input class="form-control" id="password" name="password" type="password" placeholder="Password" value="<?php echo $_POST['password'] ?? ''; ?>">
    </div>
    <button type="submit" class="btn btn-primary">Register</button>
</form>