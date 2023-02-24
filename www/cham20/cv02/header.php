<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business card</title>
</head>

<body>
    <style>
        .business-card {
            position: relative;
            left: 35%;
            top: 50px;
            width: 370px;
            height: 200px;
            border: 2px solid darkgrey;
            padding: 20px;
            border-radius: 2%;
            background: rgb(255, 35, 61);
            color: black;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            overflow: hidden;
            z-index: -10;
            line-height: 0.75em;
            margin-bottom: 20px;
        }

        .name {
            font-size: 1.7em;
            font-weight: 600;
            margin-bottom: 10px;
        }

        img {
            width: 100px;
            display: inline;
            float: right;
            position: relative;
            top: -80px;
        }

        .dot {
            height: 300px;
            width: 300px;
            background-color: lightgrey;
            border-radius: 50%;
            display: inline-block;
            position: relative;
            top: -250px;
            right: 160px;
            z-index: -1;
        }
    </style>