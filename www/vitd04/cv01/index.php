<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="output.css" rel="stylesheet">
</head>

<?php

$avatarUrl = 'https://www.swiftyspace.com/Logo.svg'; //Avatar nebo Logo
$lastName = 'Vít'; //Příjmení
$firstName = 'Dominik'; //Jméno
$birthDate = '2000-02-12'; // Věk (výpočet z datumu narození)
$role = 'Developer'; //Povolání nebo Pozice
$company = 'SwiftySpace s. r. o. '; // Název firmy
$street = 'Nám. W. Churchilla'; // Ulice
$houseNumber = 141; // Číslo popisné
$zip = '141 00'; // Číslo orientační
$city = 'Praha 4'; //Město
$phone = '+420 735 012 000'; //Telefon
$email = 'mail@dominikvit.cz'; // E-mail
$web = 'dominikvit.cz'; // Adresa webové stránky
$lookingForWork = true; // Zda sháníte práci (Boolean)

function getAge($date)
{
    return intval(date('Y', time() - strtotime($date))) - 1970;
}

?>

<body class="w-full">
    <div class="mt-12 bg-black w-[600px] h-[300px] mx-auto text-white flex space-x-12 p-12 items-center">
        <div>
            <img src="<?php echo $avatarUrl; ?>" alt="" class="w-36" />
        </div>
        <div class="flex-1">
            <h1 class="font-bold text-3xl">
                <?php echo $firstName . " " . $lastName . " (" . getAge($birthDate) . ")"; ?>
            </h1>
            <span class="text-xs text-gray-400">
                <?php echo $role; ?> @
                <?php echo $company; ?>
            </span>
            <a href="<?php echo $web; ?>" class="text-xs text-indigo-400 block">
                <?php echo $web; ?>
            </a>

            <div class="mt-3">
                <?php
                if ($lookingForWork) {
                    echo "Looking for opportunities";
                } else {
                    echo "Not looking for opportunities";
                }
                ?>
            </div>
        </div>
    </div>

    <div class="mt-12 bg-black w-[600px] h-[300px] mx-auto p-12 text-white space-y-4">
        <div>
            <h1>
                <?php echo $company; ?>
            </h1>
            <p>
                <?php echo $street; ?>
                <?php echo $houseNumber; ?>
            </p>
            <p>
                <?php echo $zip; ?>
                <?php echo $city; ?>
            </p>
        </div>
        <div>
            <h1 class="uppercase text-xs text-gray-400 font-bold">Kontakt</h1>
            <p class="text-sm">Phone:
                <?php echo $phone; ?>
            </p>
            <p class="text-sm">Email:
                <?php echo $email; ?>
            </p>
        </div>
    </div>
</body>

</html>