<?php

require './classes/Person.php';
require './utils/utils.php';

$person1 = new Person('David', 'Vikor', 'https://cdn-icons-png.flaticon.com/512/1920/1920990.png', 'Programmer', 'Never ending development s.r.o', 2001);
$person2 = new Person('Jan', 'Hrasko', 'https://cdn-icons-png.flaticon.com/512/3588/3588614.png', 'Zvarac CO2', 'Constructors s.r.o', 1993);
$person3 = new Person('John', 'Worker', 'https://cdn-icons-png.flaticon.com/512/1008/1008112.png', 'Bagrista', 'Bager s.r.o', 1991);

$people = [$person1, $person2, $person3];



?>


<?php include './includes/head.php' ?>

<body>
    <?php foreach ($people as $person) : ?>
        <div class="card-front">
            <div class="image">
                <img alt="logo" src="<?php echo $person->logo ?>">
            </div>
            <div class="front-content">
                <h1><?php echo $person->getFullName() ?></h1>
                <p><?php echo calcAge($person->birthYear) ?></p>
                <p><?php echo $person->profession ?></p>
                <p><?php echo $person->company ?></p>
            </div>
        </div>
    <?php endforeach ?>
</body>

<?php include './includes/foot.php' ?>