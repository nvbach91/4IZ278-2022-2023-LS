<?php 

    //write do db

    //jeden způsob
    // $file = fopen("database.db", "w");
    // fwrite($file, "");    
    // fclose($file);

    //druhý způsob
    // file_put_contents("database.db", $email, FILE_APPEND);
    // $fileContent = file_get_contents("database.db");


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
        }
    </style>
</head>
<body>
    <?php include "regForm.php" ?>
</body>
</html>