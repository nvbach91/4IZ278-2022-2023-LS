<?php
$avatar = "https://gravatar.com/avatar/fa7f66472a076b2003d15d8d0e749004?s=400&d=robohash&r=x";
$firstName = "Petr";
$lastName = "Buk";
$birthdate = mktime(0, 0, 0, 01, 28, 2000);
$position = "PHP Developer";
$company = "Master programmers, s.r.o.";

$email = "petr.buk@masters.com";
$phone = "+420 111 222 333";
$street = "Winstona Churchilla, 110";
$city = "Praha 3, Žižkoff";
$web = "https://petrbuk.cz";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/main.css">
  <title>Vizitka</title>
</head>

<body>
  <article class="wrapper">
    <div class="card">
      <img class="avatar" src="<?php echo $avatar ?>" alt="avatar" />
      <div class="data-wrapper">
        <p class="name background">
          <?php echo $firstName, " ", $lastName ?>
        </p>
        <p>
          <?php echo date("m.d.Y", $birthdate) ?>
        </p>
        <p>
          <?php echo $position ?>
        </p>
        <p class="company">
          <?php echo $company ?>
        </p>
      </div>
    </div>
    <div class="card">
      <img class="avatar" src="<?php echo $avatar ?>" alt="avatar" />
      <div class="data-wrapper">
        <p class="background">
          <a href="<?php echo $web ?>" class="weblink">
            <?php echo $web ?>
          </a>
        </p>
        <p>
          <?php echo $email ?>
        </p>
        <p>
          <?php echo $phone ?>
        </p>
        <p>
          <?php echo $street ?>
        </p>
        <p>
          <?php echo $city ?>
        </p>
      </div>
    </div>
  </article>
</body>

</html>