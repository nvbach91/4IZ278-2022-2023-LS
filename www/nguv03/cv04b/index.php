<?php

$filename = './users.db';
/*
$file = fopen($filename, 'a');
// Windows newline = \r\n
// Linux newline = \n
fwrite($file, 'Hello word' . PHP_EOL);
fclose($file);
*/
// $dataToWrite = 'Hello World' . PHP_EOL;
// file_put_contents($filename, $dataToWrite, FILE_APPEND);

$fileContent = file_get_contents($filename);
$explodedString = explode(PHP_EOL, $fileContent);
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
    <h1>PHP File handling</h1>
    <?php foreach($explodedString as $es) :?>
        <p><?php echo $es; ?></p>
    <?php endforeach;?>
</body>
</html>