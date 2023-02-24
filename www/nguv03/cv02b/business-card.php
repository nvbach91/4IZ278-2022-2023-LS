<?php

require './classes/Person.php';

$person1 = new Person(
    'John',
    'Doe',
    'https://hips.hearstapps.com/hmg-prod/images/barack-obama-12782369-1-402.jpg',
    '+420 777 555 888',
    'Praha 1',
    1945,
);

$person2 = new Person(
    'Michelle',
    'Obama',
    'https://upload.wikimedia.org/wikipedia/commons/thumb/4/4b/Michelle_Obama_2013_official_portrait.jpg/398px-Michelle_Obama_2013_official_portrait.jpg',
    '+420 778 884 123',
    'Brno 1',
    1950,
);

$person3 = new Person(
    'Michelle',
    'Obama',
    'https://upload.wikimedia.org/wikipedia/commons/thumb/4/4b/Michelle_Obama_2013_official_portrait.jpg/398px-Michelle_Obama_2013_official_portrait.jpg',
    '+420 778 884 123',
    'Brno 1',
    1980,
);

$people = [$person1, $person2, $person3];

function calculateAge($birthYear) {
    $result = 2023 - $birthYear;
    return $result;
}

?>
<?php include './includes/head.php'; ?>
    <?php foreach($people as $person): ?>
        <div class="business-card">
            <div class="bc-name">
                <?php echo $person->getFullName(); ?>
            </div>
            <div class="bc-phone">
                <?php echo $person->phone; ?>
            </div>
            <div class="bc-address">
                <?php echo $person->address; ?>
            </div>
            <div class="bc-avatar">
                <img width="150" src="<?php echo $person->avatar; ?>" alt="avatar">
            </div>
            <div class="bc-age">
                <?php echo calculateAge($person->birthYear); ?>
            </div>
        </div>
    <?php endforeach; ?>
<?php include './includes/foot.php'; ?>