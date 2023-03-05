<?php
    require 'Person.php';

    $person1 = new Person(
      "avatar.jpg",
      "Maceška",
      "Zdeněk",
      "1999-12-11",
      "Software tester",
      "Vysoká škola ekonomická Praha",
      "Náměstí Winstona Churchilla",
      "69",
      "0",
      "Praha",
      "+420 123 456 789",
      "macz02@vse.cz",
      "https://insis.vse.cz/auth/student/studium.pl?studium=215227;obdobi=2024;lang=cz",
      false
    );

    $person2 = new Person(
      "avatar2.jpg",
      "Novák",
      "Karel",
      "1985-02-15",
      "Web Developer",
      "ABC s.r.o.",
      "Polská",
      "27",
      "12",
      "Brno",
      "+420 987 654 321",
      "novak@abc.cz",
      "https://www.abc.cz/",
      true
  );

    $person3 = new Person(
      "avatar3.jpg",
      "Nový",
      "Josef",
      "1977-09-03",
      "Project Manager",
      "XYZ a.s.",
      "Malostranské náměstí",
      "7",
      "1",
      "Praha",
      "+420 555 123 789",
      "novy@xyz.cz",
      "https://www.xyz.cz/",
      true
  );
  $people = [$person1, $person2, $person3];
  ?>
  <?php include('head.php'); ?>
  <div class='title'>Business cards in PHP</div>
    <?php foreach ($people as $person): ?>
      <div class="card">
        <img src="<?php echo $person->avatar; ?>" alt="Avatar">
        <h1><?php echo $person->getFullName(); ?></h1>
        <h2><?php echo $person->position; ?></h2>
        <p><?php echo $person->company; ?></p>
        <p><?php echo $person->getAddress(); ?></p>
        <p>Tel: <?php echo $person->phone; ?></p>
        <p>E-mail: <?php echo $person->email; ?></p>
        <p>Web: <a href="<?php echo $person->website; ?>"><?php echo $person->website; ?></a></p>
        <p>Věk: <?php echo $person->getAge(); ?></p>
        <p>Shání práci: <?php echo $person->looking_for_job ? 'Ano' : 'Ne'; ?></p>
      </div>
    <?php endforeach; ?>
  <?php include('foot.php'); ?>