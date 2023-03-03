<?php 

// class Person {
//     public function __construct(
//         public $name,
//         public $age,
//     )
//     {}
// }

// $person = new Person('David Beckham', 50);

// JavaScript
// var person = {
//     name: 'David Beckham',
//     age: 50,
// };

// PHP associative arrays
$person = [
    'name' => 'David Beckham',
    'age' => 50,
];
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
    <h1>PHP Form validation</h1>
    <?php require './registration-form.php'; ?>

    <form action="./get-users.php">
        <input name="username">
        <input name="search">
        <button>Submit</button>
    </form>



    
    <!-- <h2>Associative arrays</h2>
    <div>
        <div>Person name <?php echo $person['name']; ?></div>
        <div>Person age  <?php echo $person['age']; ?></div>
    </div> -->
</body>
</html>