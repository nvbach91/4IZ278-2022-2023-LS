<?php

require_once __DIR__ . '/../model/Company.php';
require_once __DIR__ . '/../model/Person.php';

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

foreach ($persons as $person) {

?>

<div class="page front-page">
    <div class="grid-x align-middle">
        <div class="cell medium-5">
            <img class="logo" src="<?= Company::COMPANY_AVATAR ?>">
        </div>

        <div class="cell medium-7">
            <div class="grid-y">
                <div class="cell">
                    <h2 class="text-center name-main">
                        <?= $person->getFullName() ?>
                    </h2>
                </div>

                <hr>

                <div class="cell">
                    <h4 class="text-center profession">
                        <?= $person->proffesion ?>
                    </h4>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page back-page">
    <div class="grid-x align-middle">
        <div class="cell medium-7">
            <div class="grid-y">
                <div class="cell">
                    <h3><?= Company::COMPANY_NAME ?></h3>
                </div>

                <div class="cell">
                    <i class="fa-solid fa-person"></i><?=  $person->getFullName() ?>
                </div>

                <div class="cell">
                    <i class="fa-solid fa-calendar-days"></i><?=  $person->getAge() ?> let
                </div>

                <div class="cell">
                    <i class="fa-solid fa-briefcase"></i><?=  $person->proffesion ?>
                </div>

                <div class="cell">
                    <i class="fa-solid fa-location-dot"></i><?=  Company::getFullAddress() ?>
                </div>

                <div class="cell">
                    <i class="fa-solid fa-envelope"></i><?=  $person->email ?>
                </div>

                <div class="cell">
                    <i class="fa-solid fa-phone"></i><?=  $person->phone ?>
                </div>

                <div class="cell">
                    <i class="fa-solid fa-link"></i> <a href="<?= Company::COMPANY_URL ?>" target="_blank"><?= Company::COMPANY_URL ?></a>
                </div>
            </div>
        </div>

        <div class="cell medium-5">
            <img class="logo" src="<?= Company::COMPANY_AVATAR ?>">
        </div>
    </div>
</div>

<hr/>

<?php

}
