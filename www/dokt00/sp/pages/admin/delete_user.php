<?php
require_once '../../db/Database.php';
require_once '../../db/UsersDB.php';

if(isset($_POST['user_id'])) {
    $userID = $_POST['user_id'];
    
    $usersDB = new UsersDB();
    
    try {
        $usersDB->deleteUser($userID);
        echo "User deleted successfully.";
    } catch (Exception $e) {
        error_log($e->getMessage());
        echo "Error deleting user.";
        echo $e->getMessage();
    }
} else {
    echo "Invalid data.";
}
?>
