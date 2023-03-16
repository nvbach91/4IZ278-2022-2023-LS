<?php 

$email = "nguv03@vse.cz\n";

// $file = fopen('./database.db', 'a');
// fwrite($file, $email);
// fclose($file);

file_put_contents('./database.db', $email, FILE_APPEND);

$databaseFileContent = file_get_contents('./database.db');

var_dump($databaseFileContent);

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
    <h1>File handling in PHP</h1>
</body>
</html>