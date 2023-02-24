<?php

    require './Person.php';
    
    $avatar = 'img/icon.png';

    $person1 = new Person('Jan', 'Novák', '12/04/1974', 'Developer');
    $person2 = new Person('Marie', 'Nováková', '12/04/1973', 'Developerka');
    $person3 = new Person('Marek','Vejvoda', '12/04/2001', 'Student');
    $people = [$person1, $person2, $person3];
?>

<!DOCTYPE html>
    <head>
        <meta charset = 'utf-8'>
        <title>Buisness card</title>
        <link rel = 'stylesheet' href = 'style.css'/>
    </head>
    <body>
        <?php foreach($people as $person): ?>
            <div class = "front">
                <img class = 'avatar' src = '<?php echo $avatar; ?>'>
                <div class = 'line'></div>
                <div class = 'text'>
                    <span class = 'name'> <?php echo $person->name; ?> </span>
                    <span class = 'lastname'> <?php echo $person->surname; ?> </span> 
                    <div class = 'age'>Age: <?php echo $person->getAge(); ?></div>
                    <div class = 'position'><?php echo $person->job; ?></div>
                </div>
            </div>
        <?php endforeach; ?>
    </body>
</html>