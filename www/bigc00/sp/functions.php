<?php
require_once "db.php";

function get_course_by_id( $id ){
	global $connection;

	$query = "SELECT * FROM courses WHERE id=" . $id;
	$req = mysqli_query($connection, $query);
	$resp = mysqli_fetch_assoc($req);

	return $resp;
}

function sendRegistrationEmail($email) {
    $to = $email;
    $subject = 'Registration Confirmation';
    $message = 'Thank you for registering on our website.';

    $headers = "From: bigc00@vse.cz"."\r\n";
    $headers .= "Reply-To: bigc00@vse.cz"."\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8"."\r\n";
    $headers .= "X-Mailer: PHP/";

    // Send the email
    mail($to, $subject, $message, $headers);
}

function sendOrderConfirmationEmail($email, $orderID, $courseList)
{
    $to = $email;
    $subject = 'Order Confirmation';
    $message = 'Thank you for your order! Here are the details:' . PHP_EOL;

    foreach ($courseList as $course) {
        $message .= 'Course: ' . $course['title'] . ' | Price: ' . $course['price'] . ' CZK' . PHP_EOL;
    }

    $message .= 'Order ID: ' . $orderID;

    $headers = "From: bigc00@vse.cz" . "\r\n";
    $headers .= "Reply-To: bigc00@vse.cz" . "\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8" . "\r\n";
    $headers .= "X-Mailer: PHP/";

    // Send the email
    mail($to, $subject, $message, $headers);
}


?>