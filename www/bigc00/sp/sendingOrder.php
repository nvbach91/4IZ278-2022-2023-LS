<?php 
session_start();
require_once 'db.php';
require_once 'functions.php';
    if (isset($_SESSION['cart_list']) && count($_SESSION['cart_list']) > 0) {
        $name = $_SESSION['userData']['name'] . ' ' . $_SESSION['userData']['surname'];
        $email = $_SESSION['userData']['email'];
        $user_id = $_SESSION['userData']['id'];

        // Generate a unique order ID
        $orderID = uniqid();

        // Prepare an array to hold the values for the multiple rows
        $orderRows = [];
        $infoRows = [];

        foreach ($_SESSION['cart_list'] as $course) {
            $courseID = $course['id'];
            $coursePrice = $course['price'];
            $quantity = 1;
            $total = $quantity * $coursePrice;

            // Add the values for each course to the arrays
            $orderRows[] = "('$orderID','$user_id')";
            $infoRows[] = "('$orderID','$courseID','$quantity','$total')";
        }

        // Construct the queries to insert multiple rows
        $orderQuery = "INSERT INTO orders (orderID, userID) VALUES " . implode(',', $orderRows);
        $infoQuery = "INSERT INTO orderinfo (orderID, courseID, quantity, total) VALUES " . implode(',', $infoRows);

        if (mysqli_query($connection, $orderQuery) && mysqli_query($connection, $infoQuery)) {
            $_SESSION['message'] = "Order sent successfully!";
            // Send order confirmation email
            sendOrderConfirmationEmail($email, $orderID, $_SESSION['cart_list']);
        } else {
            echo "Error sending order: " . mysqli_error($connection);
        }

        // Output the message and unset the cart session
        
        unset($_SESSION['cart_list']);
        header("Location:cart.php");
        unset($_SESSION['totalCart.php']);
        die;
    }

