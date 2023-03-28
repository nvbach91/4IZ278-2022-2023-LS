<?php


class Order{

    public function __construct(public $id, public $date) {
        
    }
}

class OrdersDB extends Database {

    public function create($data)
    {
      $this->save($data);
    }
  
    public function fetch()
    {
      $data = file_get_contents($this->getPath());


      $allOrders = explode(PHP_EOL, $data);

      $orders = [];
  
      foreach ($allOrders as $order) {
        if ($order) {
          $att = explode(';', $order);
  
          array_push($orders, new Order($att[0], $att[1]));
        }
      }

      return $orders;
    }
  
    public function save($data)
    {
        $orders = $this->fetch();
        if(!empty($orders)){
            $id = end($orders)->id + 1; 
            file_put_contents($this->getPath(), $id . $this->getDelimiter() . $data['date'] . PHP_EOL, FILE_APPEND);
            file_put_contents("messages.txt", 'Objednávka #' .  $id . ' byla přidána!' . PHP_EOL, FILE_APPEND);
        }
        else{
            file_put_contents($this->getPath(), 1 . $this->getDelimiter() . $data['date'] . PHP_EOL, FILE_APPEND);
            file_put_contents("messages.txt", 'Objednávka #1 byla přidána!' . PHP_EOL, FILE_APPEND);
        }
        
    }
  
    public function delete($id)
    {
        
        $orders = $this->fetch();
        file_put_contents($this->getPath(), "");
        foreach ($orders as $order) {
            if($order->id != $id){
                file_put_contents($this->getPath(), $order->id . $this->getDelimiter() . $order->date . PHP_EOL, FILE_APPEND);              
            }
            else{
                file_put_contents("messages.txt", 'Objednávka #' .  $id . ' byla smazána!' . PHP_EOL, FILE_APPEND);
            }
        }

        
    }
}



?>