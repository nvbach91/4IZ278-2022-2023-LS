<?php
Session::regenerate();

$_SESSION["user"] = new User( "usernameA", "passwordA" );
var_dump( $_SESSION["user"] );

# $_SESSION["items"]
# array_push( $_SESSION["items"], $prod_id );

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1><?php echo $_SESSION["user"]->username ?></h1>
</body>
</html>
