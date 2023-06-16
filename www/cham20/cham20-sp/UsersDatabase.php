<?php
require_once './pdo.php';
require './AdressesDatabase.php';

class UsersDatabase extends Database
{

    private $primaryKey = 1;

    public function fetchAll()
    {
        $query = "SELECT * FROM `users`"; //zmenit na backtics
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }

    //check database for existing user. returns number of rows found
    public function checkUserExistence($email)
    {
        $query = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $query->execute([$email]);
        return $query->rowCount();
    }


    public function insertUser($first_name, $second_name, $email, $password, $phone, $city, $postal_code, $street_plus_number, $country)
    {

        $hashed = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO adresses (city, postal_code, street_plus_number, country)
                  VALUES ('$city', '$postal_code', '$street_plus_number', '$country') ";
        $statement = $this->pdo->prepare($query);
        $result = $statement->execute();

        $adressId = $this->pdo->lastInsertId();
        $query = "INSERT INTO users (first_name, second_name, email, password, phone, adress_id)
                  VALUES ('$first_name', '$second_name', '$email', '$hashed', '$phone', $adressId) ";
        $statement = $this->pdo->prepare($query);
        $result = $statement->execute();

        $this->primaryKey++;
        var_dump($this->primaryKey);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function getUSer($email)
    {
        $query = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $query->execute([$email]);
        return $query->fetchAll();
    }

    public function alterUser($email, $first_nameA, $second_nameA, $phoneA, $countryA, $cityA, $streetA, $postal_codeA, $adress_id)
    {
        $now = time();
        $query = "UPDATE users SET first_name = '$first_nameA', second_name = '$second_nameA', phone = '$phoneA', last_modified = '$now' WHERE email = '$email'";
        $statement = $this->pdo->prepare($query);
        $result = $statement->execute();

        $query2 = "UPDATE adresses SET city = '$cityA', postal_code = '$postal_codeA', street_plus_number = '$streetA', country = '$countryA' WHERE adress_id = '$adress_id'";
        $statement2 = $this->pdo->prepare($query2);
        $result_adresses = $statement2->execute();

        if ($result && $result_adresses) {
            return true;
        } else {
            return false;
        }
    }
}
