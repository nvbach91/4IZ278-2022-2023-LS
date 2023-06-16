<?php
require_once '../../db/Database.php';
require_once '../../db/UsersDB.php';

if(isset($_POST['user_id']) && isset($_POST['column']) && isset($_POST['value'])) {
    $userID = $_POST['user_id'];
    $column = $_POST['column'];
    $value = $_POST['value'];
    
    $usersDB = new UsersDB();
    
    try {
        $usersDB->updateUser($userID, $column, $value);
        echo "User updated successfully.";
    } catch (Exception $e) {
        error_log($e->getMessage());
        echo "Error updating user.";
    }
} else {
    echo "Invalid data.";
}
?>
