<?php


$to = $email;
$subject = "FTP Klient - přístup nasdílen";

$message =  '<html><body>';
$message .= '<h4> Byl vám nasdílen nový ftp přístup</h4> koukněte na profil';
$message .= '</body></html>';

$headers = 'From: ftpklient@patriktrejtnar.cz' . "\r\n" .
'Reply-To: ftpklient@patriktrejtnar.cz' . "\r\n" .
"Content-type:text/html;charset=UTF-8" . "\r\n" .
'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);