<?php require_once 'Database.php';?>
<?php 

class CategoriesDatabase extends Database{

    public function fetchAll(){
        $query = "SELECT * FROM `categories`";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function addCategory($name){
        $statement=$this->pdo->prepare("INSERT INTO categories (name) VALUES (?)");
        $statement->execute([$name]);
    }
}

?>