<?php
    
    if(!empty($_GET)){
        $username = htmlspecialchars(trim($_POST['username']));
        $search = htmlspecialchars(trim($_POST['search']));

    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    you sumbmitted <?php echo isset($username) ?>
    you sumbmitted <?php echo isset($search) ?>
</body>
</html>