<?php
include '../config.php';
session_start();

$fromEmail = "help.bookworms@gmail.com";
$toMail = isset($_POST['toMail']) ? htmlspecialchars($_POST['toMail']) : '';
$subject = isset($_POST['subject']) ? htmlspecialchars($_POST['subject']) : '';
$emailMessage = isset($_POST['emailMessage']) ? htmlspecialchars($_POST['emailMessage']) : '';

require "../vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

//new instance of the PHPMailer class
$mail = new PHPMailer(true);

// indicates that the script will use the SMTP server for sending the email
$mail->isSMTP();

//enable SMTP authentication
$mail->SMTPAuth = true;

//host name of Gmail's SMTP server
$mail->Host = "smtp.gmail.com";

// use STARTTLS encryption
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

// port number for Gmail's SMTP server
$mail->Port = 587;

$mail->Username = "help.bookworms@gmail.com";
$mail->Password = "";

$mail->setFrom($fromEmail);
$mail->addAddress($toMail);

$mail->Subject = $subject;
$mail->Body = $emailMessage;

try {
    $mail->send();
    header('location: admin_messages.php');
    exit;
} catch (Exception $e) {
    echo "Email could not be sent. Error: " . $mail->ErrorInfo;
}
