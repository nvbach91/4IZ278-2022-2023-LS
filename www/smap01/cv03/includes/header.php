<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Player registration</title>
    <link rel="stylesheet" href="https://bootswatch.com/4/flatly/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="./css/styles.css">
</head>

<body>
    <header>
        <nav class="navbar">
            <a class="brand" href="<?php echo $_SERVER['PHP_SELF'] ?>">4IZ278</a>
            <div>
                <ul>
                    <li class='play'><a href="#play">Play</a></li>
                    <li><a href="#settings">Settings</a></li>
                    <li><a href="#help">Help</a></li>
                </ul>
            </div>
        </nav>
        <div class="et_col_2">
            <input class="navbar_search" name="search" placeholder="Search">
            <button><i class="fas fa-search"></i></button>
        </div>
    </header>