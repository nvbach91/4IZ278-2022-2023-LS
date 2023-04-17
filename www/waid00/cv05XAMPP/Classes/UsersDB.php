<?php
include_once ("E:/xampp/htdocs/www/waid00/cv05XAMPP/Interface/DatabaseOperations.php");
include_once ("E:/xampp/htdocs/www/waid00/cv05XAMPP/Abstract/Database.php");

class UsersDB extends Database implements DatabaseOperations{
    public function __construct() {
        $this->folderPath = "/www/waid00/cv05/users/";
        $this->fileExtension = ".txt";
        $this->fieldSeparator = ",";
        parent::__construct();
    }

    public function create($data) {
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
        echo "<strong>Creating user record...</strong><br>";
    }

    public function fetch($id) {
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
                echo "Name: " . $data[1] . "<br>";
                echo "Email: " . $data[2] . "<br>";
                echo "<br>";
            }
        }

        fclose($file);
    }

    public function save($id, $name, $email) {
        $filename = $_SERVER['DOCUMENT_ROOT'] . $this->folderPath . "records" . $this->fileExtension;
        $lines = file($filename);

        $output = "";

        foreach ($lines as $line) {
            $data = explode($this->fieldSeparator, $line);
            if (trim($data[0]) == $id) {
                $output .= "$id,$name,$email\n";
            } else {
                $output .= $line;
            }
        }

        file_put_contents($filename, $output);
        echo "User edited with an ID of ".$id."<br>";
    }


    public function delete($id) {
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
        echo "Deleted user with an ID of ".$id."<br>";
    }

}