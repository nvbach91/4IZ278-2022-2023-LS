<?php
require('./Person.php');
require('./utils.php');

$people = array();
array_push($people, new Person(
    getFullName('Camila', 'Bigunets'),
    getAge('20-01-2000'),
    getAdress('Czech Republic', 'Prague', 'Vodičkova', 2),
    '+420-755-32-10',
    'Coach',
    'bigc00@vse.cz',
    true
));
array_push($people, new Person(
    getFullName('John', 'Johnson'),
    getAge('10-03-1997'),
    getAdress('USA', 'Washington', 'Main Street', 15),
    '+1-323-12-32',
    'Manager',
    'John.J@gmail.com',
    false
));

?>


<body>
    <h1> Buisness cards in PHP</h1>
    <div class = 'cards'>
    <?php foreach($people as $person): ?>
        <div class = 'card'>
            <div class = 'front'>
                <div class = 'avatar'><img src = 'img/avatar.jpeg'></div>
                <div class = 'frontText'>
                    <p><?php echo $person -> getFullName() ?></p>
                    <p><?php echo $person -> getAge() ?> </p>
                    <p><?php echo $person -> getJob() ?> </p>
                </div>
            </div>
            <div class = 'back'>
                <div class = 'backText'>
                    <p><?php echo $person -> getPhoneNumber() ?></p>
                    <p><?php echo $person -> getEmail() ?></p>
                    <p><?php echo $person -> getAddress() ?></p>
                    <p><?php echo $person -> getAvailabaility() ? 'Available' : 'Not available' ?></p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
</body>
</html>
