
<?php 
require_once('Database.php');

class ProductDatabase extends Database {
    
    protected $tableName='products';

    public function fetchByCategory ($category_id){
        return $this->fetchBy('category_id',$category_id);
    }

    public function fetchById($productid)
    {
        return $this -> fetchBy('product_id', $productid);
    }

    public function fetchAllWithLimit($offset,$limit)
    {
        $sql = 'SELECT * FROM ' . $this->tableName . ' LIMIT '. $limit . ' OFFSET ' . $offset;
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }



    public function create($args)
    {
        $sql = 'INSERT INTO ' . $this->tableName . '(name, price, img) VALUES (:name, :price, :img)';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'name' => $args['name'], 
            'price' => $args['price'], 
            'img' => $args['img'],
        ]);
    }
}
?>