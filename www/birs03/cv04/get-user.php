<?php

if(!empty($_GET)){
    $username = $_GET['username'];
    $search = $_GET['search'];
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
    you submited <?php echo isset($username)? $username :'';?>
</body>
</html>