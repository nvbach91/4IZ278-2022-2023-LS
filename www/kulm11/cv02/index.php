<?php
    require "./classes/Person.php";

    $person1 = new Person("Michal", "Kulvejt", "Student VŠE", "assets/img/avatar.gif", "michalkulvejt.com",2000);
    $person2 = new Person("Random", "Name", "Jobless", "assets/img/peppa.png", "name.lol",2023);
    $person3 = new Person("Phoenix", "Wright", "Attorney", "assets/img/phoenix.png", "phoenixwright.com",1996);
    $people = [$person1, $person2, $person3];
?>

<?php include "./includes/head.php" ?>
    <?php foreach($people as $person): ?>
        <div class= "business-card">
            <div clas = "row1">
                <div class="bc-avatar"><img width = "150" src="<?php echo $person->imageSrc ?>"></div>
            </div>
            <div clas = "row2">
                <div class="bc-name"><?php echo $person->getFullName();; ?></div>
                <div class="bc-job"><?php echo $person->job; ?></div>
                <div class="bc-web"><a href="http://<?php echo $person->webAdress; ?>"><?php echo $person->webAdress; ?></a></div>
            </div>
        </div>
    <?php endforeach; ?>
<?php include "./includes/foot.php" ?>