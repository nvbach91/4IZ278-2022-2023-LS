<?php

class Database extends mysqli
{
    public function __construct() {

        $envFile = '.env'; 
        $envConfig = parse_ini_file($envFile); 

        $host = $envConfig['DB_HOST'];
        $db = $envConfig['DB_NAME'];
        $user = $envConfig['DB_USER'];
        $pass = $envConfig['DB_PASS'];

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