<?php
require ('index.php');

if (!empty($_SESSION['user'])) {
    header("Location:cart.php");
}
?>
<section>
    <div class="errors">
        <?php
        if (!empty($_SESSION['message'])) {
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        }
        ?>
    </div>
    <div class="form-box">
        <div class="form-value">
            <form action="signin.php" method="post">
                <h2>Login</h2>
                <div class="inputbox">
                    <input type="text" name="email" placeholder="E-mail">
                    <ion-icon name="mail-outline"></ion-icon>
                    <label for="">E-mail</label>
                </div>
                <div class="inputbox">
                    <input type="password" name="password" placeholder="Password">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                    <label for="">Password</label>
                </div>
                <div class="remember">
                    <label for=""><input type="checkbox">Remember me</label>
                </div>
                <div class="forgot">
                    <a href="#">Forgot password?</a>
                </div>
                <div class="continueButton">
                    <button>Log in</button>
                </div>
                <div class="register">
                    <a href="registration.php">Don't have an account? Register</a>
                    <a href="adressForm.php">Continue without registration</a>
                    <a href="googleLogin.php">Continue with Google</a>
                </div>
            </form>
        </div>
    </div>
</section>