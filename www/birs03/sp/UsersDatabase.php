<?php require_once 'Database.php';?>
<?php 

class UsersDatabase extends Database{

    public function addUser($username,$email,$password,$address,$admin){
        $statement=$this->pdo->prepare("INSERT INTO users (username,email,password,address,admin) VALUES (?,?,?,?,?)");
        $statement->execute([$username,$email,$password,$address,$admin]);
    }

    public function getUser($email){
        $statement=$this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $statement->execute([$email]);
        $result = $statement->fetch();
        return $result;
    }

    public function getUserById($id){
        $statement=$this->pdo->prepare("SELECT * FROM users WHERE user_id = ?");
        $statement->execute([$id]);
        $result = $statement->fetch();
        return $result;
    }
}

?>