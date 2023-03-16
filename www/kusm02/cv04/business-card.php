<?php

require './Person.php';
include './header.php';

$person1 = new Person(
    'Maksym',
    'Kushchynskyi',
    'Praha 1',
    '+333 333 333 333',
    'https://cdn.vox-cdn.com/thumbor/Yd7b7iobK45wxkAo-62R39OItbU=/1400x1400/filters:format(png)/cdn.vox-cdn.com/uploads/chorus_asset/file/16329042/cyberpunk_2077_keanu_reeves_1920.png',
    'Something about me.',
    'Something else about me.',
    'And a bit more.',
    2004
);

$people = [$person1];
function calculateAge($birthYear) {
    $age = 2023 - $birthYear;
    return $age;
}
?>

<?php foreach($people as $person): ?>
    <div class="business-card">
        <div class="bc-avatar">
            <img width="100" src="<?php echo $person->avatar; ?>" alt="avatar">
        </div>
        <div class="bc-age"><?php echo calculateAge($person->birthYear); ?></div>
        <div class="bc-name"><?php echo $person->getFullName(); ?></div>
        <div class="bc-address"><?php echo $person->address; ?></div>
        <div class="bc-phone"><?php echo $person->phone; ?></div>
        <div class="bc-something"><?php echo $person->something; ?></div>
        <div class="bc-somethingElse"><?php echo $person->somethingElse; ?></div>
        <div class="bc-somethingMore"><?php echo $person->somethingMore; ?></div>
    </div>
<?php endforeach; ?>

<?php include './footer.php'; ?>