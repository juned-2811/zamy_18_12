<?php 
$paramList["order_id"] 	= $order_id;
$paramList["name"] 		= $customer_name;
$paramList["phone"] 	= $phone;
$paramList["email"] 	= $email;
$paramList["amount"] 	= $order_total;
?>
<form method="post" action="<?php echo base_url('instamojo_pay/pay')?>" name="f1">
	<table border="1">
		<tbody>
		<?php
		foreach($paramList as $name => $value) {
			echo '<input type="hidden" name="' . $name .'" value="' . $value . '">';
		}
		?> 
		</tbody>
	</table>
	<script type="text/javascript">
		document.f1.submit();
	</script>
</form>