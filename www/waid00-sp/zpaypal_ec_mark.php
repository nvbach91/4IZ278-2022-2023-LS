<?php require_once("zpaypal_functions.php"); ?>
<?php
//'------------------------------------
//' Calls the SetExpressCheckout API call
//'
//' The CallMarkExpressCheckout function is defined in the file zpaypal_functions.php,
//' it is included at the top of this file.
//'-------------------------------------------------

$itemDetail = $_SESSION['post_value'];
$shippingDetail = $_POST;
$paymentAmount = $itemDetail['PAYMENTREQUEST_0_AMT'];
if(isset($_POST['PAYMENTREQUEST_0_SHIPPINGAMT'])) {
	$new_shipping = $_POST['PAYMENTREQUEST_0_SHIPPINGAMT']; //need to change this value, just for testing
	$paymentAmount = ($paymentAmount + $new_shipping) - $itemDetail['PAYMENTREQUEST_0_SHIPPINGAMT'];
	$itemDetail['PAYMENTREQUEST_0_SHIPPINGAMT'] = $new_shipping;
	$itemDetail['PAYMENTREQUEST_0_AMT'] = $paymentAmount;

}
$resArray = CallMarkExpressCheckout ($paymentAmount, $shippingDetail, $itemDetail);

$ack = strtoupper($resArray["ACK"]);
if($ack=="SUCCESS" || $ack=="SUCCESSWITHWARNING")  //if SetExpressCheckout API call is successful
{
	//RedirectToPayPal ( $resArray["TOKEN"] );
	echo $resArray["TOKEN"];
}
else
{
	//Display a user friendly Error on the page using any of the following error information returned by PayPal
	$ErrorCode = urldecode($resArray["L_ERRORCODE0"]);
	$ErrorShortMsg = urldecode($resArray["L_SHORTMESSAGE0"]);
	$ErrorLongMsg = urldecode($resArray["L_LONGMESSAGE0"]);
	$ErrorSeverityCode = urldecode($resArray["L_SEVERITYCODE0"]);

	echo "SetExpressCheckout API call failed. ";
	echo "Detailed Error Message: " . $ErrorLongMsg;
	echo "Short Error Message: " . $ErrorShortMsg;
	echo "Error Code: " . $ErrorCode;
	echo "Error Severity Code: " . $ErrorSeverityCode;
}

?>
