<?php defined('BASEPATH') OR exit('No direct script access allowed');
function order_confirmation($order_id,$user_id){
	
	$CI = get_instance();
	$CI->load->model('order_model');

	$order_details = $CI->order_model->order_details($order_id,$user_id);
	
	$prodduct_html='';
	
	foreach($order_details['order_items'] as $item){
		$prodduct_html .='
		<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full" object="drag-module-small">
            <tbody>
				<tr><td width="100%" align="center" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
				<tr>
					<td valign="top" align="center" width="100%" style="font-family: Helvetica, Arial, sans-serif; color: #30373a; font-weight: bold; font-size: 15px; line-height: 24px; text-align: center;" class="fullCenter">
						<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="full">
						 <tbody>
							 <tr>
								<td width="20" height="50">&nbsp;&nbsp;&nbsp;&nbsp;</td>
								<td width="50" height="50" valign="middle" style="text-align: left;" class="erase" id="image49">
										<a href="#"><img width="49" src="'.$item['menu_logo'].'" alt="" border="0" style="vertical-align: middle; padding-top: 1px;" mc:edit="17"> </a>
								</td>
								<td width="15" height="50" class="erase"></td>
								<td width="205" height="50" valign="top" class="full">
										<table width="205" border="0" cellpadding="0" cellspacing="0" align="left">
												<tbody>
												<tr><td width="100%" height="2" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
												<tr>
														<td width="100%" style="font-family: Helvetica, Arial, sans-serif; color: #222222; font-weight: bold; font-size: 15px; line-height: 18px; text-align: left;" class="w70" mc:edit="18">
																<!--[if !mso]><!--><span style="font-family: proxima_nova_rgbold, Helvetica; font-weight: normal;"><!--<![endif]--><p  cu-identify="element_0638462864365142">
																<div>'.$item['menu_name'].'</div>
																<!--[if !mso]><!-->
																</span>
																<!--<![endif]-->
														</td>
												</tr>
												<tr><td width="100%" height="5" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
												<tr>
														<td width="100%" style="font-family: Helvetica, Arial, sans-serif; color: #222222; font-weight: normal; font-size: 13px; line-height: 18px; text-align: left;" class="w70" mc:edit="19">
																<!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]-->Delivery: <span style="color: #71a42e;"></span>
																<!--[if !mso]><!-->
																</span>
																<!--<![endif]-->
														</td>
												</tr>
										</tbody>
										</table>
								</td>
								<td width="80" valign="top" height="50" class="erase">
										<table width="80" border="0" cellpadding="0" cellspacing="0" align="right" class="w70">
												<tbody>
														<tr><td width="100%" height="2" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
														<tr>
																<td width="100%" style="font-family: Helvetica, Arial, sans-serif; color: #222222; font-weight: normal; font-size: 14px; line-height: 20px; text-align: right;" class="w70" mc:edit="20">
																		<!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]--><p  cu-identify="element_009125256622760869">Rs. '.$item['price'].'<!--[if !mso]><!--></span>
																		<!--<![endif]-->
																</td>
														</tr>
												</tbody>
										</table>
								</td>
								<td width="40" height="50">&nbsp;&nbsp;</td>
								<td width="80" height="50" valign="top" class="w50">
										<table width="80" border="0" cellpadding="0" cellspacing="0" align="left" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;"
										class="w50">
												<tbody>
														<tr><td width="100%" height="2" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
														<tr>
																<td width="100%" style="font-family: Helvetica, Arial, sans-serif; color: #222222; font-weight: normal; font-size: 14px; line-height: 20px; text-align: left;" class="w50" mc:edit="21">
																		<!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]-->'.$item['qty'].'x<!--[if !mso]><!--></span>
																		<!--<![endif]-->
																</td>
														</tr>
												</tbody>
										</table>
								</td>
								<td width="90" valign="top" height="50" class="erase">
										<table width="90" border="0" cellpadding="0" cellspacing="0" align="right">
												<tbody>
														<tr>
																<td width="100%" style="font-family: Helvetica, Arial, sans-serif; color: #222222; font-weight: normal; font-size: 14px; line-height: 20px; text-align: right;" class="w70" mc:edit="22">
																		<!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]--><p  cu-identify="element_020128349030194048">Rs. '.$item['subtotal'].'<!--[if !mso]><!--></span>
																		<!--<![endif]-->
																</td>
														</tr>
												</tbody>
										</table>
								</td>
								<td width="20" height="50" class="erase"></td>
						 </tr>
					</tbody>
					</table>
				</td>
			</tr>
				<tr><td width="100%" height="1" bgcolor="#f4f4f4" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
				<tr><td width="100%" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
			</tbody>
		</table>';

	}
	
	$delivery_charge = 0;
	if(!empty($order_details['delivery_charge'])){
		$delivery_charge = $order_details['delivery_charge'];
	}
	
	//$order_total = $order_details['order_total'] + $delivery_charge;
	$order_total = $order_details['order_total'];
	
	$payment_details = '';
	if(strtolower($order_details['payment_method'])=='cod'){
		$payment_details .= '<span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]--><p  cu-identify="element_02865282806828009">Payment method: <span style="font-family: proxima_nova_rgbold, Helvetica;">'.$order_details['payment_method'].'</span>
				<br>You order has been Pending Payment.
				<!--[if !mso]><!-->
				</span>';
	}else{
	
		$payment_details .= '<span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]--><p  cu-identify="element_02865282806828009">Payment method: <span style="font-family: proxima_nova_rgbold, Helvetica;">'.$order_details['payment_method'].'</span>
				<!--[if !mso]><!-->
				</span>';
	}
	
	
	$billing_address ='<span style="font-weight: bold;">
                  
                    <span style="font-family: proxima_nova_rgbold, Helvetica; font-weight: normal;">
                    '.$order_details['billing']['billing_name'].'</span>
                   </span><br>
                    <span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;">
					'.$order_details['billing']['billing_phone'].'</span><br>
					<span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;">
                      '.$order_details['billing']['billing_email'].'</span><br><br><br>';
	
	$shipping_address ='<span style="font-weight: bold;">
                    <!--[if !mso]><!-->
                    <span style="font-family: proxima_nova_rgbold, Helvetica; font-weight: normal;">
                    <!--<![endif]-->'.$order_details['shipping']['shipping_name'].'<!--[if !mso]><!--></span>
                    <!--<![endif]--></span><br>
                    <!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]-->
                      '.$order_details['shipping']['shipping_address'].'<!--[if !mso]><!--></span><!--<![endif]-->';
	
	$complementary_food = '';		
	
	if(!empty($order_details['complementary_food'])){
		$complementary_food .= '<tr>
			<td valign="middle" width="100%" style="text-align: center; font-size: 12px;font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-weight: normal; text-transform: uppercase; line-height: 18px;" mc:edit="2">
				<span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;">'.$order_details['complementary_food'].'</span>
			</td>
		</tr>';
	}
	
	 
	
	$message = '';
	$message .= '<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
