<div id="login" class="overlay">
    <form action="logIn.php" method="POST">
        <h1>Log In</h1>
        <input type="text" name="username" placeholder="username">
        <input type="password" name="password" placeholder="password">
        <button type="submit" name="login">Log In</button>
        <a href="<?php echo $redirectURL?>">FB log in</a>
    </form>
    
    <p>Not registered yet? <span id="register-link" class="custom-link">Register</span></p>
</div>

<div id="register" class="overlay">
    <form action="register.php" method="POST">
        <h1>Register</h1>
        <input type="text" name="username" placeholder="username" required>
        <input type="password" name="password" placeholder="password" required>
        <input type="text" name="name" placeholder="name" required>
        <input type="email" name="email" placeholder="email" required>
        <input type="text" name="address" placeholder="address" required>
        <input type="number" name="phone" placeholder="phone" required>
        <button type="submit" name="register">Register</button>
    </form>
</div>