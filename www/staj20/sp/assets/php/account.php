<?php
require_once "database.php";

class Account
{

    public function signup($username, $email, $password, &$errorMsg)
    {
        $database = new Database();
        $query = "SELECT COUNT(user_id) FROM `users` WHERE `username` = ? OR `email` = ?";
        $params = array(
            $username, $email
        );
        $result = $database->queryGet($query, $params);
        $duplicateUsers = $result[0]["COUNT(user_id)"];
        if ($duplicateUsers != 0) {
            $errorMsg = "Uživatel už existuje. Zvolte si jiné uživatelské jméno nebo email.";
            return;
        }
        $query = "SELECT COUNT(user_id) FROM `users`";
        $result = $database->queryGet($query, array());
        $userId = $result[0]["COUNT(user_id)"];

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO `users`(`user_id`, `username`, `email`, `password`, `privilege`) VALUES (?,?,?,?,1)";
        $params = array(
            $userId, $username, $email, $passwordHash
        );
        $database->querySet($query, $params);
        $_SESSION['user_id'] = $userId;
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        $this->sendSignupEmail($email,$username);

    }
    public function sendSignupEmail($email,$username){
        $email = $email;
        $name = $username;
        $subject = "Staromor - ucet vytvoren";
        $htmlEmailContent = "<p>Váš účet byl úspěšně vytvořen.</p>
        <p>Uživatelské jméno:$username</p>
        <p>Email:$email</p>";
        $plainEmailContent = "<p>Váš účet byl úspěšně vytvořen.\n
        Uživatelské jméno: $username\n
        Email: $email\n";
        require('mailsend.php');
    }
    public function login($username, $password, &$errorMsg)
    {

        $database = new Database();
        $query = "SELECT * FROM `users` WHERE (`username` = ? OR `email` = ?)";
        $params = array(
            $username, $username
        );
        $result = $database->queryGet($query, $params);
        $passwordHash = $result[0]['password'];
        if (!password_verify($password, $passwordHash)) {
            $errorMsg = "Špatné uživatelské jméno nebo heslo.";
            return;
        }
        $_SESSION['user_id'] = $result[0]['user_id'];
        $_SESSION['username'] = $result[0]['username'];
        $_SESSION['email'] = $result[0]['email'];
        $this->LoadUserAddress();
    }
    public function loginGoogle(&$client)
    {
        $google_oauth = new Google_Service_Oauth2($client);
        $user_info = $google_oauth->userinfo->get();
        $email = $user_info['email'];
        $username = $user_info['id'];



        $database = new Database();
        $query = "SELECT user_id FROM `users` WHERE `email` = ?";
        $params = array(
            $email
        );
        $result = $database->queryGet($query, $params);
        if (empty($result)) {
            $query = "SELECT COUNT(user_id) FROM `users`";
            $params = array();
            $result = $database->queryGet($query, $params);
            $userId = $result[0]["COUNT(user_id)"];

            $query = "INSERT INTO `users`(`user_id`, `username`, `email`, `password`, `privilege`) VALUES (?,?,?,?,1)";
            $params = array(
                $userId, $username, $email, "googleUser"
            );
            $database->querySet($query, $params);
        } else {
            $userId = $result[0]['user_id'];
        }
        $_SESSION['user_id'] = $userId;
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        $this->LoadUserAddress();
    }
    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['email']);
        unset($_SESSION['username']);
        unset($_SESSION['address']);
        unset($_SESSION['cart']);
    }
    public function getPrivilege()
    {
        if (!isset($_SESSION['user_id'])) {
            return 0;
        }
        $database = new Database();
        $query = "SELECT `privilege` FROM `users` WHERE `user_id` = ?";
        $params = array(
            $_SESSION['user_id']
        );
        $result = $database->queryGet($query, $params);
        return $result[0]['privilege'];
    }
    public function SaveAddress($address)
    {
        $database = new Database();
        $query = "SELECT COUNT(address_id) FROM `address`";
        $params = array();
        $result = $database->queryGet($query, $params);
        $addressId = $result[0]["COUNT(address_id)"];
        $userId = $_SESSION['user_id'];

        $query = "INSERT INTO `address`
        (`address_id`, `name`, `zip`, `country`, `city`, `street`, `additional_info`
        , `email`, `phone`, `user_id`)
         VALUES (?,?,?,?,?,?,?,?,?,?)";
        $params = array(
            $addressId, $address->name, $address->zip, $address->country,
            $address->city, $address->street, $address->additional_info, $address->email,
            $address->phone, $userId
        );
        $database->querySet($query, $params);
        $query = "SELECT `default_address` FROM `users` WHERE `user_id`=?";
        $params = array($userId);
        $result = $database->queryGet($query, $params);
        if(is_null($result[0]['default_address'])){
            $query = "UPDATE `users` SET `default_address`=? WHERE `user_id`=?";
            $params = array($addressId,$userId);
            $database->querySet($query, $params);
            $_SESSION['address'] = serialize($address);
        }
    }
    public function SetDefaultAddress($addressId){
        $database = new Database();

        $userId = $_SESSION['user_id'];
        $query = "UPDATE `users` SET `default_address`=? WHERE `user_id`=?";
        $params = array($addressId,$userId);
        $database->querySet($query, $params);
        $this->LoadUserAddress();

    }
    public function GetDefaultAddress(){
        $database = new Database();
        $query = "SELECT * FROM `users` 
        JOIN `address` ON `users`.`default_address`=`address`.`address_id`
        WHERE `users`.`user_id`=?";
        $params = array($_SESSION['user_id']);
        $result = $database->queryGet($query, $params);
        if (!empty($result)) {
            $address = new Address();
            $address->name = $result[0]['name'];
            $address->street = $result[0]['street'];
            $address->zip = $result[0]['zip'];
            $address->city = $result[0]['city'];
            $address->country = $result[0]['country'];
            $address->email = $result[0]['email'];
            $address->id = $result[0]['address_id'];

            $address->additional_info = $result[0]['additional_info'];
            $address->phone = $result[0]['phone'];
            return $address;
        }
        return NULL;
    }
    public function GetNonDefaultAddresses(){
        $database = new Database();
        $query = "SELECT * FROM `users` 
        JOIN `address` ON `users`.`user_id`=`address`.`user_id`
        WHERE `users`.`user_id`=? AND NOT `default_address`=`address_id`";
        $params = array($_SESSION['user_id']);
        $result = $database->queryGet($query, $params);

        $addresses = array();
        foreach($result as $row){
            $address = new Address();
            $address->name = $row['name'];
            $address->street = $row['street'];
            $address->zip = $row['zip'];
            $address->city = $row['city'];
            $address->country = $row['country'];
            $address->email = $row['email'];
            $address->id = $row['address_id'];

            $address->additional_info = $row['additional_info'];
            $address->phone = $row['phone'];
            array_push($addresses,$address);
        }
        return $addresses;
    }
    public function DeleteAddress($addressId){
        echo $addressId;
        $database = new Database();
        $query = "SELECT `default_address` FROM `users` WHERE `user_id`=?";
        $userId = $_SESSION['user_id'];

        $params = array($userId);
        $result = $database->queryGet($query, $params);
        if($addressId == $result[0]['default_address']){
            $query = "UPDATE `users` SET `default_address`=NULL WHERE `user_id`=?";
            $params = array($userId);
            $database->querySet($query, $params);
            unset($_SESSION['address']);
        }
        $query = "UPDATE `address` SET `user_id`=NULL WHERE `address_id`=?";
        $params = array($addressId);
        $database->querySet($query, $params);
    }
    private function LoadUserAddress()
    {
        $database = new Database();
        $query = "SELECT * FROM `users` 
        JOIN `address` ON `users`.`default_address`=`address`.`address_id`
        WHERE `users`.`user_id`=?";
        $params = array($_SESSION['user_id']);
        $result = $database->queryGet($query, $params);
        if (!empty($result)) {
            $address = new Address();
            $address->name = $result[0]['name'];
            $address->street = $result[0]['street'];
            $address->zip = $result[0]['zip'];
            $address->city = $result[0]['city'];
            $address->country = $result[0]['country'];
            $address->email = $result[0]['email'];
            $address->id = $result[0]['address_id'];

            $address->additional_info = $result[0]['additional_info'];
            $address->phone = $result[0]['phone'];
            $_SESSION['address'] = serialize($address);
        }
    }
}
