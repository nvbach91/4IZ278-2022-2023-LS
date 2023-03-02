<?php
require_once './classes/company.php';
require_once './classes/person.php';

$companies = [
    "Agrofert" => new Company(
        "AGROFERT, a.s.",
        "www.agrofert.cz",
        "Pyšelská 2327/2",
        "149 00",
        "Praha 4 - Chodov",
        "Česká republika",
        "agrofert.png"
    ),
   "Globus" => new Company(
        "Globus ČR, v.o.s.",
        "www.globus.cz",
        "Kostelecká 822/75",
        "196 00",
        "Praha 9 - Čakovice",
        "Česká republika",
        "globus.png"
    )
];

$people = [
    new Person(
        "Andrej Babiš",
        "Generálný ředitěl",
        "2.9.1954",
        "+420272192111",
        "bossbabis@agrofert.cz",
        true,
        "babis.png",
        $companies["Agrofert"]
    ),
    new Person(
        "Vivien Babišová",
        "sekretářka",
        "28.7.2000",
        "+420272338412",
        "vbabisova@agrofert.cz",
        true,
        "vivien.png",
        $companies["Agrofert"]
    ),
    new Person(
        "Karel Zeman",
        "CEO",
        "14.4.1973",
        "+420715201465",
        "reditel@globus.cz",
        true,
        "karel-zeman.png",
        $companies["Globus"]
    )
];
