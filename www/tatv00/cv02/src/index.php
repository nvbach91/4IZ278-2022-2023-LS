<?php

require './classes/Person.php';

$person1 = new Person(
    'Floppa',
    'Cat',
    'DevOps',
    'https://yt3.googleusercontent.com/1H0pCwfSIJdvCkGASZboVkPVxScmES_KcnqB5y9OetXo8YjU02jq_s8W58UMOnGV2mGFFAXRrg=s900-c-k-c0x00ffffff-no-rj',
    '+434781241',
    'Berlin',
    'Landsberger',
    '26',
    2002,
    'https://github.com/utikpuhlik?tab=repositories',
    'test@example.com',
    'Adastra',
    false,
    'utikpuhlik'
);

$person2 = new Person(
    'Riki',
    'Tiki',
    'Rust Chad',
    'http://t1.gstatic.com/licensed-image?q=tbn:ANd9GcSkLByqBzjaUWDkWGBkj5SlcmEA1sNwBcCgMULLhCE_gZmh9wzL_QZj8BNxQGlmSKoNHm21Yzi6wlswQpU',
    '+32432904439',
    'Florida',
    'Lands',
    '89/1',
    2022,
    'https://github.com/riki?tab=repositories',
    'test@example.com',
    '1c',
    true,
    'Riki'
);

$person3 = new Person(
    'Monkey',
    'Bananas',
    'Java Developer',
    'http://t1.gstatic.com/licensed-image?q=tbn:ANd9GcQJ_gjc70B1IxnW05GaEOrZmftPw2X-NnHo80IgkygE0hTWrXCzLJNkX9TNqenUScYVu4efy_WY22YbYRbd8VqftnVAPDraApxO7mq5S_Xn',
    '+433901246',
    'Zimbabwe',
    'Uga-buga',
    '1487',
    2014,
    'https://github.com/moon?tab=repositories',
    'test@example.com',
    'Carvago',
    false,
    'MoonMonkey'
);


$people = [$person1, $person2, $person3];

// function calculateAge($birthYear) {
//     $result = 2023 - $birthYear;
//     return $result;
// }

?>
<?php include './includes/head.php'; ?>
    <?php foreach($people as $person): ?>
    <div class="block">
        <div class="flex">
            <div class="com-8">
                <div class="avatar" style="background-image: url(<?php echo $person->avatar ?>)"></div>
            </div>
            <div class="info">
                <h2 class="name"><?php echo $person->getFullName() ?></h2>
                <h3>Position: <?php echo $person->position ?></h3>
                <p>Address: <?php echo $person->getAddress() ?></p>
                <p>Looking for work: <?php echo $person->work ? "Yes" : "No" ?> </p>
            </div>
        </div>
        <div class="foot">
            <div>
                Github: <a href="<?php echo $person->github ?>"><?php echo $person->githubUser ?></a>
            </div>
        </div>

        <div class="container">
            <div class="meow line">
                <div class="contact">
                    <h2 class="header_contacts">Contacts:</h2>
                    <p>
                        <a href="tel:+434781241">tel: <?php echo $person->phone ?></a>
                    </p>
                    <p>
                        <a href="mailto:cat@example.com">mail: <?php echo $person->email ?></a>
                    </p>
                </div>
            </div>
            <div class="meow">
                <div class="contact">
                    <h2>Details:</h2>
                    <p>Age: <?php echo $person->getAge() ?></p>
                    <p>Firm: <?php echo $person->firm ?></p>
                </div>
            </div>

        </div>
    <?php endforeach; ?>
<?php include './includes/foot.php'; ?>