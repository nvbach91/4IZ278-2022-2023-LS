<?php


class User{

    public function __construct(public $id, public $name, public $age, public $avatar) {
        
    }
}

class UsersDB extends Database {

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
  
          array_push($products, new User($att[0], $att[1], $att[2], $att[3]));
        }
      }

      return $products;
    }
  
    public function save($data)
    {
        $users = $this->fetch();
        if(!empty($users)){
            $id = end($users)->id + 1; 
            file_put_contents($this->getPath(), $id . $this->getDelimiter() . $data['name'] . $this->getDelimiter() . $data['age'] . $this->getDelimiter() . $data['avatar'] . PHP_EOL, FILE_APPEND);
            file_put_contents("messages.txt", 'Uživatel #' .  $id . ' byl přidán!' . PHP_EOL, FILE_APPEND);
        }
        else{
            file_put_contents($this->getPath(), 1 . $this->getDelimiter() . $data['name'] . $this->getDelimiter() . $data['age'] . $this->getDelimiter() . $data['avatar'] . PHP_EOL, FILE_APPEND);
            file_put_contents("messages.txt", 'Uživatel #1 byl přidán!' . PHP_EOL, FILE_APPEND);
        }
    }
  
    public function delete($id)
    {
        
        $users = $this->fetch();
        file_put_contents($this->getPath(), "");
        foreach ($users as $user) {
            if($user->id != $id){
                file_put_contents($this->getPath(), $user->id . $this->getDelimiter() . $user->name . $this->getDelimiter() . $user->age . $this->getDelimiter() . $user->avatar . PHP_EOL, FILE_APPEND);
                
            }
            else{
                file_put_contents("messages.txt", 'Uživatel #' .  $id . ' byl smazán!' . PHP_EOL, FILE_APPEND);
            }
        }

        
    }
}

?>