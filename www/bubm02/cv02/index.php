<?php

require './Person.php';

$person1 = new Person(
    "Mykhailo",
    "Bubnov",
    "Software Developer",
    "Sefira spol.",
    "A. Staška",
    '2027',
    '/77',
    "Praha 4",
    "+420 777 777 777",
    "bubnov@sefira.cz",
    "https://www.sefira.cz/",
    false,
    2004,
    "logo.png"
);

$person2 = new Person(
    "Samuel",
    "Mokriš",
    "Software Remover",
    "Sefira spol.",
    "A. Staška",
    '2027',
    '/77',
    "Praha 4",
    "+420 666 666 666",
    "mokris@sefira.cz",
    "https://www.sefira.cz/",
    true,
    1973,
    "logo.png"
);

$person3 = new Person(
    "Sykora",
    "Zdenek",
    "Marketing Manager",
    "Sefira spol.",
    "A. Staška",
    '2027',
    '/77',
    "Praha 4",
    "+420 555 555 555",
    "sykora@sefira.cz",
    "https://www.sefira.cz/",
    false,
    1956,
    "logo.png"
);
$people = [$person1, $person2, $person3];
?>
<?php include './head.php' ?>
<body>
    <?php foreach($people as $person) : ?>
    <h1><?php echo $person->name?>s business card</h1>
    <div class="bc-container">
        <div class="bc-front bc">
            <div class="bc-img-div">
                <img src="<?php echo $person->avatar ?>" alt="avatar" />
            </div>
            <div class="bc-textbox">
                <div class="bc-name"><?php echo $person->name ?></div>
                <div class="bc-surname"><?php echo $person->surname ?></div>
                <div class="bc-position"><?php echo $person->position ?></div>
                <div class="bc-organisation"><?php echo $person->firmName ?></div>
            </div>
        </div>
        <div class="bc-back bc">
            <div class="bc-textbox back-name w-50">
                <div class="bc-name"><?php echo $person->name ?></div>
                <div class="bc-surname"><?php echo $person->surname ?></div>
                <div class="bc-position"><?php echo $person->position ?></div>
            </div>
            <div class="contacts w-50" class="bc-textbox">
                <div class="bc-address"> <?php echo $person->street . ' ' . $person->streetNumber1 . $person->streetNumber2 ?></div>
                <div class="bc-phone"> <?php echo $person->phone ?> </div>
                <div class="bc-email"> <?php echo $person->email ?> </div>
                <div class="bc-web"><a href="<?php echo $person->web ?>"> <?php echo $person->web ?> </a></div>
                <div> <?php echo $person->getLookingForJob() ?> </div>
                <div> age: <?php echo $person->getAge() ?> </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</body>

</html>