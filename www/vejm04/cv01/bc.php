<?php
    $avatar = 'img/icon.png';
    $name = 'Jan';
    $surname = 'Novák';
    $birth = '12/04/1974';
    $birth = explode("/", $birth);
    $age = (date("md", date("U", mktime(0, 0, 0, $birth[0], $birth[1], $birth[2]))) > date("md")
        ? ((date("Y") - $birth[2]) - 1)
        : (date("Y") - $birth[2]));
    $job = 'Developer';
    $company = 'Tesco';
    $street = 'Ulicova';
    $streetNumber = '123';
    $specificNumber = '45';
    $city = 'Praha';
    $streetComplete = $street . ' ' . (string) $streetNumber . '/' . (string) $specificNumber . ', ' . $city;
    $phone = '+420 123 456 789';
    $email = 'jan.novak@tesco.cz';
    $web = 'www.tesco.cz';
    $looking = false;
?>

<!DOCTYPE html>
    <head>
        <meta charset = 'utf-8'>
        <title>Buisness card</title>
        <link rel = 'stylesheet' href = 'style.css'/>
    </head>
    <body>
        <div class = "front">
            <img class = 'avatar' src = '<?php echo $avatar; ?>'>
            <div class = 'line'></div>
            <div class = 'text'>
                <span class = 'name'> <?php echo $name; ?> </span>
                <span class = 'lastname'> <?php echo $surname; ?> </span> 
                <div class = 'age'>Age: <?php echo $age; ?></div>
                <div class = 'position'><?php echo $job; ?></div>
            </div>
        </div>
        <div class = 'back'>
            <div class = 'contacts'>
            <p class = 'company_name'><?php echo $company; ?></p>
                <div class = 'contact_div'><?php echo $streetComplete; ?></div>
                <div class = 'contact_div'><?php echo $phone; ?></div>
                <div class = 'contact_div'><?php echo $email; ?></div>
                <div class = 'contact_div'><?php echo $web; ?></div>
                <div class = 'contact_div'> <?php echo $looking ? 'Looking for a new job' : 'Not looking for a new job'; ?></div>
            </div>
        </div>
    </body>
</html>