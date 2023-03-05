<?php

use Person as GlobalPerson;

    class Person {
        public function __construct(public $name, public $age)
        {}
    }
    $person = new Person("random", 102);
    $person = [
        "name" => "random",
        "age" => 102
    ];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>PHP Form Validation</title>
</head>
<body>
    <?php require "./registration-form.php"?>
</body>
</html>