<?php
include '../config.php';
include_once 'utils.php';


if (isset($_POST['genre'])) {
    $genre = $_POST['genre'];
    if ($genre === "") {
        $books = getAllBooks($connection);
    } else {
        $books = getBooksByGenre($connection, $genre);
    }
    echo json_encode($books);
}
