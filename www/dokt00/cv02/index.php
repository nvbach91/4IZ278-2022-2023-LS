<?php

class Person
{
    public function __construct(
        public $avatar,
        public $firstName,
        public $lastName,
        public $title,
        public $company,
        public $phone,
        public $email,
        public $website,
        public $available,
        public $street,
        public $propertyNumber,
        public $orientationNumber,
        public $city,
        public $birthYear,
    ) {
    }

    function getFullName()
    {
        $fullName = $this->firstName . ' ' . $this->lastName;
        return $fullName;
    }

    function calculateAge($birthYear)
    {
        $age = 2023 - $this->birthYear;
        return $age;
    }

    function getFullAddress()
    {
        $fullAddress = $this->street . ' ' . $this->propertyNumber . '/' . $this->orientationNumber . ', ' . $this->city;
        return $fullAddress;
    }
}

$person1 = new Person(
    'jedi-logo.svg',
    'James',
    'Nobel',
    'Senior Developer',
    'Nobel s.r.o.',
    '+420 604 156 123',
    'skywalker@jedi-council.com',
    'www.jedi-council.com',
    false,
    "Bartolomějská",
    "113",
    "15",
    "Praha",
    1989,
);

$person2 = new Person(
    'jedi-logo.svg',
    'John',
    'Doe',
    'Junior Developer',
    'Nobel s.r.o.',
    '+420 603 106 123',
    'skywalker@jedi-council.com',
    'www.jedi-council.com',
    true,
    "Chodovská",
    "33",
    "6",
    "Praha",
    1909,
);

$people = [$person1, $person2];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Business card</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="./css/styles.css">
</head>

<body>
    <main class="container">
        <h1 class="text-center">My Business Card in PHP</h1>

        <?php foreach ($people as $person) : ?>
            <div class="business-card bc-front row">
                <div class="col-sm-4">
                    <div class="logo" style="background-image: url(./img/<?php echo $person->avatar; ?>)"></div>
                </div>
                <div class="col-sm-8">
                    <div class="bc-firstname"><?php echo $person->firstName; ?></div>
                    <div class="bc-lastname"><?php echo $person->lastName; ?></div>
                    <div class="bc-title"><?php echo $person->title; ?></div>
                    <div class="bc-company"><?php echo $person->company; ?></div>
                </div>
            </div>
            <div class="business-card bc-back row">
                <div class="col-sm-6">
                    <div class="bc-firstname"><?php echo $person->firstName; ?></div>
                    <div class="bc-lastname"><?php echo $person->lastName; ?></div>
                    <div class="bc-title"><?php echo $person->title ?></div>
                </div>
                <div class="col-sm-6 contacts">
                    <div class="bc-address"><i class="fas fa-map-marker-alt"></i> <?php echo $person->getFullAddress(); ?></div>
                    <div class="bc-phone"><i class="fas fa-phone"></i> <?php echo $person->phone; ?></div>
                    <div class="bc-email"><i class="fas fa-at"></i> <?php echo $person-> email; ?></div>
                    <div class="bc-website"><i class="fas fa-globe"></i> <?php echo $person->website; ?></div>
                    <div class="bc-available"><?php echo $person->available ? 'Not available for contracts' : 'Now available for contracts'; ?></div>
                </div>
            </div>
        <?php endforeach; ?>
    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js"></script>
</body>

</html>