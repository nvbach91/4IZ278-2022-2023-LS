<?php

$fruits = ['mango', 'blueberry', 'melon', 'orange'];
$companies = ['ibm', 'tesla', 'microsoft'];
$animals = ['dog', 'cat', 'bear', 'pig'];
$numbers = [1, 2, 3, 4, 5]
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
    <h1>Fruits</h1>
    <ul>
        <?php foreach ($fruits as $fruit) : ?>
            <li><?php echo $fruit; ?></li>
        <?php endforeach; ?>
    </ul>
    <h1>Companies</h1>
    <ul>
        <?php foreach ($companies as $company) : ?>
            <li><?php echo $company; ?></li>
        <?php endforeach; ?>
    </ul>
    <h1>Animals</h1>
    <ul>
        <?php foreach ($animals as $animal) : ?>
            <li><?php echo $animal; ?></li>
        <?php endforeach; ?>
    </ul>
    <h1>Numbers</h1>
    <ul>
        <?php foreach ($numbers as $number) : ?>
            <li><?php echo "$number"; ?></li>
        <?php endforeach; ?>
    </ul>
</body>

</html>