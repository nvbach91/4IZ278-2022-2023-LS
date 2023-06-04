<?php

include_once '../config.php';
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

class AdminDashboard
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    private function fetchData($query)
    {
        $statement = mysqli_prepare($this->connection, $query);
        if ($statement) {
            mysqli_stmt_execute($statement);
            $result = mysqli_stmt_get_result($statement);
            $data = mysqli_fetch_assoc($result);
            mysqli_stmt_close($statement);
            return $data;
        }
        return false;
    }

    public function sanitize($value)
    {
        return isset($value) ? htmlspecialchars($value) : '0';
    }

    public function getTotalPendings()
    {
        $query = "SELECT SUM(total_price) AS total_pendings FROM `orders` WHERE payment_status = 'pending'";
        $data = $this->fetchData($query);
        return $data ? $data['total_pendings'] : 0;
    }

    public function getTotalCompleted()
    {
        $query = "SELECT SUM(total_price) AS total_completed FROM `orders` WHERE payment_status = 'completed'";
        $data = $this->fetchData($query);
        return $data ? $data['total_completed'] : 0;
    }

    public function getNumberOfOrders()
    {
        $query = "SELECT COUNT(*) AS number_of_orders FROM `orders`";
        $data = $this->fetchData($query);
        return $data ? $data['number_of_orders'] : 0;
    }

    public function getNumberOfProducts()
    {
        $query = "SELECT COUNT(*) AS number_of_products FROM `products`";
        $data = $this->fetchData($query);
        return $data ? $data['number_of_products'] : 0;
    }

    public function getNumberOfUsers()
    {
        $query = "SELECT COUNT(*) AS number_of_users FROM `users`";
        $data = $this->fetchData($query);
        return $data ? $data['number_of_users'] : 0;
    }

    public function getNumberOfMessages()
    {
        $query = "SELECT COUNT(*) AS number_of_messages FROM `message`";
        $data = $this->fetchData($query);
        return $data ? $data['number_of_messages'] : 0;
    }
}


$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('Location: ./login.php');
    exit;
}

$dashboard = new AdminDashboard($connection);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin board</title>
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
        <section class='dashboard'>
            <h1 class='title'>Dashboard</h1>
            <div class='box-container'>
                <div class="box">
                    <h3>$<?php echo $dashboard->sanitize($dashboard->getTotalPendings()); ?>/-</h3>
                    <p>Total pendings</p>
                </div>

                <div class='box'>
                    <h3>$<?php echo $dashboard->sanitize($dashboard->getTotalCompleted()); ?>/-</h3>
                    <p>Completed payments</p>
                </div>

                <div class='box'>
                    <h3><?php echo $dashboard->sanitize($dashboard->getNumberOfOrders()); ?></h3>
                    <p>Orders placed</p>
                </div>

                <div class='box'>
                    <h3><?php echo $dashboard->sanitize($dashboard->getNumberOfProducts()); ?></h3>
                    <p>Products added</p>
                </div>

                <div class='box'>
                    <h3><?php echo $dashboard->sanitize($dashboard->getNumberOfUsers()); ?></h3>
                    <p>Users</p>
                </div>

                <div class='box'>
                    <h3><?php echo $dashboard->sanitize($dashboard->getNumberOfMessages()); ?></h3>
                    <p>New messages</p>
                </div>
            </div>
        </section>
    </div>

    <script src="../js/admin_script.js"></script>
</body>

</html>