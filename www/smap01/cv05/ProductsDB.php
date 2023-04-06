<?php
class ProductsDB extends Database
{
    public function create($args)
    {
        echo "<br>Product " . $args['name'] . " with a price of " . $args['price'] . " was created.</br>" . PHP_EOL;
        $this->save($args);
    }
    public function fetch()
    {
        $productsDatabase = [];
        $products = [];
        $ProductDatabase = file_get_contents($this->getFilePath());
        $productsDatabase = explode(PHP_EOL, $ProductDatabase);
        foreach ($productsDatabase as $product) {
            if (strlen($product) > 0) {
                $product = explode($this->separator, $product);
                array_push($products, $product);
            }
        }
        return $products;
    }
    public function save($args)
    {
        file_put_contents($this->getFilePath(), $args['name'] . $this->separator . $args['price'] . PHP_EOL, FILE_APPEND);
        echo "<br>Product was saved!</br>" . PHP_EOL;
    }
    public function delete()
    {
        echo "Sorry products cannot be deleted at the moment";
    }
}
