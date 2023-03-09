<?php
function send_emails($from, $to_arr, $cc_arr, $bcc_arr, $subject, $body, $text_html = 'text')
{
	if (empty($from))
		return (false);
	if (empty($to_arr))
		return (false);
	$subject = '=?UTF-8?B?' . base64_encode($subject) . '?=';
	$body = base64_encode($body);
	if ($text_html == 'html')
		$headers = 'Content-Type: text/html; charset=utf-8' . "\r\n";
	else
		$headers = 'Content-Type: text/plain; charset=utf-8' . "\r\n";
	$headers .= 'Content-Transfer-Encoding: base64' . "\r\n";
	$headers .= 'From: ' . $from.' <'.$from.'>' . "\r\n";
	if (!empty($cc_arr))
		$headers .= 'Cc: ' . implode(",", $cc_arr) . "\r\n";
	if (!empty($bcc_arr))
		$headers .= 'Bcc: ' . implode(",", $bcc_arr) . "\r\n";
	return (mail(implode(',', $to_arr), $subject, $body, $headers, '-f' . $from));
}
?>