<?php
require_once('./database/Database.php');
//Class with singleton pattern that delegates instance creation to a method. Class works with sp_reviews table in database
class ReviewsDB{
    private $pdo;
    static $reviewsDB;
    private final function __construct()
    {
        $db=Database::getDatabase();
        $this->pdo=$db->getPdo();
    }

    //Function that shares or creates class instance and returns it
    public static function getDatabase(){
        if(!isset($reviewsDB)){
            self::$reviewsDB=new ReviewsDB;
        }
        return self::$reviewsDB;
    }

    //Function that adds a review for a book with book_id with user_id, reviewStars, reviewTitle, reviewMessage
    function addReview($book_id, $user_id, $reviewStars, $reviewTitle, $reviewMessage){
        try{
            $statement=$this->pdo->prepare("INSERT INTO sp_reviews (review_title, review_text, review_stars, review_book_id, review_user_id) VALUES (?, ?, ?, ?, ?);");
            $statement->bindParam(1, $reviewTitle);
            $statement->bindParam(2, $reviewMessage);
            $statement->bindParam(3, $reviewStars);
            $statement->bindParam(4, $book_id);
            $statement->bindParam(5, $user_id);
            $statement->execute();
            }catch(PDOException $e){
                return $e;
            }
    }

    //Function that returns review records for a book with book_id
    function getReviews($book_id){
        try{
        $statement=$this->pdo->prepare("SELECT * FROM sp_reviews WHERE review_book_id=:book_id");
        $statement->execute([':book_id'=>$book_id]);
        $result=$statement->fetchAll();
        return $result;
        }catch(PDOException $e){
            return $e;
        }
    }

    function getReviewsByOffset($book_id, $offset, $itemsCountPerPage)
    {
        $statement = $this->pdo->prepare("SELECT * FROM sp_reviews WHERE review_book_id=? ORDER BY review_id DESC LIMIT ? OFFSET ?");
        $statement->bindParam(2, $itemsCountPerPage, PDO::PARAM_INT);
        $statement->bindParam(3, $offset, PDO::PARAM_INT);
        $statement->bindParam(1, $book_id, PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }

    function getCountOfTotalRecord($book_id)
    {
        $statement = $this->pdo->prepare("SELECT * FROM sp_reviews WHERE review_book_id=:book_id");
        $statement->execute([':book_id'=>$book_id]);
        $result = $statement->fetchAll();
        return count($result);
    }
}


?>