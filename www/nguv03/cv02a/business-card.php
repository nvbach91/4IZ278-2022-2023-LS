<?php
// PascalCase

require './Person.php';
include './head.php';
include './foot.php';



$person1 = new Person(
    'Andrej',
    'Skukla',
    'Praha 1',
    '+123456789',
    'https://upload.wikimedia.org/wikipedia/commons/thumb/8/8d/President_Barack_Obama.jpg/220px-President_Barack_Obama.jpg',
    1950
);
$person2 = new Person(
    'David',
    'Machac',
    'Brno 2',
    '+456789321',
    'https://sp-ao.shortpixel.ai/client/to_webp,q_lossy,ret_img/https://my.kumonglobal.com/wp-content/uploads/2022/03/Learn-from-Rowan-Atkinson_Kumon-Malaysia_530x530_NewsThumbnail.jpg',
    1980
);
$people = [$person1, $person2];
function calculateAge($birthYear) {
    $age = 2023 - $birthYear;
    return $age;
}


?>
<?php include './head.php'; ?>

<?php foreach($people as $person): ?>
    <div class="business-card">
        <div class="bc-avatar">
            <img width="100" src="<?php echo $person->avatar; ?>" alt="avatar">
        </div>
        <div class="bc-age"><?php echo calculateAge($person->birthYear); ?></div>
        <div class="bc-name"><?php echo $person->getFullName(); ?></div>
        <div class="bc-address"><?php echo $person->address; ?></div>
        <div class="bc-phone"><?php echo $person->phone; ?></div>
    </div>
<?php endforeach; ?>>

<?php include './foot.php'; ?>