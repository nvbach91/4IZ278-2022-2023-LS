<?php
require_once './classes/Person.php';

$people = [
    new Person(
        "Otto Chairman",
        "17/12/1983",
        "Pizza Chef",
        "Risottiamo",
        "Joe Street 1, 10005 Namibia",
        "+420 725 888 777",
        "otto.chairman@risottiamo.com",
        "www.risottiamo.com",
        false
    ),

    new Person(
        "Joe Pizza",
        "18/12/1932",
        "Waiter",
        "Risottiamo",
        "Diehl Street 11, 10005 Namibia",
        "+264 81 33 33 056",
        "wildapple.org@gmail.com",
        "www.risottiamo.com",
        true
    ),

    new Person(
        "Muhammad Pizzaman",
        "1/12/2002",
        "Pizza Deliver Driver",
        "Risottiamo",
        "Xena Street, 10005 Namibia",
        "+264 61 415250",
        "reception@waldorf-namibia.org",
        "www.risottiamo.com",
        false
    )
];