<title>Order Confirmation - Your Order with zamy.in [#'.$order_details['order_id'].'] has been successfully placed!</title>
<style type="text/css">
div,p,a,li,td {-webkit-text-size-adjust: none;}
* {-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;}
.ReadMsgBody {width: 100%; background-color: #ffffff;}
.ExternalClass {width: 100%;background-color: #ffffff;}
body {width: 100%; height: 100%;margin: 0; padding: 0;-webkit-font-smoothing: antialiased;}
html {background-color: #e6e4db; width: 100%; }
@font-face {font-family: "proxima_novalight"; src: url("http://rocketway.net/themebuilder/products/font/proximanova-light-webfont.eot"); src: url("http://rocketway.net/themebuilder/products/font/proximanova-light-webfont.eot?#iefix") format("embedded-opentype"), url("http://rocketway.net/themebuilder/products/font/proximanova-light-webfont.woff") format("woff"), url("http://rocketway.net/themebuilder/products/font/proximanova-light-webfont.ttf") format("truetype"); font-weight: normal; font-style: normal; }
@font-face {font-family: proxima_nova_rgregular; src: url("http://rocketway.net/themebuilder/products/font/proximanova-regular-webfont.eot"); src: url("http://rocketway.net/themebuilder/products/font/proximanova-regular-webfont.eot?#iefix") format("embedded-opentype"), url("http://rocketway.net/themebuilder/products/font/proximanova-regular-webfont.woff") format("woff"), url("http://rocketway.net/themebuilder/products/font/proximanova-regular-webfont.ttf") format("truetype"); font-weight: normal; font-style: normal; }
@font-face {font-family: "proxima_novasemibold"; src: url("http://rocketway.net/themebuilder/products/font/proximanova-semibold-webfont.eot"); src: url("http://rocketway.net/themebuilder/products/font/proximanova-semibold-webfont.eot?#iefix") format("embedded-opentype"), url("http://rocketway.net/themebuilder/products/font/proximanova-semibold-webfont.woff") format("woff"), url("http://rocketway.net/themebuilder/products/font/proximanova-semibold-webfont.ttf") format("truetype"); font-weight: normal; font-style: normal;}
@font-face {font-family: proxima_nova_rgbold;src: url("http://rocketway.net/themebuilder/products/font/proximanova-bold-webfont.eot");src: url("http://rocketway.net/themebuilder/products/font/proximanova-bold-webfont.eot?#iefix") format("embedded-opentype"), url("http://rocketway.net/themebuilder/products/font/proximanova-bold-webfont.woff") format("woff"), url("http://rocketway.net/themebuilder/products/font/proximanova-bold-webfont.ttf") format("truetype"); font-weight: normal; font-style: normal;}
@font-face {font-family: "proxima_novathin"; src: url("http://rocketway.net/themebuilder/products/font/proximanova-thin-webfont.eot"); src: url("http://rocketway.net/themebuilder/products/font/proximanova-thin-webfont.eot?#iefix") format("embedded-opentype"), url("http://rocketway.net/themebuilder/products/font/proximanova-thin-webfont.woff") format("woff"), url("http://rocketway.net/themebuilder/products/font/proximanova-thin-webfont.ttf") format("truetype"); font-weight: normal;font-style: normal;}
@font-face {font-family: "proxima_novablack";src: url("http://rocketway.net/themebuilder/products/font/proximanova-black-webfont.eot"); src: url("http://rocketway.net/themebuilder/products/font/proximanova-black-webfont.eot?#iefix") format("embedded-opentype"), url("http://rocketway.net/themebuilder/products/font/proximanova-black-webfont.woff") format("woff"), url("http://rocketway.net/themebuilder/products/font/proximanova-black-webfont.ttf") format("truetype");font-weight: normal;font-style: normal;}
@font-face {font-family: "proxima_novaextrabold"; src: url("http://rocketway.net/themebuilder/products/font/proximanova-extrabold-webfont.eot"); src: url("http://rocketway.net/themebuilder/products/font/proximanova-extrabold-webfont.eot?#iefix") format("embedded-opentype"), url("http://rocketway.net/themebuilder/products/font/proximanova-extrabold-webfont.woff2") format("woff2"), url("http://rocketway.net/themebuilder/products/font/proximanova-extrabold-webfont.woff") format("woff"), url("http://rocketway.net/themebuilder/products/font/proximanova-extrabold-webfont.ttf") format("truetype"); font-weight: normal; font-style: normal;}
p {padding: 0!important;margin-top: 0!important;margin-right: 0!important;margin-bottom: 0!important;margin-left: 0!important;}
.hover:hover {opacity: 0.85;filter: alpha(opacity=85);}
.underline:hover {text-decoration: underline!important;}
.jump:hover {opacity: 0.75;filter: alpha(opacity=75); padding-top: 10px!important;}
#image49 img {width: 49px;height: auto;}
</style>
<!-- @media only screen and (max-width: 640px) 
           {*/
           -->
<style type="text/css">
@media only screen and (max-width: 640px) {
        body { width: auto!important; }
        table[class=full] {width: 100%!important; clear: both;}
        table[class=mobile] {width: 100%!important;padding-left: 20px; padding-right: 20px;clear: both; }
        table[class=fullCenter] {width: 100%!important; text-align: center!important; clear: both; }
        td[class=image600] img {width: 100%!important;text-align: center!important; clear: both; }
        td[class=fullCenter] {width: 100%!important; text-align: center!important; clear: both;}
        td[class=full] { width: 100%!important; clear: both;  }
        *[class=erase] { display: none; }
        *[class=buttonScale] { float: none!important; text-align: center!important; display: inline-block!important; clear: both; }
        *[class=buttonLeft] {float: left!important; text-align: left!important; display: inline-block!important;  clear: both; }
        .pad20 { padding-left: 20px!important; padding-right: 20px!important; }
        .w50 {width: 50px!important;}
        .h30 { height: 30px!important; }
}
</style>
<!--
@media only screen and (max-width: 479px) 
           {
           -->
<style type="text/css">
@media only screen and (max-width: 479px) {
        body {width: auto!important;}
        table[class=full] {width: 100%!important; clear: both; }
        table[class=mobile] {width: 100%!important; padding-left: 20px; padding-right: 20px; clear: both;}
        table[class=fullCenter] {width: 100%!important;text-align: center!important; clear: both; }
        td[class=fullCenter] { width: 100%!important; text-align: center!important; clear: both;}
        td[class=full] {width: 100%!important;clear: both; }
        *[class=erase] {display: none; }
        *[class=buttonScale] {float: none!important; text-align: center!important;display: inline-block!important;clear: both; }
        *[class=buttonLeft] { float: left!important; text-align: left!important; display: inline-block!important;clear: both;}
        .pad20 { padding-left: 20px!important; padding-right: 20px!important; }
        .w70 { width: 70px!important; }
        .w50 { width: 50px!important;}
        .h30 { height: 30px!important;  }
}
}
</style>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" yahoo="fix">
	<div class="ui-sortable" id="sort_them"><!-- Wrapper 2 -->
		<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full" bgcolor="#e6e4db" style="background-color: rgb(230, 228, 219);">
			<tbody>
                            <tr mc:repeatable>
                                    <td width="100%" valign="top" align="center">
                                            <div mc:hideable><!-- Wrapper -->
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile">
                                                        <tbody><tr><td align="center"> <!-- Space -->
                                                            <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
                                                                    <tbody><tr> <td width="100%" height="50"></td> </tr></tbody>
                                                            </table> <!-- End Space --> </td>  </tr>
                                                        </tbody>
                                                    </table><!-- End Wrapper -->
                                            </div>
                                    </td>
                            </tr>
			</tbody>
		</table><!-- Wrapper 2 --><!-- Wrapper 3  -->
		<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full" bgcolor="#e6e4db" style="background-color: rgb(230, 228, 219);">
			<tbody>
				<tr mc:repeatable>
					<td bgcolor="#e6e4db" align="center" style="background-color: rgb(230, 228, 219);">
						<div mc:hideable><!-- Mobile Wrapper -->
							<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile">
								<tbody>
									<tr>
										<td width="600" align="center"><!-- Start Nav -->
											<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full" style="background-image: url(http://rocketway.net/themebuilder/products/batch1/templates/template_1/images/header_bg.jpg); background-position: center top; background-repeat:no-preat!important; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; background-position: center center; background-repeat: no-repeat; background-color: #323132; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; bgcolor:#323132" id="BGheaderChange">
												<tbody>
													<tr><td width="100%" height="30"></td></tr>
													<tr>
														<td width="100%" valign="middle" class="pad20" align="center">
															<!-- Nav -->
															<table width="500" border="0" cellpadding="0" cellspacing="0" align="center" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="full">
																<tbody>
																	<tr>
																		<td valign="middle" width="100%" style="text-align: center; font-size: 30px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-weight: bold; line-height: 36px;"  mc:edit="1">
																			<!--[if !mso]><!--><span style="font-family: proxima_nova_rgbold, Helvetica; font-weight: normal;"><!--<![endif]-->Thank you for your order!<!--[if !mso]><!--></span>
																			<!--<![endif]-->
																		</td>
																	</tr>
																	<tr><td width="100%" height="6"></td></tr>
																	<tr>
																		<td valign="middle" width="100%" style="text-align: center; font-size: 12px;font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-weight: normal; text-transform: uppercase; line-height: 18px;" mc:edit="2">
																			<!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]-->Your order has been Processed<!--[if !mso]><!--></span>
																			<!--<![endif]-->
																		</td>
																	</tr>
																	'.$complementary_food.'
																</tbody>
															</table>
														</td>
													</tr>
													<tr><td width="100%" height="30"></td></tr>
												</tbody>
											</table><!-- End Nav -->
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</td>
				</tr>
			</tbody>
		</table><!-- End 3 --><!-- Wrapper 6  -->
		<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile" bgcolor="#e6e4db" style="background-color: rgb(230, 228, 219);">
			<tbody>
				<tr mc:repeatable>
					<td bgcolor="#e6e4db" valign="top" align="center" style="background-color: rgb(230, 228, 219);">
						<div mc:hideable><!-- Mobile Wrapper -->
							<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
								<tbody>
									<tr>
										<td width="600" valign="top" align="center"><!-- Space -->
											<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
												<tbody><tr><td width="100%" height="35"></td></tr>
												</tbody>
											</table><!-- End Space --><!-- Text Left -->
											<table width="420" border="0" cellpadding="0" cellspacing="0" align="left" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
												<tbody>
													<tr>
														<td valign="top" width="100%" align="center"><!-- SORTABLE -->
															<div class="sortable_inner ui-sortable"><!-- Text -->
																<table width="420" border="0" cellpadding="0" cellspacing="0" align="center" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" object="drag-module-small">
																	<tbody>
																		<tr>
																			<td valign="top" width="100%" align="center"><!-- Text -->
																				<table width="420" border="0" cellpadding="0" cellspacing="0" align="center" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																					<tbody>
																						<tr>
																							<td valign="middle" width="100%" style="text-align: left; font-size: 18px; font-family: Helvetica, Arial, sans-serif; color: #222222; font-weight: bold; line-height: 24px;"
																							mc:edit="3">
																								<!--[if !mso]><!--><span style="font-family: "proxima_novasemibold", Helvetica; font-weight: normal;"><!--<![endif]-->Dear '.$order_details['billing']['billing_name'].',<!--[if !mso]><!--></span>
																								<!--<![endif]-->
																							</td>
																						</tr>
																						<tr><td width="100%" height="10"></td></tr>
																						<tr>
																							<td valign="middle" width="100%" style="text-align: left; font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: #222222; line-height: 24px; font-weight: normal;"  mc:edit="4">
																								<!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]-->
                                                                                                                                                                                                    Thank you for your order!<br>
                                                                                                                                                                                                    We will send you another email once the items in your order have been shipped. Meanwhile, you can check the status of your order on zamy.in
                                                                                                                                                                                                    <br><br>
                                                                                                                                                                                                 As a part of zamy initiative we will not be sending the invoice to you with the shipment. You will receive a soft copy of a invoice as a part of the delivery confirmation email of the delivery completion.
                                                                                                                                                                                         <!--[if !mso]><!--><!--<![endif]-->
                                                                                                                                                                                    </span> </td>
																						</tr>
																						<tr><td width="100%" height="35" class="h30"></td></tr>
																					</tbody>
																				</table><!-- End Text -->
																			</td>
																		</tr>
																	</tbody>
																</table>
															</div>
														</td>
													</tr>
												</tbody>
											</table><!-- Order Right -->
											<table width="150" border="0" cellpadding="0" cellspacing="0" align="right" class="buttonLeft" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
												<tbody>
													<tr>
														<td width="100%" valign="top" align="center"><!-- SORTABLE -->
															<div class="sortable_inner ui-sortable">
																<table width="150" border="0" cellpadding="0" cellspacing="0" align="center" class="buttonLeft" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" object="drag-module-small">
																	<tbody>
																		<tr>
																			<td width="100%" bgcolor="#ffffff" valign="top" align="center" style="border-radius: 3px; background-color: rgb(255, 255, 255);">
																				<table width="150" border="0" cellpadding="0" cellspacing="0" align="center">
																					<tbody>
																						<tr><td width="100%" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr>
																							<td valign="middle" width="100%" style="text-align: center; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #222222; font-weight: normal; line-height: 24px;" mc:edit="5">
																								<!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]-->Order number:<!--[if !mso]><!--></span>
																								<!--<![endif]-->
																							</td>
																						</tr>
																						<tr>
																							<td valign="middle" width="100%" style="text-align: center; font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: #222222; line-height: 24px; font-weight: bold;"  mc:edit="6">
																								<!--[if !mso]><!--><span style="font-family: proxima_nova_rgbold, Helvetica; font-weight: normal;"><!--<![endif]-->#'.$order_details['order_id'].'<!--[if !mso]><!--></span>
																								<!--<![endif]-->
																							</td>
																						</tr>
																						<tr><td width="100%" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																					</tbody>
																				</table>
																			</td>
																		</tr>
																		<tr><td width="100%" height="15"></td></tr>
																	</tbody>
																</table>
															</div>
														</td>
													</tr>
													<tr>
														<td width="100%" align="center"><!-- SORTABLE -->
															<div class="sortable_inner ui-sortable">
																<table width="150" border="0" cellpadding="0" cellspacing="0" align="center" class="buttonLeft" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" object="drag-module-small">
																	<tbody>
																		<tr>
																			<td width="100%" bgcolor="#71a42e" align="center" style="border-radius: 3px; background-color: rgb(113, 164, 46);">
																				<table width="150" border="0" cellpadding="0" cellspacing="0" align="center">
																					<tbody>
																						<tr><td width="100%" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr>
																							<td valign="top" width="100%" align="center" style="text-align: center; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: rgb(34, 34, 34); font-weight: bold; line-height: 18px; text-transform: uppercase;"  mc:edit="7">
																								<!--[if !mso]><!--><span style="font-family: "proxima_novasemibold", Helvetica; font-weight: normal;"><!--<![endif]--><a href="'.base_url('my_account').'" style="text-decoration: none; color: #ffffff;">account login</a><!--[if !mso]><!--></span>
																								<!--<![endif]-->
																							</td>
																						</tr>
																						<tr><td width="100%" height="10" style="font-size: 1px; line-height: 1px; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px;">&nbsp;</td></tr>
																					</tbody>
																				</table>
																			</td>
																		</tr>
																		<tr><td width="100%" height="15"></td></tr>
																	</tbody>
																</table>
															</div>
														</td>
													</tr>
													<tr>
														<td width="100%" align="center"><!-- SORTABLE -->
															<div class="sortable_inner ui-sortable">
																<table width="150" border="0" cellpadding="0" cellspacing="0" align="center" class="buttonLeft" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" object="drag-module-small">
																	<tbody><tr><td width="100%" height="15"></td></tr></tbody>
																</table>
															</div>
														</td>
													</tr>
												</tbody>
											</table><!-- End Order Right -->
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</td>
				</tr>
			</tbody>
		</table><!-- End Wrapper 6 --><!-- Wrapper 1 -->
		<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full" bgcolor="#e6e4db" style="background-color: rgb(230, 228, 219);">
			<tbody>
				<tr mc:repeatable>
					<td width="100%" valign="top" align="center">
						<div mc:hideable><!-- Wrapper -->
							<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile">
								<tbody>
									<tr>
										<td align="center"><!-- Space -->
											<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
												<tbody><tr><td width="100%" height="0" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr></tbody>
											</table><!-- End Space -->
										</td>
									</tr>
								</tbody>
							</table><!-- End Wrapper -->
						</div>
					</td>
				</tr>
			</tbody>
		</table><!-- Wrapper 1 --><!-- Wrapper 6  -->
		<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile" bgcolor="#e6e4db" style="background-color: rgb(230, 228, 219);">
			<tbody>
				<tr mc:repeatable>
					<td bgcolor="#e6e4db" align="center" style="background-color: rgb(230, 228, 219);">
						<div mc:hideable>
							<!-- Mobile Wrapper -->
							<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
								<tbody>
									<tr>
										<td width="600" align="center"><!-- Wrapper -->
											<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full" style="border-radius: 3px; background-color: rgb(255, 255, 255);">
												<tbody>
													<tr>
														<td width="600" align="center" style="border-radius: 3px; background-color: rgb(255, 255, 255);" bgcolor="#ffffff" class="mobile3">
															<!-- Wrapper -->
															<table width="586" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
																<tbody>
																	<tr>
																		<td width="586" align="center" valign="top" style="-webkit-border-bottom-right-radius: 3px; -moz-border-bottom-right-radius: 3px; border-bottom-right-radius: 3px; -webkit-border-bottom-left-radius: 3px; -moz-border-bottom-left-radius: 3px; border-bottom-left-radius: 3px;">
																			<div class="sortable_inner ui-sortable">
																				<!-- Wrapper -->
																				<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full" object="drag-module-small">
																					<tbody>
																						<tr>
																							<td width="100%" align="center" bgcolor="#71a42e" style="border-top-right-radius: 3px; border-top-left-radius: 3px; background-color: rgb(113, 164, 46);">
																								<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
																									<tbody>
																										<tr><td width="100%" height="13" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr><!-- Order Details -->
																										<tr>
																											<td align="center" valign="top" width="600" class="fullCenter">
																												<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="full">
																													<tbody>
																														<tr>
																															<td width="20" height="15"></td>
																															<td width="270" height="15" valign="top" class="fullCenter">
																																<table width="270" border="0" cellpadding="0" cellspacing="0" align="left" class="fullCenter">
																																	<tbody>
																																		<tr>
																																			<td valign="top" width="100%" style="text-align: left; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-weight: bold; line-height: 24px;" class="fullCenter" mc:edit="8">
																																				<!--[if !mso]><!--><span style="font-family: proxima_nova_rgbold, Helvetica; font-weight: normal;">
																																					<!--<![endif]-->ORDER
																																					DETAILS
																																					<!--[if !mso]><!-->
																																					</span>
																																				<!--<![endif]-->
																																			</td>
																																		</tr>
																																	</tbody>
																																</table>
																															</td>
																															<td width="80" height="15" class="erase">
																																<table width="80" border="0" cellpadding="0" cellspacing="0" align="left" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;"
																																class="full">
																																	<tbody>
																																		<tr>
																																			<td valign="top" width="100%" style="text-align: right; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-weight: bold; line-height: 24px;" mc:edit="9">
																																				<!--[if !mso]><!--><span style="font-family: proxima_nova_rgbold, Helvetica; font-weight: normal;"><!--<![endif]-->Price<!--[if !mso]><!--></span>
																																				<!--<![endif]-->
																																			</td>
																																		</tr>
																																	</tbody>
																																</table>
																															</td>
																															<td width="40" height="15" class="erase">&nbsp;&nbsp;</td>
																															<td width="80" height="15" class="erase">
																																<table width="80" border="0" cellpadding="0" cellspacing="0" align="left" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;"
																																class="full">
																																	<tbody>
																																		<tr>
																																			<td valign="top" width="100%" style="text-align: left; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-weight: bold; line-height: 24px;" mc:edit="9-2">
																																				<!--[if !mso]><!--><span style="font-family: proxima_nova_rgbold, Helvetica; font-weight: normal;"><!--<![endif]-->Quantity<!--[if !mso]><!--></span>
																																				<!--<![endif]-->
																																			</td>
																																		</tr>
																																	</tbody>
																																</table>
																															</td>
																															<td width="90" height="15" valign="middle" class="erase">
																																<table width="90" border="0" cellpadding="0" cellspacing="0" align="right" class="w70">
																																	<tbody>
																																		<tr>
																																			<td valign="top" width="100%" style="text-align: right; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-weight: bold; line-height: 24px;" mc:edit="10">
																																				<!--[if !mso]><!--><span style="font-family: proxima_nova_rgbold, Helvetica; font-weight: normal;"><!--<![endif]-->Subtotal<!--[if !mso]><!--></span>
																																				<!--<![endif]-->
																																			</td>
																																		</tr>
																																	</tbody>
																																</table>
																															</td>
																															<td width="20" height="15"></td>
																														</tr>
																													</tbody>
																												</table>
																											</td>
																										</tr>
																										<tr><td width="100%" height="13" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																									</tbody>
																								</table>
																							</td>
																						</tr>
																					</tbody>
																				</table>
																				<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full" object="drag-module-small">
																					<tbody><tr><td width="100%" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr></tbody>
																				</table><!-- End Wrapper 2 -->'.$prodduct_html.'<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full" style="-webkit-border-bottom-right-radius: 3px; -moz-border-bottom-right-radius: 3px; border-bottom-right-radius: 3px; -webkit-border-bottom-left-radius: 3px; -moz-border-bottom-left-radius: 3px; border-bottom-left-radius: 3px;"  object="drag-module-small">
																	                        <tbody><tr><td width="100%" height="30" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr></tbody>
																				</table><!-- End Wrapper 2 -->
																			</div>
																		</td>
																	</tr>
																</tbody>
															</table>
														</td>
													</tr>
												</tbody>
											</table>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</td>
				</tr>
			</tbody>
		</table><!-- End Wrapper 6 --><!-- Wrapper 1 -->
		<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full" bgcolor="#e6e4db" style="background-color: rgb(230, 228, 219);">
			<tbody>
				<tr mc:repeatable>
					<td width="100%" valign="top" align="center">
						<div mc:hideable><!-- Wrapper -->
							<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile">
								<tbody>
									<tr>
										<td align="center"><!-- Space -->
											<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
												<tbody><tr><td width="100%" height="30" align="center" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr></tbody>
											</table><!-- End Space -->
										</td>
									</tr>
								</tbody>
							</table><!-- End Wrapper -->
						</div>
					</td>
				</tr>
			</tbody>
		</table><!-- Wrapper 1 --><!-- Wrapper 6  -->
		<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile" bgcolor="#e6e4db" style="background-color: rgb(230, 228, 219);">
			<tbody>
				<tr mc:repeatable>
					<td bgcolor="#e6e4db" align="center" style="background-color: rgb(230, 228, 219);">
						<div mc:hideable><!-- Mobile Wrapper -->
							<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
								<tbody>
									<tr>
										<td width="600" align="center"><!-- Order Right -->
											<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
												<tbody>
													<tr>
														<td width="100%" bgcolor="#71a42e" align="center" style="border-top-right-radius: 3px; border-top-left-radius: 3px; background-color: rgb(113, 164, 46);" class="pad20"><!-- Space -->
															<table width="30" border="0" cellpadding="0" cellspacing="0" align="left" class="erase" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																<tbody><tr><td width="100%" height="1"></td></tr></tbody>
															</table><!-- End Space -->
															<table width="400" border="0" cellpadding="0" cellspacing="0" align="left" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																<tbody>
																	<tr>
																		<td width="100%" valign="top" align="center">
																			<div class="sortable_inner ui-sortable">
																				<table width="400" border="0" cellpadding="0" cellspacing="0" align="center" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" object="drag-module-small">
																					<tbody>
																						<tr><td width="100%" height="15" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr>
																							<td valign="middle" width="100%" style="text-align: left; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-weight: bold; line-height: 24px; text-transform: uppercase;" mc:edit="29">
																								<!--[if !mso]><!--><span style="font-family: proxima_nova_rgbold, Helvetica; font-weight: normal;"><!--<![endif]-->payment:<!--[if !mso]><!--></span>
																								<!--<![endif]-->
																							</td>
																						</tr>
																					</tbody>
																				</table>
																			</div>
																		</td>
																	</tr>
																	<tr><td width="100%" height="15" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																</tbody>
															</table>
														</td>
													</tr>
												</tbody>
											</table><!-- End Order Right --><!-- Order Right -->
											<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
												<tbody>
													<tr>
														<td width="100%" bgcolor="#ffffff" style="border-bottom-right-radius: 3px; border-bottom-left-radius: 3px; background-color: rgb(255, 255, 255);" class="pad20">
															<!-- Space -->
															<table width="30" border="0" cellpadding="0" cellspacing="0" align="left" class="erase" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																<tbody><tr><td width="100%" height="1"></td></tr></tbody>
															</table><!-- End Space -->
															<table width="250" border="0" cellpadding="0" cellspacing="0" align="left" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																<tbody>
																	<tr><td width="100%" height="15" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																	<tr>
																		<td width="100%" valign="top" align="center">
																			<div class="sortable_inner ui-sortable">
																				<table width="250" border="0" cellpadding="0" cellspacing="0" align="center" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" object="drag-module-small">
																					<tbody>
																						<tr><td width="100%" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr><td width="100%" height="5" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr>
																							<td valign="middle" width="100%" style="text-align: left; font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: #222222; line-height: 24px; font-weight: normal;" mc:edit="30">
																								<!--[if !mso]><!-->
																								'.$payment_details.'
																								<!--<![endif]-->
																							</td>
																						</tr>
																						<tr><td width="100%" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																					</tbody>
																				</table>
																			</div>
																		</td>
																	</tr>
																	<tr><td width="100%" height="20" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																</tbody>
															</table><!-- Space -->
															<table width="30" border="0" cellpadding="0" cellspacing="0" align="right" class="erase" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																<tbody><tr><td width="100%" height="10"></td></tr></tbody>
															</table><!-- End Space -->
															<table width="250" border="0" cellpadding="0" cellspacing="0" align="right" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																<tbody>
																	<tr><td width="100%" height="25" style="font-size: 1px; line-height: 1px;" class="erase">&nbsp;</td></tr>
																	<tr>
																		<td width="100%" valign="top" align="center">
																			<div class="sortable_inner ui-sortable">
																				<table width="250" border="0" cellpadding="0" cellspacing="0" align="center" class="full" style="border-collapse: collapse; position: relative; z-index: 0;"
																				object="drag-module-small" cu-identifier="element_05166087824665626">
																					<tbody>
																						<tr><td width="100%" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr>
																							<td width="250" valign="top" align="center">
																								<table width="250" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
																									<tbody>
																										<tr>
																											<td width="150" style="text-align: left; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #222222; font-weight: normal; line-height: 24px;" mc:edit="31">
																												<!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]--><p  cu-identify="element_08357365587062129">Subtotal<!--[if !mso]><!--></span>
																												<!--<![endif]-->
																											</td>
																											<td width="100" style="text-align: right; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #222222; font-weight: normal; line-height: 24px;" mc:edit="2-928">
																												<!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]--><p  cu-identify="element_09906574810450846">Rs. '.$order_details['sub_total'].'<!--[if !mso]><!--></span>
																												<!--<![endif]-->
																											</td>
																										</tr>
																									</tbody>
																								</table>
																							</td>
																						</tr>
																						<tr><td width="100%" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr><td width="100%" height="1" bgcolor="#dfdfdf" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr><td width="100%" height="8" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr>
																							<td width="250" valign="top" align="center">
																								<table width="250" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
																									<tbody>
																										<tr>
																											<td width="150" style="text-align: left; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #222222; font-weight: normal; line-height: 24px;" mc:edit="32">
																												<!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]--><p  cu-identify="element_07070737449479834">Shipping Charges<!--[if !mso]><!--></span>
																												<!--<![endif]-->
																											</td>
																											<td width="100" style="text-align: right; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #222222; font-weight: normal; line-height: 24px;" mc:edit="2-22">
																												<!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]--><p  cu-identify="element_09499041805787367">Rs.'.$order_details['delivery_charge'].'<!--[if !mso]><!--></span>
																												<!--<![endif]-->
																											</td>
																										</tr>
																									</tbody>
																								</table>
																							</td>
																						</tr>
																						<tr><td width="100%" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr>
																							<td width="250" valign="top" align="center">
																								<table width="250" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
																									<tbody>
																										<tr>
																											<td width="150" style="text-align: left; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #222222; font-weight: normal; line-height: 24px;" mc:edit="33">
																												<!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]-->Discount<!--[if !mso]><!--></span>
																												<!--<![endif]-->
																											</td>
																											<td width="100" style="text-align: right; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #222222; font-weight: normal; line-height: 24px;" mc:edit="2-23">
																												<!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]--><p  cu-identify="element_07813623902119076"> Rs.'.$order_details['discount_amount'].'<!--[if !mso]><!--></span>
																												<!--<![endif]-->
																											</td>
																										</tr>
																									</tbody>
																								</table>
																							</td>
																						</tr>
																						<tr><td width="100%" height="8" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr><td width="100%" height="1" bgcolor="#dfdfdf" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr><td width="100%" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr>
																							<td width="250" valign="top" align="center">
																								<table width="250" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
																									<tbody>
																										<tr>
																											<td width="150" style="text-align: left; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #222222; font-weight: bold; line-height: 24px;"  mc:edit="34">
																												<!--[if !mso]><!--><span style="font-family: proxima_nova_rgbold, Helvetica; font-weight: normal;"><!--<![endif]-->Total<!--[if !mso]><!--></span>
																												<!--<![endif]-->
																											</td>
																											<td width="100" style="text-align: right; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #222222; font-weight: bold; line-height: 24px;"  mc:edit="2-24">
																												<!--[if !mso]><!--><span style="font-family: proxima_nova_rgbold, Helvetica; font-weight: normal;"><!--<![endif]--><p  cu-identify="element_05173461792879972">Rs. '.$order_total.'<!--[if !mso]><!--></span>
																												<!--<![endif]-->
																											</td>
																										</tr>
																									</tbody>
																								</table>
																							</td>
																						</tr>
																						<tr><td width="100%" height="20" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																					</tbody>
																				</table>
																			</div>
																		</td>
																	</tr>
																	<tr><td width="100%" height="20" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																</tbody>
															</table>
														</td>
													</tr>
												</tbody>
											</table><!-- End Order Right -->
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</td>
				</tr>
			</tbody>
		</table><!-- End Wrapper 6 --><!-- Wrapper 1 -->
		<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full" bgcolor="#e6e4db" style="background-color: rgb(230, 228, 219);">
			<tbody>
				<tr mc:repeatable>
					<td width="100%" valign="top" align="center">
						<div mc:hideable><!-- Wrapper -->
							<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile">
								<tbody>
									<tr>
										<td align="center"><!-- Space -->
											<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
												<tbody><tr><td width="100%" height="30" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr></tbody>
											</table><!-- End Space -->
										</td>
									</tr>
								</tbody>
							</table><!-- End Wrapper -->
						</div>
					</td>
				</tr>
			</tbody>
		</table><!-- Wrapper 1 --><!-- Wrapper 6  -->
		<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile" bgcolor="#e6e4db" style="background-color: rgb(230, 228, 219);">
			<tbody>
				<tr mc:repeatable>
					<td bgcolor="#e6e4db" align="center" style="background-color: rgb(230, 228, 219);">
						<div mc:hideable><!-- Mobile Wrapper -->
							<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
								<tbody>
									<tr>
										<td width="600" valign="top" align="center"><!-- Delivery address -->
											<table width="290" border="0" cellpadding="0" cellspacing="0" align="left" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
												<tbody>
													<tr>
														<td width="100%" class="full" align="center">
															<div class="sortable_inner ui-sortable">
																<table width="290" border="0" cellpadding="0" cellspacing="0" align="center" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" object="drag-module-small">
																	<tbody>
																		<tr>
																			<td width="100%" valign="top" align="center" bgcolor="#71a42e" style="border-top-right-radius: 3px; border-top-left-radius: 3px; background-color: rgb(113, 164, 46);" class="pad20"><!-- Space -->
																				<table width="30" border="0" cellpadding="0" cellspacing="0" align="left" class="erase" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																					<tbody><tr><td width="100%" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr></tbody>
																				</table><!-- End Space -->
																				<table width="220" border="0" cellpadding="0" cellspacing="0" align="left" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																					<tbody>
																						<tr><td width="100%" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr>
                                                                                                                                                                                    <td valign="middle" width="100%" style="text-align: left; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-weight: bold; line-height: 24px; text-transform: uppercase;" mc:edit="35">
                                                                                                                                                                                            <!--[if !mso]><!--><span style="font-family:proxima_nova_rgbold, Helvetica; font-weight: normal;"><!--<![endif]-->Delivery address<!--[if !mso]><!--></span> <!--<![endif]-->
                                                                                                                                                                                    </td>
																						</tr>
																						<tr><td width="100%" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																					</tbody>
																				</table><!-- Space -->
																				<table width="30" border="0" cellpadding="0" cellspacing="0" align="right" class="erase" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																					<tbody><tr><td width="100%" height="1" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr></tbody>
																				</table><!-- End Space -->
																			</td>
																		</tr>
																	</tbody>
																</table>
																<table width="290" border="0" cellpadding="0" cellspacing="0" align="center" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" object="drag-module-small">
																	<tbody>
																		<tr>
																			<td width="100%" valign="top" align="center" bgcolor="#ffffff" style="border-bottom-right-radius: 3px; border-bottom-left-radius: 3px; background-color: rgb(255, 255, 255);" class="pad20"><!-- Space -->
																				<table width="30" border="0" cellpadding="0" cellspacing="0" align="left" class="erase" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																				   <tbody><tr><td width="100%" height="1"></td></tr></tbody>
																				</table><!-- End Space -->
																				<table width="220" border="0" cellpadding="0" cellspacing="0" align="left" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																					<tbody>
																						<tr><td width="100%" height="25" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr>
                                                                                                                                                                                    <td valign="middle" width="100%" style="text-align: left; font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: #222222; line-height: 24px; font-weight: normal;" mc:edit="36"> 
                                                                                                                                                                                    '.$shipping_address.'
                                                                                                                                                                                    </td>
																						</tr>
																						<tr><td width="100%" height="25" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																					</tbody>
																				</table><!-- Space -->
																				<table width="30" border="0" cellpadding="0" cellspacing="0" align="right" class="erase" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																					<tbody><tr><td width="100%" height="1"></td></tr></tbody>
																				</table><!-- End Space -->
																			</td>
																		</tr>
																	</tbody>
																</table>
															</div>
														</td>
													</tr>
												</tbody>
											</table><!-- End Delivery address --><!-- Space -->
											<table width="1" border="0" cellpadding="0" cellspacing="0" align="left" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
												<tbody><tr><td width="100%" height="20"></td></tr></tbody>
											</table><!-- End Space --><!-- Invoice address -->
											<table width="290" border="0" cellpadding="0" cellspacing="0" align="right" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
												<tbody>
													<tr>
														<td width="100%" class="full" align="center">
															<div class="sortable_inner ui-sortable">
																<table width="290" border="0" cellpadding="0" cellspacing="0" align="center" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" object="drag-module-small">
																	<tbody>
																		<tr>
																			<td width="100%" valign="top" align="center" bgcolor="#71a42e" style="border-top-right-radius: 3px; border-top-left-radius: 3px; background-color: rgb(113, 164, 46);" class="pad20"><!-- Space -->
																				<table width="30" border="0" cellpadding="0" cellspacing="0" align="left" class="erase" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																					<tbody><tr><td width="100%" height="1"></td></tr></tbody>
																				</table><!-- End Space -->
																				<table width="220" border="0" cellpadding="0" cellspacing="0" align="left" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																					<tbody>
																						<tr><td width="100%" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr>
																							<td valign="middle" width="100%" style="text-align: left; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-weight: bold; line-height: 24px; text-transform: uppercase;" mc:edit="37">
																								<!--[if !mso]><!--><span style="font-family: proxima_nova_rgbold, Helvetica; font-weight: normal;"><!--<![endif]-->Invoice address<!--[if !mso]><!--></span>
                                                                                                                                                                                        </td>
                                                                                                                                                                                </tr>
																						<tr><td width="100%" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																					</tbody>
																				</table><!-- Space -->
																				<table width="30" border="0" cellpadding="0" cellspacing="0" align="right" class="erase" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																					<tbody><tr><td width="100%" height="1"></td></tr></tbody>
																				</table><!-- End Space -->
																			</td>
																		</tr>
																	</tbody>
																</table>
																<table width="290" border="0" cellpadding="0" cellspacing="0" align="center" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" object="drag-module-small">
																	<tbody>
																		<tr>
																			<td width="100%" valign="top" align="center" bgcolor="#ffffff" style="border-bottom-right-radius: 3px; border-bottom-left-radius: 3px; background-color: rgb(255, 255, 255);"  class="pad20"><!-- Space -->
																				<table width="30" border="0" cellpadding="0" cellspacing="0" align="left" class="erase" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																					<tbody><tr><td width="100%" height="1"></td></tr></tbody>
																				</table><!-- End Space -->
																				<table width="220" border="0" cellpadding="0" cellspacing="0" align="left" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																					<tbody>
																						<tr><td width="100%" height="25" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr>
																							<td valign="middle" width="100%" style="text-align: left; font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: #222222; line-height: 24px; font-weight: normal;" mc:edit="38"> 
                                                                                                                                                                                           '.$billing_address.'
                                                                                                                                                                                          </td>
                                                                                                                                                                                        </tr>
                                                                                                                                                                                        <tr><td width="100%" height="25" style="font-size: 1px; line-height: 1px;">&nbsp;</td> </tr>
                                                                                                                                                                                </tbody>
                                                                                                                                                                        </table><!-- Space -->
                                                                                                                                                                        <table width="30" border="0" cellpadding="0" cellspacing="0" align="right" class="erase" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
                                                                                                                                                                                <tbody><tr><td width="100%" height="15"></td></tr></tbody>
                                                                                                                                                                        </table><!-- End Space -->
                                                                                                                                                                </td>
                                                                                                                                                        </tr>
                                                                                                                                                </tbody>
                                                                                                                                        </table>
															</div>
														</td>
													</tr>
												</tbody>
											</table><!-- End Invoice address --><!-- Space -->
											<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
												<tbody><tr><td width="100%" height="15"></td></tr></tbody>
											</table><!-- End Space -->
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</td>
				</tr>
			</tbody>
		</table> <!-- End Wrapper 6 --><!-- Wrapper 6  -->
		<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile" bgcolor="#e6e4db" style="background-color: rgb(230, 228, 219);">
			<tbody>
				<tr mc:repeatable>
					<td bgcolor="#e6e4db" align="center" style="background-color: rgb(230, 228, 219);">
						<div mc:hideable> <!-- Mobile Wrapper -->
							<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
								<tbody>
									<tr>
										<td width="600" align="center"><!-- Space -->
											<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
												<tbody><tr><td width="100%" height="15"></td></tr></tbody>
											</table><!-- End Space --><!-- Space -->
											<table width="5" border="0" cellpadding="0" cellspacing="0" align="left" class="erase" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
											     <tbody><tr><td width="100%" height="15"></td></tr></tbody>
											</table><!-- End Space --><!-- Text -->
											<table width="580" border="0" cellpadding="0" cellspacing="0" align="left" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
												<tbody>
													<tr>
														<td valign="middle" width="100%" style="text-align: left; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #222222; font-weight: bold; line-height: 24px;" mc:edit="39">
															<!--[if !mso]><!--><span style="font-family: "proxima_novasemibold", Helvetica; font-weight: normal;"><!--<![endif]-->Cancel your order or Questions?<!--[if !mso]><!--></span>
															<!--<![endif]-->
														</td>
													</tr>
													<tr><td width="100%" height="15"></td></tr>
													<tr>
														<td valign="middle" width="100%" style="text-align: left; font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: #222222; line-height: 24px; font-weight: normal;" mc:edit="40">
														  <!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]-->
                                                                                                                            Enjoy your shopping! Visit the <b>My Orders</b> Page in case you wish to return any items. 
                                                                                                                      <br />Please reply to this email or get in touch with our 24x7 <b>Customer Care</b> team.
                                                                                                                    <!--[if !mso]><!--><!--<![endif]-->
                                                                                                                    </span> </td>
													</tr>
												</tbody>
											</table><!-- End Text --><!-- Space -->
                                                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
                                                                                            <tbody><tr><td width="100%" height="15"></td></tr></tbody>
                                                                                    </table><!-- End Space -->
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</td>
				</tr>
			</tbody>
		</table><!-- End Wrapper 6 --><!-- Wrapper 3  -->
		<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full" bgcolor="#e6e4db" style="background-color: rgb(230, 228, 219);">
			<tbody>
				<tr mc:repeatable>
					<td bgcolor="#e6e4db" align="center" style="background-color: rgb(230, 228, 219);">
						<div mc:hideable><!-- Mobile Wrapper -->
							<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile">
								<tbody>
									<tr>
										<td width="600" align="center"><!-- Start Nav -->
											<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full" bgcolor="#2d2d2d" style="border-radius: 3px; background-color: rgb(45, 45, 45);">
												<tbody>
													<tr><td width="100%" height="15"></td></tr>
													<tr>
														<td width="100%" valign="top" class="pad20" align="center"><!-- Copyright Text -->
															<table width="540" border="0" cellpadding="0" cellspacing="0" align="center" style="text-align: center; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="fullCenter">
																<tbody>
																	<tr>
                                                                                                                                            <td valign="top" width="540" align="center" style="text-align: center; font-family: Helvetica, Arial, sans-serif; font-size: 13px; color: #ffffff; line-height: 18px; font-weight: normal;" class="fullCenter" mc:edit="41">
                                                                                                                                                    <!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]--><span  cu-identify="element_0018516645610561433">@ 2019 Zamy. All rights Reserved</span>
                                                                                                                                                    <!--[if !mso]><!--></span><!--<![endif]-->
                                                                                                                                            </td>
																	</tr>
																</tbody>
															</table>
														</td>
													</tr>
													<tr><td width="100%" height="15"></td></tr>
												</tbody>
											</table>
											<!-- End Nav -->
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</td>
				</tr>
			</tbody>
		</table><!-- End 3 -->

