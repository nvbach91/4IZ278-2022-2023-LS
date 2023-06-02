<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$databaseName = 'bookstore';

$connection = mysqli_connect(
    $servername,
    $username,
    $password,
    $databaseName
) or die('connection failed');


function getAllBooks($connection)
{
    $query = 'SELECT * FROM `products`';
    $selectBooks = mysqli_query($connection, $query);
    $books = array();
    while ($fetch_row = mysqli_fetch_assoc($selectBooks)) {
        $books[] = $fetch_row;
    }
    return $books;
}

function getBooksByGenre($connection, $genre)
{
    $query = "SELECT * FROM `products` WHERE genre ='$genre'";
    $selectBooks = mysqli_query($connection, $query);
    $books = array();
    while ($fetch_row = mysqli_fetch_assoc($selectBooks)) {
        $books[] = $fetch_row;
    }
    return $books;
}
