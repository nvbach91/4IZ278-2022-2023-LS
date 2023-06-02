<?php
include_once '../config.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:./login.php');
    exit;
}
class AdminOrders
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function updatePaymentStatus($orderId, $updatePayment)
    {
        $query = "UPDATE `orders` SET payment_status = ? WHERE id = ?";
        $stmt = mysqli_prepare($this->connection, $query);
        mysqli_stmt_bind_param($stmt, "si", $updatePayment, $orderId);
        mysqli_stmt_execute($stmt);
        $message[] = 'Payment status has been updated';
    }

    public function deleteOrder($orderId)
    {
        $query = "DELETE FROM `orders` WHERE id = ?";
        $stmt = mysqli_prepare($this->connection, $query);
        mysqli_stmt_bind_param($stmt, "i", $orderId);
        mysqli_stmt_execute($stmt);
        header('location:admin_orders.php');
    }

    public function getOrders()
    {
        $orders = [];

        $query = "SELECT * FROM `orders`";
        $result = mysqli_query($this->connection, $query) or die('query failed');

        if (mysqli_num_rows($result) > 0) {
            while ($fetch_orders = mysqli_fetch_assoc($result)) {
                $orders[] = $fetch_orders;
            }
        }

        return $orders;
    }

    public function displayOrders()
    {
        $orders = $this->getOrders();

        if (empty($orders)) {
            echo '<p class="empty">No placed orders yet</p>';
            return;
        }

        foreach ($orders as $order) {
            $userId = htmlspecialchars($order['user_id']);
            $placedOn = htmlspecialchars($order['placed_on']);
            $name = htmlspecialchars($order['name']);
            $number = htmlspecialchars($order['number']);
            $email = htmlspecialchars($order['email']);
            $address = htmlspecialchars($order['address']);
            $totalProducts = htmlspecialchars($order['total_products']);
            $totalPrice = htmlspecialchars($order['total_price']);
            $paymentMethod = htmlspecialchars($order['payment_method']);
            $orderId = htmlspecialchars($order['id']);
            $paymentStatus = htmlspecialchars($order['payment_status']);

            echo <<<HTML
            <div class="box">
                <p>user id: <span>$userId</span></p>
                <p>placed on: <span>$placedOn</span></p>
                <p>name: <span>$name</span></p>
                <p>number: <span>$number</span></p>
                <p>email: <span>$email</span></p>
                <p>address: <span>$address</span></p>
                <p>total products: <span>$totalProducts</span></p>
                <p>total price: <span>$$totalPrice/-</span></p>
                <p>payment method: <span>$paymentMethod</span></p>
                <form action="" method="post">
                    <input type="hidden" name="order_id" value="$orderId">
                    <select name="update_payment">
                        <option value="" selected disabled>$paymentStatus</option>
                        <option value="pending">pending</option>
                        <option value="completed">completed</option>
                    </select>
                    <input type="submit" value="update" name="update_order" class="option-button">
                    <a href="admin_orders.php?delete=$orderId" onclick="return confirm('Delete this order?')" class="delete-button">Delete</a>
                </form>
            </div>
        HTML;
        }
    }
}



$adminOrders = new AdminOrders($connection);

if (isset($_POST['update_order'])) {
    $order_update_id = $_POST['order_id'];
    $update_payment = $_POST['update_payment'];
    $adminOrders->updatePaymentStatus($order_update_id, $update_payment);
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $adminOrders->deleteOrder($delete_id);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
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
        <section class="orders">
            <h1 class="title">Placed orders</h1>

            <div class="box-container">
                <?php
                $adminOrders->displayOrders();
                ?>
            </div>
        </section>
    </div>

    <script src="../js/admin_script.js"></script>
</body>

</html>