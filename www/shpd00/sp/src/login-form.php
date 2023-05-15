<form method="POST" action=".">
    <div>
        <?php  if(!empty($_GET['registration'])) echo $_GET['registration']=='success'?"Registration successfull":""?>
    </div>
    <div>
        <label>username</label>
        <input name="username" type="text" value="<?php echo $username?>">
        <?php  if(!empty($_POST)) echo isset($usernameError)?$usernameError:""?>
    </div>
    <div>
        <label >password</label>
        <input name="password" type="password" value="<?php echo $password?>">
    </div>
    <?php  if(!empty($_POST)) echo isset($loginError)?$usernameError:""?>
    <button type="submit" class= 'signUpButton' formaction="./registration/index.php">SIGN UP</button>
    <button type="submit" class= 'signInButton'>SIGN IN</button>
</form>