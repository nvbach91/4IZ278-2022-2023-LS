<!DOCTYPE html>
<html lang="en">
<?php include "header.php" ?>
<main>
    <h1>Hello world</h1>

    <div>
    <?php
        require 'UsersDB.php';
        require 'ProductsDB.php';
        require 'OrdersDB.php';
        
        $users = new UsersDB();
        $users->create(['id' => 1, 'name' => 'Dave', 'age' => 42]);
        $users->create(['id' => 2,'name' => 'dsa', 'age' => 55]);
        $users->fetch(1);
        $users->save(1, array('name' => 'James', 'age' => 15));
        $users->delete(1);
        echo PHP_EOL;
    ?>
    </div>
    <div>
    <?php
        $products = new ProductsDB();
        $products->create(['name' => 'nintendo weeeee', 'price' => 15000]);
        $products->create(['name' => 'xbox x one x series x version XXL X', 'price' => 18000]);
        echo PHP_EOL;
    ?>
    </div>
    <div>
    <?php
        $orders = new OrdersDB();
        echo PHP_EOL;
        echo $orders, PHP_EOL;
        $orders->create(['number' => 5, 'date' => '2018-06-12']);
        echo $orders, PHP_EOL;
    ?>
    </div>
    
</main>
</html>