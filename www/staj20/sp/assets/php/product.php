<?php
class Product{
    public function __construct($id)
    {
        $this->id=$id;
    }
    public function showProduct()
    {
        $database = new Database();
        $query = "SELECT * FROM products WHERE product_id = $this->id";
        $data = $database->queryGet($query);
        return $data[0];

    }
    private $id;
}

?>