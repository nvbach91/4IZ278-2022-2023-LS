<?php require './data/data.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Risottiamo business cards</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <?php foreach($people as $Person) : ?>
        <div class=business-card>
            <div class="business-card-frontside">
                <div class="logo"><img class="picture" src="images/Pizza-logo-transparent-PNG.png" ></div>
                <div class=company-name><?php     echo $Person->getCompanyName(); ?></div>
            </div>
            <div class="business-card-backside">
                <div class="bc-left-side">
                    <div class="name"><?php    echo $Person->getName(); ?></div>
                    <div class="age"><?php     echo "Age: " . $Person->getAge(); ?></div>
                    <div class="job-position"><?php     echo $Person->getJobPosition(); ?></div>
                </div>
                <div class="bc-right-side">
                    <div class="adress"><?php     echo $Person->getAdress(); ?></div>
                    <div class="phone-number"><?php     echo $Person->getPhoneNumber(); ?></div>
                    <div class="email"><?php     echo $Person->getEmail(); ?></div>
                    <div class="website"><?php     echo $Person->getWebsite(); ?></div>
                    <div class="looking-for-job"><?php     echo $Person->isLookingForJob() ? 'Looking for new job' : 'Not looking for new job'; ?></div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</body>
</html>