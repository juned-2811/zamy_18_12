<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

$checkSum = "";
$paramList = array();

$ORDER_ID 			= $order_id;
$CUST_ID 			= $user_id;
$INDUSTRY_TYPE_ID 	= "Retail";
$CHANNEL_ID 		= "WEB";
$TXN_AMOUNT 		= $order_total;

// Create an array having all required parameters for creating checksum.
$paramList["MID"] 				= PAYTM_MERCHANT_MID;
$paramList["ORDER_ID"] 			= $ORDER_ID;
$paramList["CUST_ID"] 			= $CUST_ID;
$paramList["INDUSTRY_TYPE_ID"] 	= $INDUSTRY_TYPE_ID;
$paramList["CHANNEL_ID"] 		= $CHANNEL_ID;
$paramList["TXN_AMOUNT"] 		= $TXN_AMOUNT;
$paramList["WEBSITE"] 			= PAYTM_MERCHANT_WEBSITE;

if(isset($api_data) && !empty($api_data)){
	$paramList["CALLBACK_URL"] = base_url('api/payment_response');
}
else{
	$paramList["CALLBACK_URL"] = base_url('checkout/response');
}
 
$checksum = getChecksumFromArray($paramList,PAYTM_MERCHANT_KEY);
?>
<form method="post" action="<?php echo PAYTM_TXN_URL ?>" name="f1">
	<table border="1">
		<tbody>
		<?php
		foreach($paramList as $name => $value) {
			echo '<input type="hidden" name="' . $name .'" value="' . $value . '">';
		}
		?>
		<input type="hidden" name="CHECKSUMHASH" value="<?php echo $checksum ?>">
		</tbody>
	</table>
	<script type="text/javascript">
		document.f1.submit();
	</script>
</form>