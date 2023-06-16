<?php


abstract class Repository
{
    protected Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

}