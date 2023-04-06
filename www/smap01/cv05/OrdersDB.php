<?php
class OrdersDB extends Database
{
    public function create($args)
    {
        echo "<br>Order " . $args['name'] . " with a priority of " . $args['priority'] . " was created.</br>" . PHP_EOL;
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
                $order = explode($this->separator, $order);
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
