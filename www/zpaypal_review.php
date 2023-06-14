<?php 	include_once("database.php");
/*
* Call to GetExpressCheckoutDetails
*/

require_once ("zpaypal_functions.php");

/*
* in paypalfunctions.php in a session variable
*/
$_SESSION['payer_id'] =	$_GET['PayerID'];

// Check to see if the Request object contains a variable named 'token'
$token = "";

if (isset($_REQUEST['token']))
{
	$token = $_REQUEST['token'];
	$_SESSION['TOKEN'] = $token;
}

// If the Request object contains the variable 'token' then it means that the user is coming from PayPal site.
if ( $token != "" )
{
	/*
	* Calls the GetExpressCheckoutDetails API call
	*/
	$resArrayGetExpressCheckout = GetShippingDetails( $token );
	$ackGetExpressCheckout = strtoupper($resArrayGetExpressCheckout["ACK"]);
	if( $ackGetExpressCheckout == "SUCCESS" || $ackGetExpressCheckout == "SUCESSWITHWARNING")
	{
		/*
		* The information that is returned by the GetExpressCheckoutDetails call should be integrated by the partner into his Order Review
		* page
		*/
		$email 				= $resArrayGetExpressCheckout["EMAIL"]; // ' Email address of payer.
		$payerId 			= $resArrayGetExpressCheckout["PAYERID"]; // ' Unique PayPal customer account identification number.
		$payerStatus		= $resArrayGetExpressCheckout["PAYERSTATUS"]; // ' Status of payer. Character length and limitations: 10 single-byte alphabetic characters.
		$firstName			= $resArrayGetExpressCheckout["FIRSTNAME"]; // ' Payer's first name.
		$lastName			= $resArrayGetExpressCheckout["LASTNAME"]; // ' Payer's last name.
		$cntryCode			= $resArrayGetExpressCheckout["COUNTRYCODE"]; // ' Payer's country of residence in the form of ISO standard 3166 two-character country codes.
		$shipToName			= $resArrayGetExpressCheckout["PAYMENTREQUEST_0_SHIPTONAME"]; // ' Person's name associated with this address.
		$shipToStreet		= $resArrayGetExpressCheckout["PAYMENTREQUEST_0_SHIPTOSTREET"]; // ' First street address.
		$shipToCity			= $resArrayGetExpressCheckout["PAYMENTREQUEST_0_SHIPTOCITY"]; // ' Name of city.
		$shipToState		= $resArrayGetExpressCheckout["PAYMENTREQUEST_0_SHIPTOSTATE"]; // ' State or province
		$shipToCntryCode	= $resArrayGetExpressCheckout["PAYMENTREQUEST_0_SHIPTOCOUNTRYCODE"]; // ' Country code.
		$shipToZip			= $resArrayGetExpressCheckout["PAYMENTREQUEST_0_SHIPTOZIP"]; // ' U.S. Zip code or other country-specific postal code.
		$addressStatus 		= $resArrayGetExpressCheckout["ADDRESSSTATUS"]; // ' Status of street address on file with PayPal
		$totalAmt   		= $resArrayGetExpressCheckout["PAYMENTREQUEST_0_AMT"]; // ' Total Amount to be paid by buyer
		$currencyCode       = $resArrayGetExpressCheckout["PAYMENTREQUEST_0_CURRENCYCODE"]; // 'Currency being used
		$shippingAmt        = $resArrayGetExpressCheckout["PAYMENTREQUEST_0_SHIPPINGAMT"]; // 'Currency being used
		/*
		* Add check here to verify if the payment amount stored in session is the same as the one returned from GetExpressCheckoutDetails API call
		* Checks whether the session has been compromised
		*/
		if($_SESSION["Payment_Amount"] != $totalAmt || $_SESSION["currencyCodeType"] != $currencyCode)
		exit("Parameters in session do not match those in PayPal API calls");
	}
	else
	{
		//Display a user friendly Error on the page using any of the following error information returned by PayPal
		$ErrorCode = urldecode($resArrayGetExpressCheckout["L_ERRORCODE0"]);
		$ErrorShortMsg = urldecode($resArrayGetExpressCheckout["L_SHORTMESSAGE0"]);
		$ErrorLongMsg = urldecode($resArrayGetExpressCheckout["L_LONGMESSAGE0"]);
		$ErrorSeverityCode = urldecode($resArrayGetExpressCheckout["L_SEVERITYCODE0"]);

		echo "GetExpressCheckoutDetails API call failed. ";
		echo "Detailed Error Message: " . $ErrorLongMsg;
		echo "Short Error Message: " . $ErrorShortMsg;
		echo "Error Code: " . $ErrorCode;
		echo "Error Severity Code: " . $ErrorSeverityCode;
	}
}


include_once("header_style.php");
$date = date('Y-m-d');
$date30 = strtotime ( '30 day' , strtotime ( $date ) ) ;
$date30 = date ( 'Y-m-d' , $date30 );
$data = $conn->prepare("UPDATE `_dmp_users` SET `wallet` = '1', `paypal_date` = '$date30' WHERE `username` = ?");
$data->execute([$_SESSION["user"]]);
header("Location: main_logout.php");



?>
<?php include('zpaypal_footer.php'); ?>
