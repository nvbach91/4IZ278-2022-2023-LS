<?php
$name = "David";
$surname = "Wais";
$age = 21;
$profession = "Student";
$student = "VŠE";
$street = "Obama Street";
$streetPopis = 123;
$streetOrient = 7;
$wholeStreet = $street . " " . $streetPopis . "/" . $streetOrient;
$city = "New Prague";
$phone = 723 888 777;
$mail = "david@wais.cz";
$webUrl = "david.pohena.com";
$doINeedWork = true;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vizitka</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="vizitka">
    <img src="https://images.unsplash.com/photo-1481349518771-20055b2a7b24?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MzN8fHJhbmRvbS4uLnxlbnwwfHwwfHw%3D&w=1000&q=80" alt="Profile picture">
    <div class="leftSide">
        <h2 class="nameSur"><?php echo $name . " " . $surname ?></h2>
        <p class="student"><?php echo $profession ?></p>
        <ul class="underLeftSide">
            <p><?php echo $phone ?></p>
            <p><?php echo $mail ?></p>
            <p><?php echo $webUrl ?></p>
        </ul>
    </div>
    <div class="rightSide">
        <p><?php echo $age ?> years old</p>
        <p>Studying at <?php echo $student ?></p>
        <p><?php echo $wholeStreet ?></p>
        <p><?php echo $city ?></p>
        <p>Looking for work: <?php echo ($doINeedWork ? "Yes" : "No") ?></p>
    </div>
</div>
</body>
</html>
