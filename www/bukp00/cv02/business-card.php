<?php

require './Person.php';

$harry = new Person(
  'harry-potter.svg',
  'Harry',
  'Potter',
  mktime(0, 0, 0, 7, 31, 1980),

  'Chaser',
  'Hufflepuff',

  '+420 222 111 333',
  'harry@hogwarts.com',
  'www.harry-potter.com',

  'Hogwarts 33',
  '123/21',
  'Hogsmeade',
);

$hermiona = new Person(
  'hermiona-granger.svg',
  'Hermiona',
  'Granger',
  mktime(0, 0, 0, 9, 19, 1979),

  'Beator',
  'Gryffindor',

  '+420 111 222 333',
  'hermiona@hogwarts.com',
  'www.hermiona-granger.com',

  'Shrieking Shack 1',
  '123/21',
  'Hogsmeade',
);

$ron = new Person(
  'ron-weasley.svg',
  'Ron',
  'Weasley',
  mktime(0, 0, 0, 3, 1, 1980),

  'Keeper',
  'Ravenclaw',

  '+420 333 111 222',
  'ron@hogwarts.com',
  'www.ron-weasley.com',

  'Shrieking Shack 1',
  '123/21',
  'Hogsmeade',
);

$people = [$harry, $hermiona, $ron];

?>

<?php foreach ($people as $person) : ?>
  <article class="person">
    <div class="card">
      <img class="avatar" src="img/<?php echo $person->avatar ?>" alt="avatar" />
      <div class="data-wrapper">
        <p class="name background">
          <?php echo $person->getFullName() ?>
        </p>
        <p>
          <?php echo $person->getAge() ?>
        </p>
        <p>
          <?php echo $person->position ?>
        </p>
        <p class="company">
          <?php echo $person->company ?>
        </p>
      </div>
    </div>
    <div class="card">
      <img class="avatar" src="img/<?php echo $person->avatar ?>" alt="avatar" />
      <div class="data-wrapper">
        <p class="background">
          <a href="<?php echo $person->web ?>" class="weblink">
            <?php echo $person->web ?>
          </a>
        </p>
        <p>
          <?php echo $person->email ?>
        </p>
        <p>
          <?php echo $person->phone ?>
        </p>
        <p>
          <?php echo $person->getAddress() ?>
        </p>
      </div>
    </div>
  </article>
<?php endforeach; ?>