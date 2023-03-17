<?php
require './utils.php'
?>


<?php

$formIsSubmitted = !empty($_POST);
if ($formIsSubmitted) {
   
    $nickname = $_POST['nickname'];
    $user = getUser($nickname);
    
    if ($user == null) {
        echo "You are not registered";
    } else {
        echo "Login success";
        
        exit;
    }
}
?>

<?php include './head.php' ?>


<h1>Login</h1>
<form method="POST" action="./login.php"> 
    <div>
        <label>Nickname</label>
        <input name="nickname">
    </div>
    <button>LOGIN</button>
</form>
<?php include './tail.php'; ?>