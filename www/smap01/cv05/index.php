<?php include("./includes/header.php") ?>

<?php require("./database.php") ?>

<?php

class usersDB extends Database
{
    public function create($args)
    {
        echo "<br>User " . $args['name'] . "with email " . $args['email'] . " was created.</br>" . PHP_EOL;
        $this->save($args);
    }
    public function fetch()
    {
        $users = [];
        $userDatabase = file_get_contents($this->getFilePath());
        $userDatabase = explode(PHP_EOL, $userDatabase);
        foreach ($userDatabase as $user) {
            if (strlen($user) > 0) {
                $user = explode($this->separator, $user);
                array_push($users, $user);
            }
        }
        return $users;
    }
    public function save($args)
    {
        file_put_contents($this->getFilePath(), $args['name'] . $this->separator . $args['email'] . PHP_EOL, FILE_APPEND);
        echo "<br>User was saved!</br>" . PHP_EOL;
    }
    public function delete()
    {
        echo "Sorry users cannot be deleted at the moment";
    }
}

class productsDB extends Database
{
    public function create($args)
    {
        echo "<br>Product " . $args['name'] . "with a price of " . $args['price'] . " was created.</br>" . PHP_EOL;
        $this->save($args);
    }
    public function fetch()
    {
        $productsDatabase=[];
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

class ordersDB extends Database
{
    public function create($args)
    {
        echo "<br>Order " . $args['name'] . "with a priority of " . $args['priority'] . " was created.</br>" . PHP_EOL;
        $this->save($args);
    }
    public function fetch()
    {
        $ordersDatabase=[];
        $orders = [];
        $orderDatabase = file_get_contents($this->getFilePath());
        $ordersDatabase = explode(PHP_EOL, $orderDatabase);
        foreach ($ordersDatabase as $order) {
            if (strlen($order) > 0) {
                $product = explode($this->separator, $order);
                array_push($orders, $order);
            }
        }
        return $orders;
    }
    public function save($args)
    {
        file_put_contents($this->getFilePath(), $args['name'] . $this->separator . $args['priority'] . PHP_EOL, FILE_APPEND);
        echo "<br>Order was saved!</br>" . PHP_EOL;
    }
    public function delete()
    {
        echo "Sorry orders cannot be deleted at the moment";
    }
}








$usersDB = new usersDB;
$usersDB->create(['name' => 'Patrik Šmátrala', 'email' => 'smap01@vse.cz']);
$users = $usersDB->fetch();
foreach ($users as $user) {
    echo "<br>$user[0] has an email address $user[1]</br>" . PHP_EOL;
}
$productsDB = new productsDB;
$productsDB->create(['name' => 'Table', 'price' => '2000 Kč']);
$products = $productsDB->fetch();
foreach ($products as $product) {
    echo "<br>$product[0] has a price of $product[1]</br>" . PHP_EOL;
}
$ordersDB = new ordersDB;
$ordersDB->create(['name' => 'Food', 'priority' => '1']);
$orders = $ordersDB->fetch();
foreach ($orders as $order) {
    echo "<br>$order[0] has a priority of $order[1]</br>" . PHP_EOL;
}
?>

<?php include("./includes/footer.php") ?>