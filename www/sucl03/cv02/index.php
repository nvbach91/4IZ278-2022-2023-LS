<?php

class Person {
        public $avatar;
        public $firstName;
        public $lastName;
        public $phone;
        public $street;
        public $propNumber;
        public $orientationNumber;
        public $city;
        public $birthYear;
        public function __construct($avatar, $firstName, $lastName, $phone, $street, $propNumber, $orientationNumber, $city, $birthYear)
        {
        $this->avatar = $avatar;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->phone = $phone;
        $this->street = $street;
        $this->propNumber = $propNumber;
        $this->orientationNumber = $orientationNumber;
        $this->city = $city;
		$this->birthYear = $birthYear;
    }
    public function getAddress() {
        return "$this->street $this->propNumber / $this->orientationNumber, $this->city";
    }
    public function getAge() {
        return (int) date("Y") - $this->birthYear;
    }
}

$person1 = new Person (
    'cervena-karkulka.jpg',
    'Červená',
    'Karkulka',
    '+420 444 222 000',
    'Úplně pusto',
    '77',
    '155',
    'Les',
    2000
);

$person2 = new Person (
    'hladovy-vlk.jpg',
    'Hladový',
    'Vlk',
    '+420 420 420 420',
    'Ještě více pusto',
    '12',
    '150',
    'Les',
    1960
);

$person3 = new Person (
    'hodna-babicka.jpg',
    'Hodná',
    'Babička',
    '+420 111 222 333',
    'Úplně pusto',
    '77',
    '155',
    'Les',
    1918
);

$people = [$person1, $person2, $person3];

require('libs/html-header.php');

?>


<main class="container">
        <h1 class="text-center">Vizitky</h1>
<?php foreach($people as $person): ?>
    <div class="row">
			<div class="business-card bc-front">
				<div class="col-sm-4">
					<div class="logo" style="background-image: url(./img/<?php echo $person->avatar ?>)"></div>
				</div>
				<div class="col-sm-8">
					<div class="bc-firstname"><?php echo $person->firstName ?></div>
					<div class="bc-lastname"><?php echo $person->lastName ?></div>
				</div>
			</div>
			<div class="business-card bc-back">
				<div class="col-sm-6">
					<div class="bc-firstname"><?php echo $person->firstName ?></div>
					<div class="bc-lastname"><?php echo $person->lastName ?></div>
				</div>
				<div class="col-sm-6 contacts">
					<div class="bc-address"><i class="fas fa-map-marker-alt"></i> <?php echo $person->getAddress() ?></div>
					<div class="bc-phone"><i class="fas fa-phone"></i> <?php echo $person->phone ?></div>
					<div class="bc-age"><?php echo $person->getAge() ?></div>
				</div>
			</div>
		</div>
<?php endforeach; ?>
</main>

<?php

require('libs/html-footer.php');

?>