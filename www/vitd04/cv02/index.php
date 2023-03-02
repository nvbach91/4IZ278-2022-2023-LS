<?php

require_once("models/company.php");
require_once("models/person.php");
require_once("views/card.php");
require_once("utils/utils.php");

$swiftySpace = new Company(
    'SwiftySpace s. r. o. ',
    'Nám. W. Churchilla',
    12,
    '141 00',
    'Praha 4',
    'swiftyspace.com',
);

$people = [
    new Person(
        'https://this-person-does-not-exist.com/img/avatar-11062e1d556388ce325e01dbdf6ea7db.jpg',
        'Dominik',
        'Vít',
        DateTimeImmutable::createFromFormat('Y-m-d', '2000-02-12'),
        $swiftySpace,
        'Developer',
        '+420 735 012 000',
        'mail@dominikvit.cz',
        false,
    ),

    new Person(
        'https://this-person-does-not-exist.com/img/avatar-115b4242f66f236326eaf23032ae1251.jpg',
        'Lukáš',
        'Vít',
        DateTimeImmutable::createFromFormat('Y-m-d', '2000-02-12'),
        $swiftySpace,
        'Junior Developer',
        '+420 735 012 000',
        'lukas@swiftyspace.com',
        false,
    ),

    new Person(
        'https://this-person-does-not-exist.com/img/avatar-11b7cdeadb71814aec48210790828995.jpg',
        'Pepa',
        'Hrdlička',
        DateTimeImmutable::createFromFormat('Y-m-d', '1933-04-02'),
        $swiftySpace,
        'Janitor',
        '+420 735 012 000',
        'pepa@swiftyspace.com',
        true,
    )
]
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vizitky</title>
    <link href="output.css" rel="stylesheet">
</head>

<body class="w-full bg-gray-900 divide-y-2 divide-gray-800">
    <?php
    foreach ($people as $person) {
        Card::render($person);
    }
    ?>
</body>

</html>