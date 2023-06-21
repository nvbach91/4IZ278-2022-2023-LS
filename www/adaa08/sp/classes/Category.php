<?php

class Category {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function getCategories() {
        $stmt = $this->db->prepare('SELECT * FROM categories');
        $stmt->execute();

        $data = [];
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()) {
            $data[] = array_map(function($value) {
                return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
            }, $row);
        }
        
        return $data;
    }
}

?>