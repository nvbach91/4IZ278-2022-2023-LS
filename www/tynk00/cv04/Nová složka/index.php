<?php

$filename = './users.db';
/*$file = fopen($filename, 'a');

fwrite($file, "Hello world" . PHP_EOL);
fclose($file);*/

$data = "Hello world" . PHP_EOL;

file_put_contents($filename, $data, FILE_APPEND);

$fileContent = file_get_contents($filename);

$explodedString = explode(PHP_EOL, $fileContent);




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</head>

<body>

    <div class="container pt-5">

        <div class="card shadow-sm p-3">
            <div class="card-header">ss</div>
            <div class="card-body">
                <ul class="list-group list-group-flush">

                    <?php foreach ($explodedString as $string) : ?>
                        <li class="list-group-item"><?php echo $string; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>

        </div>



    </div>

</body>

</html>