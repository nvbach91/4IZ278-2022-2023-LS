<?php
require_once 'Device.php';

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
        // if ($result = $this->conn -> execute_query("call phpetlowner.check_username ('?');",[$username])) {     
        $username = $this->conn->real_escape_string($username);
        if ($result = $this->conn -> query("call phpetlowner.check_username ('".$username."');")) {     
            $dbOutput = $result->fetch_all();
            $result -> free_result();
            $this->conn->next_result();
            return boolval($dbOutput[0][0]);
            }
        return;
    }

    function checkEmail($email){
        $email = $this->conn->real_escape_string($email);
        
        if ($result = $this->conn -> query("call phpetlowner.check_email ('".$email."');")) {
            $dbOutput = $result->fetch_all();
            $result -> free_result();
            $this->conn->next_result();
            return boolval($dbOutput[0][0]);
        }
        return;
    }

    function verifySession($username,$sessionToken){
        $username = $this->conn->real_escape_string($username);
        $sessionToken = $this->conn->real_escape_string($sessionToken);

        if($result = $this->conn -> query("CALL phpetlowner.verify_session('doorkeeper','".$username."','".$sessionToken."');")){
            $dbOutput = $result->fetch_all();
            $result -> free_result();
            $this->conn->next_result();

            $sucess = false;
            if($dbOutput[0][0] == 1){
                // $_SESSION["username"] = $dbOutput[0][1];
                // $_SESSION["sessiontoken"] = $dbOutput[0][2];
                // $_SESSION["sessionSerial"] = $dbOutput[0][3];
                $sucess = true;
            }
            return $sucess;
        }
        return false;
    }

    function loginUser($username,$password){
        $username = $this->conn->real_escape_string($username);
        $password = $this->conn->real_escape_string($password);

    //password check
        $result = $this->conn -> query("CALL phpetlowner.GET_PASSWORD_HASH('".$username."');");
        $dbOutput = $result->fetch_all();
        $result -> free_result();
        $this->conn->next_result();

        $sucess = false;
        if(!empty($dbOutput[0][0])){
            $password_hash =$dbOutput[0][0];
            $sucess = password_verify($password,$dbOutput[0][0]);
        }
    //if password is correct 
        if($sucess){            
        //create session record in database
            $result = $this->conn -> query("CALL phpetlowner.LOG_IN_USER('doorkeeper','".$username."','".$password_hash."');");
            // returns false if connection unsucessfull
            if ($result !== false){
                $dbOutput = $result->fetch_all();
                $result -> free_result();
                $this->conn->next_result();
                // return $dbOutput;
                if ($dbOutput[0][0]==true){
                    // setcookie('username',$username,time()+3600,'/','demosp.tech',true,false);
                    // setcookie('token',$dbOutput[0][2] ,time()+3600,'/','demosp.tech',true,false);
                    setcookie('username',$username,time()+3600);
                    setcookie('token',$dbOutput[0][2] ,time()+3600);
                    return array($dbOutput[0][0],$dbOutput[0][1]);
                }else{
                    return $dbOutput[0];
                }
            }else{
                return array('0','Database connection error');
            }
            return array('0','Database connection error');
        }else{
        return array('0','Wrong username or password');
        }
    }

    function registerUser($username,$password,$email){
        $username = $this->conn->real_escape_string($username);
        $password = $this->conn->real_escape_string($password);
        $email = $this->conn->real_escape_string($email);

        return $this->conn -> query("CALL phpetlowner.REGISTER_USER('".$username."','".$email."','".password_hash($password, PASSWORD_DEFAULT)."','doorkeeper_reg_page');");
        // returns false if connection unsucessfull
    }

    function addDevice($deviceSerial,$deviceModel,$deviceKey){
        $deviceSerial = $this->conn->real_escape_string($deviceSerial);
        $deviceModel = $this->conn->real_escape_string($deviceModel);
        $deviceKey = $this->conn->real_escape_string($deviceKey);

        return $this->conn -> query("CALL phpetlowner.ADD_DEVICE('".$deviceSerial."','".$deviceKey."','".$deviceModel."')");
        // returns false if connection unsucessfull
    }

    function pushDeviceStatus($deviceSerial,$deviceKey,$nextReportOffset){
        $deviceSerial = $this->conn->real_escape_string($deviceSerial);
        $deviceKey = $this->conn->real_escape_string($deviceKey);
        $nextReportOffset = $this->conn->real_escape_string($nextReportOffset);

        return $this->conn -> query("CALL phpetlowner.INSERT_MEASURE('".$deviceSerial."','".$deviceKey."','device_status',CURTIME(),CURTIME(),NULL,".$nextReportOffset.",NULL,NULL,DATE_ADD(CURTIME(),INTERVAL ".$nextReportOffset." SECOND));");
        // returns false if connection unsucessfull
    }

    function pushMeasure($deviceSerial,$deviceKey,$measureType,$boolVal){
        $deviceSerial = $this->conn->real_escape_string($deviceSerial);
        $deviceKey = $this->conn->real_escape_string($deviceKey);
        $measureType = $this->conn->real_escape_string($measureType);
        $boolVal = $this->conn->real_escape_string($boolVal);

        return $this->conn -> query("CALL phpetlowner.INSERT_MEASURE('".$deviceSerial."','".$deviceKey."','".$measureType."',CURTIME(),CURTIME(),NULL,NULL,NULL,".$boolVal.",NULL);");
        // returns false if connection unsucessfull
    }

    function getUserDevices($username,$sessionToken){
        $username = $this->conn->real_escape_string($username);
        $sessionToken = $this->conn->real_escape_string($sessionToken);

        if ($result = $this->conn -> query("call phpetlowner.get_user_devices('Doorkeeper','".$username."','".$sessionToken."');")) {
            $dbOutput = $result->fetch_all(MYSQLI_ASSOC);
            $result -> free_result();
            $this->conn->next_result();
            return $dbOutput;
            
        }
        return array('0','Database connection error');
    }

    function getDeviceHistory($username,$sessionToken,$deviceSerial,$limit,$offset){
        $username = $this->conn->real_escape_string($username);
        $sessionToken = $this->conn->real_escape_string($sessionToken);
        $deviceSerial = $this->conn->real_escape_string($deviceSerial);
        $limit = $this->conn->real_escape_string($limit);
        $offset = $this->conn->real_escape_string($offset);

        if ($result = $this->conn -> query("call phpetlowner.get_device_history('Doorkeeper','".$username."','".$sessionToken."','".$deviceSerial."',".$limit.",".$offset.");")) {
            $dbOutput = $result->fetch_all(MYSQLI_ASSOC);
            $result -> free_result();
            $this->conn->next_result();
            return $dbOutput;
        }
        return array('0','Database connection error');
    }

    function getDeviceStatistics($username,$sessionToken,$deviceSerial,$dateFrom,$dateTo){
        $username = $this->conn->real_escape_string($username);
        $sessionToken = $this->conn->real_escape_string($sessionToken);
        $deviceSerial = $this->conn->real_escape_string($deviceSerial);
        $dateFrom = $this->conn->real_escape_string($dateFrom);
        $dateTo = $this->conn->real_escape_string($dateTo);

        if ($result = $this->conn -> query("call phpetlowner.get_device_statistics('Doorkeeper','".$username."','".$sessionToken."','".$deviceSerial."','".$dateFrom."','".$dateTo."');")) {
            $dbOutput = $result->fetch_all(MYSQLI_ASSOC);
            $result -> free_result();
            $this->conn->next_result();
            return $dbOutput;
        }
        return array('0','Database connection error');
    }

    function renameDevice($username,$sessionToken,$deviceSerial,$deviceName){
        $username = $this->conn->real_escape_string($username);
        $sessionToken = $this->conn->real_escape_string($sessionToken);
        $deviceSerial = $this->conn->real_escape_string($deviceSerial);
        $deviceName = $this->conn->real_escape_string($deviceName);

        if ($result = $this->conn -> query("call phpetlowner.rename_device('Doorkeeper','".$username."','".$sessionToken."','".$deviceSerial."','".$deviceName."','N');")) {
            $dbOutput = $result->fetch_all(MYSQLI_ASSOC);
            $result -> free_result();
            $this->conn->next_result();
            return $dbOutput;
        }
        return array('0','Database connection error');
    }

}

$dbcon= new DBConnection();
?>