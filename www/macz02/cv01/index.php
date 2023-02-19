<!DOCTYPE html>
<html>
  <head>
    <title>Vizitka</title>
  </head>
  <body>
  <style>
  <?php include 'styles.css'; ?>
  </style>
    <?php
      $avatar = "avatar.jpg";
      $surname = "Maceška";
      $firstname = "Zdeněk";
      $birthdate = "1999-12-11";
      $position = "Software tester";
      $company = "Vysoká škola ekonomicka Praha";
      $street = "Náměstí Winstona Churchilla";
      $housenumber = "69";
      $orientationnumber = "0";
      $city = "Praha";
      $phone = "+420 123 456 789";
      $email = "macz02@vse.cz";
      $website = "https://insis.vse.cz/auth/student/studium.pl?studium=215227;obdobi=2024;lang=cz";
      $looking_for_job = false;
      $age = "23";
    ?>
    <div>
      <img src="<?php echo $avatar ?>" alt="Avatar">
      <h1><?php echo $surname ?> <?php echo $firstname ?></h1>
      <h2><?php echo $position ?></h2>
      <p><?php echo $company ?></p>
      <p><?php echo $street ?> <?php echo $housenumber ?>/<?php echo $orientationnumber ?></p>
      <p><?php echo $city ?></p>
      <p>Tel: <?php echo $phone ?></p>
      <p>E-mail: <?php echo $email ?></p>
      <p>Web: <a href="<?php echo $website ?>"><?php echo $website ?></a></p>
      <p>Věk: <?php echo $age ?></p>
      <p>Shání práci: <?php echo $looking_for_job ? 'Ano' : 'Ne' ?></p>
    </div>
  </body>
</html>
