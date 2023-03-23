<?php
require './classes/Person.php';

$person1 = new Person('Jan', 'Matura','2000-04-12','javaDev');
$person2 = new Person('Danda', 'MC','2001-07-05','Server Admin');
$person3 = new Person('Old', 'Troll','2001-02-05','Shop Manager');
$people = [$person1,$person2,$person3];
include './includes/head.php'
?>
<body>
<?php foreach ($people as $person):?>
<div class="bCard">
    <div class="logo"></div>
    <h1><?php echo "$person->name $person->surname" ; ?></h1>
    <p>Age: <?php echo$person->ageInYears($person->born)?></p>
    <p>Job: <?php echo $person->job?></p>
</div>
<br>
<?php endforeach;?>
</body>
<?php include './includes/foot.php' ?>
