
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
    public function fetchByName($productName)
    {
        return $this -> fetchBy('product_name', $productName);
    }

    public function fetchAllWithLimit($offset,$limit)
    {
        $sql = 'SELECT * FROM ' . $this->tableName . ' LIMIT '. $limit . ' OFFSET ' . $offset;
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function updateProduct($productId, $newProductName, $newPrice, $newCategoryId, $newDiscount, $newImgLink)
    {
        $sql = 'UPDATE products SET ';
    
        $sets = [];
        if (($newProductName)!=null) {
            $sets[] = 'product_name = :new_product_name';
        }
        if (($newPrice)!=null) {
            $sets[] = 'price = :new_price';
        }
        if (($newCategoryId)!=null) {
            $sets[] = 'category_id = :new_category_id';
        }
        if (($newDiscount)!=null) {
            $sets[] = 'discount = :new_discount';
        }
        if ($newImgLink!=null) {
            $sets[] = 'img_link = :new_img_link';
        }
    
        $sql .= implode(', ', $sets);
        $sql .= ' WHERE product_id = :product_id';
    
        $statement = $this->pdo->prepare($sql);
    
        if (($newProductName)!=null) {
            $statement->bindValue(':new_product_name', $newProductName);
        }
        if (($newPrice)!=null) {
            $statement->bindValue(':new_price', $newPrice);
        }
        if (($newCategoryId)!=null) {
            $statement->bindValue(':new_category_id', $newCategoryId);
        }
        if (($newDiscount)!=null) {
            $statement->bindValue(':new_discount', $newDiscount);
        }
        if (($newImgLink)!=null) {
            $statement->bindValue(':new_img_link', $newImgLink);
        }
    
        $statement->bindValue(':product_id', $productId);
        $statement->execute();
    }

    public function deleteByProduct($productId)
    {
        return $this->deleteBy('product_id',$productId);
    } 
    


    public function create($args)
    {
        $sql = 'INSERT INTO ' . $this->tableName . '(product_id,product_name, price, category_id, discount, img_link) VALUES (:product_id, :product_name, :price, :category_id, :discount, :img_link)';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'product_id'=>$args['product_id'],
            'product_name'=>$args['product_name'], 
           'price'=>$args['price'], 
            'category_id'=>$args['category_id'], 
            'discount'=>$args['discount'], 
            'img_link'=>$args['img_link']
        ]);
    }
}
?>