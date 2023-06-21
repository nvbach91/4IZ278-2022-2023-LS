<?php
class mailer
{
    protected $headers = 
    'From: kuza13@vse.cz' . "\r\n" .
    'Reply-To: kuza13@vse.cz' . "\r\n" .
    'X-Mailer: PHP/';

    // Send the email
    public function mailRegistered($to,)
    {
        $message = 'Registration complete!';
        $subject = 'Grow Republic';
        return mail($to, $subject, $message, $this->headers);
    }

    public function mailOrdered($to, $message)
    {
        $subject = 'We got your order!';
        return mail($to, $subject, $message, $this->headers);
    }

    // Check if the email was sent successfully

}
