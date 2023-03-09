<?php
//PascalCase

require './Person.php';


$person1 = new Person('Bob','Green','+654323456',1994,'street1', 'economist', 'bob-green@gmail.com','webpage-green.com',false, 'img/VSE_logo_black.png');

$person2 = new Person('Anna', 'Black', '+9876523456',2001,'street2', 'designer', 'anna-black@mail.ru','webpage-black.com',true, 'img/logo2.png');

$person3 = new Person('Peter', 'Cloud','+420789765274',1978,'street3','data analyst','peter.cloud@gmail.com','www.peter-cloud.com',false,'img/logo.png');

$people = [$person1,$person2,$person3];
// echo $person1 -> name;
// var_dump($person1);

$name = 'Avdeeva Nadezhda';
$birthDate = "07/28/2001";
$birthYear = 2001;
 
  $birthDate = explode("/", $birthDate);

  $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
    ? ((date("Y") - $birthDate[2]) - 1)
    : (date("Y") - $birthDate[2]));

    function calculaetAge($birthYear) {
      $age1 = 2023 - $birthYear;
      return $age1;
    }


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


<?php include './head.php';?>

<?php foreach($people as $person):?>
    <div class="business-card">
        <div class="head">
            <div class="logo">
              <img src=<?php echo $person -> logo?> width="90px">
            </div>
            <div class="bc-name"><p><?php echo $person -> GetFullName();?></p><hr></div>
        </div>
        
        <div class="info">
        
        <div class="bc-occupation"><?php echo $person -> occupation;?></div>
    <div class="bc-street"><?php echo $person -> street;?></div>
        <div class="bc-available">
         <?php if ($person ->available ==true) {
          echo 'Now available for new projects';
         } else {echo 'Not available for new projects' ;}?></div>
        
        <div class="bc-phone"><?php echo $person->phone;?><img src="img/phone.png"></div>
        <div class="bc-email"><?php echo $person->email;?> <img src="img/email.png"></div>
        <div class="bc-webPage"><?php echo  $person->webPage;?><img src="img/web.png"></div>
         <!-- <div><?php echo calculaetAge($birthYear) ?></div> -->
         </div>
        
    </div>
    <?php endforeach?>

<?php include './foot.php';?>
