<?php
session_start();

require_once '../../db/Database.php';
require_once '../../db/OrderDB.php';
require_once '../../db/OrderitemDB.php';
require_once '../../db/ProductDB.php';

$invalidInputs = [];
$alertMessages = [];
$alertType = 'alert-danger';

$submittedForm = !empty($_POST);
if ($submittedForm) {
    if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
        array_push($alertMessages, 'Invalid CSRF token');
        array_push($invalidInputs, 'token');
    }

    $phone_pattern = "/^[0-9\-+\s()]*$/u";
    $name_pattern = "/^[\p{L}\p{Z}]*$/u";
    $address_pattern = "/^[\p{L}\p{N},.\p{Z}]*$/u";
    $psc_pattern = "/^[0-9]{5}$/u";

    $firstName = htmlspecialchars(trim($_POST['first_name']));
    if (!preg_match($name_pattern, $firstName)) {
        array_push($alertMessages, 'Invalid first name');
        array_push($invalidInputs, 'first_name');
    }

    $lastName = htmlspecialchars(trim($_POST['last_name']));
    if (!preg_match($name_pattern, $lastName)) {
        array_push($alertMessages, 'Invalid last name');
        array_push($invalidInputs, 'last_name');
    }

    $phone = htmlspecialchars(trim($_POST['phone']));
    if (!preg_match($phone_pattern, $phone)) {
        array_push($alertMessages, 'Invalid phone number');
        array_push($invalidInputs, 'phone');
    }

    $city = htmlspecialchars(trim($_POST['city']));
    if (!preg_match($name_pattern, $city)) {
        array_push($alertMessages, 'Invalid city name');
        array_push($invalidInputs, 'city');
    }

    $street = htmlspecialchars(trim($_POST['street']));
    if (!preg_match($address_pattern, $street)) {
        array_push($alertMessages, 'Invalid street name');
        array_push($invalidInputs, 'street');
    }

    $psc = htmlspecialchars(trim($_POST['psc']));
    if (!preg_match($psc_pattern, $psc)) {
        array_push($alertMessages, 'Invalid PSC. PSC should be 5 digits');
        array_push($invalidInputs, 'psc');
    }

    $paymentMethod = htmlspecialchars(trim($_POST['payment_method']));
    if (!in_array($paymentMethod, ['dobirka', 'prevod'])) {
        array_push($alertMessages, 'Invalid payment method');
        array_push($invalidInputs, 'payment_method');
    }

    $_SESSION['inputValues'] = [
        'first_name' => $firstName,
        'last_name' => $lastName,
        'phone' => $phone,
        'city' => $city,
        'street' => $street,
        'psc' => $psc,
        'payment_method' => $paymentMethod,
    ];

    if (!count($alertMessages)) {
        $orderDB = new OrderDB();
        $orderitemDB = new OrderitemDB();
        $productDB = new ProductDB();

        $user_id = $_SESSION['user_id'];
        $order_id = $orderDB->getPendingOrderIDByUserId($user_id);

        $order_items = $orderitemDB->getAllByOrderId($order_id);

        if (empty($order_items)) {
            array_push($alertMessages, 'Your cart is empty');
        } else {
            foreach ($order_items as $item) {
                $productDB->decrementStock($item['product_id'], $item['quantity']);
            }

            $orderDB->markAsCompleted($order_id);

            $_SESSION['order_success'] = 'Your order has been successfully placed';

            $alertType = 'alert-success';
            $alertMessages = ['Checkout successful'];

            $to = $_SESSION['email'];

            $subject = "Teashop order confirmation";

            $message =
                '<div>
                <h1> Your order has been successfully placed</h1>
                <br>
                <p>Thank you!</p>
                </div>';

            $headers = "From: info@teashop.com\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

            mail($to, $subject, $message, $headers);

            unset($_SESSION['token']);
            unset($_SESSION['inputValues']);

            header('Location: logged_in.php');
            exit;
        } 
    }

    if (count($alertMessages)) {
        $_SESSION['invalidInputs'] = $invalidInputs;
        $_SESSION['alertMessages'] = $alertMessages;
        $_SESSION['alertType'] = $alertType;

        header('Location: checkout_page.php');
        exit;
    }
}
