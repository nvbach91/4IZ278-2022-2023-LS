<?php 
require('./Person.php');
require('./PersonUtils.php');

$PersonUtils = new PersonUtils();

// Files
$logo = 'icon.png';
$qrcode = 'qrcode.svg';
$place_icon = 'place_icon.svg';
$phone_icon = 'phone_icon.svg';
$at_icon = 'at_icon.svg';
$web_icon = 'web_icon.svg';

// Company infos
$company_name = 'PixelWave Tech.';
$website = 'https://www.pixelwave.tech';
$postcode = 11000;
$city = 'Prague';
$country = 'Czech Republic';
$street = 'Vodičkova';
$dn = '791';
$rn = '41';
$adress = $PersonUtils -> getAdress($postcode, $city, $country, $street, $dn, $rn);

// Creating characters
$people = [];
$PersonUtils = new PersonUtils();
array_push(
    $people,
    new Person(
        'David',
        'Novák',
        $PersonUtils -> getAge('03-12-1979'),
        '987-654-321',
        'Chief Executive Officer',
        $PersonUtils -> generateEmail('David', 'Novak'),
        true
    )
);

array_push(
    $people,
    new Person(
        'Petra',
        'Vlčková',
        $PersonUtils -> getAge('25-03-1986'), 
        '739 204 658',
        'Chief Technical Officer',
        $PersonUtils -> generateEmail('Petra', 'Vlckova'),
        false
    )
);

array_push(
    $people,
    new Person(
        'Tomáš',
        'Kratochvil',
        $PersonUtils -> getAge('14-08-1994'), 
        '775 916 223',
        'Chief Operating Officer',
        $PersonUtils -> generateEmail('Tomas', 'Kratochvil'),
        true
    )
);
?>

<body>

    <div class = "title">
        <h1>My First Buisness Card in PHP</h1>
    </div>
    <div class = 'main'>
        <?php foreach($people as $person): ?>
                <div class = 'buisness_card'>
                    <div class = 'front'>
                        <img class = 'icon' src = 'img/<?php echo $logo; ?>'>
                        <div class = 'line1'></div>
                        <div class = 'text1'>
                            <span class = 'name'> <?php echo $person -> getName(); ?> </span>
                            <span class = 'lastname'> <?php echo $person -> getLastName(); ?> </span> 
                            <div class = 'age'> <?php echo $person -> getAge(); ?> y.o</div>
                            <div class = 'position'><?php echo $person -> getPosition(); ?></div>
                        </div>
                    </div>
                    <div class = 'back'>
                        <div class = 'back_header'>
                            <img class = 'icon_small' src = 'img/<?php echo $logo; ?>'>
                            <p class = 'company_name'><?php echo $company_name; ?></p>
                        </div>
                        <img class = 'qrcode' src = 'img/qrcode.svg'>
                        
                        <div class = 'line2'></div>
                        <div class = 'contacts'>
                            <div class = 'contact_div'>
                                <img class = 'contact_icon' src = 'img/<?php echo $place_icon; ?>'>
                                <p class = 'contact_text' style = 'margin-left:18px'><?php echo $adress; ?></p>
                            </div>
                            <div class = 'contact_div'>
                                <img class = 'contact_icon' src = 'img/<?php echo $phone_icon; ?>'>
                                <p class = 'contact_text'>+420 <?php echo $person -> getPhone(); ?></p>
                            </div>
                            <div class = 'contact_div'>
                                <img class = 'contact_icon' src = 'img/<?php echo $web_icon; ?>'>
                                <p class = 'contact_text'><?php echo $website; ?></p>
                            </div>
                            <div class = 'contact_div'>
                                <img class = 'contact_icon' src = 'img/<?php echo $at_icon; ?>'>
                                <p class = 'contact_text'><?php echo $person -> getEmail(); ?></p>
                            </div>
                            <p class = 'contact_text'> <?php echo $person -> getAvailable() ? 'Now available for contracts' : 'Not available for contracts'; ?></p>
                        </div>
                    </div>
                </div>
        <?php endforeach; ?>
    </div>
</body>
</html>