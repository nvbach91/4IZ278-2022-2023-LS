<form method="POST" action=".">
    <div>
        <label>username</label>
        <input name="username" type="text" value="<?php echo $username?>">
        <?php  if(!empty($_POST)) echo isset($usernameError)?$usernameError:"ok"?>
    </div>
    <div>
        <label >email</label>
        <input name="email" type="email" value="<?php echo $email?>">
        <?php  if(!empty($_POST)) echo  isset($emailError)?$emailError:"ok"?>
    </div>
    <div>
        <label >password</label>
        <input name="password" type="password" value="<?php echo $password?>">
    </div>
    <button type="submit" class= 'signInButton' formaction="..">SIGN IN</button>
    <button type="submit" class= 'signUpButton'>SIGN UP</button>
</form>