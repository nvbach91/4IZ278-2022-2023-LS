<?php
// class Person {
//     public function __construct(
//         public $name,
//         public $age,
//     ) {}
// }

// javascript

// var person = {
//     name: 'David Beckham',
//     age: 50,
// };

// associative arrays
$person = [
    'name' => 'David Beckham',
    'age' => 50,
];

// var_dump($person);



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
    <h1>Form validation in PHP</h1>

    <?php include './registration-form.php'; ?>






    <h2>Associative arrays</h2>
    <div>Person name <?php echo $person['name']; ?></div>
    <div>Person age <?php echo $person['age']; ?></div>
</body>
</html>