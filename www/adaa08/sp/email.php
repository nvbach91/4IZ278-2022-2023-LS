<?php
function sendEmail($to, $subject, $message, $from = "example@vse.cz") {
    $headers = "From: {$from}\r\n" .
        "Reply-To: {$from}\r\n" .
        "Return-Path: {$from}\r\n" .
        'X-Mailer: PHP/' . phpversion();

    return mail($to, $subject, $message, $headers);
}

?>