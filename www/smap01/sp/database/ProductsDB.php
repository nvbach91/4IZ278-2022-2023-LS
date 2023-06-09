<?php
require_once(__DIR__.'/Database.php');

//Class for working with sp_books table. Uses singleton pattern
class ProductsDB{
    private $pdo;
    static $productsDB;
    private final function __construct()
    {
        $db=Database::getDatabase();
        $this->pdo=$db->getPdo();
    }

    //Function that return class instance
    public static function getDatabase(){
        if(!isset($productsDB)){
            self::$productsDB=new ProductsDB;
        }
        return self::$productsDB;
    }

    //Function that returns book record with book_id
    function getBook($book_id)
    {
        $statement = $this->pdo->prepare("SELECT * FROM sp_books WHERE book_id=?");
        $statement->bindParam(1, $book_id);
        $statement->execute();
        $result = $statement->fetch();
        return $result;
    }
    
    //Function that returns items by offset using itemsCountPerPage
    function getItemByOffset($offset, $itemsCountPerPage)
    {
        $statement = $this->pdo->prepare("SELECT * FROM sp_books ORDER BY book_id ASC LIMIT ? OFFSET ?");
        $statement->bindParam(1, $itemsCountPerPage, PDO::PARAM_INT);
        $statement->bindParam(2, $offset, PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }

    //Function that returns the total number of records
    function getCountOfTotalRecord()
    {
        $statement = $this->pdo->prepare("SELECT * FROM sp_books");
        $statement->execute();
        $result = $statement->fetchAll();
        return count($result);
    }

    //Function that returns true if a book with book_id exists in the database otherwise returns false
    function bookExists($book_id)
    {
        $statement = $this->pdo->prepare("SELECT * FROM sp_books WHERE book_id=?");
        $statement->bindParam(1, $book_id);
        $statement->execute();
        $result = $statement->fetchAll();
        if (count($result) != 0) return true;
        return false;
    }

    //Function that inserts books into the database with name, authors, description, thumbnail and price. If successful returns NULL otherwise error
    function insertItem($name, $authors, $description, $thumbnail, $price)
    {
        try {
            $statement = $this->pdo->prepare("INSERT INTO sp_books (book_name, book_author, book_description, price, thumbnail_url) VALUES (?, ?, ?, ?, ?);");
            $statement->bindParam(1, $name);
            $statement->bindParam(2, $authors);
            $statement->bindParam(3, $description);
            $statement->bindParam(4, $price);
            $statement->bindParam(5, $thumbnail);
            $statement->execute();
        } catch (PDOException $e) {
            return $e;
        }
    }

    //Function that deletes a book record from the database with book_id
    function deleteItem($book_id)
    {
        try {
            $statement = $this->pdo->prepare("DELETE FROM sp_books WHERE book_id=?;");
            $statement->bindParam(1, $book_id);
            $statement->execute();
        } catch (PDOException $e) {
            return $e;
        }
    }

    //Function that modifies a particular book record with book_id
    function updateBook($book_id, $name, $authors, $description, $thumbnail, $price)
    {
        try {
            $statement = $this->pdo->prepare("UPDATE sp_books SET book_name = ?, book_description = ?, book_author=?, price=?, thumbnail_url=? WHERE book_id=?; ");
            $statement->bindParam(1, $name);
            $statement->bindParam(2, $description);
            $statement->bindParam(3, $authors);
            $statement->bindParam(4, $price);
            $statement->bindParam(5, $thumbnail);
            $statement->bindParam(6, $book_id);
            $statement->execute();
        } catch (PDOException $e) {
            return $e;
        }
    }

    //Function for pessimistic edit. Returns edited_by and opened_at columns from database
    function getEdited($book_id){
        try{
            $statement=$this->pdo->prepare("SELECT edited_by, opened_at FROM sp_books WHERE book_id=?;");
            $statement->bindParam(1, $book_id);
            $statement->execute();
            $result=$statement->fetch();
            return $result;
        }catch(PDOException $e){
            return $e;
        }
    }

    //Function for pessimistic edit. Sets edited_by and opened_at columns in the database for a book with book_id
    function setEdited($book_id, $edited_by, $opened_at){
        try{
            $statement=$this->pdo->prepare("UPDATE sp_books SET edited_by=?, opened_at=? WHERE book_id=?;");
            $statement->bindParam(1, $edited_by);
            $statement->bindParam(2, $opened_at);
            $statement->bindParam(3, $book_id);
            $statement->execute();
            $result=$statement->fetch();
            return $result;
        }catch(PDOException $e){
            return $e;
        }
    }
}


?>