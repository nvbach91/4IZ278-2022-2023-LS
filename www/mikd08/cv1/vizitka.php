<?php
    $name = "David";
    $surname = "Mikula";
    $age = 20;
    $pic = "logo.jpg";


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="vizitka.css">
</head>
<body>
    <div id="card">
        <div id="pic"><img src=<?php echo $pic?> alt="pic"></div>
        <div id="name">jméno: <?php echo $name?></div>
        <div id="surname">přijmení: <?php echo $surname?></div>
        <div id="age">věk: <?php echo $age?></div>
    </div>
</body>
</html>