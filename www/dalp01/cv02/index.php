<?php
require './classes/Person.php';

# all random apart from Harambe, The Monke
$people = [
    new Person( "Harambe", "", "https://www.gannett-cdn.com/-mm-/cdeb9a9e093b3172aa58ea309e74edcf80bf651f/c=0-77-2911-1722/local/-/media/2016/05/29/Cincinnati/Cincinnati/636001135964333349-Harambe2.jpg?width=2911&height=1645&fit=crop&format=pjpg&auto=webp", "N/A", "Cincinnati Zoo", "Cincinnati", "2013-03-15" ),
    new Person( "Big", "Monke", "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR-xCCjRF_yeABM1fdkCHojXtrYCpfEuD3Lkg&usqp=CAU", "+420 123 456 789", "Krenova 8", "Brno 1", "1970-01-01" ),
    new Person( "Me, Myself", "and I", "https://upload.wikimedia.org/wikipedia/commons/thumb/1/11/Blue_question_mark_icon.svg/2048px-Blue_question_mark_icon.svg.png", "#########", "Vostelčická 490", "Vysoké Mýto", "1920-02-29" )
    ];
?>

<?php include './includes/head.php'; ?>
<body>
    <?php foreach( $people as $person ): ?>
    <div class="bc_front">
        <div class="avatar" style="background-image: url(<?php echo $person->avatar?>)"></div>
        <div class="name"><?php echo $person->getFullName()?></div>
        <div class="info">
            <div class="line"><?php echo "Age: " . $person->calculateAge() ?></div>
            <div class="line"><?php echo "Phone: " . $person->phone ?></div>
            <div class="line"><?php echo "Address: " . $person->getAddress() ?></div>
        </div>
    </div>
    <?php endforeach; ?>
</body>
</html>