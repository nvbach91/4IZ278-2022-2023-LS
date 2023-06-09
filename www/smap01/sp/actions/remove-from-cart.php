<?php
session_start();
require_once('../database/UsersDB.php');
$usersDB=UsersDB::getDatabase();

//First enter and input tests
if(!isset($_COOKIE['user_email'])||!$usersDB->userExists(htmlspecialchars($_COOKIE['user_email']))){
    header('Location: ../login.php');
    exit;
}
if(!isset($_GET)||!isset($_GET['book_id'])){
    header('Location: ../index.php');
    exit;
}

$delete=false;

if(isset($_GET['all'])&&$_GET['all']==1){
    $book_cart=deleteBook($_SESSION['books'], getBookIndex($_SESSION['books'], htmlspecialchars($_GET['book_id'])));
    $_SESSION['books']=$book_cart;
    header('Location: '.$_SERVER['HTTP_REFERER']);
    exit;
}

if(!isset($_SESSION['books'])){
    header('Location: '.$_SERVER['HTTP_REFERER']);
    exit;
}else{
    $book_cart=removeBook($_SESSION['books'], htmlspecialchars($_GET['book_id']));
    $_SESSION['books']=$book_cart;
    header('Location: '.$_SERVER['HTTP_REFERER']);
    exit;
}


//Function that takes an array of ids and decreases the count of a particular book in a book is found in the seesion
function removeBook($book_cart, $book_id){
    $index=getBookIndex($book_cart, $book_id);
    if($index>=0){
        $book_cart[$index]['book_count']-=1;
        if($book_cart[$index]['book_count']<=0){
            $book_cart=deleteBook($book_cart, getBookIndex($book_cart, $book_id));
        }
    }
    return $book_cart;
}

//Function that returns index of a book by book_id from book_cart array. If match is found, returns the index of the book otherwise return -1.
function getBookIndex($book_cart, $book_id){
    for($i=0;$i<count($book_cart);$i++){
        if($book_cart[$i]['book_id']==$book_id){
            return $i;
        }
    }
    return -1;
}

//Function that moves book records after book_index from book_cart array one index to the left and unsets the last one to effectively shorten the array. Returns the edited book_cart array
function deleteBook($book_cart, $book_index){
    for($i=$book_index;$i<count($book_cart)-1;$i++){
        $book_cart[$i]=$book_cart[$i+1];
    }
    echo "<br>";
    unset($book_cart[count($book_cart)-1]);
    return $book_cart;
}