<!-- Wrapper 1 -->
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full"  bgcolor="#e6e4db"style="background-color: rgb(230, 228, 219);">
	<tbody><tr mc:repeatable>
		<td width="100%" valign="top" align="center">
		<div mc:hideable><!-- Wrapper -->
			<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile">
				<tbody><tr>
					<td align="center"><!-- Space -->
						<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
							<tbody><tr>
								<td width="100%" height="50"></td>
							</tr>
							<tr>
								<td width="100%" height="1" style="font-size: 1px; line-height: 1px;">&nbsp;</td>
							</tr>
						</tbody></table><!-- End Space -->
					</td>
				</tr>
			</tbody></table><!-- End Wrapper -->
		</div>
		</td>
	</tr>
</tbody></table><!-- Wrapper 1 -->		
	</div>
</body>
</html>
<style>body {background: none !important;}</style>';

	$to = $order_details['billing']['billing_email'];
	//$to = $order_details['shipping']['shipping_email'];
	
	$restaurant_subject = 'Order Confirmation - Your Order with zamy.in [#'.$order_details['order_id'].'] has been successfully placed!';
	
	$headers = "From: zamy.in<zamyindia@gmail.com>\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n"; 
	
	$mail = mail($to, $restaurant_subject, $message, $headers);
	
	return $mail;
}

function order_confirmation_admin($order_id,$user_id){
	
	$CI = get_instance();
	$CI->load->model('order_model');

	$order_details = $CI->order_model->order_details($order_id,$user_id);
	
	$prodduct_html='';
	
	foreach($order_details['order_items'] as $item){
		$prodduct_html .='
		<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full" object="drag-module-small">
            <tbody>
				<tr><td width="100%" align="center" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
				<tr>
					<td valign="top" align="center" width="100%" style="font-family: Helvetica, Arial, sans-serif; color: #30373a; font-weight: bold; font-size: 15px; line-height: 24px; text-align: center;" class="fullCenter">
						<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="full">
						 <tbody>
							 <tr>
								<td width="20" height="50">&nbsp;&nbsp;&nbsp;&nbsp;</td>
								<td width="50" height="50" valign="middle" style="text-align: left;" class="erase" id="image49">
										<a href="#"><img width="49" src="'.$item['menu_logo'].'" alt="" border="0" style="vertical-align: middle; padding-top: 1px;" mc:edit="17"> </a>
								</td>
								<td width="15" height="50" class="erase"></td>
								<td width="205" height="50" valign="top" class="full">
										<table width="205" border="0" cellpadding="0" cellspacing="0" align="left">
												<tbody>
												<tr><td width="100%" height="2" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
												<tr>
														<td width="100%" style="font-family: Helvetica, Arial, sans-serif; color: #222222; font-weight: bold; font-size: 15px; line-height: 18px; text-align: left;" class="w70" mc:edit="18">
																<!--[if !mso]><!--><span style="font-family: proxima_nova_rgbold, Helvetica; font-weight: normal;"><!--<![endif]--><p  cu-identify="element_0638462864365142">
																<div>'.$item['menu_name'].'</div>
																<!--[if !mso]><!-->
																</span>
																<!--<![endif]-->
														</td>
												</tr>
												<tr><td width="100%" height="5" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
												<tr>
														<td width="100%" style="font-family: Helvetica, Arial, sans-serif; color: #222222; font-weight: normal; font-size: 13px; line-height: 18px; text-align: left;" class="w70" mc:edit="19">
																<!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]-->Delivery: <span style="color: #71a42e;"></span>
																<!--[if !mso]><!-->
																</span>
																<!--<![endif]-->
														</td>
												</tr>
										</tbody>
										</table>
								</td>
								<td width="80" valign="top" height="50" class="erase">
										<table width="80" border="0" cellpadding="0" cellspacing="0" align="right" class="w70">
												<tbody>
														<tr><td width="100%" height="2" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
														<tr>
																<td width="100%" style="font-family: Helvetica, Arial, sans-serif; color: #222222; font-weight: normal; font-size: 14px; line-height: 20px; text-align: right;" class="w70" mc:edit="20">
																		<!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]--><p  cu-identify="element_009125256622760869">Rs. '.$item['price'].'<!--[if !mso]><!--></span>
																		<!--<![endif]-->
																</td>
														</tr>
												</tbody>
										</table>
								</td>
								<td width="40" height="50">&nbsp;&nbsp;</td>
								<td width="80" height="50" valign="top" class="w50">
										<table width="80" border="0" cellpadding="0" cellspacing="0" align="left" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;"
										class="w50">
												<tbody>
														<tr><td width="100%" height="2" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
														<tr>
																<td width="100%" style="font-family: Helvetica, Arial, sans-serif; color: #222222; font-weight: normal; font-size: 14px; line-height: 20px; text-align: left;" class="w50" mc:edit="21">
																		<!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]-->'.$item['qty'].'x<!--[if !mso]><!--></span>
																		<!--<![endif]-->
																</td>
														</tr>
												</tbody>
										</table>
								</td>
								<td width="90" valign="top" height="50" class="erase">
										<table width="90" border="0" cellpadding="0" cellspacing="0" align="right">
												<tbody>
														<tr>
																<td width="100%" style="font-family: Helvetica, Arial, sans-serif; color: #222222; font-weight: normal; font-size: 14px; line-height: 20px; text-align: right;" class="w70" mc:edit="22">
																		<!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]--><p  cu-identify="element_020128349030194048">Rs. '.$item['subtotal'].'<!--[if !mso]><!--></span>
																		<!--<![endif]-->
																</td>
														</tr>
												</tbody>
										</table>
								</td>
								<td width="20" height="50" class="erase"></td>
						 </tr>
					</tbody>
					</table>
				</td>
			</tr>
				<tr><td width="100%" height="1" bgcolor="#f4f4f4" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
				<tr><td width="100%" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
			</tbody>
		</table>';

	}
	
	$delivery_charge = 0;
	if(!empty($order_details['delivery_charge'])){
		$delivery_charge = $order_details['delivery_charge'];
	}
	
	//$order_total = $order_details['order_total'] + $delivery_charge;
	$order_total = $order_details['order_total'];
	
	
	$payment_details = '';
	if(strtolower($order_details['payment_method'])=='cod'){
		$payment_details .= '<span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]--><p  cu-identify="element_02865282806828009">Payment method: <span style="font-family: proxima_nova_rgbold, Helvetica;">'.$order_details['payment_method'].'</span>
				<br>You order has been Pending Payment.
				<!--[if !mso]><!-->
				</span>';
	}else{
	
		$payment_details .= '<span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]--><p  cu-identify="element_02865282806828009">Payment method: <span style="font-family: proxima_nova_rgbold, Helvetica;">'.$order_details['payment_method'].'</span>
				<!--[if !mso]><!-->
				</span>';
	}
	
	
	$billing_address ='<span style="font-weight: bold;">
                    <!--[if !mso]><!-->
                    <span style="font-family: proxima_nova_rgbold, Helvetica; font-weight: normal;">
                    <!--<![endif]-->'.$order_details['billing']['billing_name'].'<!--[if !mso]><!--></span>
                    <!--<![endif]--></span><br>
                    <!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]-->
                      '.$order_details['billing']['billing_address'].'<!--[if !mso]><!--></span><!--<![endif]-->';
	
	$shipping_address ='<span style="font-weight: bold;">
                    <!--[if !mso]><!-->
                    <span style="font-family: proxima_nova_rgbold, Helvetica; font-weight: normal;">
                    <!--<![endif]-->'.$order_details['shipping']['shipping_name'].'<!--[if !mso]><!--></span>
                    <!--<![endif]--></span><br>
                    <!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]-->
                      '.$order_details['shipping']['shipping_address'].'<!--[if !mso]><!--></span><!--<![endif]-->';
	
	$complementary_food = '';			  
	if(!empty($order_details['complementary_food'])){
		$complementary_food = '<tr>
			<td valign="middle" width="100%" style="text-align: center; font-size: 12px;font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-weight: normal; text-transform: uppercase; line-height: 18px;" mc:edit="2">
				<span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;">'.$order_details['complementary_food'].'</span>
			</td>
		</tr>';
	}
	
	$customer_subject = 'Order Confirmation - Your Order with zamy.in [#'.$order_details['order_id'].'] has been successfully placed!';
	
	$admin_subject = '[Zamy] New customer order ('.$order_details['order_id'].') - '.$order_details['order_date'].'';
	
	$headers = "From: zamy.in<zamyindia@gmail.com>\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n"; 
	
	$message = '';
	$message .= '<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
