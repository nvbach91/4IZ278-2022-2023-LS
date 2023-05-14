<?php
//require_once 'Product.php';
class DBConnection{
    private $conn;
    public function __construct(){
        $dbconfig = parse_ini_file('dbconfig.ini');
        $this->conn = new mysqli($dbconfig['db_server'], $dbconfig['db_user'], $dbconfig['db_password']);
        if ($this->conn->connect_error) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    function checkUsername($username){
        if ($result = $this->conn -> query("call phpetlowner.check_username ('".$username."');")) {     
            $dbOutput = $result->fetch_all();
            $result -> free_result();
            $this->conn->next_result();
            return boolval($dbOutput[0][0]);
            }
        return;
    }

    function checkEmail($email){
        if ($result = $this->conn -> query("call phpetlowner.check_email ('".$email."');")) {
            $dbOutput = $result->fetch_all();
            $result -> free_result();
            $this->conn->next_result();
            return boolval($dbOutput[0][0]);
        }
        return;
    }

    function registerUser($username,$password,$email){
        return $this->conn -> query("CALL phpetlowner.REGISTER_USER('".$username."','".$email."','".password_hash($password, PASSWORD_DEFAULT)."','doorkeeper_reg_page');");
        // returns false if connection unsucessfull
    }

    function addDevice($deviceSerial,$deviceModel,$deviceKey){
        return $this->conn -> query("CALL phpetlowner.ADD_DEVICE('".$deviceSerial."','".$deviceKey."','".$deviceModel."')");
        // returns false if connection unsucessfull
    }

    function pushDeviceStatus($deviceSerial,$deviceKey,$nextReportOffset){
        return $this->conn -> query("CALL phpetlowner.INSERT_MEASURE('".$deviceSerial."','".$deviceKey."','device_status',CURTIME(),CURTIME(),NULL,".$nextReportOffset.",NULL,NULL,DATE_ADD(CURTIME(),INTERVAL ".$nextReportOffset." SECOND));");
        // returns false if connection unsucessfull
    }

    function pushMeasure($deviceSerial,$deviceKey,$measureType,$boolVal){
        return $this->conn -> query("CALL phpetlowner.INSERT_MEASURE('".$deviceSerial."','".$deviceKey."','".$measureType."',CURTIME(),CURTIME(),NULL,NULL,NULL,".$boolVal.",NULL);");
        // returns false if connection unsucessfull
    }

    // function getProducts($category_id = -1,$items_per_page = 5,$page=1){
    //     $query = 'SELECT p.name,p.price,p.category_id FROM eshop.products p';
    //     if($category_id != -1):
    //         $query = $query." WHERE category_id = '".$category_id."'";
    //     endif;
    //     $query = $query." LIMIT ".$items_per_page." OFFSET ".($page-1)*$items_per_page;
    //     if ($result = $this->conn -> query($query)) {
    //         $dbOutput = $result->fetch_all();
    //         $result -> free_result();
    //         $output= array();
    //         foreach($dbOutput as $productArray):
    //             array_push($output,new Product( $productArray[0] ,$productArray[1]));
    //         endforeach;
    //         return $output;
    //       }
    //     return;
    // }

    // function getPagesCount($items_per_page = 5,$category_id = -1){
    //     $query = 'SELECT count(0) FROM eshop.products p';
    //     if($category_id != -1):
    //         $query = $query." WHERE category_id = '".$category_id."'";
    //     endif;
    //     if ($result = $this->conn -> query($query)) {
    //         $dbOutput = $result->fetch_array();
    //         $result -> free_result();
    //         $output= ceil( floatval($dbOutput[0])/$items_per_page);
    //         return $output;
    //       }
    //     return;
    // }

    // function getCategories(){
    //     if ($result = $this->conn -> query("SELECT category_id, name FROM eshop.categories")) {       
    //         $dbOutput = $result->fetch_all();
    //         $result -> free_result();
    //         return $dbOutput;
    //       }
    //     return;
    // }
}

$dbcon= new DBConnection();
?>