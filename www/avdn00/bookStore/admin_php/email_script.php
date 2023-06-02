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

$mail = new PHPMailer(true);
$mail->isSMTP();

$mail->SMTPAuth = true;

$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;

$mail->Username = "help.bookworms@gmail.com";
$mail->Password = "urqfzgtodxglktbf";

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
