<?php 

$name = 'Homer';
$lastName = 'Simpson';

$fullName = $name . ' ' . $lastName;

// echo $fullName;

$a = 5;

$a = $a + 5;
$a += 5;


$fruits = [
    'Blueberry',
    'Melon',
    'Kiwi',
    'Orange',
    'Starfruit',
];

$person = [
    'name' => 'Homer',
    'lastname' => 'Simpson',
    'age' => 75,
];

$books = [
    [
        'name' => 'Harry Potr',
        'price' => 200,
        /* ...*/
    ],
    [/* ... */],
    [/* ... */],
    //...
];

// var_dump($person);
if ($person['name'] === 'Homer') {
    echo 'ano';
} else {
    echo 'ne';
}

function add($a, $b) {
    $result = $a + $b;
    return $result;
}

$addResult = add(55, 6);
$addResult = 55 + 6;

echo $addResult;


// vytvorte pole z 5 objektu (ne instanci Tridy)
// v kazdem objektu jsou informace o knihach
// nazev, rok vydani, autor, cena

// v html se vypise tolik div
// v kazdem divu jsou uvedeny tyto informace 
// pod sebou
// 6. informace = 
    // jak stara je publikace tj. 
    // 2022 minus rok vydani




class Person {
    private $name;
    private $age;
    private $gender;

    function __construct($name, $age, $gender) {
        $this->name = $name;
        $this->age = $age;
        $this->gender = $gender;
    }
    public function getName() {
        return $this->name;
    }
    public function getAge() {
        return $this->age;
    }
    public function getGender() {
        return $this->gender;
    }
}

$person1 = new Person('Dave', 20, 'M');


echo $person1->getName();
echo $person1->getAge();
echo $person1->getGender();


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
    <h1>Hello world</h1>
    <h2><?php echo $name; ?></h2>
    
    <ul>
        <?php foreach ($fruits as $fruit): ?>
            <li><?php echo $fruit; ?></li>
        <?php endforeach; ?>
    </ul>

    <p>
        This is <?php echo $person['name']; ?> 
        <?php echo $person['lastname']; ?>
        and he is <?php echo $person['age']; ?> years old
    </p>
</body>
</html>