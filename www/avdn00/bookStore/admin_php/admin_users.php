<?php

include '../config.php';
require '../customer_php/utils.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:./login.php');
    exit;
}

class AdminUsersPage
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }


    public function deleteUser($delete_id)
    {
        $query = "DELETE FROM `users` WHERE id = ?";
        $stmt = mysqli_prepare($this->connection, $query);
        mysqli_stmt_bind_param($stmt, "i", $delete_id);
        mysqli_stmt_execute($stmt);
        header('location:admin_users.php');
        exit();
    }

    public function displayUsers()
    {
        $query = "SELECT * FROM `users`";
        $select_users = mysqli_query($this->connection, $query) or die('query failed');

        while ($fetch_users = mysqli_fetch_assoc($select_users)) {
            $name = htmlspecialchars($fetch_users['name']);
            $email = htmlspecialchars($fetch_users['email']);
            $user_type = $fetch_users['user_type'];
            $user_color = ($user_type == 'admin') ? 'var(--orange)' : '';

            echo <<<HTML
                <div class="box">
                    <p>username: <span>$name</span></p>
                    <p>email: <span>$email</span></p>
                    <p>user type: <span style="color: $user_color">$user_type</span></p>
                    <a href="admin_users.php?delete=$fetch_users[id]" onclick="return confirm('Delete this user?')" class="delete-button">Delete</a>
                </div>
            HTML;
        }
    }
}

$adminUsersPage = new AdminUsersPage($connection);

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $adminUsersPage->deleteUser($delete_id);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <!--font awesome cdn link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/admin_style.css">
</head>

<body>
    <?php include 'admin_header.php'; ?>
    <div class="window">
        <div class="logo-container">
            <div class="logo">
                <p><img alt="logo" src="../img/open-book.png"></p>
            </div>
        </div>
        <section class="users">
            <h1 class="title">Users</h1>
            <div class="box-container">
                <?php
                $adminUsersPage->displayUsers();
                ?>
            </div>
        </section>
    </div>
    <script src="../js/admin_script.js"></script>
</body>

</html>