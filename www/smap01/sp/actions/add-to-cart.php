<?php
session_start();
require_once('../database/UsersDB.php');
$usersDB=UsersDB::getDatabase();

//First enter and input tests
if(!isset($_COOKIE['user_email'])||!$usersDB->userExists($_COOKIE['user_email'])){
    header('Location: ../login.php');
    exit;
}
if(!isset($_GET)||!isset($_GET['book_id'])){
    header('Location: ../index.php');
    exit;
}

if(!isset($_SESSION['books'])){
    $_SESSION['books']=[
        ['book_id'=>$_GET['book_id'],'book_count'=>1]
    ];
    header('Location: '.$_SERVER['HTTP_REFERER']);
    exit;
}else{
    $book_cart=addBook($_SESSION['books'], $_GET['book_id']);
    $_SESSION['books']=$book_cart;
    header('Location: '.$_SERVER['HTTP_REFERER']);
    exit;
}

//Function that takes an array of ids and counts and pushes into the array if a book is not found or increments the count of a particular book in a book is found in the seesion
function addBook($book_cart, $book_id){
    $index=-1;
    $found=false;
    for($i=0;$i<count($book_cart);$i++){
        if($book_cart[$i]['book_id']==$book_id){
            $index=$i;
            $found=true;
        }
    }
    if($found){
        $book_cart[$index]['book_count']+=1;
    }else{
        array_push($book_cart, ['book_id'=>$book_id, 'book_count'=>1]);
    }
    return $book_cart;
}
