<?php

class UsersRepository extends Repository
{
    public function getUserById($id_user) //
    {
        $sql = "SELECT * FROM users WHERE id_user = :id_user";
        $params = [
            ":id_user" => $id_user
        ];

        return $this->db->select($sql,$params);
    }

    public function getUserByEmail($user_email) //
    {
        $sql = "SELECT * FROM users WHERE user_email = :user_email";
        $params = [
            ":user_email" => $user_email
        ];

        return $this->db->selectOne($sql,$params);
    }

    public function addUser($user_email,$user_password) //
    {
        $sql = "INSERT INTO users (user_email, user_password) VALUES (:user_email , :user_password)";
        $params = [
            ":user_email" => $user_email,
            ":user_password" =>password_hash($user_password, PASSWORD_DEFAULT)
        ];

        return $this->db->insert($sql,$params);
    }



}