<?php require_once 'Database.php';?>
<?php 

class ProductsDatabase extends Database{

    function getTotalRecortds(){
        $statement=$this->pdo->prepare("SELECT COUNT(*) AS count FROM products");
        $statement->execute();
        $result = $statement->fetchAll()[0]['count'];
        return $result;
    }

    function getTotalRecortdsByCategory($category_id){
        $statement=$this->pdo->prepare("SELECT COUNT(*) AS count FROM products WHERE category_id = $category_id");
        $statement->execute();
        $result = $statement->fetchAll()[0]['count'];
        return $result;
    }

    function fetchRecords($itemsCountPerPage,$offset){
        $query = "SELECT * FROM products ORDER BY product_id ASC LIMIT $itemsCountPerPage OFFSET ?";
        $statement = $this->pdo->prepare($query);
        $statement->bindParam(1,$offset,PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll();
    }

    function fetchRecordsByCategory($itemsCountPerPage,$offset,$category_id){
        $query = "SELECT * FROM products WHERE category_id = $category_id ORDER BY product_id ASC LIMIT $itemsCountPerPage OFFSET ?";
        $statement = $this->pdo->prepare($query);
        $statement->bindParam(1,$offset,PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function getRecortdsById($in_array){
        $in  = str_repeat('?,', count($in_array) - 1) . '?';
        $statement=$this->pdo->prepare("SELECT * FROM products WHERE product_id IN ($in)");
        $statement->execute($in_array);
        $result = $statement->fetchAll();
        return $result;
    }

    function getRecordById($id){
        $statement=$this->pdo->prepare("SELECT * FROM products WHERE product_id = $id");
        $statement->execute();
        $result = $statement->fetch();
        return $result;
    }

    function editRecord($id,$name,$price,$description,$img,$category_id){
        $statement=$this->pdo->prepare("UPDATE products SET name=?, price=?, description=?, img=?, category_id=? WHERE product_id = $id");
        $statement->execute([$name,$price,$description,$img,$category_id]);
    }

    function deleteRecord($id){
        $statement=$this->pdo->prepare("DELETE FROM products WHERE product_id = $id");
        $statement->execute();
    }

    function addRecord($name,$price,$description,$img,$category_id){
        $statement=$this->pdo->prepare("INSERT INTO products (name,price,description,img,category_id) VALUES (?,?,?,?,?)");
        $statement->execute([$name,$price,$description,$img,$category_id]);
    }
}

?>