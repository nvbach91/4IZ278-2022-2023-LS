<?php
class Product{
    public function __construct($id)
    {
        $this->id=$id;
    }
    public function showProduct()
    {
        $database = new Database();
        $query = "SELECT * FROM products WHERE product_id = ?";
        $params = array($this->id);
        $data = $database->queryGet($query,$params);
        return $data[0];

    }
    private $id;
}

?>