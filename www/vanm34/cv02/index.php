<?php 
require 'person.php';

$person1 = new Person(
    'Martin',
    'Váňa',
    'Code Monkey',
    '777 888 999',
    'Prague',
    'falesna',
    123,
    2000,
    'mv@email.com',
    'MonkeyLand',
    'img/logo.jpg'
);

$person2 = new Person(
  'Veronika',
  'Váňová',
  'Assistant',
  '777 888 666',
  'Prague',
  'falesna',
  124,
  1990,
  'VV@email.com',
  'MonkeyIsland',
  'img/cat.jpg'
);

$person3 = new Person(
  'Dominik',
  'Kolář',
  'CEO',
  '555 888 999',
  'Prague',
  'falesna',
  125,
  1980,
  'DK@email.com',
  'MonkeyLand',
  'img/monke.jpeg'
);


  $people = [$person1, $person2, $person3];
?>
<html>
<?php include 'head.php'; ?>
  <?php foreach($people as $person): ?>
  <body>
    <div class="card">
    <div class="avatar" style="background-image: url(<?php echo $person->avatar; ?>)"></div>
        <div class = "content">            
            <div class="text"><?php echo $person -> position ?></div>
            <div class="FirstName"><?php echo $person -> getFullName() ?></div>
            <div class="contact">Age: <?php echo $person -> getAge() ?></div>
            <div class="contact"><?php echo $person -> phoneNumber ?></div>
            <div class="contact"> Email: <a class="email"><?php echo $person -> email ?></a></div>
            <div class="contact"> <?php echo $person -> getAddress() ?></div>
            <div class="contact"> <?php echo $person -> company ?></div>
        </div>    
    </div>
  </body>
  <?php endforeach; ?>
</html>