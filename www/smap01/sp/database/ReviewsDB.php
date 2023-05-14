<?php
require_once(__DIR__.'/Database.php');
class ReviewsDB extends Database{
    function addReview($book_id, $user_id, $reviewStars, $reviewTitle, $reviewMessage){

    }
    function deleteReview($book_id, $user_id){

    }
    function updateReview($book_id, $user_id, $reviewStars, $reviewTitle, $reviewMessage){

    }
    function getUsersReviews($user_id){

    }
    function getUsersBookReview($user_id, $book_id){

    }
    function getBooksReviews($book_id){
        
    }
}


?>