<?php require_once './data.php' ?>

<?php foreach ($people as $person) : ?>
    <div class="bussiness-card">
        <div class="company-logo-wrapper">
            <div class="company-logo-image" style="background-image: url('./img/company/<?php echo $person->getCompany()->getLogoImageName(); ?>');"></div>
        </div>

        <div class="info-box">
            <div class="portrait-wrapper">
                <div class="portrait-image" style="background-image: url('./img/portrait/<?php echo $person->getPortraitImageName(); ?>');"></div>
            </div>
            <div class="person-info">
                <div class="main-info">
                    <h2><?php echo $person->getName(); ?></h2>
                    <p><?php echo $person->getPosition(); ?></p>
                    <p><?php echo $person->getBirthdate() . " (" . $person->calculateAge() . " let)"; ?></p>
                </div>
                <div class="contact-info">
                    <p><a href="tel:<?php echo $person->getPhone(); ?>"><?php echo $person->getPhone(); ?></a></p>
                    <p><a href="mailto:<?php echo $person->getEmail(); ?>"><?php echo $person->getEmail(); ?></a></p>

                    <?php if ($person->getName() === "Andrej Babiš") : ?>
                        <p class="stress"><?php echo $person->isEmployed() ? "nikdy neodstupim" : "Máro, gdě stě?" ?></p>
                    <?php else : ?>
                        <p><?php echo $person->isEmployed() ? "Zaměstnaný/á" : "Otevřený/a novým příležitostem" ?></p>
                    <?php endif; ?>

                </div>
            </div>

            <div class="company-contact-info">
                <?php if ($person->getCompany() !== null) : ?>
                    <h2><?php echo $person->getCompany()->getName(); ?></h2>
                    <div class="address">
                        <p><?php echo $person->getCompany()->getStreet(); ?></p>
                        <p><?php echo $person->getCompany()->getZipcode(); ?></p>
                        <p><?php echo $person->getCompany()->getCity(); ?></p>
                        <p><?php echo $person->getCompany()->getCountry(); ?></p>
                    </div>
                    <p>
                        <a href="https://<?php echo $person->getCompany()->getWeb(); ?>">
                            <?php echo $person->getCompany()->getWeb(); ?>
                        </a>
                    </p>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>