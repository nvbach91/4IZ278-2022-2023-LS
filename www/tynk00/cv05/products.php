<?php


class Product{

    public function __construct(public $id, public $name, public $price) {
        
    }
}

class ProductsDB extends Database {

    public function create($data)
    {
      $this->save($data);
    }
  
    public function fetch()
    {
      $data = file_get_contents($this->getPath());


      $allProducts = explode(PHP_EOL, $data);

      $products = [];
  
      foreach ($allProducts as $product) {
        if ($product) {
          $att = explode(';', $product);
  
          array_push($products, new product($att[0], $att[1], $att[2]));
        }
      }

      return $products;
    }
  
    public function save($data)
    {
        $products = $this->fetch();
        if(!empty($products)){
            $id = end($products)->id + 1; 
            file_put_contents($this->getPath(), $id . $this->getDelimiter() . $data['name'] . $this->getDelimiter() . $data['price'] . PHP_EOL, FILE_APPEND);
            file_put_contents("messages.txt", 'Produkt #' .  $id . ' byl přidán!' . PHP_EOL, FILE_APPEND);
        }
        else{
            file_put_contents($this->getPath(), 1 . $this->getDelimiter() . $data['name'] . $this->getDelimiter() . $data['price'] . PHP_EOL, FILE_APPEND);
            file_put_contents("messages.txt", 'Produkt #1 byl přidán!' . PHP_EOL, FILE_APPEND);
        }
        
    }
  
    public function delete($id)
    {
        
        $products = $this->fetch();
        file_put_contents($this->getPath(), "");
        foreach ($products as $product) {
            if($product->id != $id){
                file_put_contents($this->getPath(), $product->id . $this->getDelimiter() . $product->name . $this->getDelimiter() . $product->price . PHP_EOL, FILE_APPEND);
                echo $id;
            }
            else{
                file_put_contents("messages.txt", 'Produkt #' .  $id . ' byl smazán!' . PHP_EOL, FILE_APPEND);
            }
        }
        
    }
}



?>