<title>Order Confirmation - Your Order with zamy.in [#'.$order_details['order_id'].'] has been successfully placed!</title>
<style type="text/css">
div,p,a,li,td {-webkit-text-size-adjust: none;}
* {-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;}
.ReadMsgBody {width: 100%; background-color: #ffffff;}
.ExternalClass {width: 100%;background-color: #ffffff;}
body {width: 100%; height: 100%;margin: 0; padding: 0;-webkit-font-smoothing: antialiased;}
html {background-color: #e6e4db; width: 100%; }
@font-face {font-family: "proxima_novalight"; src: url("http://rocketway.net/themebuilder/products/font/proximanova-light-webfont.eot"); src: url("http://rocketway.net/themebuilder/products/font/proximanova-light-webfont.eot?#iefix") format("embedded-opentype"), url("http://rocketway.net/themebuilder/products/font/proximanova-light-webfont.woff") format("woff"), url("http://rocketway.net/themebuilder/products/font/proximanova-light-webfont.ttf") format("truetype"); font-weight: normal; font-style: normal; }
@font-face {font-family: proxima_nova_rgregular; src: url("http://rocketway.net/themebuilder/products/font/proximanova-regular-webfont.eot"); src: url("http://rocketway.net/themebuilder/products/font/proximanova-regular-webfont.eot?#iefix") format("embedded-opentype"), url("http://rocketway.net/themebuilder/products/font/proximanova-regular-webfont.woff") format("woff"), url("http://rocketway.net/themebuilder/products/font/proximanova-regular-webfont.ttf") format("truetype"); font-weight: normal; font-style: normal; }
@font-face {font-family: "proxima_novasemibold"; src: url("http://rocketway.net/themebuilder/products/font/proximanova-semibold-webfont.eot"); src: url("http://rocketway.net/themebuilder/products/font/proximanova-semibold-webfont.eot?#iefix") format("embedded-opentype"), url("http://rocketway.net/themebuilder/products/font/proximanova-semibold-webfont.woff") format("woff"), url("http://rocketway.net/themebuilder/products/font/proximanova-semibold-webfont.ttf") format("truetype"); font-weight: normal; font-style: normal;}
@font-face {font-family: proxima_nova_rgbold;src: url("http://rocketway.net/themebuilder/products/font/proximanova-bold-webfont.eot");src: url("http://rocketway.net/themebuilder/products/font/proximanova-bold-webfont.eot?#iefix") format("embedded-opentype"), url("http://rocketway.net/themebuilder/products/font/proximanova-bold-webfont.woff") format("woff"), url("http://rocketway.net/themebuilder/products/font/proximanova-bold-webfont.ttf") format("truetype"); font-weight: normal; font-style: normal;}
@font-face {font-family: "proxima_novathin"; src: url("http://rocketway.net/themebuilder/products/font/proximanova-thin-webfont.eot"); src: url("http://rocketway.net/themebuilder/products/font/proximanova-thin-webfont.eot?#iefix") format("embedded-opentype"), url("http://rocketway.net/themebuilder/products/font/proximanova-thin-webfont.woff") format("woff"), url("http://rocketway.net/themebuilder/products/font/proximanova-thin-webfont.ttf") format("truetype"); font-weight: normal;font-style: normal;}
@font-face {font-family: "proxima_novablack";src: url("http://rocketway.net/themebuilder/products/font/proximanova-black-webfont.eot"); src: url("http://rocketway.net/themebuilder/products/font/proximanova-black-webfont.eot?#iefix") format("embedded-opentype"), url("http://rocketway.net/themebuilder/products/font/proximanova-black-webfont.woff") format("woff"), url("http://rocketway.net/themebuilder/products/font/proximanova-black-webfont.ttf") format("truetype");font-weight: normal;font-style: normal;}
@font-face {font-family: "proxima_novaextrabold"; src: url("http://rocketway.net/themebuilder/products/font/proximanova-extrabold-webfont.eot"); src: url("http://rocketway.net/themebuilder/products/font/proximanova-extrabold-webfont.eot?#iefix") format("embedded-opentype"), url("http://rocketway.net/themebuilder/products/font/proximanova-extrabold-webfont.woff2") format("woff2"), url("http://rocketway.net/themebuilder/products/font/proximanova-extrabold-webfont.woff") format("woff"), url("http://rocketway.net/themebuilder/products/font/proximanova-extrabold-webfont.ttf") format("truetype"); font-weight: normal; font-style: normal;}
p {padding: 0!important;margin-top: 0!important;margin-right: 0!important;margin-bottom: 0!important;margin-left: 0!important;}
.hover:hover {opacity: 0.85;filter: alpha(opacity=85);}
.underline:hover {text-decoration: underline!important;}
.jump:hover {opacity: 0.75;filter: alpha(opacity=75); padding-top: 10px!important;}
#image49 img {width: 49px;height: auto;}
</style>
<!-- @media only screen and (max-width: 640px) 
           {*/
           -->
<style type="text/css">
@media only screen and (max-width: 640px) {
        body { width: auto!important; }
        table[class=full] {width: 100%!important; clear: both;}
        table[class=mobile] {width: 100%!important;padding-left: 20px; padding-right: 20px;clear: both; }
        table[class=fullCenter] {width: 100%!important; text-align: center!important; clear: both; }
        td[class=image600] img {width: 100%!important;text-align: center!important; clear: both; }
        td[class=fullCenter] {width: 100%!important; text-align: center!important; clear: both;}
        td[class=full] { width: 100%!important; clear: both;  }
        *[class=erase] { display: none; }
        *[class=buttonScale] { float: none!important; text-align: center!important; display: inline-block!important; clear: both; }
        *[class=buttonLeft] {float: left!important; text-align: left!important; display: inline-block!important;  clear: both; }
        .pad20 { padding-left: 20px!important; padding-right: 20px!important; }
        .w50 {width: 50px!important;}
        .h30 { height: 30px!important; }
}
</style>
<!--
@media only screen and (max-width: 479px) 
           {
           -->
<style type="text/css">
@media only screen and (max-width: 479px) {
        body {width: auto!important;}
        table[class=full] {width: 100%!important; clear: both; }
        table[class=mobile] {width: 100%!important; padding-left: 20px; padding-right: 20px; clear: both;}
        table[class=fullCenter] {width: 100%!important;text-align: center!important; clear: both; }
        td[class=fullCenter] { width: 100%!important; text-align: center!important; clear: both;}
        td[class=full] {width: 100%!important;clear: both; }
        *[class=erase] {display: none; }
        *[class=buttonScale] {float: none!important; text-align: center!important;display: inline-block!important;clear: both; }
        *[class=buttonLeft] { float: left!important; text-align: left!important; display: inline-block!important;clear: both;}
        .pad20 { padding-left: 20px!important; padding-right: 20px!important; }
        .w70 { width: 70px!important; }
        .w50 { width: 50px!important;}
        .h30 { height: 30px!important;  }
}
}
</style>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" yahoo="fix">
	<div class="ui-sortable" id="sort_them"><!-- Wrapper 2 -->
		<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full" bgcolor="#e6e4db" style="background-color: rgb(230, 228, 219);">
			<tbody>
                            <tr mc:repeatable>
                                    <td width="100%" valign="top" align="center">
                                            <div mc:hideable><!-- Wrapper -->
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile">
                                                        <tbody><tr><td align="center"> <!-- Space -->
                                                            <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
                                                                    <tbody><tr> <td width="100%" height="50"></td> </tr></tbody>
                                                            </table> <!-- End Space --> </td>  </tr>
                                                        </tbody>
                                                    </table><!-- End Wrapper -->
                                            </div>
                                    </td>
                            </tr>
			</tbody>
		</table><!-- Wrapper 2 --><!-- Wrapper 3  -->
		<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full" bgcolor="#e6e4db" style="background-color: rgb(230, 228, 219);">
			<tbody>
				<tr mc:repeatable>
					<td bgcolor="#e6e4db" align="center" style="background-color: rgb(230, 228, 219);">
						<div mc:hideable><!-- Mobile Wrapper -->
							<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile">
								<tbody>
									<tr>
										<td width="600" align="center"><!-- Start Nav -->
											<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full" style="background-image: url(http://rocketway.net/themebuilder/products/batch1/templates/template_1/images/header_bg.jpg); background-position: center top; background-repeat:no-preat!important; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; background-position: center center; background-repeat: no-repeat; background-color: #323132; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; bgcolor:#323132" id="BGheaderChange">
												<tbody>
													<tr><td width="100%" height="30"></td></tr>
													<tr>
														<td width="100%" valign="middle" class="pad20" align="center">
															<!-- Nav -->
															<table width="500" border="0" cellpadding="0" cellspacing="0" align="center" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="full">
																<tbody>
																	<tr>
																		<td valign="middle" width="100%" style="text-align: center; font-size: 30px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-weight: bold; line-height: 36px;"  mc:edit="1">
																			<!--[if !mso]><!--><span style="font-family: proxima_nova_rgbold, Helvetica; font-weight: normal;"><!--<![endif]-->New order
!<!--[if !mso]><!--></span>
																			<!--<![endif]-->
																		</td>
																	</tr>
																	<tr><td width="100%" height="6"></td></tr>
																	<tr>
																		<td valign="middle" width="100%" style="text-align: center; font-size: 12px;font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-weight: normal; text-transform: uppercase; line-height: 18px;" mc:edit="2">
																			<!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]-->RESTAURANT : '.$order_details['restaurant_name'].'

<!--[if !mso]><!--></span>
																			<!--<![endif]-->
																		</td>
																	</tr>
																	
																	'.$complementary_food.'
																</tbody>
															</table>
														</td>
													</tr>
													<tr><td width="100%" height="30"></td></tr>
												</tbody>
											</table><!-- End Nav -->
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</td>
				</tr>
			</tbody>
		</table><!-- End 3 --><!-- Wrapper 6  -->
		<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile" bgcolor="#e6e4db" style="background-color: rgb(230, 228, 219);">
			<tbody>
				<tr mc:repeatable>
					<td bgcolor="#e6e4db" valign="top" align="center" style="background-color: rgb(230, 228, 219);">
						<div mc:hideable><!-- Mobile Wrapper -->
							<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
								<tbody>
									<tr>
										<td width="600" valign="top" align="center"><!-- Space -->
											<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
												<tbody><tr><td width="100%" height="35"></td></tr>
												</tbody>
											</table><!-- End Space --><!-- Text Left -->
											<table width="420" border="0" cellpadding="0" cellspacing="0" align="left" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
												<tbody>
													<tr>
														<td valign="top" width="100%" align="center"><!-- SORTABLE -->
															<div class="sortable_inner ui-sortable"><!-- Text -->
																<table width="420" border="0" cellpadding="0" cellspacing="0" align="center" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" object="drag-module-small">
																	<tbody>
																		<tr>
																			<td valign="top" width="100%" align="center"><!-- Text -->
																				<table width="420" border="0" cellpadding="0" cellspacing="0" align="center" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																					<tbody>
																						<tr>
																							<td valign="middle" width="100%" style="text-align: left; font-size: 18px; font-family: Helvetica, Arial, sans-serif; color: #222222; font-weight: bold; line-height: 24px;"
																							mc:edit="3">
																								<!--[if !mso]><!--><span style="font-family: "proxima_novasemibold", Helvetica; font-weight: normal;"><!--<![endif]-->
																								Order #'.$order_details['order_id'].' ('.$order_details['order_date'].')<!--[if !mso]><!--></span>
																								<!--<![endif]-->
																							</td>
																						</tr>
																						<tr><td width="100%" height="10"></td></tr>
																						<tr>
																							<td valign="middle" width="100%" style="text-align: left; font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: #222222; line-height: 24px; font-weight: normal;"  mc:edit="4">
																								<!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]-->
																																																							You have received an order from '.$order_details['billing']['billing_name'].'. The order is as follows:
																																																							</span> </td>
																						</tr>
																						<tr><td width="100%" height="35" class="h30"></td></tr>
																					</tbody>
																				</table><!-- End Text -->
																			</td>
																		</tr>
																	</tbody>
																</table>
															</div>
														</td>
													</tr>
												</tbody>
											</table><!-- Order Right -->
											
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</td>
				</tr>
			</tbody>
		</table><!-- End Wrapper 6 --><!-- Wrapper 1 -->
		<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full" bgcolor="#e6e4db" style="background-color: rgb(230, 228, 219);">
			<tbody>
				<tr mc:repeatable>
					<td width="100%" valign="top" align="center">
						<div mc:hideable><!-- Wrapper -->
							<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile">
								<tbody>
									<tr>
										<td align="center"><!-- Space -->
											<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
												<tbody><tr><td width="100%" height="0" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr></tbody>
											</table><!-- End Space -->
										</td>
									</tr>
								</tbody>
							</table><!-- End Wrapper -->
						</div>
					</td>
				</tr>
			</tbody>
		</table><!-- Wrapper 1 --><!-- Wrapper 6  -->
		<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile" bgcolor="#e6e4db" style="background-color: rgb(230, 228, 219);">
			<tbody>
				<tr mc:repeatable>
					<td bgcolor="#e6e4db" align="center" style="background-color: rgb(230, 228, 219);">
						<div mc:hideable>
							<!-- Mobile Wrapper -->
							<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
								<tbody>
									<tr>
										<td width="600" align="center"><!-- Wrapper -->
											<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full" style="border-radius: 3px; background-color: rgb(255, 255, 255);">
												<tbody>
													<tr>
														<td width="600" align="center" style="border-radius: 3px; background-color: rgb(255, 255, 255);" bgcolor="#ffffff" class="mobile3">
															<!-- Wrapper -->
															<table width="586" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
																<tbody>
																	<tr>
																		<td width="586" align="center" valign="top" style="-webkit-border-bottom-right-radius: 3px; -moz-border-bottom-right-radius: 3px; border-bottom-right-radius: 3px; -webkit-border-bottom-left-radius: 3px; -moz-border-bottom-left-radius: 3px; border-bottom-left-radius: 3px;">
																			<div class="sortable_inner ui-sortable">
																				<!-- Wrapper -->
																				<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full" object="drag-module-small">
																					<tbody>
																						<tr>
																							<td width="100%" align="center" bgcolor="#71a42e" style="border-top-right-radius: 3px; border-top-left-radius: 3px; background-color: rgb(113, 164, 46);">
																								<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
																									<tbody>
																										<tr><td width="100%" height="13" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr><!-- Order Details -->
																										<tr>
																											<td align="center" valign="top" width="600" class="fullCenter">
																												<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="full">
																													<tbody>
																														<tr>
																															<td width="20" height="15"></td>
																															<td width="270" height="15" valign="top" class="fullCenter">
																																<table width="270" border="0" cellpadding="0" cellspacing="0" align="left" class="fullCenter">
																																	<tbody>
																																		<tr>
																																			<td valign="top" width="100%" style="text-align: left; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-weight: bold; line-height: 24px;" class="fullCenter" mc:edit="8">
																																				<!--[if !mso]><!--><span style="font-family: proxima_nova_rgbold, Helvetica; font-weight: normal;">
																																					<!--<![endif]-->ORDER
																																					DETAILS
																																					<!--[if !mso]><!-->
																																					</span>
																																				<!--<![endif]-->
																																			</td>
																																		</tr>
																																	</tbody>
																																</table>
																															</td>
																															<td width="80" height="15" class="erase">
																																<table width="80" border="0" cellpadding="0" cellspacing="0" align="left" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;"
																																class="full">
																																	<tbody>
																																		<tr>
																																			<td valign="top" width="100%" style="text-align: right; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-weight: bold; line-height: 24px;" mc:edit="9">
																																				<!--[if !mso]><!--><span style="font-family: proxima_nova_rgbold, Helvetica; font-weight: normal;"><!--<![endif]-->Price<!--[if !mso]><!--></span>
																																				<!--<![endif]-->
																																			</td>
																																		</tr>
																																	</tbody>
																																</table>
																															</td>
																															<td width="40" height="15" class="erase">&nbsp;&nbsp;</td>
																															<td width="80" height="15" class="erase">
																																<table width="80" border="0" cellpadding="0" cellspacing="0" align="left" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;"
																																class="full">
																																	<tbody>
																																		<tr>
																																			<td valign="top" width="100%" style="text-align: left; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-weight: bold; line-height: 24px;" mc:edit="9-2">
																																				<!--[if !mso]><!--><span style="font-family: proxima_nova_rgbold, Helvetica; font-weight: normal;"><!--<![endif]-->Quantity<!--[if !mso]><!--></span>
																																				<!--<![endif]-->
																																			</td>
																																		</tr>
																																	</tbody>
																																</table>
																															</td>
																															<td width="90" height="15" valign="middle" class="erase">
																																<table width="90" border="0" cellpadding="0" cellspacing="0" align="right" class="w70">
																																	<tbody>
																																		<tr>
																																			<td valign="top" width="100%" style="text-align: right; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-weight: bold; line-height: 24px;" mc:edit="10">
																																				<!--[if !mso]><!--><span style="font-family: proxima_nova_rgbold, Helvetica; font-weight: normal;"><!--<![endif]-->Subtotal<!--[if !mso]><!--></span>
																																				<!--<![endif]-->
																																			</td>
																																		</tr>
																																	</tbody>
																																</table>
																															</td>
																															<td width="20" height="15"></td>
																														</tr>
																													</tbody>
																												</table>
																											</td>
																										</tr>
																										<tr><td width="100%" height="13" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																									</tbody>
																								</table>
																							</td>
																						</tr>
																					</tbody>
																				</table>
																				<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full" object="drag-module-small">
																					<tbody><tr><td width="100%" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr></tbody>
																				</table><!-- End Wrapper 2 -->'.$prodduct_html.'<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full" style="-webkit-border-bottom-right-radius: 3px; -moz-border-bottom-right-radius: 3px; border-bottom-right-radius: 3px; -webkit-border-bottom-left-radius: 3px; -moz-border-bottom-left-radius: 3px; border-bottom-left-radius: 3px;"  object="drag-module-small">
																	                        <tbody><tr><td width="100%" height="30" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr></tbody>
																				</table><!-- End Wrapper 2 -->
																			</div>
																		</td>
																	</tr>
																</tbody>
															</table>
														</td>
													</tr>
												</tbody>
											</table>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</td>
				</tr>
			</tbody>
		</table><!-- End Wrapper 6 --><!-- Wrapper 1 -->
		<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full" bgcolor="#e6e4db" style="background-color: rgb(230, 228, 219);">
			<tbody>
				<tr mc:repeatable>
					<td width="100%" valign="top" align="center">
						<div mc:hideable><!-- Wrapper -->
							<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile">
								<tbody>
									<tr>
										<td align="center"><!-- Space -->
											<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
												<tbody><tr><td width="100%" height="30" align="center" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr></tbody>
											</table><!-- End Space -->
										</td>
									</tr>
								</tbody>
							</table><!-- End Wrapper -->
						</div>
					</td>
				</tr>
			</tbody>
		</table><!-- Wrapper 1 --><!-- Wrapper 6  -->
		<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile" bgcolor="#e6e4db" style="background-color: rgb(230, 228, 219);">
			<tbody>
				<tr mc:repeatable>
					<td bgcolor="#e6e4db" align="center" style="background-color: rgb(230, 228, 219);">
						<div mc:hideable><!-- Mobile Wrapper -->
							<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
								<tbody>
									<tr>
										<td width="600" align="center"><!-- Order Right -->
											<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
												<tbody>
													<tr>
														<td width="100%" bgcolor="#71a42e" align="center" style="border-top-right-radius: 3px; border-top-left-radius: 3px; background-color: rgb(113, 164, 46);" class="pad20"><!-- Space -->
															<table width="30" border="0" cellpadding="0" cellspacing="0" align="left" class="erase" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																<tbody><tr><td width="100%" height="1"></td></tr></tbody>
															</table><!-- End Space -->
															<table width="400" border="0" cellpadding="0" cellspacing="0" align="left" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																<tbody>
																	<tr>
																		<td width="100%" valign="top" align="center">
																			<div class="sortable_inner ui-sortable">
																				<table width="400" border="0" cellpadding="0" cellspacing="0" align="center" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" object="drag-module-small">
																					<tbody>
																						<tr><td width="100%" height="15" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr>
																							<td valign="middle" width="100%" style="text-align: left; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-weight: bold; line-height: 24px; text-transform: uppercase;" mc:edit="29">
																								<!--[if !mso]><!--><span style="font-family: proxima_nova_rgbold, Helvetica; font-weight: normal;"><!--<![endif]-->payment:<!--[if !mso]><!--></span>
																								<!--<![endif]-->
																							</td>
																						</tr>
																					</tbody>
																				</table>
																			</div>
																		</td>
																	</tr>
																	<tr><td width="100%" height="15" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																</tbody>
															</table>
														</td>
													</tr>
												</tbody>
											</table><!-- End Order Right --><!-- Order Right -->
											<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
												<tbody>
													<tr>
														<td width="100%" bgcolor="#ffffff" style="border-bottom-right-radius: 3px; border-bottom-left-radius: 3px; background-color: rgb(255, 255, 255);" class="pad20">
															<!-- Space -->
															<table width="30" border="0" cellpadding="0" cellspacing="0" align="left" class="erase" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																<tbody><tr><td width="100%" height="1"></td></tr></tbody>
															</table><!-- End Space -->
															<table width="250" border="0" cellpadding="0" cellspacing="0" align="left" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																<tbody>
																	<tr><td width="100%" height="15" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																	<tr>
																		<td width="100%" valign="top" align="center">
																			<div class="sortable_inner ui-sortable">
																				<table width="250" border="0" cellpadding="0" cellspacing="0" align="center" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" object="drag-module-small">
																					<tbody>
																						<tr><td width="100%" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr><td width="100%" height="5" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr>
																							<td valign="middle" width="100%" style="text-align: left; font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: #222222; line-height: 24px; font-weight: normal;" mc:edit="30">
																								<!--[if !mso]><!-->
																								'.$payment_details.'
																								<!--<![endif]-->
																							</td>
																						</tr>
																						<tr><td width="100%" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																					</tbody>
																				</table>
																			</div>
																		</td>
																	</tr>
																	<tr><td width="100%" height="20" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																</tbody>
															</table><!-- Space -->
															<table width="30" border="0" cellpadding="0" cellspacing="0" align="right" class="erase" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																<tbody><tr><td width="100%" height="10"></td></tr></tbody>
															</table><!-- End Space -->
															<table width="250" border="0" cellpadding="0" cellspacing="0" align="right" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																<tbody>
																	<tr><td width="100%" height="25" style="font-size: 1px; line-height: 1px;" class="erase">&nbsp;</td></tr>
																	<tr>
																		<td width="100%" valign="top" align="center">
																			<div class="sortable_inner ui-sortable">
																				<table width="250" border="0" cellpadding="0" cellspacing="0" align="center" class="full" style="border-collapse: collapse; position: relative; z-index: 0;"
																				object="drag-module-small" cu-identifier="element_05166087824665626">
																					<tbody>
																						<tr><td width="100%" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr>
																							<td width="250" valign="top" align="center">
																								<table width="250" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
																									<tbody>
																										<tr>
																											<td width="150" style="text-align: left; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #222222; font-weight: normal; line-height: 24px;" mc:edit="31">
																												<!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]--><p  cu-identify="element_08357365587062129">Subtotal<!--[if !mso]><!--></span>
																												<!--<![endif]-->
																											</td>
																											<td width="100" style="text-align: right; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #222222; font-weight: normal; line-height: 24px;" mc:edit="2-928">
																												<!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]--><p  cu-identify="element_09906574810450846">Rs. '.$order_details['sub_total'].'<!--[if !mso]><!--></span>
																												<!--<![endif]-->
																											</td>
																										</tr>
																									</tbody>
																								</table>
																							</td>
																						</tr>
																						<tr><td width="100%" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr><td width="100%" height="1" bgcolor="#dfdfdf" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr><td width="100%" height="8" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr>
																							<td width="250" valign="top" align="center">
																								<table width="250" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
																									<tbody>
																										<tr>
																											<td width="150" style="text-align: left; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #222222; font-weight: normal; line-height: 24px;" mc:edit="32">
																												<!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]--><p  cu-identify="element_07070737449479834">Shipping Charges<!--[if !mso]><!--></span>
																												<!--<![endif]-->
																											</td>
																											<td width="100" style="text-align: right; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #222222; font-weight: normal; line-height: 24px;" mc:edit="2-22">
																												<!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]--><p  cu-identify="element_09499041805787367">Rs.'.$order_details['delivery_charge'].'<!--[if !mso]><!--></span>
																												<!--<![endif]-->
																											</td>
																										</tr>
																									</tbody>
																								</table>
																							</td>
																						</tr>
																						<tr><td width="100%" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr>
																							<td width="250" valign="top" align="center">
																								<table width="250" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
																									<tbody>
																										<tr>
																											<td width="150" style="text-align: left; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #222222; font-weight: normal; line-height: 24px;" mc:edit="33">
																												<!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]-->Discount<!--[if !mso]><!--></span>
																												<!--<![endif]-->
																											</td>
																											<td width="100" style="text-align: right; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #222222; font-weight: normal; line-height: 24px;" mc:edit="2-23">
																												<!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]--><p  cu-identify="element_07813623902119076"> Rs.'.$order_details['discount_amount'].'<!--[if !mso]><!--></span>
																												<!--<![endif]-->
																											</td>
																										</tr>
																									</tbody>
																								</table>
																							</td>
																						</tr>
																						<tr><td width="100%" height="8" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr><td width="100%" height="1" bgcolor="#dfdfdf" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr><td width="100%" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr>
																							<td width="250" valign="top" align="center">
																								<table width="250" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
																									<tbody>
																										<tr>
																											<td width="150" style="text-align: left; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #222222; font-weight: bold; line-height: 24px;"  mc:edit="34">
																												<!--[if !mso]><!--><span style="font-family: proxima_nova_rgbold, Helvetica; font-weight: normal;"><!--<![endif]-->Total<!--[if !mso]><!--></span>
																												<!--<![endif]-->
																											</td>
																											<td width="100" style="text-align: right; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #222222; font-weight: bold; line-height: 24px;"  mc:edit="2-24">
																												<!--[if !mso]><!--><span style="font-family: proxima_nova_rgbold, Helvetica; font-weight: normal;"><!--<![endif]--><p  cu-identify="element_05173461792879972">Rs. '.$order_details['order_total'].'<!--[if !mso]><!--></span>
																												<!--<![endif]-->
																											</td>
																										</tr>
																									</tbody>
																								</table>
																							</td>
																						</tr>
																						<tr><td width="100%" height="20" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																					</tbody>
																				</table>
																			</div>
																		</td>
																	</tr>
																	<tr><td width="100%" height="20" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																</tbody>
															</table>
														</td>
													</tr>
												</tbody>
											</table><!-- End Order Right -->
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</td>
				</tr>
			</tbody>
		</table><!-- End Wrapper 6 --><!-- Wrapper 1 -->
		<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full" bgcolor="#e6e4db" style="background-color: rgb(230, 228, 219);">
			<tbody>
				<tr mc:repeatable>
					<td width="100%" valign="top" align="center">
						<div mc:hideable><!-- Wrapper -->
							<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile">
								<tbody>
									<tr>
										<td align="center"><!-- Space -->
											<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
												<tbody><tr><td width="100%" height="30" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr></tbody>
											</table><!-- End Space -->
										</td>
									</tr>
								</tbody>
							</table><!-- End Wrapper -->
						</div>
					</td>
				</tr>
			</tbody>
		</table><!-- Wrapper 1 --><!-- Wrapper 6  -->
		<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile" bgcolor="#e6e4db" style="background-color: rgb(230, 228, 219);">
			<tbody>
				<tr mc:repeatable>
					<td bgcolor="#e6e4db" align="center" style="background-color: rgb(230, 228, 219);">
						<div mc:hideable><!-- Mobile Wrapper -->
							<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
								<tbody>
									<tr>
										<td width="600" valign="top" align="center"><!-- Delivery address -->
											<table width="290" border="0" cellpadding="0" cellspacing="0" align="left" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
												<tbody>
													<tr>
														<td width="100%" class="full" align="center">
															<div class="sortable_inner ui-sortable">
																<table width="290" border="0" cellpadding="0" cellspacing="0" align="center" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" object="drag-module-small">
																	<tbody>
																		<tr>
																			<td width="100%" valign="top" align="center" bgcolor="#71a42e" style="border-top-right-radius: 3px; border-top-left-radius: 3px; background-color: rgb(113, 164, 46);" class="pad20"><!-- Space -->
																				<table width="30" border="0" cellpadding="0" cellspacing="0" align="left" class="erase" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																					<tbody><tr><td width="100%" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr></tbody>
																				</table><!-- End Space -->
																				<table width="220" border="0" cellpadding="0" cellspacing="0" align="left" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																					<tbody>
																						<tr><td width="100%" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr>
                                                                                                                                                                                    <td valign="middle" width="100%" style="text-align: left; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-weight: bold; line-height: 24px; text-transform: uppercase;" mc:edit="35">
                                                                                                                                                                                            <!--[if !mso]><!--><span style="font-family:proxima_nova_rgbold, Helvetica; font-weight: normal;"><!--<![endif]-->Delivery address<!--[if !mso]><!--></span> <!--<![endif]-->
                                                                                                                                                                                    </td>
																						</tr>
																						<tr><td width="100%" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																					</tbody>
																				</table><!-- Space -->
																				<table width="30" border="0" cellpadding="0" cellspacing="0" align="right" class="erase" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																					<tbody><tr><td width="100%" height="1" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr></tbody>
																				</table><!-- End Space -->
																			</td>
																		</tr>
																	</tbody>
																</table>
																<table width="290" border="0" cellpadding="0" cellspacing="0" align="center" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" object="drag-module-small">
																	<tbody>
																		<tr>
																			<td width="100%" valign="top" align="center" bgcolor="#ffffff" style="border-bottom-right-radius: 3px; border-bottom-left-radius: 3px; background-color: rgb(255, 255, 255);" class="pad20"><!-- Space -->
																				<table width="30" border="0" cellpadding="0" cellspacing="0" align="left" class="erase" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																				   <tbody><tr><td width="100%" height="1"></td></tr></tbody>
																				</table><!-- End Space -->
																				<table width="220" border="0" cellpadding="0" cellspacing="0" align="left" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																					<tbody>
																						<tr><td width="100%" height="25" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr>
                                                                                                                                                                                    <td valign="middle" width="100%" style="text-align: left; font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: #222222; line-height: 24px; font-weight: normal;" mc:edit="36"> 
                                                                                                                                                                                    '.$shipping_address.'
                                                                                                                                                                                    </td>
																						</tr>
																						<tr><td width="100%" height="25" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																					</tbody>
																				</table><!-- Space -->
																				<table width="30" border="0" cellpadding="0" cellspacing="0" align="right" class="erase" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																					<tbody><tr><td width="100%" height="1"></td></tr></tbody>
																				</table><!-- End Space -->
																			</td>
																		</tr>
																	</tbody>
																</table>
															</div>
														</td>
													</tr>
												</tbody>
											</table><!-- End Delivery address --><!-- Space -->
											<table width="1" border="0" cellpadding="0" cellspacing="0" align="left" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
												<tbody><tr><td width="100%" height="20"></td></tr></tbody>
											</table><!-- End Space --><!-- Invoice address -->
											<table width="290" border="0" cellpadding="0" cellspacing="0" align="right" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
												<tbody>
													<tr>
														<td width="100%" class="full" align="center">
															<div class="sortable_inner ui-sortable">
																<table width="290" border="0" cellpadding="0" cellspacing="0" align="center" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" object="drag-module-small">
																	<tbody>
																		<tr>
																			<td width="100%" valign="top" align="center" bgcolor="#71a42e" style="border-top-right-radius: 3px; border-top-left-radius: 3px; background-color: rgb(113, 164, 46);" class="pad20"><!-- Space -->
																				<table width="30" border="0" cellpadding="0" cellspacing="0" align="left" class="erase" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																					<tbody><tr><td width="100%" height="1"></td></tr></tbody>
																				</table><!-- End Space -->
																				<table width="220" border="0" cellpadding="0" cellspacing="0" align="left" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																					<tbody>
																						<tr><td width="100%" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr>
																							<td valign="middle" width="100%" style="text-align: left; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-weight: bold; line-height: 24px; text-transform: uppercase;" mc:edit="37">
																								<!--[if !mso]><!--><span style="font-family: proxima_nova_rgbold, Helvetica; font-weight: normal;"><!--<![endif]-->Billing Information<!--[if !mso]><!--></span>
                                                                                                                                                                                        </td>
                                                                                                                                                                                </tr>
																						<tr><td width="100%" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																					</tbody>
																				</table><!-- Space -->
																				<table width="30" border="0" cellpadding="0" cellspacing="0" align="right" class="erase" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																					<tbody><tr><td width="100%" height="1"></td></tr></tbody>
																				</table><!-- End Space -->
																			</td>
																		</tr>
																	</tbody>
																</table>
																<table width="290" border="0" cellpadding="0" cellspacing="0" align="center" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" object="drag-module-small">
																	<tbody>
																		<tr>
																			<td width="100%" valign="top" align="center" bgcolor="#ffffff" style="border-bottom-right-radius: 3px; border-bottom-left-radius: 3px; background-color: rgb(255, 255, 255);"  class="pad20"><!-- Space -->
																				<table width="30" border="0" cellpadding="0" cellspacing="0" align="left" class="erase" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																					<tbody><tr><td width="100%" height="1"></td></tr></tbody>
																				</table><!-- End Space -->
																				<table width="220" border="0" cellpadding="0" cellspacing="0" align="left" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																					<tbody>
																						<tr><td width="100%" height="25" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr>
																							<td valign="middle" width="100%" style="text-align: left; font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: #222222; line-height: 24px; font-weight: normal;" mc:edit="38"> 
                                                                                                                                                                                           '.$billing_address.'
                                                                                                                                                                                          </td>
                                                                                                                                                                                        </tr>
                                                                                                                                                                                        <tr><td width="100%" height="25" style="font-size: 1px; line-height: 1px;">&nbsp;</td> </tr>
                                                                                                                                                                                </tbody>
                                                                                                                                                                        </table><!-- Space -->
                                                                                                                                                                        <table width="30" border="0" cellpadding="0" cellspacing="0" align="right" class="erase" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
                                                                                                                                                                                <tbody><tr><td width="100%" height="15"></td></tr></tbody>
                                                                                                                                                                        </table><!-- End Space -->
                                                                                                                                                                </td>
                                                                                                                                                        </tr>
                                                                                                                                                </tbody>
                                                                                                                                        </table>
															</div>
														</td>
													</tr>
												</tbody>
											</table><!-- End Invoice address --><!-- Space -->
											<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
												<tbody><tr><td width="100%" height="15"></td></tr></tbody>
											</table><!-- End Space -->
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</td>
				</tr>
			</tbody>
		</table> <!-- End Wrapper 6 --><!-- Wrapper 6  -->
		<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile" bgcolor="#e6e4db" style="background-color: rgb(230, 228, 219);">
			<tbody>
				<tr mc:repeatable>
					<td bgcolor="#e6e4db" align="center" style="background-color: rgb(230, 228, 219);">
						<div mc:hideable> <!-- Mobile Wrapper -->
							<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
								<tbody>
									<tr>
										<td width="600" align="center"><!-- Space -->
											<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
												<tbody><tr><td width="100%" height="15"></td></tr></tbody>
											</table><!-- End Space --><!-- Space -->
											<table width="5" border="0" cellpadding="0" cellspacing="0" align="left" class="erase" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
											     <tbody><tr><td width="100%" height="15"></td></tr></tbody>
											</table><!-- End Space --><!-- Text -->
											<!-- End Text --><!-- Space -->
                                                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
                                                                                            <tbody><tr><td width="100%" height="15"></td></tr></tbody>
                                                                                    </table><!-- End Space -->
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</td>
				</tr>
			</tbody>
		</table><!-- End Wrapper 6 --><!-- Wrapper 3  -->
		<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full" bgcolor="#e6e4db" style="background-color: rgb(230, 228, 219);">
			<tbody>
				<tr mc:repeatable>
					<td bgcolor="#e6e4db" align="center" style="background-color: rgb(230, 228, 219);">
						<div mc:hideable><!-- Mobile Wrapper -->
							<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile">
								<tbody>
									<tr>
										<td width="600" align="center"><!-- Start Nav -->
											<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full" bgcolor="#2d2d2d" style="border-radius: 3px; background-color: rgb(45, 45, 45);">
												<tbody>
													<tr><td width="100%" height="15"></td></tr>
													<tr>
														<td width="100%" valign="top" class="pad20" align="center"><!-- Copyright Text -->
															<table width="540" border="0" cellpadding="0" cellspacing="0" align="center" style="text-align: center; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="fullCenter">
																<tbody>
																	<tr>
                                                                                                                                            <td valign="top" width="540" align="center" style="text-align: center; font-family: Helvetica, Arial, sans-serif; font-size: 13px; color: #ffffff; line-height: 18px; font-weight: normal;" class="fullCenter" mc:edit="41">
                                                                                                                                                    <!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]--><span  cu-identify="element_0018516645610561433">@ 2019 Zamy. All rights Reserved</span>
                                                                                                                                                    <!--[if !mso]><!--></span><!--<![endif]-->
                                                                                                                                            </td>
																	</tr>
																</tbody>
															</table>
														</td>
													</tr>
													<tr><td width="100%" height="15"></td></tr>
												</tbody>
											</table>
											<!-- End Nav -->
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</td>
				</tr>
			</tbody>
		</table><!-- End 3 -->

<!-- Wrapper 1 -->
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full"  bgcolor="#e6e4db"style="background-color: rgb(230, 228, 219);">
	<tbody><tr mc:repeatable>
		<td width="100%" valign="top" align="center">
		<div mc:hideable><!-- Wrapper -->
			<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile">
				<tbody><tr>
					<td align="center"><!-- Space -->
						<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
							<tbody><tr>
								<td width="100%" height="50"></td>
							</tr>
							<tr>
								<td width="100%" height="1" style="font-size: 1px; line-height: 1px;">&nbsp;</td>
							</tr>
						</tbody></table><!-- End Space -->
					</td>
				</tr>
			</tbody></table><!-- End Wrapper -->
		</div>
		</td>
	</tr>
</tbody></table><!-- Wrapper 1 -->		
	</div>
</body>
</html>
<style>body {background: none !important;}</style>';

	$restaurant_email	= $order_details['restaurant_email'];
	$admin_email		= 'zamyindia@gmail.com';
	
	$restaurant_subject = 'Order Confirmation - Your Order with zamy.in [#'.$order_details['order_id'].'] has been successfully placed!';
	
	$admin_subject = '[Zamy] New customer order ('.$order_details['order_id'].') - '.$order_details['order_date'].'';
	
	mail($admin_email, $admin_subject, $message, $headers);
	
	$mail = mail($restaurant_email, $restaurant_subject, $message, $headers);
	
	return $mail;
} 

