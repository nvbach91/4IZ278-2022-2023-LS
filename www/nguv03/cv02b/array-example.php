<?php
$fruits = ['mango', 'blueberry', 'melon', 'orange'];

$people = []; // foreach($people as $person)
$companies = []; // foreach($companies as $company)
$animals = []; 
$numbers = []; 
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
    <h2>Fruits</h2>
    <ul>
        <?php foreach($fruits as $fruit): ?>
            <li><?php echo $fruit; ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>