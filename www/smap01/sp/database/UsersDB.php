<?php
require_once(__DIR__.'/Database.php');
//Class with singleton pattern. Class works with sp_users database
class UsersDB{
    private $pdo;
    static $usersDB;
    private final function __construct()
    {
        $db=Database::getDatabase();
        $this->pdo=$db->getPdo();
    }

    //Function that shares or creates a class instance and reutrns it
    public static function getDatabase(){
        if(!isset(self::$usersDB)){
            self::$usersDB = new UsersDB();
        }
        return self::$usersDB;
    }

    //Function that registers a user. Return NULL if successful otherwise returns error
    function registerUser($userName, $userEmail, $userPassword, $userAddress)
    {
        try {
            $statement = $this->pdo->prepare("INSERT sp_users (user_name, user_email, user_password, user_privilege, user_address) VALUES(?,?, ?, 1, ?);");
            $statement->bindParam(1, $userName);
            $statement->bindParam(2, $userEmail);
            $statement->bindParam(3, $userPassword);
            $statement->bindParam(4, $userAddress);
            $statement->execute();
        } catch (PDOException $e) {
            return $e;
        }
    }

    //Function that returns true if user with user_email exists otherwise returns false
    function userExists($user_email)
    {
        $statement = $this->pdo->prepare("SELECT * FROM sp_users WHERE user_email=?");
        $statement->bindParam(1, $user_email);
        $statement->execute();
        $result = $statement->fetchAll();
        if (count($result) != 0) return true;
        return false;
    }

    //Function that verifies that user_email and password is correct. Returns 1 if successful otherwise returns 0
    function verifyLogin($user_email, $password)
    {
        try {
            $statement = $this->pdo->prepare("SELECT * FROM sp_users WHERE user_email=?");
            $statement->bindParam(1, $user_email);
            $statement->execute();
            $result = $statement->fetch();
            if($result==false){
                return 0;
            }
            if (password_verify($password, $result['user_password'])) {
                return 1;
            } else {
                return 0;
            }
        } catch (PDOException $e) {
            return $e;
        }
    }

    //Function that returns user_privilege of a user with user_email
    function getUserPrivilege($user_email)
    {
        try {
            $statement = $this->pdo->prepare("SELECT * FROM sp_users WHERE user_email=?");
            $statement->bindParam(1, $user_email);
            $statement->execute();
            $result = $statement->fetch();
            return $result['user_privilege'];
        } catch (PDOException $e) {
            echo 0;
        }
    }

    //Function that returns all users
    function getUsers()
    {
        try {
            $statement = $this->pdo->prepare("SELECT * FROM sp_users");
            $statement->execute();
            $result = $statement->fetchAll();
            return $result;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    //Function that change the user_privilege of a user with user_email
    function changePrivilege($user_email, $privilege)
    {
        try {
            $statement = $this->pdo->prepare("UPDATE sp_users SET user_privilege=? WHERE user_email=?;");
            $statement->bindParam(1, $privilege);
            $statement->bindParam(2, $user_email);
            $statement->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    //Function that returns a user record of a user with user_id
    function getUser($user_id){
        try{
            $statement=$this->pdo->prepare("SELECT * from sp_users WHERE user_id=:user_id");
            $statement->execute([':user_id'=>$user_id]);
            $result=$statement->fetch();
            return $result;
        }catch(PDOException $e){
            return $e;
        }
    }

    //Function that returns user_id of a user with user_email
    function getUserID($user_email){
        try{
            $statement=$this->pdo->prepare("SELECT user_id from sp_users WHERE user_email=:user_email");
            $statement->execute([':user_email'=>$user_email]);
            $result=$statement->fetch();
            return $result['user_id'];
        }catch(PDOException $e){
            return $e;
        }
    }
}


?>