<?php
interface DatabaseOperations {
    public function create($data);
    public function fetch($id);
    public function save($id, $name, $email);
    public function delete($id);
}

abstract class Database implements DatabaseOperations {
    protected $folderPath;
    protected $fileExtension;
    protected $fieldSeparator;

    public function __construct() {
        echo "<strong>Constructing " . get_class($this) . "...</strong>";
    }

    public function __toString() {
        return "<br><strong>Database configuration:</strong><br>Folder path: " . $this->folderPath . "<br>File extension: " . $this->fileExtension . "<br>Field separator: " . $this->fieldSeparator . "<br>";
    }
}

class UsersDB extends Database {
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

class ProductsDB extends Database {
    public function __construct() {
        $this->folderPath = "/www/waid00/cv05/products/";
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
        echo "<strong>Creating product record...</strong><br>";
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
                echo "product: " . $data[1] . "<br>";
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
                $email = 'product';
                $output .= "$id,$name,$email\n";
            } else {
                $output .= $line;
            }
        }

        file_put_contents($filename, $output);
        echo "Record edited with an ID of ".$id."<br>";
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
        echo "Record deleted with an ID of ".$id."<br>";
    }

}

class OrdersDB extends Database {
    public function __construct() {
        $this->folderPath = "/www/waid00/cv05/orders/";
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
        echo "<strong>Creating order record...</strong><br>";
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
                echo "order: " . $data[1] . "<br>";
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


$usersDB = new UsersDB();
echo $usersDB;
$usersDB->create(array("id" => 1,"name" => "John Doe", "email" => "johndoe@example.com"));
$usersDB->create(array("id" => 3,"name" => "John Doe", "email" => "johndoe@example.com"));
$usersDB->fetch(1);
$usersDB->fetch(3);
$usersDB->save(1, "asd", "asd@asd.asd");
$usersDB->fetch(1);
$usersDB->fetch(3);
$usersDB->delete(1);
$usersDB->delete(3);
echo "------------------------------------------------------------------------<br>";
$productsDB = new ProductsDB();
echo $productsDB;
$productsDB->create(array("id" => 1, "product" => "what"));
$productsDB->create(array("id" => 2, "product" => "asd"));
$productsDB->fetch(1);
$productsDB->fetch(2);
$productsDB->save(1, "idk", 'asdasd');
$productsDB->delete(1);
$productsDB->delete(2);
echo "------------------------------------------------------------------------<br>";
$ordersDB = new OrdersDB();
echo $ordersDB;
$ordersDB->create(array("id" => 1, "order" => "qweqweqwe"));
$ordersDB->create(array("id" => 2, "order" => "qghghhghgghhh"));
$ordersDB->fetch(1);
$ordersDB->fetch(2);
$ordersDB->save(1, "idk", 'qwedasqweqwe');
$ordersDB->delete(1);
$ordersDB->delete(2);
?>