function order_failed_confirmation($order_id,$user_id){
	
	$CI = get_instance();
	$CI->load->model('order_model');

	$order_details = $CI->order_model->order_details($order_id,$user_id);
	
	$prodduct_html='';
	
	foreach($order_details['order_items'] as $item){
		$prodduct_html .='
		<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full" object="drag-module-small">
            <tbody>
				<tr><td width="100%" align="center" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
				<tr>
					<td valign="top" align="center" width="100%" style="font-family: Helvetica, Arial, sans-serif; color: #30373a; font-weight: bold; font-size: 15px; line-height: 24px; text-align: center;" class="fullCenter">
						<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="full">
						 <tbody>
							 <tr>
								<td width="20" height="50">&nbsp;&nbsp;&nbsp;&nbsp;</td>
								<td width="50" height="50" valign="middle" style="text-align: left;" class="erase" id="image49">
										<a href="#"><img width="49" src="'.$item['menu_logo'].'" alt="" border="0" style="vertical-align: middle; padding-top: 1px;" mc:edit="17"> </a>
								</td>
								<td width="15" height="50" class="erase"></td>
								<td width="205" height="50" valign="top" class="full">
										<table width="205" border="0" cellpadding="0" cellspacing="0" align="left">
												<tbody>
												<tr><td width="100%" height="2" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
												<tr>
														<td width="100%" style="font-family: Helvetica, Arial, sans-serif; color: #222222; font-weight: bold; font-size: 15px; line-height: 18px; text-align: left;" class="w70" mc:edit="18">
																<!--[if !mso]><!--><span style="font-family: proxima_nova_rgbold, Helvetica; font-weight: normal;"><!--<![endif]--><p  cu-identify="element_0638462864365142">
																<div>'.$item['menu_name'].'</div>
																<!--[if !mso]><!-->
																</span>
																<!--<![endif]-->
														</td>
												</tr>
												<tr><td width="100%" height="5" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
												<tr>
														<td width="100%" style="font-family: Helvetica, Arial, sans-serif; color: #222222; font-weight: normal; font-size: 13px; line-height: 18px; text-align: left;" class="w70" mc:edit="19">
																<!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]-->Delivery: <span style="color: #71a42e;"></span>
																<!--[if !mso]><!-->
																</span>
																<!--<![endif]-->
														</td>
												</tr>
										</tbody>
										</table>
								</td>
								<td width="80" valign="top" height="50" class="erase">
										<table width="80" border="0" cellpadding="0" cellspacing="0" align="right" class="w70">
												<tbody>
														<tr><td width="100%" height="2" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
														<tr>
																<td width="100%" style="font-family: Helvetica, Arial, sans-serif; color: #222222; font-weight: normal; font-size: 14px; line-height: 20px; text-align: right;" class="w70" mc:edit="20">
																		<!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]--><p  cu-identify="element_009125256622760869">Rs. '.$item['price'].'<!--[if !mso]><!--></span>
																		<!--<![endif]-->
																</td>
														</tr>
												</tbody>
										</table>
								</td>
								<td width="40" height="50">&nbsp;&nbsp;</td>
								<td width="80" height="50" valign="top" class="w50">
										<table width="80" border="0" cellpadding="0" cellspacing="0" align="left" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;"
										class="w50">
												<tbody>
														<tr><td width="100%" height="2" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
														<tr>
																<td width="100%" style="font-family: Helvetica, Arial, sans-serif; color: #222222; font-weight: normal; font-size: 14px; line-height: 20px; text-align: left;" class="w50" mc:edit="21">
																		<!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]-->'.$item['qty'].'x<!--[if !mso]><!--></span>
																		<!--<![endif]-->
																</td>
														</tr>
												</tbody>
										</table>
								</td>
								<td width="90" valign="top" height="50" class="erase">
										<table width="90" border="0" cellpadding="0" cellspacing="0" align="right">
												<tbody>
														<tr>
																<td width="100%" style="font-family: Helvetica, Arial, sans-serif; color: #222222; font-weight: normal; font-size: 14px; line-height: 20px; text-align: right;" class="w70" mc:edit="22">
																		<!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]--><p  cu-identify="element_020128349030194048">Rs. '.$item['subtotal'].'<!--[if !mso]><!--></span>
																		<!--<![endif]-->
																</td>
														</tr>
												</tbody>
										</table>
								</td>
								<td width="20" height="50" class="erase"></td>
						 </tr>
					</tbody>
					</table>
				</td>
			</tr>
				<tr><td width="100%" height="1" bgcolor="#f4f4f4" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
				<tr><td width="100%" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
			</tbody>
		</table>';

	}
	
	$delivery_charge = 0;
	if(!empty($order_details['delivery_charge'])){
		$delivery_charge = $order_details['delivery_charge'];
	}
	
	//$order_total = $order_details['order_total'] + $delivery_charge;
	$order_total = $order_details['order_total'];
	
	$payment_details = '';
	if(strtolower($order_details['payment_method'])=='cod'){
		$payment_details .= '<span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]--><p  cu-identify="element_02865282806828009">Payment method: <span style="font-family: proxima_nova_rgbold, Helvetica;">'.$order_details['payment_method'].'</span>
				<br>You order has been Pending Payment.
				<!--[if !mso]><!-->
				</span>';
	}else{
	
		$payment_details .= '<span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]--><p  cu-identify="element_02865282806828009">Payment method: <span style="font-family: proxima_nova_rgbold, Helvetica;">'.$order_details['payment_method'].'</span>
				<!--[if !mso]><!-->
				</span>';
	}
	
	
	$billing_address ='<span style="font-weight: bold;">
                  
                    <span style="font-family: proxima_nova_rgbold, Helvetica; font-weight: normal;">
                    '.$order_details['billing']['billing_name'].'</span>
                   </span><br>
                    <span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;">
					'.$order_details['billing']['billing_phone'].'</span><br>
					<span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;">
                      '.$order_details['billing']['billing_email'].'</span><br><br><br>';
	
	$shipping_address ='<span style="font-weight: bold;">
                    <!--[if !mso]><!-->
                    <span style="font-family: proxima_nova_rgbold, Helvetica; font-weight: normal;">
                    <!--<![endif]-->'.$order_details['shipping']['shipping_name'].'<!--[if !mso]><!--></span>
                    <!--<![endif]--></span><br>
                    <!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]-->
                      '.$order_details['shipping']['shipping_address'].'<!--[if !mso]><!--></span><!--<![endif]-->';
	
	$complementary_food = '';		
	
	if(!empty($order_details['complementary_food'])){
		$complementary_food .= '<tr>
			<td valign="middle" width="100%" style="text-align: center; font-size: 12px;font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-weight: normal; text-transform: uppercase; line-height: 18px;" mc:edit="2">
				<span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;">'.$order_details['complementary_food'].'</span>
			</td>
		</tr>';
	}
	
	 
	
	$message = '';
	$message .= '<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
