<?php

error_reporting(E_ERROR | E_PARSE);

$user = @$_COOKIE['username'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Easy tickets</title>
    <link rel="apple-touch-icon" sizes="180x180" href="assets/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="assets/site.webmanifest">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" type="text/css" href="./css/main.css">
</head>

<body class="bg-white text-black antialiased dark:bg-gray-900 dark:text-white">
    <div class="flex h-full w-full flex-col justify-between px-4 sm:px-6 xl:max-w-5xl xl:px-0">
        <header class="flex flex-col w-full items-center justify-between p-8">
            <div class="flex">
                <a href="/">
                    <div class="flex items-center justify-between">
                        <div class="mr-3">
                            <img src="./assets/logo.png" alt="Page logo" width=200 height=80 />
                        </div>
                    </div>
                </a>
            </div>
            <div class="flex items-center text-base leading-5">
                <a class="p-1 font-medium text-gray-900 dark:text-gray-100 sm:p-4" href="./index.php">
                    Home
                </a>
                <a class="p-1 font-medium text-gray-900 dark:text-gray-100 sm:p-4" href="./participant.php">
                    My tickets
                </a>
                <a class="p-1 font-medium text-gray-900 dark:text-gray-100 sm:p-4" href="./organiser.php">
                    My events
                </a>
                <a class="p-1 font-medium text-gray-900 dark:text-gray-100 sm:p-4" href="./login.php">
                    Login
                </a>
            </div>
        </header>