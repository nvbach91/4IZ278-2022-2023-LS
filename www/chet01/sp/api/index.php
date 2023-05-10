<?php
require_once('./config.php');
require_once('./UserModel.php');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

class API
{
    private $db;
    private $userModel;

    function __construct()
    {
        try {
            $this->db = new PDO(
                'mysql:host=' . DB_HOST .
                    ';dbname=' . DB_DATABASE .
                    ';charset=utf8mb4',
                DB_USERNAME,
                DB_PASSWORD
            );
            $this->db->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
            $this->db->setAttribute(
                PDO::ATTR_DEFAULT_FETCH_MODE,
                PDO::FETCH_ASSOC
            );
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            $this->userModel = new UserModel();
        } catch (PDOException $e) {
            exit("Connection failed: " . $e->getMessage());
        }
    }
    function executeQuery($query, $params = [])
    {
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            echo "Query failed: " . $e->getMessage();
            exit;
        }
    }
    function handleRequest()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $uriParts = explode('/', $uri);

        // !!! v produkci nastavit podle finalni url 
        $action = $uriParts[4];

        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $requestData = json_decode(file_get_contents('php://input'), true);
            if (method_exists($this->userModel, $action)) {
                call_user_func(array($this->userModel, $action), $this, $requestData);
            } else {
                echo "Unknown action: $action";
            }
        } else {
            if (method_exists($this->userModel, $action)) {
                call_user_func(array($this->userModel, $action), $_GET);
            } else {
                echo "Unknown action: $action";
            }
        }
    }
    function sendOutput($data = array(), $httpHeaders = array())
    {
        header_remove('Set-Cookie');

        if (is_array($httpHeaders) && count($httpHeaders)) {
            foreach ($httpHeaders as $httpHeader) {
                header($httpHeader);
            }
        }

        echo $data;
        exit;
    }
}

$api = new API();
$api->handleRequest();

?>

<meta http-equiv="Expires" content="Tue, 01 Jan 1994 12:12:12 GMT">
<meta http-equiv="Pragma" content="no-cache">