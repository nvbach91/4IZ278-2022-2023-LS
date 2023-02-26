<?php

require_once __DIR__ . '/utils/utils.php';

require_once __DIR__ . '/view/BusinessCardFront.php';
require_once __DIR__ . '/view/BusinessCardBack.php';

require_once __DIR__ . '/model/Company.php';
require_once __DIR__ . '/model/Person.php';

$person1 = new Person(
    'Ondřej',
    'Tölg',
    '9.3.2001',
    'Lead Developer',
    '(+420) 608 363 903',
    'tolgicraft@gmail.com',
    false,
);

$person2 = new Person(
    'Vojtěch',
    'Přiklopil',
    '2.4.2004',
    'Architect',
    '(+420) 777 888 999',
    'vojta@priklopil.com',
    false,
);

$person3 = new Person(
    'Jan',
    'Tölg',
    '17.11.1989',
    'Consultant',
    '(+420) 888 777 999',
    'jan@tolg.com',
    false,
);

$persons = [$person1, $person2, $person3];

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FaceBlock Entertainment - Ondřej Tölg</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/foundation-sites@6.7.5/dist/css/foundation.min.css"
          crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
          crossorigin="anonymous">

    <style>
        .page {
            min-height: 16rem;
            color: white;
            background-color: black;
            border-radius: 1rem;
            padding: 1rem;
            margin-bottom: 1rem;
            box-shadow: 9px 2px 53px -18px rgba(0, 0, 0, 0.75);
            border: 2px solid white;
        }

        .page .logo {
            max-width: 13rem;
            max-height: 13rem;
        }

        .front-page .name-main {
            font-weight: bold;
        }

        .front-page hr {
            border: 1px solid white;
            width: 50%;
            margin: 1rem auto;
        }

        .back-page i {
            margin-left: 1rem;
            margin-right: 0.5rem;
        }

        .back-page a {
            color: white;
            text-decoration: underline;
        }

        .back-page a:hover {
            text-decoration: none;
        }
    </style>
</head>

<body>
<div class="grid-container">
    <div class="grid-x grid-padding-x align-center">
        <div class="cell medium-6">
            <h1 class="text-center">Vizitka FaceBlock Entertainment</h1>

            <main>
                <?php
                    foreach ($persons as $person) {
                        BusinessCardFront::render($person);
                        BusinessCardBack::render($person);
                        echo '<hr/>';
                    }
                ?>
            </main>

        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/foundation/6.6.3/js/foundation.min.js"></script>
</body>
</html>