<title>Order Failed - Your Order with zamy.in [#'.$order_details['order_id'].'] has been failed!</title>
<style type="text/css">
div,p,a,li,td {-webkit-text-size-adjust: none;}
* {-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;}
.ReadMsgBody {width: 100%; background-color: #ffffff;}
.ExternalClass {width: 100%;background-color: #ffffff;}
body {width: 100%; height: 100%;margin: 0; padding: 0;-webkit-font-smoothing: antialiased;}
html {background-color: #e6e4db; width: 100%; }
@font-face {font-family: "proxima_novalight"; src: url("http://rocketway.net/themebuilder/products/font/proximanova-light-webfont.eot"); src: url("http://rocketway.net/themebuilder/products/font/proximanova-light-webfont.eot?#iefix") format("embedded-opentype"), url("http://rocketway.net/themebuilder/products/font/proximanova-light-webfont.woff") format("woff"), url("http://rocketway.net/themebuilder/products/font/proximanova-light-webfont.ttf") format("truetype"); font-weight: normal; font-style: normal; }
@font-face {font-family: proxima_nova_rgregular; src: url("http://rocketway.net/themebuilder/products/font/proximanova-regular-webfont.eot"); src: url("http://rocketway.net/themebuilder/products/font/proximanova-regular-webfont.eot?#iefix") format("embedded-opentype"), url("http://rocketway.net/themebuilder/products/font/proximanova-regular-webfont.woff") format("woff"), url("http://rocketway.net/themebuilder/products/font/proximanova-regular-webfont.ttf") format("truetype"); font-weight: normal; font-style: normal; }
@font-face {font-family: "proxima_novasemibold"; src: url("http://rocketway.net/themebuilder/products/font/proximanova-semibold-webfont.eot"); src: url("http://rocketway.net/themebuilder/products/font/proximanova-semibold-webfont.eot?#iefix") format("embedded-opentype"), url("http://rocketway.net/themebuilder/products/font/proximanova-semibold-webfont.woff") format("woff"), url("http://rocketway.net/themebuilder/products/font/proximanova-semibold-webfont.ttf") format("truetype"); font-weight: normal; font-style: normal;}
@font-face {font-family: proxima_nova_rgbold;src: url("http://rocketway.net/themebuilder/products/font/proximanova-bold-webfont.eot");src: url("http://rocketway.net/themebuilder/products/font/proximanova-bold-webfont.eot?#iefix") format("embedded-opentype"), url("http://rocketway.net/themebuilder/products/font/proximanova-bold-webfont.woff") format("woff"), url("http://rocketway.net/themebuilder/products/font/proximanova-bold-webfont.ttf") format("truetype"); font-weight: normal; font-style: normal;}
@font-face {font-family: "proxima_novathin"; src: url("http://rocketway.net/themebuilder/products/font/proximanova-thin-webfont.eot"); src: url("http://rocketway.net/themebuilder/products/font/proximanova-thin-webfont.eot?#iefix") format("embedded-opentype"), url("http://rocketway.net/themebuilder/products/font/proximanova-thin-webfont.woff") format("woff"), url("http://rocketway.net/themebuilder/products/font/proximanova-thin-webfont.ttf") format("truetype"); font-weight: normal;font-style: normal;}
@font-face {font-family: "proxima_novablack";src: url("http://rocketway.net/themebuilder/products/font/proximanova-black-webfont.eot"); src: url("http://rocketway.net/themebuilder/products/font/proximanova-black-webfont.eot?#iefix") format("embedded-opentype"), url("http://rocketway.net/themebuilder/products/font/proximanova-black-webfont.woff") format("woff"), url("http://rocketway.net/themebuilder/products/font/proximanova-black-webfont.ttf") format("truetype");font-weight: normal;font-style: normal;}
@font-face {font-family: "proxima_novaextrabold"; src: url("http://rocketway.net/themebuilder/products/font/proximanova-extrabold-webfont.eot"); src: url("http://rocketway.net/themebuilder/products/font/proximanova-extrabold-webfont.eot?#iefix") format("embedded-opentype"), url("http://rocketway.net/themebuilder/products/font/proximanova-extrabold-webfont.woff2") format("woff2"), url("http://rocketway.net/themebuilder/products/font/proximanova-extrabold-webfont.woff") format("woff"), url("http://rocketway.net/themebuilder/products/font/proximanova-extrabold-webfont.ttf") format("truetype"); font-weight: normal; font-style: normal;}
p {padding: 0!important;margin-top: 0!important;margin-right: 0!important;margin-bottom: 0!important;margin-left: 0!important;}
.hover:hover {opacity: 0.85;filter: alpha(opacity=85);}
.underline:hover {text-decoration: underline!important;}
.jump:hover {opacity: 0.75;filter: alpha(opacity=75); padding-top: 10px!important;}
#image49 img {width: 49px;height: auto;}
</style>
<!-- @media only screen and (max-width: 640px) 
           {*/
           -->
<style type="text/css">
@media only screen and (max-width: 640px) {
        body { width: auto!important; }
        table[class=full] {width: 100%!important; clear: both;}
        table[class=mobile] {width: 100%!important;padding-left: 20px; padding-right: 20px;clear: both; }
        table[class=fullCenter] {width: 100%!important; text-align: center!important; clear: both; }
        td[class=image600] img {width: 100%!important;text-align: center!important; clear: both; }
        td[class=fullCenter] {width: 100%!important; text-align: center!important; clear: both;}
        td[class=full] { width: 100%!important; clear: both;  }
        *[class=erase] { display: none; }
        *[class=buttonScale] { float: none!important; text-align: center!important; display: inline-block!important; clear: both; }
        *[class=buttonLeft] {float: left!important; text-align: left!important; display: inline-block!important;  clear: both; }
        .pad20 { padding-left: 20px!important; padding-right: 20px!important; }
        .w50 {width: 50px!important;}
        .h30 { height: 30px!important; }
}
</style>
<!--
@media only screen and (max-width: 479px) 
           {
           -->
<style type="text/css">
@media only screen and (max-width: 479px) {
        body {width: auto!important;}
        table[class=full] {width: 100%!important; clear: both; }
        table[class=mobile] {width: 100%!important; padding-left: 20px; padding-right: 20px; clear: both;}
        table[class=fullCenter] {width: 100%!important;text-align: center!important; clear: both; }
        td[class=fullCenter] { width: 100%!important; text-align: center!important; clear: both;}
        td[class=full] {width: 100%!important;clear: both; }
        *[class=erase] {display: none; }
        *[class=buttonScale] {float: none!important; text-align: center!important;display: inline-block!important;clear: both; }
        *[class=buttonLeft] { float: left!important; text-align: left!important; display: inline-block!important;clear: both;}
        .pad20 { padding-left: 20px!important; padding-right: 20px!important; }
        .w70 { width: 70px!important; }
        .w50 { width: 50px!important;}
        .h30 { height: 30px!important;  }
}
}
</style>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" yahoo="fix">
	<div class="ui-sortable" id="sort_them"><!-- Wrapper 2 -->
		<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full" bgcolor="#e6e4db" style="background-color: rgb(230, 228, 219);">
			<tbody>
                            <tr mc:repeatable>
                                    <td width="100%" valign="top" align="center">
                                            <div mc:hideable><!-- Wrapper -->
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile">
                                                        <tbody><tr><td align="center"> <!-- Space -->
                                                            <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
                                                                    <tbody><tr> <td width="100%" height="50"></td> </tr></tbody>
                                                            </table> <!-- End Space --> </td>  </tr>
                                                        </tbody>
                                                    </table><!-- End Wrapper -->
                                            </div>
                                    </td>
                            </tr>
			</tbody>
		</table><!-- Wrapper 2 --><!-- Wrapper 3  -->
		<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full" bgcolor="#e6e4db" style="background-color: rgb(230, 228, 219);">
			<tbody>
				<tr mc:repeatable>
					<td bgcolor="#e6e4db" align="center" style="background-color: rgb(230, 228, 219);">
						<div mc:hideable><!-- Mobile Wrapper -->
							<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile">
								<tbody>
									<tr>
										<td width="600" align="center"><!-- Start Nav -->
											<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full" style="background-image: url(http://rocketway.net/themebuilder/products/batch1/templates/template_1/images/header_bg.jpg); background-position: center top; background-repeat:no-preat!important; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; background-position: center center; background-repeat: no-repeat; background-color: #323132; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; bgcolor:#323132" id="BGheaderChange">
												<tbody>
													<tr><td width="100%" height="30"></td></tr>
													<tr>
														<td width="100%" valign="middle" class="pad20" align="center">
															<!-- Nav -->
															<table width="500" border="0" cellpadding="0" cellspacing="0" align="center" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="full">
																<tbody>
																	<tr>
																		<td valign="middle" width="100%" style="text-align: center; font-size: 30px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-weight: bold; line-height: 36px;"  mc:edit="1">
																			<!--[if !mso]><!--><span style="font-family: proxima_nova_rgbold, Helvetica; font-weight: normal;"><!--<![endif]-->Order Payment failed!<!--[if !mso]><!--></span>
																			<!--<![endif]-->
																		</td>
																	</tr>
																	<tr><td width="100%" height="6"></td></tr>
																	<tr>
																		<td valign="middle" width="100%" style="text-align: center; font-size: 12px;font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-weight: normal; text-transform: uppercase; line-height: 18px;" mc:edit="2">
																			<!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]-->Your order has been Processed<!--[if !mso]><!--></span>
																			<!--<![endif]-->
																		</td>
																	</tr>
																	'.$complementary_food.'
																</tbody>
															</table>
														</td>
													</tr>
													<tr><td width="100%" height="30"></td></tr>
												</tbody>
											</table><!-- End Nav -->
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</td>
				</tr>
			</tbody>
		</table><!-- End 3 --><!-- Wrapper 6  -->
		<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile" bgcolor="#e6e4db" style="background-color: rgb(230, 228, 219);">
			<tbody>
				<tr mc:repeatable>
					<td bgcolor="#e6e4db" valign="top" align="center" style="background-color: rgb(230, 228, 219);">
						<div mc:hideable><!-- Mobile Wrapper -->
							<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
								<tbody>
									<tr>
										<td width="600" valign="top" align="center"><!-- Space -->
											<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
												<tbody><tr><td width="100%" height="35"></td></tr>
												</tbody>
											</table><!-- End Space --><!-- Text Left -->
											<table width="420" border="0" cellpadding="0" cellspacing="0" align="left" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
												<tbody>
													<tr>
														<td valign="top" width="100%" align="center"><!-- SORTABLE -->
															<div class="sortable_inner ui-sortable"><!-- Text -->
																<table width="420" border="0" cellpadding="0" cellspacing="0" align="center" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" object="drag-module-small">
																	<tbody>
																		<tr>
																			<td valign="top" width="100%" align="center"><!-- Text -->
																				<table width="420" border="0" cellpadding="0" cellspacing="0" align="center" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																					<tbody>
																						<tr>
																							<td valign="middle" width="100%" style="text-align: left; font-size: 18px; font-family: Helvetica, Arial, sans-serif; color: #222222; font-weight: bold; line-height: 24px;"
																							mc:edit="3">
																								<!--[if !mso]><!--><span style="font-family: "proxima_novasemibold", Helvetica; font-weight: normal;"><!--<![endif]-->Dear '.$order_details['billing']['billing_name'].',<!--[if !mso]><!--></span>
																								<!--<![endif]-->
																							</td>
																						</tr>
																						<tr><td width="100%" height="10"></td></tr>
																						<tr>
																							<td valign="middle" width="100%" style="text-align: left; font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: #222222; line-height: 24px; font-weight: normal;"  mc:edit="4">
																								<!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]-->
                                                                                                                                                                                                    Oreder payment Failed!<br>
                                                                                                                                                                                                    Sorry, your payment of order is failed. Please try again.you can pay with another method of payment of your order on zamy.in
                                                                                                                                                                                                    <br><br>
                                                                                                                                                                                                 As a part of zamy initiative we will not be sending the invoice to you with the shipment. You will receive a soft copy of a invoice as a part of the delivery confirmation email of the delivery completion.
                                                                                                                                                                                         <!--[if !mso]><!--><!--<![endif]-->
                                                                                                                                                                                    </span> </td>
																						</tr>
																						<tr><td width="100%" height="35" class="h30"></td></tr>
																					</tbody>
																				</table><!-- End Text -->
																			</td>
																		</tr>
																	</tbody>
																</table>
															</div>
														</td>
													</tr>
												</tbody>
											</table><!-- Order Right -->
											<table width="150" border="0" cellpadding="0" cellspacing="0" align="right" class="buttonLeft" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
												<tbody>
													<tr>
														<td width="100%" valign="top" align="center"><!-- SORTABLE -->
															<div class="sortable_inner ui-sortable">
																<table width="150" border="0" cellpadding="0" cellspacing="0" align="center" class="buttonLeft" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" object="drag-module-small">
																	<tbody>
																		<tr>
																			<td width="100%" bgcolor="#ffffff" valign="top" align="center" style="border-radius: 3px; background-color: rgb(255, 255, 255);">
																				<table width="150" border="0" cellpadding="0" cellspacing="0" align="center">
																					<tbody>
																						<tr><td width="100%" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr>
																							<td valign="middle" width="100%" style="text-align: center; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #222222; font-weight: normal; line-height: 24px;" mc:edit="5">
																								<!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]-->Order number:<!--[if !mso]><!--></span>
																								<!--<![endif]-->
																							</td>
																						</tr>
																						<tr>
																							<td valign="middle" width="100%" style="text-align: center; font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: #222222; line-height: 24px; font-weight: bold;"  mc:edit="6">
																								<!--[if !mso]><!--><span style="font-family: proxima_nova_rgbold, Helvetica; font-weight: normal;"><!--<![endif]-->#'.$order_details['order_id'].'<!--[if !mso]><!--></span>
																								<!--<![endif]-->
																							</td>
																						</tr>
																						<tr><td width="100%" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																					</tbody>
																				</table>
																			</td>
																		</tr>
																		<tr><td width="100%" height="15"></td></tr>
																	</tbody>
																</table>
															</div>
														</td>
													</tr>
													<tr>
														<td width="100%" align="center"><!-- SORTABLE -->
															<div class="sortable_inner ui-sortable">
																<table width="150" border="0" cellpadding="0" cellspacing="0" align="center" class="buttonLeft" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" object="drag-module-small">
																	<tbody>
																		<tr>
																			<td width="100%" bgcolor="#71a42e" align="center" style="border-radius: 3px; background-color: rgb(113, 164, 46);">
																				<table width="150" border="0" cellpadding="0" cellspacing="0" align="center">
																					<tbody>
																						<tr><td width="100%" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr>
																							<td valign="top" width="100%" align="center" style="text-align: center; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: rgb(34, 34, 34); font-weight: bold; line-height: 18px; text-transform: uppercase;"  mc:edit="7">
																								<!--[if !mso]><!--><span style="font-family: "proxima_novasemibold", Helvetica; font-weight: normal;"><!--<![endif]--><a href="'.base_url('my_account').'" style="text-decoration: none; color: #ffffff;">account login</a><!--[if !mso]><!--></span>
																								<!--<![endif]-->
																							</td>
																						</tr>
																						<tr><td width="100%" height="10" style="font-size: 1px; line-height: 1px; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px;">&nbsp;</td></tr>
																					</tbody>
																				</table>
																			</td>
																		</tr>
																		<tr><td width="100%" height="15"></td></tr>
																	</tbody>
																</table>
															</div>
														</td>
													</tr>
													<tr>
														<td width="100%" align="center"><!-- SORTABLE -->
															<div class="sortable_inner ui-sortable">
																<table width="150" border="0" cellpadding="0" cellspacing="0" align="center" class="buttonLeft" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" object="drag-module-small">
																	<tbody><tr><td width="100%" height="15"></td></tr></tbody>
																</table>
															</div>
														</td>
													</tr>
												</tbody>
											</table><!-- End Order Right -->
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</td>
				</tr>
			</tbody>
		</table><!-- End Wrapper 6 --><!-- Wrapper 1 -->
		<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full" bgcolor="#e6e4db" style="background-color: rgb(230, 228, 219);">
			<tbody>
				<tr mc:repeatable>
					<td width="100%" valign="top" align="center">
						<div mc:hideable><!-- Wrapper -->
							<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile">
								<tbody>
									<tr>
										<td align="center"><!-- Space -->
											<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
												<tbody><tr><td width="100%" height="0" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr></tbody>
											</table><!-- End Space -->
										</td>
									</tr>
								</tbody>
							</table><!-- End Wrapper -->
						</div>
					</td>
				</tr>
			</tbody>
		</table><!-- Wrapper 1 --><!-- Wrapper 6  -->
		<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile" bgcolor="#e6e4db" style="background-color: rgb(230, 228, 219);">
			<tbody>
				<tr mc:repeatable>
					<td bgcolor="#e6e4db" align="center" style="background-color: rgb(230, 228, 219);">
						<div mc:hideable>
							<!-- Mobile Wrapper -->
							<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
								<tbody>
									<tr>
										<td width="600" align="center"><!-- Wrapper -->
											<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full" style="border-radius: 3px; background-color: rgb(255, 255, 255);">
												<tbody>
													<tr>
														<td width="600" align="center" style="border-radius: 3px; background-color: rgb(255, 255, 255);" bgcolor="#ffffff" class="mobile3">
															<!-- Wrapper -->
															<table width="586" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
																<tbody>
																	<tr>
																		<td width="586" align="center" valign="top" style="-webkit-border-bottom-right-radius: 3px; -moz-border-bottom-right-radius: 3px; border-bottom-right-radius: 3px; -webkit-border-bottom-left-radius: 3px; -moz-border-bottom-left-radius: 3px; border-bottom-left-radius: 3px;">
																			<div class="sortable_inner ui-sortable">
																				<!-- Wrapper -->
																				<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full" object="drag-module-small">
																					<tbody>
																						<tr>
																							<td width="100%" align="center" bgcolor="#71a42e" style="border-top-right-radius: 3px; border-top-left-radius: 3px; background-color: rgb(113, 164, 46);">
																								<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
																									<tbody>
																										<tr><td width="100%" height="13" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr><!-- Order Details -->
																										<tr>
																											<td align="center" valign="top" width="600" class="fullCenter">
																												<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="full">
																													<tbody>
																														<tr>
																															<td width="20" height="15"></td>
																															<td width="270" height="15" valign="top" class="fullCenter">
																																<table width="270" border="0" cellpadding="0" cellspacing="0" align="left" class="fullCenter">
																																	<tbody>
																																		<tr>
																																			<td valign="top" width="100%" style="text-align: left; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-weight: bold; line-height: 24px;" class="fullCenter" mc:edit="8">
																																				<!--[if !mso]><!--><span style="font-family: proxima_nova_rgbold, Helvetica; font-weight: normal;">
																																					<!--<![endif]-->ORDER
																																					DETAILS
																																					<!--[if !mso]><!-->
																																					</span>
																																				<!--<![endif]-->
																																			</td>
																																		</tr>
																																	</tbody>
																																</table>
																															</td>
																															<td width="80" height="15" class="erase">
																																<table width="80" border="0" cellpadding="0" cellspacing="0" align="left" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;"
																																class="full">
																																	<tbody>
																																		<tr>
																																			<td valign="top" width="100%" style="text-align: right; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-weight: bold; line-height: 24px;" mc:edit="9">
																																				<!--[if !mso]><!--><span style="font-family: proxima_nova_rgbold, Helvetica; font-weight: normal;"><!--<![endif]-->Price<!--[if !mso]><!--></span>
																																				<!--<![endif]-->
																																			</td>
																																		</tr>
																																	</tbody>
																																</table>
																															</td>
																															<td width="40" height="15" class="erase">&nbsp;&nbsp;</td>
																															<td width="80" height="15" class="erase">
																																<table width="80" border="0" cellpadding="0" cellspacing="0" align="left" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;"
																																class="full">
																																	<tbody>
																																		<tr>
																																			<td valign="top" width="100%" style="text-align: left; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-weight: bold; line-height: 24px;" mc:edit="9-2">
																																				<!--[if !mso]><!--><span style="font-family: proxima_nova_rgbold, Helvetica; font-weight: normal;"><!--<![endif]-->Quantity<!--[if !mso]><!--></span>
																																				<!--<![endif]-->
																																			</td>
																																		</tr>
																																	</tbody>
																																</table>
																															</td>
																															<td width="90" height="15" valign="middle" class="erase">
																																<table width="90" border="0" cellpadding="0" cellspacing="0" align="right" class="w70">
																																	<tbody>
																																		<tr>
																																			<td valign="top" width="100%" style="text-align: right; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-weight: bold; line-height: 24px;" mc:edit="10">
																																				<!--[if !mso]><!--><span style="font-family: proxima_nova_rgbold, Helvetica; font-weight: normal;"><!--<![endif]-->Subtotal<!--[if !mso]><!--></span>
																																				<!--<![endif]-->
																																			</td>
																																		</tr>
																																	</tbody>
																																</table>
																															</td>
																															<td width="20" height="15"></td>
																														</tr>
																													</tbody>
																												</table>
																											</td>
																										</tr>
																										<tr><td width="100%" height="13" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																									</tbody>
																								</table>
																							</td>
																						</tr>
																					</tbody>
																				</table>
																				<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full" object="drag-module-small">
																					<tbody><tr><td width="100%" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr></tbody>
																				</table><!-- End Wrapper 2 -->'.$prodduct_html.'<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full" style="-webkit-border-bottom-right-radius: 3px; -moz-border-bottom-right-radius: 3px; border-bottom-right-radius: 3px; -webkit-border-bottom-left-radius: 3px; -moz-border-bottom-left-radius: 3px; border-bottom-left-radius: 3px;"  object="drag-module-small">
																	                        <tbody><tr><td width="100%" height="30" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr></tbody>
																				</table><!-- End Wrapper 2 -->
																			</div>
																		</td>
																	</tr>
																</tbody>
															</table>
														</td>
													</tr>
												</tbody>
											</table>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</td>
				</tr>
			</tbody>
		</table><!-- End Wrapper 6 --><!-- Wrapper 1 -->
		<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full" bgcolor="#e6e4db" style="background-color: rgb(230, 228, 219);">
			<tbody>
				<tr mc:repeatable>
					<td width="100%" valign="top" align="center">
						<div mc:hideable><!-- Wrapper -->
							<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile">
								<tbody>
									<tr>
										<td align="center"><!-- Space -->
											<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
												<tbody><tr><td width="100%" height="30" align="center" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr></tbody>
											</table><!-- End Space -->
										</td>
									</tr>
								</tbody>
							</table><!-- End Wrapper -->
						</div>
					</td>
				</tr>
			</tbody>
		</table><!-- Wrapper 1 --><!-- Wrapper 6  -->
		<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile" bgcolor="#e6e4db" style="background-color: rgb(230, 228, 219);">
			<tbody>
				<tr mc:repeatable>
					<td bgcolor="#e6e4db" align="center" style="background-color: rgb(230, 228, 219);">
						<div mc:hideable><!-- Mobile Wrapper -->
							<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
								<tbody>
									<tr>
										<td width="600" align="center"><!-- Order Right -->
											<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
												<tbody>
													<tr>
														<td width="100%" bgcolor="#71a42e" align="center" style="border-top-right-radius: 3px; border-top-left-radius: 3px; background-color: rgb(113, 164, 46);" class="pad20"><!-- Space -->
															<table width="30" border="0" cellpadding="0" cellspacing="0" align="left" class="erase" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																<tbody><tr><td width="100%" height="1"></td></tr></tbody>
															</table><!-- End Space -->
															<table width="400" border="0" cellpadding="0" cellspacing="0" align="left" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																<tbody>
																	<tr>
																		<td width="100%" valign="top" align="center">
																			<div class="sortable_inner ui-sortable">
																				<table width="400" border="0" cellpadding="0" cellspacing="0" align="center" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" object="drag-module-small">
																					<tbody>
																						<tr><td width="100%" height="15" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr>
																							<td valign="middle" width="100%" style="text-align: left; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-weight: bold; line-height: 24px; text-transform: uppercase;" mc:edit="29">
																								<!--[if !mso]><!--><span style="font-family: proxima_nova_rgbold, Helvetica; font-weight: normal;"><!--<![endif]-->payment:<!--[if !mso]><!--></span>
																								<!--<![endif]-->
																							</td>
																						</tr>
																					</tbody>
																				</table>
																			</div>
																		</td>
																	</tr>
																	<tr><td width="100%" height="15" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																</tbody>
															</table>
														</td>
													</tr>
												</tbody>
											</table><!-- End Order Right --><!-- Order Right -->
											<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
												<tbody>
													<tr>
														<td width="100%" bgcolor="#ffffff" style="border-bottom-right-radius: 3px; border-bottom-left-radius: 3px; background-color: rgb(255, 255, 255);" class="pad20">
															<!-- Space -->
															<table width="30" border="0" cellpadding="0" cellspacing="0" align="left" class="erase" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																<tbody><tr><td width="100%" height="1"></td></tr></tbody>
															</table><!-- End Space -->
															<table width="250" border="0" cellpadding="0" cellspacing="0" align="left" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																<tbody>
																	<tr><td width="100%" height="15" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																	<tr>
																		<td width="100%" valign="top" align="center">
																			<div class="sortable_inner ui-sortable">
																				<table width="250" border="0" cellpadding="0" cellspacing="0" align="center" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" object="drag-module-small">
																					<tbody>
																						<tr><td width="100%" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr><td width="100%" height="5" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr>
																							<td valign="middle" width="100%" style="text-align: left; font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: #222222; line-height: 24px; font-weight: normal;" mc:edit="30">
																								<!--[if !mso]><!-->
																								'.$payment_details.'
																								<!--<![endif]-->
																							</td>
																						</tr>
																						<tr><td width="100%" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																					</tbody>
																				</table>
																			</div>
																		</td>
																	</tr>
																	<tr><td width="100%" height="20" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																</tbody>
															</table><!-- Space -->
															<table width="30" border="0" cellpadding="0" cellspacing="0" align="right" class="erase" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																<tbody><tr><td width="100%" height="10"></td></tr></tbody>
															</table><!-- End Space -->
															<table width="250" border="0" cellpadding="0" cellspacing="0" align="right" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																<tbody>
																	<tr><td width="100%" height="25" style="font-size: 1px; line-height: 1px;" class="erase">&nbsp;</td></tr>
																	<tr>
																		<td width="100%" valign="top" align="center">
																			<div class="sortable_inner ui-sortable">
																				<table width="250" border="0" cellpadding="0" cellspacing="0" align="center" class="full" style="border-collapse: collapse; position: relative; z-index: 0;"
																				object="drag-module-small" cu-identifier="element_05166087824665626">
																					<tbody>
																						<tr><td width="100%" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr>
																							<td width="250" valign="top" align="center">
																								<table width="250" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
																									<tbody>
																										<tr>
																											<td width="150" style="text-align: left; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #222222; font-weight: normal; line-height: 24px;" mc:edit="31">
																												<!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]--><p  cu-identify="element_08357365587062129">Subtotal<!--[if !mso]><!--></span>
																												<!--<![endif]-->
																											</td>
																											<td width="100" style="text-align: right; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #222222; font-weight: normal; line-height: 24px;" mc:edit="2-928">
																												<!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]--><p  cu-identify="element_09906574810450846">Rs. '.$order_details['sub_total'].'<!--[if !mso]><!--></span>
																												<!--<![endif]-->
																											</td>
																										</tr>
																									</tbody>
																								</table>
																							</td>
																						</tr>
																						<tr><td width="100%" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr><td width="100%" height="1" bgcolor="#dfdfdf" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr><td width="100%" height="8" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr>
																							<td width="250" valign="top" align="center">
																								<table width="250" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
																									<tbody>
																										<tr>
																											<td width="150" style="text-align: left; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #222222; font-weight: normal; line-height: 24px;" mc:edit="32">
																												<!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]--><p  cu-identify="element_07070737449479834">Shipping Charges<!--[if !mso]><!--></span>
																												<!--<![endif]-->
																											</td>
																											<td width="100" style="text-align: right; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #222222; font-weight: normal; line-height: 24px;" mc:edit="2-22">
																												<!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]--><p  cu-identify="element_09499041805787367">Rs.'.$order_details['delivery_charge'].'<!--[if !mso]><!--></span>
																												<!--<![endif]-->
																											</td>
																										</tr>
																									</tbody>
																								</table>
																							</td>
																						</tr>
																						<tr><td width="100%" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr>
																							<td width="250" valign="top" align="center">
																								<table width="250" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
																									<tbody>
																										<tr>
																											<td width="150" style="text-align: left; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #222222; font-weight: normal; line-height: 24px;" mc:edit="33">
																												<!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]-->Discount<!--[if !mso]><!--></span>
																												<!--<![endif]-->
																											</td>
																											<td width="100" style="text-align: right; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #222222; font-weight: normal; line-height: 24px;" mc:edit="2-23">
																												<!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]--><p  cu-identify="element_07813623902119076"> Rs.'.$order_details['discount_amount'].'<!--[if !mso]><!--></span>
																												<!--<![endif]-->
																											</td>
																										</tr>
																									</tbody>
																								</table>
																							</td>
																						</tr>
																						<tr><td width="100%" height="8" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr><td width="100%" height="1" bgcolor="#dfdfdf" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr><td width="100%" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr>
																							<td width="250" valign="top" align="center">
																								<table width="250" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
																									<tbody>
																										<tr>
																											<td width="150" style="text-align: left; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #222222; font-weight: bold; line-height: 24px;"  mc:edit="34">
																												<!--[if !mso]><!--><span style="font-family: proxima_nova_rgbold, Helvetica; font-weight: normal;"><!--<![endif]-->Total<!--[if !mso]><!--></span>
																												<!--<![endif]-->
																											</td>
																											<td width="100" style="text-align: right; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #222222; font-weight: bold; line-height: 24px;"  mc:edit="2-24">
																												<!--[if !mso]><!--><span style="font-family: proxima_nova_rgbold, Helvetica; font-weight: normal;"><!--<![endif]--><p  cu-identify="element_05173461792879972">Rs. '.$order_total.'<!--[if !mso]><!--></span>
																												<!--<![endif]-->
																											</td>
																										</tr>
																									</tbody>
																								</table>
																							</td>
																						</tr>
																						<tr><td width="100%" height="20" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																					</tbody>
																				</table>
																			</div>
																		</td>
																	</tr>
																	<tr><td width="100%" height="20" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																</tbody>
															</table>
														</td>
													</tr>
												</tbody>
											</table><!-- End Order Right -->
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</td>
				</tr>
			</tbody>
		</table><!-- End Wrapper 6 --><!-- Wrapper 1 -->
		<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full" bgcolor="#e6e4db" style="background-color: rgb(230, 228, 219);">
			<tbody>
				<tr mc:repeatable>
					<td width="100%" valign="top" align="center">
						<div mc:hideable><!-- Wrapper -->
							<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile">
								<tbody>
									<tr>
										<td align="center"><!-- Space -->
											<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
												<tbody><tr><td width="100%" height="30" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr></tbody>
											</table><!-- End Space -->
										</td>
									</tr>
								</tbody>
							</table><!-- End Wrapper -->
						</div>
					</td>
				</tr>
			</tbody>
		</table><!-- Wrapper 1 --><!-- Wrapper 6  -->
		<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile" bgcolor="#e6e4db" style="background-color: rgb(230, 228, 219);">
			<tbody>
				<tr mc:repeatable>
					<td bgcolor="#e6e4db" align="center" style="background-color: rgb(230, 228, 219);">
						<div mc:hideable><!-- Mobile Wrapper -->
							<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
								<tbody>
									<tr>
										<td width="600" valign="top" align="center"><!-- Delivery address -->
											<table width="290" border="0" cellpadding="0" cellspacing="0" align="left" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
												<tbody>
													<tr>
														<td width="100%" class="full" align="center">
															<div class="sortable_inner ui-sortable">
																<table width="290" border="0" cellpadding="0" cellspacing="0" align="center" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" object="drag-module-small">
																	<tbody>
																		<tr>
																			<td width="100%" valign="top" align="center" bgcolor="#71a42e" style="border-top-right-radius: 3px; border-top-left-radius: 3px; background-color: rgb(113, 164, 46);" class="pad20"><!-- Space -->
																				<table width="30" border="0" cellpadding="0" cellspacing="0" align="left" class="erase" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																					<tbody><tr><td width="100%" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr></tbody>
																				</table><!-- End Space -->
																				<table width="220" border="0" cellpadding="0" cellspacing="0" align="left" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																					<tbody>
																						<tr><td width="100%" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr>
                                                                                                                                                                                    <td valign="middle" width="100%" style="text-align: left; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-weight: bold; line-height: 24px; text-transform: uppercase;" mc:edit="35">
                                                                                                                                                                                            <!--[if !mso]><!--><span style="font-family:proxima_nova_rgbold, Helvetica; font-weight: normal;"><!--<![endif]-->Delivery address<!--[if !mso]><!--></span> <!--<![endif]-->
                                                                                                                                                                                    </td>
																						</tr>
																						<tr><td width="100%" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																					</tbody>
																				</table><!-- Space -->
																				<table width="30" border="0" cellpadding="0" cellspacing="0" align="right" class="erase" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																					<tbody><tr><td width="100%" height="1" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr></tbody>
																				</table><!-- End Space -->
																			</td>
																		</tr>
																	</tbody>
																</table>
																<table width="290" border="0" cellpadding="0" cellspacing="0" align="center" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" object="drag-module-small">
																	<tbody>
																		<tr>
																			<td width="100%" valign="top" align="center" bgcolor="#ffffff" style="border-bottom-right-radius: 3px; border-bottom-left-radius: 3px; background-color: rgb(255, 255, 255);" class="pad20"><!-- Space -->
																				<table width="30" border="0" cellpadding="0" cellspacing="0" align="left" class="erase" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																				   <tbody><tr><td width="100%" height="1"></td></tr></tbody>
																				</table><!-- End Space -->
																				<table width="220" border="0" cellpadding="0" cellspacing="0" align="left" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																					<tbody>
																						<tr><td width="100%" height="25" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr>
                                                                                                                                                                                    <td valign="middle" width="100%" style="text-align: left; font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: #222222; line-height: 24px; font-weight: normal;" mc:edit="36"> 
                                                                                                                                                                                    '.$shipping_address.'
                                                                                                                                                                                    </td>
																						</tr>
																						<tr><td width="100%" height="25" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																					</tbody>
																				</table><!-- Space -->
																				<table width="30" border="0" cellpadding="0" cellspacing="0" align="right" class="erase" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																					<tbody><tr><td width="100%" height="1"></td></tr></tbody>
																				</table><!-- End Space -->
																			</td>
																		</tr>
																	</tbody>
																</table>
															</div>
														</td>
													</tr>
												</tbody>
											</table><!-- End Delivery address --><!-- Space -->
											<table width="1" border="0" cellpadding="0" cellspacing="0" align="left" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
												<tbody><tr><td width="100%" height="20"></td></tr></tbody>
											</table><!-- End Space --><!-- Invoice address -->
											<table width="290" border="0" cellpadding="0" cellspacing="0" align="right" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
												<tbody>
													<tr>
														<td width="100%" class="full" align="center">
															<div class="sortable_inner ui-sortable">
																<table width="290" border="0" cellpadding="0" cellspacing="0" align="center" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" object="drag-module-small">
																	<tbody>
																		<tr>
																			<td width="100%" valign="top" align="center" bgcolor="#71a42e" style="border-top-right-radius: 3px; border-top-left-radius: 3px; background-color: rgb(113, 164, 46);" class="pad20"><!-- Space -->
																				<table width="30" border="0" cellpadding="0" cellspacing="0" align="left" class="erase" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																					<tbody><tr><td width="100%" height="1"></td></tr></tbody>
																				</table><!-- End Space -->
																				<table width="220" border="0" cellpadding="0" cellspacing="0" align="left" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																					<tbody>
																						<tr><td width="100%" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr>
																							<td valign="middle" width="100%" style="text-align: left; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-weight: bold; line-height: 24px; text-transform: uppercase;" mc:edit="37">
																								<!--[if !mso]><!--><span style="font-family: proxima_nova_rgbold, Helvetica; font-weight: normal;"><!--<![endif]-->Invoice address<!--[if !mso]><!--></span>
                                                                                                                                                                                        </td>
                                                                                                                                                                                </tr>
																						<tr><td width="100%" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																					</tbody>
																				</table><!-- Space -->
																				<table width="30" border="0" cellpadding="0" cellspacing="0" align="right" class="erase" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																					<tbody><tr><td width="100%" height="1"></td></tr></tbody>
																				</table><!-- End Space -->
																			</td>
																		</tr>
																	</tbody>
																</table>
																<table width="290" border="0" cellpadding="0" cellspacing="0" align="center" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" object="drag-module-small">
																	<tbody>
																		<tr>
																			<td width="100%" valign="top" align="center" bgcolor="#ffffff" style="border-bottom-right-radius: 3px; border-bottom-left-radius: 3px; background-color: rgb(255, 255, 255);"  class="pad20"><!-- Space -->
																				<table width="30" border="0" cellpadding="0" cellspacing="0" align="left" class="erase" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																					<tbody><tr><td width="100%" height="1"></td></tr></tbody>
																				</table><!-- End Space -->
																				<table width="220" border="0" cellpadding="0" cellspacing="0" align="left" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																					<tbody>
																						<tr><td width="100%" height="25" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr>
																							<td valign="middle" width="100%" style="text-align: left; font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: #222222; line-height: 24px; font-weight: normal;" mc:edit="38"> 
                                                                                                                                                                                           '.$billing_address.'
                                                                                                                                                                                          </td>
                                                                                                                                                                                        </tr>
                                                                                                                                                                                        <tr><td width="100%" height="25" style="font-size: 1px; line-height: 1px;">&nbsp;</td> </tr>
                                                                                                                                                                                </tbody>
                                                                                                                                                                        </table><!-- Space -->
                                                                                                                                                                        <table width="30" border="0" cellpadding="0" cellspacing="0" align="right" class="erase" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
                                                                                                                                                                                <tbody><tr><td width="100%" height="15"></td></tr></tbody>
                                                                                                                                                                        </table><!-- End Space -->
                                                                                                                                                                </td>
                                                                                                                                                        </tr>
                                                                                                                                                </tbody>
                                                                                                                                        </table>
															</div>
														</td>
													</tr>
												</tbody>
											</table><!-- End Invoice address --><!-- Space -->
											<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
												<tbody><tr><td width="100%" height="15"></td></tr></tbody>
											</table><!-- End Space -->
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</td>
				</tr>
			</tbody>
		</table> <!-- End Wrapper 6 --><!-- Wrapper 6  -->
		<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile" bgcolor="#e6e4db" style="background-color: rgb(230, 228, 219);">
			<tbody>
				<tr mc:repeatable>
					<td bgcolor="#e6e4db" align="center" style="background-color: rgb(230, 228, 219);">
						<div mc:hideable> <!-- Mobile Wrapper -->
							<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
								<tbody>
									<tr>
										<td width="600" align="center"><!-- Space -->
											<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
												<tbody><tr><td width="100%" height="15"></td></tr></tbody>
											</table><!-- End Space --><!-- Space -->
											<table width="5" border="0" cellpadding="0" cellspacing="0" align="left" class="erase" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
											     <tbody><tr><td width="100%" height="15"></td></tr></tbody>
											</table><!-- End Space --><!-- Text -->
											<table width="580" border="0" cellpadding="0" cellspacing="0" align="left" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
												<tbody>
													<tr>
														<td valign="middle" width="100%" style="text-align: left; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #222222; font-weight: bold; line-height: 24px;" mc:edit="39">
															<!--[if !mso]><!--><span style="font-family: "proxima_novasemibold", Helvetica; font-weight: normal;"><!--<![endif]-->Cancel your order or Questions?<!--[if !mso]><!--></span>
															<!--<![endif]-->
														</td>
													</tr>
													<tr><td width="100%" height="15"></td></tr>
													<tr>
														<td valign="middle" width="100%" style="text-align: left; font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: #222222; line-height: 24px; font-weight: normal;" mc:edit="40">
														  <!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]-->
                                                                                                                            Enjoy your shopping! Visit the <b>My Orders</b> Page in case you wish to return any items. 
                                                                                                                      <br />Please reply to this email or get in touch with our 24x7 <b>Customer Care</b> team.
                                                                                                                    <!--[if !mso]><!--><!--<![endif]-->
                                                                                                                    </span> </td>
													</tr>
												</tbody>
											</table><!-- End Text --><!-- Space -->
                                                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
                                                                                            <tbody><tr><td width="100%" height="15"></td></tr></tbody>
                                                                                    </table><!-- End Space -->
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</td>
				</tr>
			</tbody>
		</table><!-- End Wrapper 6 --><!-- Wrapper 3  -->
		<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full" bgcolor="#e6e4db" style="background-color: rgb(230, 228, 219);">
			<tbody>
				<tr mc:repeatable>
					<td bgcolor="#e6e4db" align="center" style="background-color: rgb(230, 228, 219);">
						<div mc:hideable><!-- Mobile Wrapper -->
							<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile">
								<tbody>
									<tr>
										<td width="600" align="center"><!-- Start Nav -->
											<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full" bgcolor="#2d2d2d" style="border-radius: 3px; background-color: rgb(45, 45, 45);">
												<tbody>
													<tr><td width="100%" height="15"></td></tr>
													<tr>
														<td width="100%" valign="top" class="pad20" align="center"><!-- Copyright Text -->
															<table width="540" border="0" cellpadding="0" cellspacing="0" align="center" style="text-align: center; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="fullCenter">
																<tbody>
																	<tr>
                                                                                                                                            <td valign="top" width="540" align="center" style="text-align: center; font-family: Helvetica, Arial, sans-serif; font-size: 13px; color: #ffffff; line-height: 18px; font-weight: normal;" class="fullCenter" mc:edit="41">
                                                                                                                                                    <!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]--><span  cu-identify="element_0018516645610561433">@ 2019 Zamy. All rights Reserved</span>
                                                                                                                                                    <!--[if !mso]><!--></span><!--<![endif]-->
                                                                                                                                            </td>
																	</tr>
																</tbody>
															</table>
														</td>
													</tr>
													<tr><td width="100%" height="15"></td></tr>
												</tbody>
											</table>
											<!-- End Nav -->
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</td>
				</tr>
			</tbody>
		</table><!-- End 3 -->

