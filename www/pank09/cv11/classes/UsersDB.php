<?php

require_once __DIR__ . '/AbstractClasses/AbstractDatabase.php';

class UsersDB extends Database
{
    protected $db_table = 'cv10_users';
    protected $db_table_pk = 'user_id';

    public function fetchByEmail($email)
    {
        $statement = $this->db_conn->prepare("SELECT user_id, name, email, password, privilege FROM `$this->db_table` WHERE email = :email");
        $statement->execute([
            'email' => $email
        ]);
        return $statement->fetch();
    }

    public function create($args)
    {
        if (empty($args['name']))
            throw new Exception("Name is empty.");

        if (!filter_var($args['email'], FILTER_VALIDATE_EMAIL))
            throw new Exception("Email is invalid.");

        if (mb_strlen($args['password']) <= 6) {
            throw new Exception("Password must contain at least 6 characters.");
        }
        elseif (!preg_match("#[0-9]+#", $args['password'])) {
            throw new Exception("Password must contain at least 1 number.");
        }
        elseif (!preg_match("#[\W]+#", $args['password'])) {
            throw new Exception("Password must contain at least 1 special character.");
        }

        if ($this->fetchByEmail($args['email']))
            throw new Exception(sprintf("User with email %s already exists", $args['email']));

        $args['password'] = password_hash($args['password'], PASSWORD_DEFAULT);

        $statement = $this->db_conn->prepare("INSERT INTO `$this->db_table` (name, `email`, `password`, `privilege`) VALUES (:name, :email, :password, 1)");
        $statement->execute($args);
    }

    public function update($user_id, $args) {}

    public function promote($user_id) {
        $statement = $this->db_conn->prepare("UPDATE `$this->db_table` SET `privilege` = LEAST(privilege + 1, 3) WHERE `$this->db_table_pk` = :user_id");
        return $statement->execute([
            'user_id' => $user_id
        ]);
    }

    public function demote($user_id) {
        $statement = $this->db_conn->prepare("UPDATE `$this->db_table` SET `privilege` = GREATEST(privilege - 1, 1) WHERE `$this->db_table_pk` = :user_id");
        return $statement->execute([
            'user_id' => $user_id
        ]);
    }

}