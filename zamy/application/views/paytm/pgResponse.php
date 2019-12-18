<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");
 
// following files need to be included
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");

$paytmChecksum = "";
$paramList = array();

$isValidChecksum = "FALSE";

$paramList = $_POST;
$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg
 
//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application’s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.

if($isValidChecksum == "TRUE") {
	echo "<b>Checksum matched and following are the transaction details:</b>" . "<br/>";
	if ($_POST["STATUS"] == "TXN_SUCCESS") {
		echo "<b>Transaction status is success</b>" . "<br/>";
		
		//Process your transaction here as success transaction.
		//Verify amount & order id received from Payment gateway with your application's order id and amount.
	}
	else {
		echo "<b>Transaction status is failure</b>" . "<br/>";
	}

	/* if (isset($_POST) && count($_POST)>0 )
	{ 
		foreach($_POST as $paramName => $paramValue) {
				echo "<br/>" . $paramName . " = " . $paramValue;
		}
	}
	header("location:http://client.attuneinfocom.com/paytm_payment_demo"); */
	 if (isset($_POST) && count($_POST)>0 )
	{ 
		foreach($_POST as $key=>$value) 
		{
			$fields_string .= $key.'='.$value.'&';
		}
			rtrim($fields_string, '&');  		
	}	 
		/* if($_POST['MERC_UNQ_REF'] == 'PharmacyList')
		{
			header("location:http://192.168.15.149:4200/#/PharmacyList?".$fields_string);
		}
		elseif($_POST['MERC_UNQ_REF'] == 'patientBookLabList')
		{
			header("location:http://192.168.15.149:4200/#/patientBookLabList?".$fields_string);
		}
		elseif($_POST['MERC_UNQ_REF'] == 'appointmentList')
		{
			header("location: http://192.168.15.149:4200/#/patientBookLabList?".$fields_string);
		} */
	header("location: http://192.168.15.149:4200/#/".$_POST['MERC_UNQ_REF']);
}
else {
	echo "<b>Checksum mismatched.</b>";
	//Process transaction as suspicious.
}
/*
no. :4263982640269299
expiry date : 04/2023
cvv : 738
*/
?>