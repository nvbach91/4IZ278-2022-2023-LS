<?php

function displayWarning($message){

}

$usersFilePath = '../users.db';
$usersData = file_get_contents($usersFilePath);
$users = explode(PHP_EOL,$usersData);

$matched = 0;

if (!empty($_POST)) {
$email = htmlentities(trim($_POST['email']));


foreach($users as $user){
    $fields = explode(';',$user);
    if(isset($email)){
        if(($fields[2] == htmlentities(trim($_POST['email'])))){
            if($fields[3] == htmlentities(trim($_POST['password']))){
                $matched = 1;
            }else{
               if($matched != 1){
                $matched = 2;
               }
            }
        }else{
            if($matched != 1){
                $matched = 2;
               }
        }
    }
}
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <?php
    $email = isset($_GET['email']) ? $_GET['email'] : '';
    $ref = isset($_GET['ref']) ? $_GET['ref'] : '';
    ?>
    <?php if($ref=='registration'):?>
        <div class="wellcome">Úspěšně jste se registrovali!</div>
        <?php endif?>
        <?php if($matched==1):?>
        <div class="wellcome">Úspěšně jste se přihlásili!</div>
        <?php endif?>
        <?php if($matched==2):?>
        <div class="failLogin">Špatné heslo či jméno!</div>
        <?php endif?>
        
    <form action="login.php" method="POST" class="loginStuff">
        <div>
            <label>Jméno</label>
            <input name="email" value="<?php echo $email ?>">
            <label>Heslo</label>
            <input name="password" type="password">
        </div>
        <div>
            <button type="submit">Login</button>
        </div>
    </form>
</body>
</html>