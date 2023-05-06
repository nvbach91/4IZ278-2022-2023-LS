<?php 
session_start();
include_once('database.php');
if(!isset($_SESSION['login']) && $_SESSION['privilege'] <= 1){
    header('Location: login.php');
}

if(isset($_GET['id']) && isset($_GET['newprivilege'])) {
    $id = $_GET['id'];
    $new_privilege = $_GET['newprivilege'];

    try {
        $query = "UPDATE users SET privilege = :privilege WHERE user_id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':privilege', $new_privilege);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        header('Location: users.php');
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>