<?php
$name = 'Avdeeva Nadezhda';
$birthDate = "07/28/2001";
 
  $birthDate = explode("/", $birthDate);

  $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
    ? ((date("Y") - $birthDate[2]) - 1)
    : (date("Y") - $birthDate[2]));
  
$occupation = 'student';
$university = 'VŠE';
$street = ' nám. Winstona Churchilla';
$cPopisne = '1938';
$cOrientacni = '4';
$city = 'Prague 3';
$phone = '+420 866 367 277';
$email = 'avdn00@vse.cz';
$webPage = 'www.webpage-avdn00.com';
$available = true;

$address = $street . ' ' . $cPopisne . '/' . $cOrientacni . ', ' . $city;
$fullOccupation = $occupation . ' at ' . $university;
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Document</title>
  </head>
  <style>

    div.business-card {
      background-image: url(img/background.png);
      background-size: cover;
      width: 360px;
      margin-left:auto;
      margin-right:auto;
      border-radius: 15px;
    }

    div.head {
        display: inline-block;
        width: 360px;
        height: 100px;
    }

    div.logo {
        float: left;
        padding: 15px;
        padding-bottom: 0;
    }

    div.bc-name p{
    font-size: 25px;
    color: white;
    font-weight: bold;
    text-transform: uppercase;
    padding-right: 30px;
    text-align: right;
    color: cornflowerblue;
    
  }
    div.info {
      color: white;
      text-align: right;
      font-size: 14px;
      padding-bottom: 15px;
      padding-right: 30px;
    }

    hr{
      width: 70%;
      text-align: right;
       border: 0;
        height: 2px;
        background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(9, 84, 132), rgba(0, 0, 0, 0));
    }

    div.bc-occupation{
      text-transform: uppercase;
    }

    div.bc-available{
      font-style: italic;
      color: cornflowerblue;
    }

    div.bc-phone img,  div.bc-email img, div.bc-webPage img{
      width: 15px;
      padding-left: 4px;
    }
  

  </style>
  <body>

    <div class="business-card">
        <div class="head">
            <div class="logo">
              <img src="img/VSE_logo_black.png" width="105px">
            </div>
            <div class="bc-name"><p><?php echo $name?></p><hr></div>
        </div>
        
        <div class="info">
        
        <div class="bc-occupation"><?php echo $fullOccupation?></div>
    <div class="bc-street"><?php echo $address?></div>
        <div class="bc-available">
         <?php if ($available = true) {
          echo 'Now available for new projects';
         } else {echo 'Not available for new projects' ;}?></div>
        
        <div class="bc-phone"><?php echo $phone?><img src="img/phone.png"></div>
        <div class="bc-email"><?php echo $email?> <img src="img/email.png"></div>
        <div class="bc-webPage"><?php echo $webPage?><img src="img/web.png"></div>
         
         </div>
        

    </div>
  </body>
</html>