<?php

class Team
{
    public function __construct(
        public $logo,
        public $teamName,
        public $company,
        public $title,
        public $driver1Number,
        public $driver1,
        public $driver1Date,
        public $driver2Number,
        public $driver2,
        public $driver2Date
    ) {
    }
}

$team1 = new Team(
    'mercedes.svg',
    'Mercedes',
    'AMG-Petronas',
    'FORMULA ONE TEAM',
    '44',
    'Lewis Hamilton',
    '07/01/1985',
    '63',
    'George Russell',
    '15/02/1998'
);

$team2 = new Team(
    'ferrari.svg',
    'Ferrari',
    'Scuderia Ferrari',
    'Formula 1 Team',
    '16',
    'Charles Leclerc',
    '16/10/1997',
    '55',
    'Carlos Sainz',
    '01/09/1994'
);

$team3 = new Team(
    'mclaren.jpeg',
    'McLaren',
    'McLaren Formula',
    'Formula 1 Team',
    '4',
    'Lando Norris',
    '13/11/1999',
    '81',
    'Oscar Piastri',
    '06/04/2001'
);

$team4 = new Team(
    'bwt.svg',
    'Alpine',
    'BWT Alpine',
    'F1 TEAM',
    '10',
    'Pierre Gasly',
    '07/02/1996',
    '31',
    'Esteban Ocon',
    '17/09/1996'
);

$team5 = new Team(
    'moneygram.svg',
    'HAAS',
    'MoneyGram',
    'F1 Team',
    '20',
    'Kevin Magnuss',
    '05/10/1992',
    '27',
    'Nico Hulkenberg',
    '19/08/1987'
);


$teams = [$team1, $team2, $team3, $team4, $team5];


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
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <main class="container">
        <?php foreach ($teams as $team) : ?>
            <div class="row">
                <div class="business-card bc-front">
                    <div class="col-sm-4">
                        <div class="logo" style="background-image: url(./assets/img/<?php echo $team->logo; ?>)"></div>
                    </div>
                    <div class="col-sm-8">
                        <div class="bc-teamname"><?php echo $team->teamName;; ?></div>
                        <div class="bc-company"><?php echo $team->company; ?></div>
                        <div class="bc-title"><?php echo $team->title; ?></div>
                    </div>
                </div>
                <div class="business-card bc-back">
                    <div class="col-sm-6">
                        <div class="bc-driver"><?php echo $team->driver1; ?></div>
                        <div class="bc-number"><?php echo $team->driver1Number; ?></div>
                        <div class="bc-date"><?php echo $team->driver1Date; ?></div>
                    </div>
                    <div class="col-sm-6">
                        <div class="bc-driver"><?php echo $team->driver2; ?></div>
                        <div class="bc-number"><?php echo $team->driver2Number; ?></div>
                        <div class="bc-date"><?php echo $team->driver2Date; ?></div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js"></script>
</body>

</html>