<?php

class Database extends mysqli
{
    public function __construct() {
        $host = getenv('DB_HOST');
        $db = getenv('DB_NAME');
        $user = getenv('DB_USER');
        $pass = getenv('DB_PASS');
        $charset = 'utf8mb4';

        parent::__construct($host, $user, $pass, $db);

        if ($this->connect_error) {
            die("Connection failed: " . $this->connect_error);
        }

        $this->set_charset($charset);
    }

    public function getInsertId()
    {
        return $this->insert_id;
    }

}

?>