<?php

$avatarPath = 'https://esotemp.vse.cz/~tolo00/cv01/avatar.jpg';
$name = 'Ondřej';
$surname = 'Tölg';
$age = 21;
$proffesion = 'Lead Developer';
$companyName = 'FaceBlock Ent.';
$street = 'Pražská';
$streetNumber = '123/2a';
$zip = '363 01';
$city = 'Ostrov';
$phone = '(+420) 608 363 903';
$email = 'tolgicraft@gmail.com';
$url = 'www.faceblockentertainment.com';
$lookingForJob = false;

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FaceBlock Entertainment - Ondřej Tölg</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/foundation-sites@6.7.5/dist/css/foundation.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" crossorigin="anonymous">

    <style>
        .page {
            min-height: 16rem;
            color: white;
            background-color: black;
            border-radius: 1rem;
            padding: 1rem;
            margin-bottom: 1rem;
            box-shadow: 9px 2px 53px -18px rgba(0,0,0,0.75);
            border: 2px solid white;
        }

        .page .logo {
            max-width: 13rem;
            max-height: 13rem;
        }

        .front-page .name-main {
            font-weight: bold;
        }

        .front-page hr {
            border: 1px solid white;
            width: 50%;
            margin: 1rem auto;
        }

        .back-page i {
            margin-left: 1rem;
            margin-right: 0.5rem;
        }

        .back-page a {
            color: white;
            text-decoration: underline;
        }

        .back-page a:hover {
            text-decoration: none;
        }
    </style>
</head>

<body>
<div class="grid-container">
    <div class="grid-x grid-padding-x align-center">
        <div class="cell medium-6">
            <h1 class="text-center">Vizitka FaceBlock Entertainment</h1>

            <div class="page front-page">
                <div class="grid-x align-middle">
                    <div class="cell medium-5">
                        <img class="logo" src="<?= $avatarPath ?>">
                    </div>

                    <div class="cell medium-7">
                        <div class="grid-y">
                            <div class="cell">
                                <h2 class="text-center name-main">
                                    <?= $name . ' ' . $surname ?>
                                </h2>
                            </div>

                            <hr>

                            <div class="cell">
                                <h4 class="text-center profession">
                                    <?= $proffesion ?>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page back-page">
                <div class="grid-x align-middle">
                    <div class="cell medium-7">
                        <div class="grid-y">
                            <div class="cell">
                                <h3><?= $companyName ?></h3>
                            </div>

                            <div class="cell">
                                <i class="fa-solid fa-person"></i> <?= $name . ' ' . $surname ?>
                            </div>

                            <div class="cell">
                                <i class="fa-solid fa-calendar-days"></i>  <?= $age ?> let
                            </div>

                            <div class="cell">
                                <i class="fa-solid fa-briefcase"></i> <?= $proffesion ?>
                            </div>

                            <div class="cell">
                                <i class="fa-solid fa-location-dot"></i> <?= $street . ' ' . $streetNumber . ', ' . $zip . ' ' . $city ?>
                            </div>

                            <div class="cell">
                                <i class="fa-solid fa-envelope"></i> <?= $email ?>
                            </div>

                            <div class="cell">
                                <i class="fa-solid fa-phone"></i> <?= $phone ?>
                            </div>

                            <div class="cell">
                                <i class="fa-solid fa-link"></i> <a href="<?= $url ?>" target="_blank"><?= $url ?></a>
                            </div>
                        </div>
                    </div>

                    <div class="cell medium-5">
                        <img class="logo" src="<?= $avatarPath ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/foundation/6.6.3/js/foundation.min.js"></script>
</body>
</html>
