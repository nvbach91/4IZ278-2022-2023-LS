<?php
include_once ("../Interface/DatabaseOperations.php");
include_once ("../Abstract/Database.php");

class OrdersDB extends Database implements DatabaseOperations {
    public function __construct() {
        $this->folderPath = "/www/waid00/cv05/orders/";
        $this->fileExtension = ".txt";
        $this->fieldSeparator = ",";
        parent::__construct();
    }

    public function create($data) {
        $_SERVER['DOCUMENT_ROOT'] = "/home/httpd/html/users/waid00/";
        $folderPath = $_SERVER['DOCUMENT_ROOT'] . $this->folderPath;
        if (!is_dir($folderPath)) {
            mkdir($folderPath, 777, true);
        }
        $filename = $folderPath . "records" . $this->fileExtension;
        $file = fopen($filename, "a");
        if ($file === false) {
            echo "Error: Could not open file $filename";
            return;
        }
        fwrite($file, implode($this->fieldSeparator, $data) . "\n");
        fclose($file);
        echo "<strong>Creating order record...</strong><br>";
    }

    public function fetch($id) {
        $_SERVER['DOCUMENT_ROOT'] = "/home/httpd/html/users/waid00/";
        $filename = $_SERVER['DOCUMENT_ROOT'] . $this->folderPath . "records" . $this->fileExtension;
        $file = fopen($filename, "r");
        while(!feof($file)) {
            $line = trim(fgets($file));

            if(empty($line)) {
                continue;
            }

            $data = explode(",", $line);

            if($data[0] == $id) {
                echo "ID: " . $data[0] . "<br>";
                echo "order: " . $data[1] . "<br>";
                echo "<br>";
            }
        }

        fclose($file);
    }

    public function save($id, $name, $email) {
        $_SERVER['DOCUMENT_ROOT'] = "/home/httpd/html/users/waid00/";
        $filename = $_SERVER['DOCUMENT_ROOT'] . $this->folderPath . "records" . $this->fileExtension;
        $lines = file($filename);

        $output = "";

        foreach ($lines as $line) {
            $data = explode($this->fieldSeparator, $line);
            if (trim($data[0]) == $id) {
                $email = 'order';
                $output .= "$id,$name,$email\n";
            } else {
                $output .= $line;
            }
        }

        file_put_contents($filename, $output);
        echo "Order edited with an ID of ".$id."<br>";
    }


    public function delete($id) {
        $_SERVER['DOCUMENT_ROOT'] = "/home/httpd/html/users/waid00/";
        $filename = $_SERVER['DOCUMENT_ROOT'] . $this->folderPath . "records" . $this->fileExtension;
        $lines = file($filename);

        $output = "";

        foreach ($lines as $line) {
            $data = explode($this->fieldSeparator, $line);
            if (trim($data[0]) == $id) {
                continue;
            } else {
                $output .= $line;
            }
        }

        file_put_contents($filename, $output);
        echo "Order deleted with an ID of ".$id."<br>";
    }

}