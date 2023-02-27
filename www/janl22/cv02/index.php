<?php

require_once 'classes/Person.php';

use classes\Person;

try {

	$person1 = new Person('assets/img/logo.svg', 'Luboš', 'Jánský', '2001-03-07', 'Consultant', 'nám. W. Churchilla', 1938, 4, 'Praha 3', 13067, '+420 123 456 789', 'janl22@vse.cz', 'https://fis.vse.cz/', true);
	$person2 = new Person('https://pr.vse.cz/wp-content/uploads/page/58/VSE_logo_CZ_circle_blue.png', 'VŠE', 'Praha', null, 'University', 'nám. W. Churchilla', 1938, 4, 'Praha 3', 13067, '+420 123 456 789', 'info@vse.cz', 'https://vse.cz/', false);
	$persons = array($person1, $person2);

} catch (Exception $e) {

}

?>
<?php $htmlTitle = 'Business Card'; require_once 'templates/htmlHeader.php'; ?>
<main>
    <div class="container mb-6">
        <?php foreach ($persons as $person): ?>
            <div class="mt-5 d-flex justify-content-center">
                <div class="row col-md-6 business-card">
                    <div class="col-md-4 text-end">
                        <img src="<?php echo $person->logo ?>" class="logo-front me-3" alt="Company logo">
                    </div>
                    <p class="col-md-8 text-start">
                        <span class="name"><?php echo $person->name ?></span><br>
                        <span class="surname"><?php echo $person->surname ?></span><br>
                        <span class="jobTitle"><?php echo $person->jobTitle ?></span>
                    </p>
                </div>
            </div>
            <div class="mt-5 d-flex justify-content-center">
                <div class="row col-md-6 business-card">
                    <div class="row">
                        <div class="col-md-10"></div>
                        <div class="col-md-2 text-end ">
                            <img src="<?php echo $person->logo ?>" class="logo-back" alt="Company logo">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <p class="address mb-1"><i class="fa-solid fa-map-location-dot"></i> <?php echo $person->getAddress() ?></p>
                            <p class="phone mb-1"><i class="fa-solid fa-phone"></i> <?php echo $person->phone ?></p>
                            <p class="mail mb-1"><i class="fa-solid fa-at"></i> <?php echo $person->mail ?></p>
                            <p class="webPage mb-1"><i class="fa-solid fa-globe"></i> <?php echo $person->webPade ?></p>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 d-flex align-items-end openForWork"><?php if ($person->openForWork) {echo 'Now open for contracts';} ?></div>
                        <div class="col-md-4"></div>
                        <div class="col-md-2 text-end ">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=50x50&margin=0&color=ffffff&bgcolor=172933&data=<?php echo $person->webPade ?>" class="qr-code" alt="QR code with web page link">
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>
<?php require_once 'templates/htmlFooter.php'; ?>