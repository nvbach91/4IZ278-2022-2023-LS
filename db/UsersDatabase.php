<?php
require_once ('Database.php');
class UsersDatabase extends Database {
    
    protected $tableName = 'users';

    public function fetchByEmail($value){
        return $this->fetchBy('email',$value);
    }
    public function fetchByID($value){
        return $this->fetchBy('user_id',$value);
    }

    public function fetchByEmailPass($value, $value2){
        return $this->fetchBy2('email', $value, 'password', $value2);
    }

    public function create(array $args)
    {
        $sql = 'INSERT INTO ' . $this->tableName . ' (
            user_id,email, name, surname, adress, phone, password, postalCode) 
            VALUES (
                :user_id, :email, :name, :surname, :adress, :phone, :password, :postalCode
            )';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'user_id'=>$this->countRow('users')+3,
            'email'=>$args['email'], 
            'name' => $args['name'], 
            'surname' => $args['surname'], 
            'adress'=>$args['adress'], 
            'phone'=>$args['phone'], 
            'password'=>$args['password'],
            'postalCode'=>$args['postalCode']
        ]);
    }

}