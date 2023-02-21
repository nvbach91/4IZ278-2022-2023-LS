<?php
$name = "Milena Chadimová";
$age = "22 let";
$jobTitle = "Student ";
$jobName = "Vysoká škola ekonomická";
$adress = "Novovysočanská 4951";
$postalCode = 19000;
$city = " Praha";
$email = "chadimova.milena@seznam.cz";
$phoneNumber = "+725698425";
$webPage = "www.myportfolio.cz";
$lookingForJob = false;



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business card</title>
</head>

<body>
    <style>
        .business-card {
            position: relative;
            left: 35%;
            top: 50px;
            width: 370px;
            height: 200px;
            border: 2px solid darkgrey;
            padding: 20px;
            border-radius: 2%;
            background: rgb(255, 35, 61);
            color: black;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            overflow: hidden;
            z-index: -10;
            line-height: 0.65em;
        }

        .name {
            font-size: 1.7em;
            font-weight: 600;
            margin-bottom: 10px;
        }

        img {
            width: 100px;
            display: inline;
            float: right;
            position: relative;
            top: -160px;
        }

        .dot {
            height: 300px;
            width: 300px;
            background-color: lightgrey;
            border-radius: 50%;
            display: inline-block;
            position: relative;
            top: -250px;
            right: 160px;
            z-index: -1;
        }
    </style>
    <div class="business-card">
        <div class="name">
            <?php echo $name; ?>
        </div>
        <br>
        <div class="age">
            <?php echo $age; ?>
        </div>
        <br>
        <div class="job">
            <?php
            echo $jobTitle;
            echo $jobName;
            ?>
        </div>
        <br>
        <div class="adress">
            <?php echo $adress; ?>
        </div>
        <br>
        <div class="postal city">
            <?php
            echo $postalCode;
            echo $city;
            ?>
        </div>
        <br>
        <div class="email">
            <?php echo $email; ?>
        </div>
        <br>
        <div class="phone-number">
            <?php echo $phoneNumber; ?>
        </div>
        <br>
        <div class="web">
            <?php echo $webPage; ?>
        </div>
        <br>
        <div class="lookingForJob">
            <?php
            if ($lookingForJob) {
                echo "Sháním práci.";
            } else {
                echo "Nesháním práci";
            }
            ?>
        </div>
        <br>
        <div class="portrait">
            <img src="./portfolio_portrait.png" alt="my face">
        </div>
        <span class="dot"></span>
    </div>

</body>

</html>