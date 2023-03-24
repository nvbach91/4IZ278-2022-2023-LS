<?php 

require_once "./OrdersDB.php"; 
require_once "./ProductsDB.php";
require_once "./UsersDB.php";


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Tool</title>
</head>
<body>
    <h1>Database manipulation tool</h1>
    <pre>
        
    <?php



        $users = new UsersDB();
        echo $users;
        $users->create(['name' => 'Foo', 'age' => 24]);
        $users->fetch();
        $users->save();
        $users->delete();

        $products = new ProductsDB();
        echo $products;
        $products->create(['name' => 'Bar', 'price' => 42069]);
        $products->fetch();
        $products->save();
        $products->delete();

        $orders = new OrdersDB();
        echo $orders;
        $orders->create(['id' => 69420, 'date' => '24.03.2023']);
        $orders->fetch();
        $orders->save();
        $orders->delete();

        
    ?>
    </pre>

</body>
</html>