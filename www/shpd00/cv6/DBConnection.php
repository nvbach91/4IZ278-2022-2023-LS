<?php
require_once 'Product.php';
class DBConnection{
    private $conn;
    public function __construct(){
        $dbconfig = parse_ini_file('dbconfig.ini');
        $this->conn = new mysqli($dbconfig['db_server'], $dbconfig['db_user'], $dbconfig['db_password']);
        if ($this->conn->connect_error) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    function getProducts($category_id = -1){
        $query = 'SELECT p.name,p.price,p.category_id FROM eshop.products p';
        if($category_id != -1):
            $query = $query." WHERE category_id = '".$category_id."'";
        endif;
        if ($result = $this->conn -> query($query)) {
            $dbOutput = $result->fetch_all();
            $result -> free_result();
            $output= array();
            foreach($dbOutput as $productArray):
                array_push($output,new Product( $productArray[0] ,$productArray[1]));
            endforeach;
            return $output;
          }
        return;
    }

    function getCategories(){
        if ($result = $this->conn -> query("SELECT category_id, name FROM eshop.categories")) {       
            $dbOutput = $result->fetch_all();
            $result -> free_result();
            return $dbOutput;
          }
        return;
    }
}

$dbcon= new DBConnection();
?>