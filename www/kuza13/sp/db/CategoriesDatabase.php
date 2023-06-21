<?php 
class CategoriesDatabase extends Database {
    protected $tableName = 'categories';
    public function fetchByCategories($categoryName){
        return $this->fetchBy(`name`,$categoryName);
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