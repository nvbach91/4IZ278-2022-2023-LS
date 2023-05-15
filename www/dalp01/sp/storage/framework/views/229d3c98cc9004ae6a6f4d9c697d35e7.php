<?php
Session::regenerate();


if( Session::get( "user" ) == null ){
    return redirect( "/home" );
}
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

</body>
</html>
<?php /**PATH C:\xampp\htdocs\semestral\resources\views/login.blade.php ENDPATH**/ ?>