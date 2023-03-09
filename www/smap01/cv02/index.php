<?php require "./includes/head.php" ?>
<?php require "./classes/Person.php" ?>
<?php require "./classes/utils.php" ?>
<?php





$person1 = new Person(
    'Patrik',
    'Šmátrala',
    '20/5/2000',
    'Student',
    'Vysoká škola ekonomická v Praze, Fakulta informatiky a statistiky',
    'Nám. Winstona Churchilla',
    '1938',
    '4',
    '120 00 Praha 3-Žižkov',
    '737 448 746',
    'smap01@vse.cz',
    './img/user_avatar.png',
    'esotemp.vse.cz/~smap01/cv01',
    false
);

$person2 = new Person(
    'Jan',
    'Novák',
    '21/3/2002',
    'Student',
    'Vysoká škola ekonomická v Praze, Fakulta národohospodářská',
    'Nám. Winstona Churchilla',
    '1938',
    '4',
    '120 00 Praha 3-Žižkov',
    '987 123 321',
    'jan.novak@yahoo.com',
    'https://www.pngkey.com/png/full/72-729716_user-avatar-png-graphic-free-download-icon.png',
    'esotemp.vse.cz/~smap01/cv01',
    false
);

$person3 = new Person(
    'Nový',
    'Novák',
    '21/3/2003',
    'Pracovník',
    'Vysoká škola ekonomická v Praze, Studijní oddělení',
    'Nám. Winstona Churchilla',
    '1938',
    '4',
    '120 00 Praha 3-Žižkov',
    '987 123 321',
    'novy.novak@yahoo.com',
    'https://www.pngkey.com/png/full/72-729716_user-avatar-png-graphic-free-download-icon.png',
    'esotemp.vse.cz/~smap01/cv01',
    false
);

$people = [$person1, $person2, $person3];
?>

<body>
    <main class="page_container">
        <?php foreach ($people as $person) : ?>
            <div class='paper'>
                <div class='business_card front_page'>
                    <div class='logo info'><img src="<?php echo $person->avatar ?>" alt="user_avatar"></div>
                    <div class='col-sm-4 info'>
                        <div class='bc-lastname'>
                            <h2><?php echo $person->getFullName($person) ?></h2>
                        </div>
                        <div class='bc-position'>
                            <h3><?php echo $person->position . "&nbsp;&nbsp;&nbsp;&nbsp;" . calculateAge($person) . ' years old' ?></h3>
                        </div>
                        <div class='bc-company'>
                            <h3><?php echo $person->company ?></h3>
                        </div>
                    </div>
                </div>
                <div class='business_card'>
                    <div class='col-1 info'>
                        <img style='width:100%;' src='./img/logo_company.png' alt="company_logo">
                    </div>
                    <div class='col-0 info'>
                        <div class='bc-address'><i class='fas fa-map-marker-alt'></i> <?php echo $person->getFullAddress($person) ?></div>
                        <div class='bc-telephone'><i class='fas fa-phone'></i> <?php echo $person->telephone ?></div>
                        <div class='bc-email'><i class='fas fa-solid fa-envelope'></i> <?php echo $person->email ?></div>
                        <div class='bc-webpage'><i class='fas fa-solid fa-globe'></i> <?php echo $person->webpage ?></div>
                        <div class="bc-available"><?php echo $person->isJobless ? 'Now available for contracts' : 'Not available for contracts'; ?></div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </main>





    <?php include './includes/footer.php' ?>