<!-- Wrapper 1 -->
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full"  bgcolor="#e6e4db"style="background-color: rgb(230, 228, 219);">
	<tbody><tr mc:repeatable>
		<td width="100%" valign="top" align="center">
		<div mc:hideable><!-- Wrapper -->
			<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile">
				<tbody><tr>
					<td align="center"><!-- Space -->
						<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
							<tbody><tr>
								<td width="100%" height="50"></td>
							</tr>
							<tr>
								<td width="100%" height="1" style="font-size: 1px; line-height: 1px;">&nbsp;</td>
							</tr>
						</tbody></table><!-- End Space -->
					</td>
				</tr>
			</tbody></table><!-- End Wrapper -->
		</div>
		</td>
	</tr>
</tbody></table><!-- Wrapper 1 -->		
	</div>
</body>
</html>
<style>body {background: none !important;}</style>';

	$to = $order_details['billing']['billing_email'];
	//$to = $order_details['shipping']['shipping_email'];
	
	$restaurant_subject = 'Order Failed - Your Order with zamy.in [#'.$order_details['order_id'].'] has been failed!';
	
	$headers = "From: zamy.in<zamyindia@gmail.com>\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n"; 
	
	$mail = mail($to, $restaurant_subject, $message, $headers);
	
	return $mail;
}

function order_failed_confirmation_admin($order_id,$user_id){
	
	$CI = get_instance();
	$CI->load->model('order_model');

	$order_details = $CI->order_model->order_details($order_id,$user_id);
	
	$prodduct_html='';
	
	foreach($order_details['order_items'] as $item){
		$prodduct_html .='
		<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full" object="drag-module-small">
            <tbody>
				<tr><td width="100%" align="center" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
				<tr>
					<td valign="top" align="center" width="100%" style="font-family: Helvetica, Arial, sans-serif; color: #30373a; font-weight: bold; font-size: 15px; line-height: 24px; text-align: center;" class="fullCenter">
						<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="full">
						 <tbody>
							 <tr>
								<td width="20" height="50">&nbsp;&nbsp;&nbsp;&nbsp;</td>
								<td width="50" height="50" valign="middle" style="text-align: left;" class="erase" id="image49">
										<a href="#"><img width="49" src="'.$item['menu_logo'].'" alt="" border="0" style="vertical-align: middle; padding-top: 1px;" mc:edit="17"> </a>
								</td>
								<td width="15" height="50" class="erase"></td>
								<td width="205" height="50" valign="top" class="full">
										<table width="205" border="0" cellpadding="0" cellspacing="0" align="left">
												<tbody>
												<tr><td width="100%" height="2" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
												<tr>
														<td width="100%" style="font-family: Helvetica, Arial, sans-serif; color: #222222; font-weight: bold; font-size: 15px; line-height: 18px; text-align: left;" class="w70" mc:edit="18">
																<!--[if !mso]><!--><span style="font-family: proxima_nova_rgbold, Helvetica; font-weight: normal;"><!--<![endif]--><p  cu-identify="element_0638462864365142">
																<div>'.$item['menu_name'].'</div>
																<!--[if !mso]><!-->
																</span>
																<!--<![endif]-->
														</td>
												</tr>
												<tr><td width="100%" height="5" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
												<tr>
														<td width="100%" style="font-family: Helvetica, Arial, sans-serif; color: #222222; font-weight: normal; font-size: 13px; line-height: 18px; text-align: left;" class="w70" mc:edit="19">
																<!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]-->Delivery: <span style="color: #71a42e;"></span>
																<!--[if !mso]><!-->
																</span>
																<!--<![endif]-->
														</td>
												</tr>
										</tbody>
										</table>
								</td>
								<td width="80" valign="top" height="50" class="erase">
										<table width="80" border="0" cellpadding="0" cellspacing="0" align="right" class="w70">
												<tbody>
														<tr><td width="100%" height="2" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
														<tr>
																<td width="100%" style="font-family: Helvetica, Arial, sans-serif; color: #222222; font-weight: normal; font-size: 14px; line-height: 20px; text-align: right;" class="w70" mc:edit="20">
																		<!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]--><p  cu-identify="element_009125256622760869">Rs. '.$item['price'].'<!--[if !mso]><!--></span>
																		<!--<![endif]-->
																</td>
														</tr>
												</tbody>
										</table>
								</td>
								<td width="40" height="50">&nbsp;&nbsp;</td>
								<td width="80" height="50" valign="top" class="w50">
										<table width="80" border="0" cellpadding="0" cellspacing="0" align="left" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;"
										class="w50">
												<tbody>
														<tr><td width="100%" height="2" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
														<tr>
																<td width="100%" style="font-family: Helvetica, Arial, sans-serif; color: #222222; font-weight: normal; font-size: 14px; line-height: 20px; text-align: left;" class="w50" mc:edit="21">
																		<!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]-->'.$item['qty'].'x<!--[if !mso]><!--></span>
																		<!--<![endif]-->
																</td>
														</tr>
												</tbody>
										</table>
								</td>
								<td width="90" valign="top" height="50" class="erase">
										<table width="90" border="0" cellpadding="0" cellspacing="0" align="right">
												<tbody>
														<tr>
																<td width="100%" style="font-family: Helvetica, Arial, sans-serif; color: #222222; font-weight: normal; font-size: 14px; line-height: 20px; text-align: right;" class="w70" mc:edit="22">
																		<!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]--><p  cu-identify="element_020128349030194048">Rs. '.$item['subtotal'].'<!--[if !mso]><!--></span>
																		<!--<![endif]-->
																</td>
														</tr>
												</tbody>
										</table>
								</td>
								<td width="20" height="50" class="erase"></td>
						 </tr>
					</tbody>
					</table>
				</td>
			</tr>
				<tr><td width="100%" height="1" bgcolor="#f4f4f4" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
				<tr><td width="100%" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
			</tbody>
		</table>';

	}
	
	$delivery_charge = 0;
	if(!empty($order_details['delivery_charge'])){
		$delivery_charge = $order_details['delivery_charge'];
	}
	
	//$order_total = $order_details['order_total'] + $delivery_charge;
	$order_total = $order_details['order_total'];
	
	
	$payment_details = '';
	if(strtolower($order_details['payment_method'])=='cod'){
		$payment_details .= '<span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]--><p  cu-identify="element_02865282806828009">Payment method: <span style="font-family: proxima_nova_rgbold, Helvetica;">'.$order_details['payment_method'].'</span>
				<br>You order has been Pending Payment.
				<!--[if !mso]><!-->
				</span>';
	}else{
	
		$payment_details .= '<span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]--><p  cu-identify="element_02865282806828009">Payment method: <span style="font-family: proxima_nova_rgbold, Helvetica;">'.$order_details['payment_method'].'</span>
				<!--[if !mso]><!-->
				</span>';
	}
	
	
	$billing_address ='<span style="font-weight: bold;">
                    <!--[if !mso]><!-->
                    <span style="font-family: proxima_nova_rgbold, Helvetica; font-weight: normal;">
                    <!--<![endif]-->'.$order_details['billing']['billing_name'].'<!--[if !mso]><!--></span>
                    <!--<![endif]--></span><br>
                    <!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]-->
                      '.$order_details['billing']['billing_address'].'<!--[if !mso]><!--></span><!--<![endif]-->';
	
	$shipping_address ='<span style="font-weight: bold;">
                    <!--[if !mso]><!-->
                    <span style="font-family: proxima_nova_rgbold, Helvetica; font-weight: normal;">
                    <!--<![endif]-->'.$order_details['shipping']['shipping_name'].'<!--[if !mso]><!--></span>
                    <!--<![endif]--></span><br>
                    <!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]-->
                      '.$order_details['shipping']['shipping_address'].'<!--[if !mso]><!--></span><!--<![endif]-->';
	
	$complementary_food = '';			  
	if(!empty($order_details['complementary_food'])){
		$complementary_food = '<tr>
			<td valign="middle" width="100%" style="text-align: center; font-size: 12px;font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-weight: normal; text-transform: uppercase; line-height: 18px;" mc:edit="2">
				<span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;">'.$order_details['complementary_food'].'</span>
			</td>
		</tr>';
	}
	
	$customer_subject = 'Order Failed - Your Order with zamy.in [#'.$order_details['order_id'].'] has been failed!';
	
	$admin_subject = '[Zamy] New customer order ('.$order_details['order_id'].') - '.$order_details['order_date'].'';
	
	$headers = "From: zamy.in<zamyindia@gmail.com>\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n"; 
	
	$message = '';
	$message .= '<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
