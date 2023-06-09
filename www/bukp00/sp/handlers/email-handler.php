<?php

function sendEmail($email, $eventName, $eventDate, $note, $seats)
{
  $to = $email;
  $subject = "Succesfully signed up at Easy Tickets";

  $message = "
<html>
<head>
<title>Signed up for an event at EasyTickets</title>
</head>
<body>
<p>Congratulation to sign up for the event %s!</p>
<p>-------------------------------------------</p>
<p>The event takes place at: %s</p>
<p>Your note: %s</p>
<p>Seats amount: %s</p>
</body>
</html>
";

  $finalMessage = sprintf($message, $eventName, $eventDate, $note, $seats);

  // Always set content-type when sending HTML email
  $headers = "MIME-Version: 1.0" . "\r\n";
  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

  // More headers
  $headers .= 'From: <bukp00@vse.com>' . "\r\n";

  mail($to, $subject, $finalMessage, $headers);
}