<title>Order Confirmation - Your Order with zamy.in [#'.$order_details['order_id'].'] has been failed!</title>
<style type="text/css">
div,p,a,li,td {-webkit-text-size-adjust: none;}
* {-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;}
.ReadMsgBody {width: 100%; background-color: #ffffff;}
.ExternalClass {width: 100%;background-color: #ffffff;}
body {width: 100%; height: 100%;margin: 0; padding: 0;-webkit-font-smoothing: antialiased;}
html {background-color: #e6e4db; width: 100%; }
@font-face {font-family: "proxima_novalight"; src: url("http://rocketway.net/themebuilder/products/font/proximanova-light-webfont.eot"); src: url("http://rocketway.net/themebuilder/products/font/proximanova-light-webfont.eot?#iefix") format("embedded-opentype"), url("http://rocketway.net/themebuilder/products/font/proximanova-light-webfont.woff") format("woff"), url("http://rocketway.net/themebuilder/products/font/proximanova-light-webfont.ttf") format("truetype"); font-weight: normal; font-style: normal; }
@font-face {font-family: proxima_nova_rgregular; src: url("http://rocketway.net/themebuilder/products/font/proximanova-regular-webfont.eot"); src: url("http://rocketway.net/themebuilder/products/font/proximanova-regular-webfont.eot?#iefix") format("embedded-opentype"), url("http://rocketway.net/themebuilder/products/font/proximanova-regular-webfont.woff") format("woff"), url("http://rocketway.net/themebuilder/products/font/proximanova-regular-webfont.ttf") format("truetype"); font-weight: normal; font-style: normal; }
@font-face {font-family: "proxima_novasemibold"; src: url("http://rocketway.net/themebuilder/products/font/proximanova-semibold-webfont.eot"); src: url("http://rocketway.net/themebuilder/products/font/proximanova-semibold-webfont.eot?#iefix") format("embedded-opentype"), url("http://rocketway.net/themebuilder/products/font/proximanova-semibold-webfont.woff") format("woff"), url("http://rocketway.net/themebuilder/products/font/proximanova-semibold-webfont.ttf") format("truetype"); font-weight: normal; font-style: normal;}
@font-face {font-family: proxima_nova_rgbold;src: url("http://rocketway.net/themebuilder/products/font/proximanova-bold-webfont.eot");src: url("http://rocketway.net/themebuilder/products/font/proximanova-bold-webfont.eot?#iefix") format("embedded-opentype"), url("http://rocketway.net/themebuilder/products/font/proximanova-bold-webfont.woff") format("woff"), url("http://rocketway.net/themebuilder/products/font/proximanova-bold-webfont.ttf") format("truetype"); font-weight: normal; font-style: normal;}
@font-face {font-family: "proxima_novathin"; src: url("http://rocketway.net/themebuilder/products/font/proximanova-thin-webfont.eot"); src: url("http://rocketway.net/themebuilder/products/font/proximanova-thin-webfont.eot?#iefix") format("embedded-opentype"), url("http://rocketway.net/themebuilder/products/font/proximanova-thin-webfont.woff") format("woff"), url("http://rocketway.net/themebuilder/products/font/proximanova-thin-webfont.ttf") format("truetype"); font-weight: normal;font-style: normal;}
@font-face {font-family: "proxima_novablack";src: url("http://rocketway.net/themebuilder/products/font/proximanova-black-webfont.eot"); src: url("http://rocketway.net/themebuilder/products/font/proximanova-black-webfont.eot?#iefix") format("embedded-opentype"), url("http://rocketway.net/themebuilder/products/font/proximanova-black-webfont.woff") format("woff"), url("http://rocketway.net/themebuilder/products/font/proximanova-black-webfont.ttf") format("truetype");font-weight: normal;font-style: normal;}
@font-face {font-family: "proxima_novaextrabold"; src: url("http://rocketway.net/themebuilder/products/font/proximanova-extrabold-webfont.eot"); src: url("http://rocketway.net/themebuilder/products/font/proximanova-extrabold-webfont.eot?#iefix") format("embedded-opentype"), url("http://rocketway.net/themebuilder/products/font/proximanova-extrabold-webfont.woff2") format("woff2"), url("http://rocketway.net/themebuilder/products/font/proximanova-extrabold-webfont.woff") format("woff"), url("http://rocketway.net/themebuilder/products/font/proximanova-extrabold-webfont.ttf") format("truetype"); font-weight: normal; font-style: normal;}
p {padding: 0!important;margin-top: 0!important;margin-right: 0!important;margin-bottom: 0!important;margin-left: 0!important;}
.hover:hover {opacity: 0.85;filter: alpha(opacity=85);}
.underline:hover {text-decoration: underline!important;}
.jump:hover {opacity: 0.75;filter: alpha(opacity=75); padding-top: 10px!important;}
#image49 img {width: 49px;height: auto;}
</style>
<!-- @media only screen and (max-width: 640px) 
           {*/
           -->
<style type="text/css">
@media only screen and (max-width: 640px) {
        body { width: auto!important; }
        table[class=full] {width: 100%!important; clear: both;}
        table[class=mobile] {width: 100%!important;padding-left: 20px; padding-right: 20px;clear: both; }
        table[class=fullCenter] {width: 100%!important; text-align: center!important; clear: both; }
        td[class=image600] img {width: 100%!important;text-align: center!important; clear: both; }
        td[class=fullCenter] {width: 100%!important; text-align: center!important; clear: both;}
        td[class=full] { width: 100%!important; clear: both;  }
        *[class=erase] { display: none; }
        *[class=buttonScale] { float: none!important; text-align: center!important; display: inline-block!important; clear: both; }
        *[class=buttonLeft] {float: left!important; text-align: left!important; display: inline-block!important;  clear: both; }
        .pad20 { padding-left: 20px!important; padding-right: 20px!important; }
        .w50 {width: 50px!important;}
        .h30 { height: 30px!important; }
}
</style>
<!--
@media only screen and (max-width: 479px) 
           {
           -->
<style type="text/css">
@media only screen and (max-width: 479px) {
        body {width: auto!important;}
        table[class=full] {width: 100%!important; clear: both; }
        table[class=mobile] {width: 100%!important; padding-left: 20px; padding-right: 20px; clear: both;}
        table[class=fullCenter] {width: 100%!important;text-align: center!important; clear: both; }
        td[class=fullCenter] { width: 100%!important; text-align: center!important; clear: both;}
        td[class=full] {width: 100%!important;clear: both; }
        *[class=erase] {display: none; }
        *[class=buttonScale] {float: none!important; text-align: center!important;display: inline-block!important;clear: both; }
        *[class=buttonLeft] { float: left!important; text-align: left!important; display: inline-block!important;clear: both;}
        .pad20 { padding-left: 20px!important; padding-right: 20px!important; }
        .w70 { width: 70px!important; }
        .w50 { width: 50px!important;}
        .h30 { height: 30px!important;  }
}
}
</style>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" yahoo="fix">
	<div class="ui-sortable" id="sort_them"><!-- Wrapper 2 -->
		<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full" bgcolor="#e6e4db" style="background-color: rgb(230, 228, 219);">
			<tbody>
                            <tr mc:repeatable>
                                    <td width="100%" valign="top" align="center">
                                            <div mc:hideable><!-- Wrapper -->
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile">
                                                        <tbody><tr><td align="center"> <!-- Space -->
                                                            <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
                                                                    <tbody><tr> <td width="100%" height="50"></td> </tr></tbody>
                                                            </table> <!-- End Space --> </td>  </tr>
                                                        </tbody>
                                                    </table><!-- End Wrapper -->
                                            </div>
                                    </td>
                            </tr>
			</tbody>
		</table><!-- Wrapper 2 --><!-- Wrapper 3  -->
		<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full" bgcolor="#e6e4db" style="background-color: rgb(230, 228, 219);">
			<tbody>
				<tr mc:repeatable>
					<td bgcolor="#e6e4db" align="center" style="background-color: rgb(230, 228, 219);">
						<div mc:hideable><!-- Mobile Wrapper -->
							<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile">
								<tbody>
									<tr>
										<td width="600" align="center"><!-- Start Nav -->
											<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full" style="background-image: url(http://rocketway.net/themebuilder/products/batch1/templates/template_1/images/header_bg.jpg); background-position: center top; background-repeat:no-preat!important; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; background-position: center center; background-repeat: no-repeat; background-color: #323132; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; bgcolor:#323132" id="BGheaderChange">
												<tbody>
													<tr><td width="100%" height="30"></td></tr>
													<tr>
														<td width="100%" valign="middle" class="pad20" align="center">
															<!-- Nav -->
															<table width="500" border="0" cellpadding="0" cellspacing="0" align="center" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="full">
																<tbody>
																	<tr>
																		<td valign="middle" width="100%" style="text-align: center; font-size: 30px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-weight: bold; line-height: 36px;"  mc:edit="1">
																			<!--[if !mso]><!--><span style="font-family: proxima_nova_rgbold, Helvetica; font-weight: normal;"><!--<![endif]-->New order
!<!--[if !mso]><!--></span>
																			<!--<![endif]-->
																		</td>
																	</tr>
																	<tr><td width="100%" height="6"></td></tr>
																	<tr>
																		<td valign="middle" width="100%" style="text-align: center; font-size: 12px;font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-weight: normal; text-transform: uppercase; line-height: 18px;" mc:edit="2">
																			<!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]-->RESTAURANT : '.$order_details['restaurant_name'].'

<!--[if !mso]><!--></span>
																			<!--<![endif]-->
																		</td>
																	</tr>
																	
																	'.$complementary_food.'
																</tbody>
															</table>
														</td>
													</tr>
													<tr><td width="100%" height="30"></td></tr>
												</tbody>
											</table><!-- End Nav -->
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</td>
				</tr>
			</tbody>
		</table><!-- End 3 --><!-- Wrapper 6  -->
		<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile" bgcolor="#e6e4db" style="background-color: rgb(230, 228, 219);">
			<tbody>
				<tr mc:repeatable>
					<td bgcolor="#e6e4db" valign="top" align="center" style="background-color: rgb(230, 228, 219);">
						<div mc:hideable><!-- Mobile Wrapper -->
							<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
								<tbody>
									<tr>
										<td width="600" valign="top" align="center"><!-- Space -->
											<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
												<tbody><tr><td width="100%" height="35"></td></tr>
												</tbody>
											</table><!-- End Space --><!-- Text Left -->
											<table width="420" border="0" cellpadding="0" cellspacing="0" align="left" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
												<tbody>
													<tr>
														<td valign="top" width="100%" align="center"><!-- SORTABLE -->
															<div class="sortable_inner ui-sortable"><!-- Text -->
																<table width="420" border="0" cellpadding="0" cellspacing="0" align="center" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" object="drag-module-small">
																	<tbody>
																		<tr>
																			<td valign="top" width="100%" align="center"><!-- Text -->
																				<table width="420" border="0" cellpadding="0" cellspacing="0" align="center" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																					<tbody>
																						<tr>
																							<td valign="middle" width="100%" style="text-align: left; font-size: 18px; font-family: Helvetica, Arial, sans-serif; color: #222222; font-weight: bold; line-height: 24px;"
																							mc:edit="3">
																								<!--[if !mso]><!--><span style="font-family: "proxima_novasemibold", Helvetica; font-weight: normal;"><!--<![endif]-->
																								Order #'.$order_details['order_id'].' ('.$order_details['order_date'].')<!--[if !mso]><!--></span>
																								<!--<![endif]-->
																							</td>
																						</tr>
																						<tr><td width="100%" height="10"></td></tr>
																						<tr>
																							<td valign="middle" width="100%" style="text-align: left; font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: #222222; line-height: 24px; font-weight: normal;"  mc:edit="4">
																								<!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]-->
																																																							You have received an order from '.$order_details['billing']['billing_name'].'. The order is as follows:
																																																							</span> </td>
																						</tr>
																						<tr><td width="100%" height="35" class="h30"></td></tr>
																					</tbody>
																				</table><!-- End Text -->
																			</td>
																		</tr>
																	</tbody>
																</table>
															</div>
														</td>
													</tr>
												</tbody>
											</table><!-- Order Right -->
											
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</td>
				</tr>
			</tbody>
		</table><!-- End Wrapper 6 --><!-- Wrapper 1 -->
		<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full" bgcolor="#e6e4db" style="background-color: rgb(230, 228, 219);">
			<tbody>
				<tr mc:repeatable>
					<td width="100%" valign="top" align="center">
						<div mc:hideable><!-- Wrapper -->
							<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile">
								<tbody>
									<tr>
										<td align="center"><!-- Space -->
											<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
												<tbody><tr><td width="100%" height="0" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr></tbody>
											</table><!-- End Space -->
										</td>
									</tr>
								</tbody>
							</table><!-- End Wrapper -->
						</div>
					</td>
				</tr>
			</tbody>
		</table><!-- Wrapper 1 --><!-- Wrapper 6  -->
		<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile" bgcolor="#e6e4db" style="background-color: rgb(230, 228, 219);">
			<tbody>
				<tr mc:repeatable>
					<td bgcolor="#e6e4db" align="center" style="background-color: rgb(230, 228, 219);">
						<div mc:hideable>
							<!-- Mobile Wrapper -->
							<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
								<tbody>
									<tr>
										<td width="600" align="center"><!-- Wrapper -->
											<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full" style="border-radius: 3px; background-color: rgb(255, 255, 255);">
												<tbody>
													<tr>
														<td width="600" align="center" style="border-radius: 3px; background-color: rgb(255, 255, 255);" bgcolor="#ffffff" class="mobile3">
															<!-- Wrapper -->
															<table width="586" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
																<tbody>
																	<tr>
																		<td width="586" align="center" valign="top" style="-webkit-border-bottom-right-radius: 3px; -moz-border-bottom-right-radius: 3px; border-bottom-right-radius: 3px; -webkit-border-bottom-left-radius: 3px; -moz-border-bottom-left-radius: 3px; border-bottom-left-radius: 3px;">
																			<div class="sortable_inner ui-sortable">
																				<!-- Wrapper -->
																				<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full" object="drag-module-small">
																					<tbody>
																						<tr>
																							<td width="100%" align="center" bgcolor="#71a42e" style="border-top-right-radius: 3px; border-top-left-radius: 3px; background-color: rgb(113, 164, 46);">
																								<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
																									<tbody>
																										<tr><td width="100%" height="13" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr><!-- Order Details -->
																										<tr>
																											<td align="center" valign="top" width="600" class="fullCenter">
																												<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="full">
																													<tbody>
																														<tr>
																															<td width="20" height="15"></td>
																															<td width="270" height="15" valign="top" class="fullCenter">
																																<table width="270" border="0" cellpadding="0" cellspacing="0" align="left" class="fullCenter">
																																	<tbody>
																																		<tr>
																																			<td valign="top" width="100%" style="text-align: left; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-weight: bold; line-height: 24px;" class="fullCenter" mc:edit="8">
																																				<!--[if !mso]><!--><span style="font-family: proxima_nova_rgbold, Helvetica; font-weight: normal;">
																																					<!--<![endif]-->ORDER
																																					DETAILS
																																					<!--[if !mso]><!-->
																																					</span>
																																				<!--<![endif]-->
																																			</td>
																																		</tr>
																																	</tbody>
																																</table>
																															</td>
																															<td width="80" height="15" class="erase">
																																<table width="80" border="0" cellpadding="0" cellspacing="0" align="left" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;"
																																class="full">
																																	<tbody>
																																		<tr>
																																			<td valign="top" width="100%" style="text-align: right; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-weight: bold; line-height: 24px;" mc:edit="9">
																																				<!--[if !mso]><!--><span style="font-family: proxima_nova_rgbold, Helvetica; font-weight: normal;"><!--<![endif]-->Price<!--[if !mso]><!--></span>
																																				<!--<![endif]-->
																																			</td>
																																		</tr>
																																	</tbody>
																																</table>
																															</td>
																															<td width="40" height="15" class="erase">&nbsp;&nbsp;</td>
																															<td width="80" height="15" class="erase">
																																<table width="80" border="0" cellpadding="0" cellspacing="0" align="left" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;"
																																class="full">
																																	<tbody>
																																		<tr>
																																			<td valign="top" width="100%" style="text-align: left; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-weight: bold; line-height: 24px;" mc:edit="9-2">
																																				<!--[if !mso]><!--><span style="font-family: proxima_nova_rgbold, Helvetica; font-weight: normal;"><!--<![endif]-->Quantity<!--[if !mso]><!--></span>
																																				<!--<![endif]-->
																																			</td>
																																		</tr>
																																	</tbody>
																																</table>
																															</td>
																															<td width="90" height="15" valign="middle" class="erase">
																																<table width="90" border="0" cellpadding="0" cellspacing="0" align="right" class="w70">
																																	<tbody>
																																		<tr>
																																			<td valign="top" width="100%" style="text-align: right; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-weight: bold; line-height: 24px;" mc:edit="10">
																																				<!--[if !mso]><!--><span style="font-family: proxima_nova_rgbold, Helvetica; font-weight: normal;"><!--<![endif]-->Subtotal<!--[if !mso]><!--></span>
																																				<!--<![endif]-->
																																			</td>
																																		</tr>
																																	</tbody>
																																</table>
																															</td>
																															<td width="20" height="15"></td>
																														</tr>
																													</tbody>
																												</table>
																											</td>
																										</tr>
																										<tr><td width="100%" height="13" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																									</tbody>
																								</table>
																							</td>
																						</tr>
																					</tbody>
																				</table>
																				<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full" object="drag-module-small">
																					<tbody><tr><td width="100%" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr></tbody>
																				</table><!-- End Wrapper 2 -->'.$prodduct_html.'<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full" style="-webkit-border-bottom-right-radius: 3px; -moz-border-bottom-right-radius: 3px; border-bottom-right-radius: 3px; -webkit-border-bottom-left-radius: 3px; -moz-border-bottom-left-radius: 3px; border-bottom-left-radius: 3px;"  object="drag-module-small">
																	                        <tbody><tr><td width="100%" height="30" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr></tbody>
																				</table><!-- End Wrapper 2 -->
																			</div>
																		</td>
																	</tr>
																</tbody>
															</table>
														</td>
													</tr>
												</tbody>
											</table>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</td>
				</tr>
			</tbody>
		</table><!-- End Wrapper 6 --><!-- Wrapper 1 -->
		<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full" bgcolor="#e6e4db" style="background-color: rgb(230, 228, 219);">
			<tbody>
				<tr mc:repeatable>
					<td width="100%" valign="top" align="center">
						<div mc:hideable><!-- Wrapper -->
							<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile">
								<tbody>
									<tr>
										<td align="center"><!-- Space -->
											<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
												<tbody><tr><td width="100%" height="30" align="center" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr></tbody>
											</table><!-- End Space -->
										</td>
									</tr>
								</tbody>
							</table><!-- End Wrapper -->
						</div>
					</td>
				</tr>
			</tbody>
		</table><!-- Wrapper 1 --><!-- Wrapper 6  -->
		<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile" bgcolor="#e6e4db" style="background-color: rgb(230, 228, 219);">
			<tbody>
				<tr mc:repeatable>
					<td bgcolor="#e6e4db" align="center" style="background-color: rgb(230, 228, 219);">
						<div mc:hideable><!-- Mobile Wrapper -->
							<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
								<tbody>
									<tr>
										<td width="600" align="center"><!-- Order Right -->
											<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
												<tbody>
													<tr>
														<td width="100%" bgcolor="#71a42e" align="center" style="border-top-right-radius: 3px; border-top-left-radius: 3px; background-color: rgb(113, 164, 46);" class="pad20"><!-- Space -->
															<table width="30" border="0" cellpadding="0" cellspacing="0" align="left" class="erase" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																<tbody><tr><td width="100%" height="1"></td></tr></tbody>
															</table><!-- End Space -->
															<table width="400" border="0" cellpadding="0" cellspacing="0" align="left" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																<tbody>
																	<tr>
																		<td width="100%" valign="top" align="center">
																			<div class="sortable_inner ui-sortable">
																				<table width="400" border="0" cellpadding="0" cellspacing="0" align="center" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" object="drag-module-small">
																					<tbody>
																						<tr><td width="100%" height="15" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr>
																							<td valign="middle" width="100%" style="text-align: left; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-weight: bold; line-height: 24px; text-transform: uppercase;" mc:edit="29">
																								<!--[if !mso]><!--><span style="font-family: proxima_nova_rgbold, Helvetica; font-weight: normal;"><!--<![endif]-->payment:<!--[if !mso]><!--></span>
																								<!--<![endif]-->
																							</td>
																						</tr>
																					</tbody>
																				</table>
																			</div>
																		</td>
																	</tr>
																	<tr><td width="100%" height="15" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																</tbody>
															</table>
														</td>
													</tr>
												</tbody>
											</table><!-- End Order Right --><!-- Order Right -->
											<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
												<tbody>
													<tr>
														<td width="100%" bgcolor="#ffffff" style="border-bottom-right-radius: 3px; border-bottom-left-radius: 3px; background-color: rgb(255, 255, 255);" class="pad20">
															<!-- Space -->
															<table width="30" border="0" cellpadding="0" cellspacing="0" align="left" class="erase" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																<tbody><tr><td width="100%" height="1"></td></tr></tbody>
															</table><!-- End Space -->
															<table width="250" border="0" cellpadding="0" cellspacing="0" align="left" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																<tbody>
																	<tr><td width="100%" height="15" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																	<tr>
																		<td width="100%" valign="top" align="center">
																			<div class="sortable_inner ui-sortable">
																				<table width="250" border="0" cellpadding="0" cellspacing="0" align="center" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" object="drag-module-small">
																					<tbody>
																						<tr><td width="100%" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr><td width="100%" height="5" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr>
																							<td valign="middle" width="100%" style="text-align: left; font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: #222222; line-height: 24px; font-weight: normal;" mc:edit="30">
																								<!--[if !mso]><!-->
																								'.$payment_details.'
																								<!--<![endif]-->
																							</td>
																						</tr>
																						<tr><td width="100%" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																					</tbody>
																				</table>
																			</div>
																		</td>
																	</tr>
																	<tr><td width="100%" height="20" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																</tbody>
															</table><!-- Space -->
															<table width="30" border="0" cellpadding="0" cellspacing="0" align="right" class="erase" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																<tbody><tr><td width="100%" height="10"></td></tr></tbody>
															</table><!-- End Space -->
															<table width="250" border="0" cellpadding="0" cellspacing="0" align="right" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																<tbody>
																	<tr><td width="100%" height="25" style="font-size: 1px; line-height: 1px;" class="erase">&nbsp;</td></tr>
																	<tr>
																		<td width="100%" valign="top" align="center">
																			<div class="sortable_inner ui-sortable">
																				<table width="250" border="0" cellpadding="0" cellspacing="0" align="center" class="full" style="border-collapse: collapse; position: relative; z-index: 0;"
																				object="drag-module-small" cu-identifier="element_05166087824665626">
																					<tbody>
																						<tr><td width="100%" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr>
																							<td width="250" valign="top" align="center">
																								<table width="250" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
																									<tbody>
																										<tr>
																											<td width="150" style="text-align: left; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #222222; font-weight: normal; line-height: 24px;" mc:edit="31">
																												<!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]--><p  cu-identify="element_08357365587062129">Subtotal<!--[if !mso]><!--></span>
																												<!--<![endif]-->
																											</td>
																											<td width="100" style="text-align: right; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #222222; font-weight: normal; line-height: 24px;" mc:edit="2-928">
																												<!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]--><p  cu-identify="element_09906574810450846">Rs. '.$order_details['sub_total'].'<!--[if !mso]><!--></span>
																												<!--<![endif]-->
																											</td>
																										</tr>
																									</tbody>
																								</table>
																							</td>
																						</tr>
																						<tr><td width="100%" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr><td width="100%" height="1" bgcolor="#dfdfdf" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr><td width="100%" height="8" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr>
																							<td width="250" valign="top" align="center">
																								<table width="250" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
																									<tbody>
																										<tr>
																											<td width="150" style="text-align: left; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #222222; font-weight: normal; line-height: 24px;" mc:edit="32">
																												<!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]--><p  cu-identify="element_07070737449479834">Shipping Charges<!--[if !mso]><!--></span>
																												<!--<![endif]-->
																											</td>
																											<td width="100" style="text-align: right; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #222222; font-weight: normal; line-height: 24px;" mc:edit="2-22">
																												<!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]--><p  cu-identify="element_09499041805787367">Rs.'.$order_details['delivery_charge'].'<!--[if !mso]><!--></span>
																												<!--<![endif]-->
																											</td>
																										</tr>
																									</tbody>
																								</table>
																							</td>
																						</tr>
																						<tr><td width="100%" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr>
																							<td width="250" valign="top" align="center">
																								<table width="250" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
																									<tbody>
																										<tr>
																											<td width="150" style="text-align: left; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #222222; font-weight: normal; line-height: 24px;" mc:edit="33">
																												<!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]-->Discount<!--[if !mso]><!--></span>
																												<!--<![endif]-->
																											</td>
																											<td width="100" style="text-align: right; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #222222; font-weight: normal; line-height: 24px;" mc:edit="2-23">
																												<!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]--><p  cu-identify="element_07813623902119076"> Rs.'.$order_details['discount_amount'].'<!--[if !mso]><!--></span>
																												<!--<![endif]-->
																											</td>
																										</tr>
																									</tbody>
																								</table>
																							</td>
																						</tr>
																						<tr><td width="100%" height="8" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr><td width="100%" height="1" bgcolor="#dfdfdf" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr><td width="100%" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr>
																							<td width="250" valign="top" align="center">
																								<table width="250" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
																									<tbody>
																										<tr>
																											<td width="150" style="text-align: left; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #222222; font-weight: bold; line-height: 24px;"  mc:edit="34">
																												<!--[if !mso]><!--><span style="font-family: proxima_nova_rgbold, Helvetica; font-weight: normal;"><!--<![endif]-->Total<!--[if !mso]><!--></span>
																												<!--<![endif]-->
																											</td>
																											<td width="100" style="text-align: right; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #222222; font-weight: bold; line-height: 24px;"  mc:edit="2-24">
																												<!--[if !mso]><!--><span style="font-family: proxima_nova_rgbold, Helvetica; font-weight: normal;"><!--<![endif]--><p  cu-identify="element_05173461792879972">Rs. '.$order_details['order_total'].'<!--[if !mso]><!--></span>
																												<!--<![endif]-->
																											</td>
																										</tr>
																									</tbody>
																								</table>
																							</td>
																						</tr>
																						<tr><td width="100%" height="20" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																					</tbody>
																				</table>
																			</div>
																		</td>
																	</tr>
																	<tr><td width="100%" height="20" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																</tbody>
															</table>
														</td>
													</tr>
												</tbody>
											</table><!-- End Order Right -->
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</td>
				</tr>
			</tbody>
		</table><!-- End Wrapper 6 --><!-- Wrapper 1 -->
		<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full" bgcolor="#e6e4db" style="background-color: rgb(230, 228, 219);">
			<tbody>
				<tr mc:repeatable>
					<td width="100%" valign="top" align="center">
						<div mc:hideable><!-- Wrapper -->
							<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile">
								<tbody>
									<tr>
										<td align="center"><!-- Space -->
											<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
												<tbody><tr><td width="100%" height="30" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr></tbody>
											</table><!-- End Space -->
										</td>
									</tr>
								</tbody>
							</table><!-- End Wrapper -->
						</div>
					</td>
				</tr>
			</tbody>
		</table><!-- Wrapper 1 --><!-- Wrapper 6  -->
		<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile" bgcolor="#e6e4db" style="background-color: rgb(230, 228, 219);">
			<tbody>
				<tr mc:repeatable>
					<td bgcolor="#e6e4db" align="center" style="background-color: rgb(230, 228, 219);">
						<div mc:hideable><!-- Mobile Wrapper -->
							<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
								<tbody>
									<tr>
										<td width="600" valign="top" align="center"><!-- Delivery address -->
											<table width="290" border="0" cellpadding="0" cellspacing="0" align="left" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
												<tbody>
													<tr>
														<td width="100%" class="full" align="center">
															<div class="sortable_inner ui-sortable">
																<table width="290" border="0" cellpadding="0" cellspacing="0" align="center" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" object="drag-module-small">
																	<tbody>
																		<tr>
																			<td width="100%" valign="top" align="center" bgcolor="#71a42e" style="border-top-right-radius: 3px; border-top-left-radius: 3px; background-color: rgb(113, 164, 46);" class="pad20"><!-- Space -->
																				<table width="30" border="0" cellpadding="0" cellspacing="0" align="left" class="erase" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																					<tbody><tr><td width="100%" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr></tbody>
																				</table><!-- End Space -->
																				<table width="220" border="0" cellpadding="0" cellspacing="0" align="left" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																					<tbody>
																						<tr><td width="100%" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr>
                                                                                                                                                                                    <td valign="middle" width="100%" style="text-align: left; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-weight: bold; line-height: 24px; text-transform: uppercase;" mc:edit="35">
                                                                                                                                                                                            <!--[if !mso]><!--><span style="font-family:proxima_nova_rgbold, Helvetica; font-weight: normal;"><!--<![endif]-->Delivery address<!--[if !mso]><!--></span> <!--<![endif]-->
                                                                                                                                                                                    </td>
																						</tr>
																						<tr><td width="100%" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																					</tbody>
																				</table><!-- Space -->
																				<table width="30" border="0" cellpadding="0" cellspacing="0" align="right" class="erase" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																					<tbody><tr><td width="100%" height="1" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr></tbody>
																				</table><!-- End Space -->
																			</td>
																		</tr>
																	</tbody>
																</table>
																<table width="290" border="0" cellpadding="0" cellspacing="0" align="center" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" object="drag-module-small">
																	<tbody>
																		<tr>
																			<td width="100%" valign="top" align="center" bgcolor="#ffffff" style="border-bottom-right-radius: 3px; border-bottom-left-radius: 3px; background-color: rgb(255, 255, 255);" class="pad20"><!-- Space -->
																				<table width="30" border="0" cellpadding="0" cellspacing="0" align="left" class="erase" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																				   <tbody><tr><td width="100%" height="1"></td></tr></tbody>
																				</table><!-- End Space -->
																				<table width="220" border="0" cellpadding="0" cellspacing="0" align="left" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																					<tbody>
																						<tr><td width="100%" height="25" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr>
                                                                                                                                                                                    <td valign="middle" width="100%" style="text-align: left; font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: #222222; line-height: 24px; font-weight: normal;" mc:edit="36"> 
                                                                                                                                                                                    '.$shipping_address.'
                                                                                                                                                                                    </td>
																						</tr>
																						<tr><td width="100%" height="25" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																					</tbody>
																				</table><!-- Space -->
																				<table width="30" border="0" cellpadding="0" cellspacing="0" align="right" class="erase" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																					<tbody><tr><td width="100%" height="1"></td></tr></tbody>
																				</table><!-- End Space -->
																			</td>
																		</tr>
																	</tbody>
																</table>
															</div>
														</td>
													</tr>
												</tbody>
											</table><!-- End Delivery address --><!-- Space -->
											<table width="1" border="0" cellpadding="0" cellspacing="0" align="left" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
												<tbody><tr><td width="100%" height="20"></td></tr></tbody>
											</table><!-- End Space --><!-- Invoice address -->
											<table width="290" border="0" cellpadding="0" cellspacing="0" align="right" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
												<tbody>
													<tr>
														<td width="100%" class="full" align="center">
															<div class="sortable_inner ui-sortable">
																<table width="290" border="0" cellpadding="0" cellspacing="0" align="center" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" object="drag-module-small">
																	<tbody>
																		<tr>
																			<td width="100%" valign="top" align="center" bgcolor="#71a42e" style="border-top-right-radius: 3px; border-top-left-radius: 3px; background-color: rgb(113, 164, 46);" class="pad20"><!-- Space -->
																				<table width="30" border="0" cellpadding="0" cellspacing="0" align="left" class="erase" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																					<tbody><tr><td width="100%" height="1"></td></tr></tbody>
																				</table><!-- End Space -->
																				<table width="220" border="0" cellpadding="0" cellspacing="0" align="left" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																					<tbody>
																						<tr><td width="100%" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr>
																							<td valign="middle" width="100%" style="text-align: left; font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-weight: bold; line-height: 24px; text-transform: uppercase;" mc:edit="37">
																								<!--[if !mso]><!--><span style="font-family: proxima_nova_rgbold, Helvetica; font-weight: normal;"><!--<![endif]-->Billing Information<!--[if !mso]><!--></span>
                                                                                                                                                                                        </td>
                                                                                                                                                                                </tr>
																						<tr><td width="100%" height="10" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																					</tbody>
																				</table><!-- Space -->
																				<table width="30" border="0" cellpadding="0" cellspacing="0" align="right" class="erase" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																					<tbody><tr><td width="100%" height="1"></td></tr></tbody>
																				</table><!-- End Space -->
																			</td>
																		</tr>
																	</tbody>
																</table>
																<table width="290" border="0" cellpadding="0" cellspacing="0" align="center" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" object="drag-module-small">
																	<tbody>
																		<tr>
																			<td width="100%" valign="top" align="center" bgcolor="#ffffff" style="border-bottom-right-radius: 3px; border-bottom-left-radius: 3px; background-color: rgb(255, 255, 255);"  class="pad20"><!-- Space -->
																				<table width="30" border="0" cellpadding="0" cellspacing="0" align="left" class="erase" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																					<tbody><tr><td width="100%" height="1"></td></tr></tbody>
																				</table><!-- End Space -->
																				<table width="220" border="0" cellpadding="0" cellspacing="0" align="left" class="full" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
																					<tbody>
																						<tr><td width="100%" height="25" style="font-size: 1px; line-height: 1px;">&nbsp;</td></tr>
																						<tr>
																							<td valign="middle" width="100%" style="text-align: left; font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: #222222; line-height: 24px; font-weight: normal;" mc:edit="38"> 
                                                                                                                                                                                           '.$billing_address.'
                                                                                                                                                                                          </td>
                                                                                                                                                                                        </tr>
                                                                                                                                                                                        <tr><td width="100%" height="25" style="font-size: 1px; line-height: 1px;">&nbsp;</td> </tr>
                                                                                                                                                                                </tbody>
                                                                                                                                                                        </table><!-- Space -->
                                                                                                                                                                        <table width="30" border="0" cellpadding="0" cellspacing="0" align="right" class="erase" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
                                                                                                                                                                                <tbody><tr><td width="100%" height="15"></td></tr></tbody>
                                                                                                                                                                        </table><!-- End Space -->
                                                                                                                                                                </td>
                                                                                                                                                        </tr>
                                                                                                                                                </tbody>
                                                                                                                                        </table>
															</div>
														</td>
													</tr>
												</tbody>
											</table><!-- End Invoice address --><!-- Space -->
											<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
												<tbody><tr><td width="100%" height="15"></td></tr></tbody>
											</table><!-- End Space -->
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</td>
				</tr>
			</tbody>
		</table> <!-- End Wrapper 6 --><!-- Wrapper 6  -->
		<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile" bgcolor="#e6e4db" style="background-color: rgb(230, 228, 219);">
			<tbody>
				<tr mc:repeatable>
					<td bgcolor="#e6e4db" align="center" style="background-color: rgb(230, 228, 219);">
						<div mc:hideable> <!-- Mobile Wrapper -->
							<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
								<tbody>
									<tr>
										<td width="600" align="center"><!-- Space -->
											<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
												<tbody><tr><td width="100%" height="15"></td></tr></tbody>
											</table><!-- End Space --><!-- Space -->
											<table width="5" border="0" cellpadding="0" cellspacing="0" align="left" class="erase" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
											     <tbody><tr><td width="100%" height="15"></td></tr></tbody>
											</table><!-- End Space --><!-- Text -->
											<!-- End Text --><!-- Space -->
                                                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
                                                                                            <tbody><tr><td width="100%" height="15"></td></tr></tbody>
                                                                                    </table><!-- End Space -->
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</td>
				</tr>
			</tbody>
		</table><!-- End Wrapper 6 --><!-- Wrapper 3  -->
		<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full" bgcolor="#e6e4db" style="background-color: rgb(230, 228, 219);">
			<tbody>
				<tr mc:repeatable>
					<td bgcolor="#e6e4db" align="center" style="background-color: rgb(230, 228, 219);">
						<div mc:hideable><!-- Mobile Wrapper -->
							<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile">
								<tbody>
									<tr>
										<td width="600" align="center"><!-- Start Nav -->
											<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="full" bgcolor="#2d2d2d" style="border-radius: 3px; background-color: rgb(45, 45, 45);">
												<tbody>
													<tr><td width="100%" height="15"></td></tr>
													<tr>
														<td width="100%" valign="top" class="pad20" align="center"><!-- Copyright Text -->
															<table width="540" border="0" cellpadding="0" cellspacing="0" align="center" style="text-align: center; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" class="fullCenter">
																<tbody>
																	<tr>
                                                                                                                                            <td valign="top" width="540" align="center" style="text-align: center; font-family: Helvetica, Arial, sans-serif; font-size: 13px; color: #ffffff; line-height: 18px; font-weight: normal;" class="fullCenter" mc:edit="41">
                                                                                                                                                    <!--[if !mso]><!--><span style="font-family: proxima_nova_rgregular, Helvetica; font-weight: normal;"><!--<![endif]--><span  cu-identify="element_0018516645610561433">@ 2019 Zamy. All rights Reserved</span>
                                                                                                                                                    <!--[if !mso]><!--></span><!--<![endif]-->
                                                                                                                                            </td>
																	</tr>
																</tbody>
															</table>
														</td>
													</tr>
													<tr><td width="100%" height="15"></td></tr>
												</tbody>
											</table>
											<!-- End Nav -->
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</td>
				</tr>
			</tbody>
		</table><!-- End 3 -->

<!-- Wrapper 1 -->
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full"  bgcolor="#e6e4db"style="background-color: rgb(230, 228, 219);">
	<tbody><tr mc:repeatable>
		<td width="100%" valign="top" align="center">
		<div mc:hideable><!-- Wrapper -->
			<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="mobile">
				<tbody><tr>
					<td align="center"><!-- Space -->
						<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="full">
							<tbody><tr>
								<td width="100%" height="50"></td>
							</tr>
							<tr>
								<td width="100%" height="1" style="font-size: 1px; line-height: 1px;">&nbsp;</td>
							</tr>
						</tbody></table><!-- End Space -->
					</td>
				</tr>
			</tbody></table><!-- End Wrapper -->
		</div>
		</td>
	</tr>
</tbody></table><!-- Wrapper 1 -->		
	</div>
</body>
</html>
<style>body {background: none !important;}</style>';

	$restaurant_email	= $order_details['restaurant_email'];
	$admin_email		= 'zamyindia@gmail.com';
	
	$restaurant_subject = 'Order Failed - Your Order with zamy.in [#'.$order_details['order_id'].'] has been failed!';
	
	$admin_subject = '[Zamy] New customer order ('.$order_details['order_id'].') - '.$order_details['order_date'].'';
	
	mail($admin_email, $admin_subject, $message, $headers);
	
	$mail = mail($restaurant_email, $restaurant_subject, $message, $headers);
	
	return $mail;
}



