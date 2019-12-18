<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.6/dist/loadingoverlay.min.js"></script>
<div class="bread-crumbs-wrapper">
	<div class="container">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?php echo base_url();?>" title="" itemprop="url">Home</a></li>
			<li class="breadcrumb-item">Cart</li>
			<li class="breadcrumb-item active">Checkout</li>
		</ol>
	</div>
</div>

<section> 
<div class="block gray-bg">
<div class="sec-box bottom-padd140">
<div class="container">
<div class="row">
<div class="col-md-12 col-sm-12 col-lg-12">
<div class="sec-wrapper">

<div class="row">
<form method="post" action="<?php echo base_url('checkout/process_order');?>" id="checkout_form" class="checkout_form">
<?php //echo form_open( array('class'=>'checkout_form','method'=>'post')) ?>
	<div class="col-md-8 col-sm-12 col-lg-8">
		<div class="restaurant-checkout-wrapper">
			<div class="row">
				<?php 
			
				if(!empty($address_book)){
					$add_count = 0;
					foreach($address_book as $data){
					
					if($data['address_type']=='Home'){
						$address_class="fa fa-home";
					}else if($data['address_type']=='Office'){
						$address_class="fa fa-building";
					}else{
						$address_class="fa fa-map-marker";
					}
					if($data['address_type']=='Other'){
						$address_type = $data['other_address_type'];
					}else{
						$address_type = $data['address_type'];
					}
					$address ='';
					
					$address .= $data['address_1'].", ";
					if(!empty($data['address_2'])){
						$address .= $data['address_2'];
					}
					$address .= $data['shipping_area'].", ";
					$address .= $data['city'].", ";
					$address .= $data['state']."-";
					$address .= $data['postcode'].", ";
					$address .= $data['country'];
				?>
				<div class="col-md-6 col-sm-6 col-lg-6 address_list">
					<div class="checkout-address-box style3 brd-rd5 wow fadeInUp" data-wow-delay="0.2s">   
						<?php 
						if($add_count==0){
							$checked = '';
							//$checked = 'checked';
						}else{
							$checked = '';
						}
						?>
						<input type="radio" onchange="check_shipping_address('<?php echo $data['id']?>');" name="address_id" class="address-radio-btn" id="address_id_<?php echo $data['id']?>" <?php echo $checked;?> value="<?php echo $data['id']?>">
						<label for="address_id_<?php echo $data['id']?>" class="address-radio-label">
							<div class="checkout-address-info">              
								<h4 itemprop="headline"><i class="<?php echo $address_class;?>"></i> <?php echo $address_type;?></h4>
								<p><?php echo $address;?></p>                                  
								<!--<ul class="post-meta">                     
									<li><i class="flaticon-transport"></i> 30min</li>                         
								</ul>-->

								<div class="clearfix"></div>                                          
								<span class="brd-rd30 dtl-btn" href="#" title="Order Online"> DELIVER HERE</span>
							</div> 
						</label>                
					</div>
				</div>
				<?php 
				$add_count++;
				}
				}else{
				?>
				<div class="col-md-6 col-sm-6 col-lg-6">
					<div class="checkout-address-box style3 brd-rd5 wow fadeInUp" data-wow-delay="0.2s"> 
						You don't have any saved address, Please add new address for delivery.
					</div>
				</div>
				<input type="radio" name="address_id" class="address-radio-btn" id="address_id" value="">
				<?php 
				}
				?>
				<div class="col-md-6 col-sm-6 col-lg-6">
					<div class="checkout-address-box style3 brd-rd5 wow fadeInUp" data-wow-delay="0.2s">      
							<div class="checkout-address-info checkout-add-address">              
								<h4 itemprop="headline">Add New Address</h4>
								<a href="<?php echo base_url('my_account/addresses/add?redirect=checkout');?>" itemprop="url" title="Add New" class="add-new-btn brd-rd30 dtl-btn"> Add New</a>
							</div>
					</div>
				</div>
			</div>
		</div> 
		<div id="payment_method_wrapper" class="payment_method_wrapper top-padd80">
			<ul class="payment-order-list-inner payment_methods">
				<li>
				<input id="payment_method_cod" type="radio" class="input-radio" name="payment_method" value="cod" data-order_button_text="">
				 <label for="payment_method_cod">
				 Cash on delivery 	
				 </label>
				</li>
				<li id="payment_method_paytm_li">
				<input id="payment_method_paytm" type="radio" class="input-radio" name="payment_method" value="paytm" checked="checked" data-order_button_text="">
				 <label for="payment_method_paytm">
				 Paytm <img src="https://www.hopmeal.com/wp-content/plugins/paytm/images/logo.gif" alt="Paytm">	</label>
				</li>
				<li id="payment_method_instamojo_li">
				<input id="payment_method_instamojo" type="radio" class="input-radio" name="payment_method" value="instamojo" checked="checked" data-order_button_text="">
				 <label for="payment_method_instamojo">
				 Instamojo <img height="50" width="200" src="<?php echo base_url().'uploads/bank_detail/instamojo.png' ?>" alt="instamojo">	</label>
				</li>
				<li id="payment_method_razorpay_li">
				<input id="payment_method_razorpay" type="radio" class="input-radio" name="payment_method" value="razorpay" checked="checked" data-order_button_text="">
				 <label for="payment_method_razorpay">
				 Razorpay <img height="50" width="200" src="<?php echo base_url().'uploads/bank_detail/instamojo.png' ?>" alt="Razorpay">	</label>
				</li> 
			</ul> 
		</div>
		<div class="coupon_code_wrapper"> 
			<input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="Coupon code"> 
			<input type="button" class="button" name="apply_coupon" id="apply_coupon" value="Apply Coupon" disabled="disabled">
		</div>
		<div class="couponcode_div text-left"> 
			<a href="javascrop:vopid(0);" data-toggle="modal" data-target="#coupon_Modal" class="coupon-popup-btn">View Coupons</a>
		</div>
		<div id="coupon_message"></div>
	</div>
	<div class="col-md-4 col-sm-12 col-lg-4">
	
	
		<div class="order-wrapper">
			<div class="order-inner gradient-brd order-checkout-sdbr">
				<span class="clear_cart_span pull-right">
					<button type="button" class="brd-rd2 clear_cart_span" onclick="clear_cart()">CLEAR CART</button>
				</span>
				<div class="featured-restaurant-box with-bg style2 brd-rd12 wow fadeIn" data-wow-delay="0.1s">
					<div class="featured-restaurant-thumb">
						<a href="<?php echo base_url('restaurants/'.$restaurant_details['res_alias']);?>" title="" itemprop="url">
						<?php
							$resto_logo = 'no_image_resto.jpg'; 
							if(!empty( $restaurant_details['images']) && file_exists( $this->config->item('restaurant_image_basepath').$restaurant_details['images'])){
							  $resto_logo = $this->config->item('restaurant_image_url').$restaurant_details['images'];
							}
						?>
						<img src="<?php echo $resto_logo; ?>" alt="most-popular-img1.png" itemprop="image">
						</a>
					</div>
					<div class="featured-restaurant-info">     
						<h4 itemprop="headline">
						<a href="<?php echo base_url('restaurants/'.$restaurant_details['res_alias']);?>" title="" itemprop="url">
						<?php echo $restaurant_details['res_name']?>
						</a>
						</h4>
						<div class=""><?php echo $restaurant_details['area']?>
						<ul class="post-meta">                     
							<li><i class="flaticon-transport"></i> <?php echo $restaurant_details['approx_delivery_time']?></li>                         
						</ul>
						</div>
					</div>
				</div>                                                    
				<div class="order-list-wrapper" id="add_to_cart">
					<ul class="order-list-inner" id="orders">
						<?php
						$cart_restaurant_id='';
						if(!empty($cart_items)){
						$item_count=1;
						
						foreach($cart_items as $order){
						
						$cart_restaurant_id = $order['restaurant_id'];
						
						$variation_name = !empty($order['variation_name']) ?  $order['variation_name'] :'';
						$foodmenu_id = $order['food_menu_id'];
						$variation_id = $order['variation_id'];
						$var_class = "";
						
						$get_choice = $this->common_model->get_field_by_id('foodmenu','choice',array('foodmenu_id'=>$foodmenu_id));
						
						if(!empty($get_choice)){
							$choice = explode(',', $get_choice);
							$veg_class = 'veg-ic'; //For veg
							if(in_array('2',$choice)){
								$veg_class = 'non-veg-ic';  //For non-veg
							}
						}
						?>
						
						<li id="<?php echo $foodmenu_id ?>" data-menu_id="<?php echo $foodmenu_id ?>" data-menu_variation="<?php echo $foodmenu_id.$variation_id ?>" data-variation="<?php echo $variation_id ?>" data-menu_price="<?php echo $order["price"]; ?>" class="menu_item_<?php echo $foodmenu_id.$variation_id ?>">
							<div class="dish-name">
								<i class="<?php echo $veg_class;?>"></i>
								<h6 itemprop="headline"><?php echo $order["menu_name"].$variation_name; ?></h6> 
								
								<span class="price">
									<i class="fa fa-inr"></i>
									<span class="item_price_<?php echo $foodmenu_id.$variation_id ?>"><?php echo $order["subtotal"]; ?></span>
								</span>
								
								<div class="qty-wrap mor-ingredients">
									<input id="tch3_<?php echo $foodmenu_id.$variation_id;?>" data-rowid="<?php echo $foodmenu_id.$variation_id ?>" type="text" value="<?php echo $order["qty"]; ?>" class="qty" name="tch3_23" data-bts-button-down-class="qty_btn btn btn-secondary btn-outline" data-bts-button-up-class="qty_btn btn btn-secondary btn-outline">
									
									<button type="button"class="brd-rd2 qty_btn btn btn-secondary btn-outline bootstrap-touchspin-down" onclick="remove_menu_item(<?php echo $foodmenu_id.$variation_id ?>)" data-bts-button-down-class="qty_btn_rm btn btn-secondary btn-outline" ><i class="fa fa-trash" id="tch_rm_<?php echo $foodmenu_id.$variation_id;?>" data-rowid="<?php echo $foodmenu_id.$variation_id ?>" value="0" data-rowid="<?php echo $foodmenu_id.$variation_id ?>"></i></button>
								</div>
							</div>
						</li>
						<?php
						echo '<script type="text/javascript">
							i= $("#tch3_"+'.$order['food_menu_id'].$variation_id.').TouchSpin({
								initval: 40,
								min: 1,
							}); 
							
							i.on("touchspin.on.startspin", function () {   
								var qty = $(this).val(); 
								var menu_id = "'.$order['food_menu_id'].'";
								var variation_id = "'.$order['variation_id'].'"; 
								
								var price =   qty * '.$order["price"].';
								
								$(".item_price_"+menu_id+variation_id).html(price.toFixed(2));  
								$("ul.order-list-inner li").each(function(i) {
									calculateColumn(i);
								});
							});
							
							i1= $("#tch_rm_"+'.$order['food_menu_id'].$variation_id.').TouchSpin({
								initval: 40,
								min: 0,
							}); 
							
							i1.on("touchspin.on.startspin", function () {   
								var qty = 0; 
								var menu_id = "'.$order['food_menu_id'].'";
								var variation_id = "'.$order['variation_id'].'"; 
								
								var price =   qty * '.$order["price"].';
								
								$(".item_price_"+menu_id+variation_id).html(price.toFixed(2));  
								$("ul.order-list-inner li").each(function(i1) {
									calculateColumn(i1);
								});
							}); 
						
						$(document).ready(function(){
							$("ul.order-list-inner li").each(function(i) {
								calculateColumn(i);
							}); 
						});
						</script>';
						$item_count++;
						}
						}
						echo "<input type='hidden' name='cart_restaurant_id' id='cart_restaurant_id' value='".$cart_restaurant_id."'>";
						?>
					</ul>
					
					<ul class="order-total">
						<li>
							<span>SubTotal</span> 
							<i class="fa fa-inr"><span id="sub_total"><?php echo $sub_total;?></span></i>
						</li>
						<?php 
						 
						if($coupon_code!=''){
							$show_coupon = 'display:block;';
							$coupon_amount = $coupon_amount;
						}else{
							$show_coupon = 'display:none;';
						} 
						?>
						 
						<li class="applied_coupon_wrap" style="<?php echo $show_coupon; ?>">
							<span>Coupon Code <span id="coupon_code"><?php echo !empty($coupon_code) ? '('. $coupon_code.') ':'' ; ?> </span><i class="fa fa-inr"><span id="coupon_amount"><?php echo $coupon_amount;?></span>
							<input type="hidden" id="coupon_amount_input" value="<?php echo $coupon_amount;?>">
							</i>
							<span style="<?php echo $show_coupon; ?>" class="remove_coupon"><a id='remove_coupon_code' title='' itemprop='url'> Remove </a></span>
						</li>
						<li>
							<span>Delivery fee</span>
								<i class="fa fa-inr"><span id="delivery_fees">
									<?php 
                                          if (!empty($delivery_charge)) {
                                          	echo $delivery_charge['delivery_charge'];
                                          } else {
                                          	echo 0;
                                          }
									  ?>
								</span></i>
						</li>
						
					</ul>
					<ul class="order-method brd-rd2 red-bg">
						<li>
							<span>Total</span>
							<?php $total_amount_rs =  $cart_total ;
								if($total_amount_rs > 0 ){
									$total_amounts = $total_amount_rs; 
								}else{
									$total_amounts = 0;
								}
								//$order_total = $total_amounts + $delivery_charge['delivery_charge'];
								$order_total = $total_amounts;
							?>
							<span class="price"><i class="fa fa-inr"></i><span id="total_amount"><?php echo $order_total?></span></span>
						</li>
						<li>
						<?php if($this->session->has_userdata('cust_id')) { ?>
							<button type="button" class="btn btn-danger" id="place_order" name="checkout" value="place_order" title="CONFIRM ORDER">CONFIRM ORDER</button>
						<?php }else{ ?>
							<button type="button" class="btn btn-danger log-popup-btn" title="CONFIRM ORDER">CONFIRM ORDER</button>
						<?php } ?>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	</form>
</div>

</div>
</div>
</div>
</div>
</div><!-- Section Box -->
</div>
</section>
<div class="modal fade" id="coupon_Modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Available Coupon Code</h4></div>
            <div class="modal-body">
                <ul class="coupon-list">
					<?php if(!empty($all_coupons)){

						foreach($all_coupons as $coupon){
					?>
					<li>
                        <div class="radiobox">
                            <input type="radio" name="coupon_name" id="<?php echo $coupon['coupon_code']?>" class="coupon_name" value="<?php echo $coupon['coupon_code']?>">
                            <label for="<?php echo $coupon['coupon_code']?>">
                                <div class="code-text"><?php echo $coupon['title']?></div>
                            </label>
                        </div>
                        <p><?php echo $coupon['description']?></p>
                    </li>
					<?php
						}
					}else{
						echo "Coupon not available.";
					}
					?>
                    
                </ul>
            </div>
            <!-- <div class="modal-footer">
                <input class="coupon-apply-btn" name="apply_coupon" value="Apply Coupon" disabled="disabled" type="submit">
            </div> -->
        </div>
    </div>
</div>
<div id="RestaurantChangeModal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title col-md-6" id="myModalLabel">Items already in cart</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<div class="modal-body">
				<p>Your cart contains items from other restaurant. Would you like to reset your cart for adding items from this restaurant?</p>
				
			</div>
			<div class="modal-footer">
				<button class="brd-rd2 no close" title="No" data-dismiss="modal">No</button>
				<button class="brd-rd2 yes" title="Order Now" onclick="clear_cart()">Yes, start a fresh order</button>
			</div>
		</div>
	</div>
</div>

<?php 
/*echo "<pre>";
print_r($delivery_charge);
echo "<pre/>";*/
?>
<script>
 
$(document).ready(function(){
	
	jQuery("input[name='apply_coupon']").attr('disabled',true);
    jQuery('#coupon_code').on('mouseup keyup focus select', function(){
        if(jQuery(this).val().length !=0)
            jQuery("input[name='apply_coupon']").attr('disabled', false);            
        else
            jQuery("input[name='apply_coupon']").attr('disabled',true);
    })
	 
	jQuery('#coupon_Modal .coupon_name').click(function() {
        var selValue = jQuery('input[name=coupon_name]:checked').val();
        jQuery("#coupon_code").val(selValue);
		jQuery("input[name='apply_coupon']").attr('disabled',false);
    });
	
	$(document).on("click", '#apply_coupon', function(event) {
	
		jQuery.LoadingOverlay("show");
		
		var coupon_code = $('#coupon_code').val();
		var sub_total 	= $('#sub_total').text();
		
		var restaurant_id = $("#cart_restaurant_id").val();
		
		jQuery.ajax({
			type : "POST",
			url  : '<?php echo base_url('checkout/apply_coupon'); ?>',
			data : {"sub_total":sub_total,"coupon_code":coupon_code,"restaurant_id":restaurant_id},
			async: false,
			success: function (response) {
				var dataResult = JSON.parse(response);
				
				console.log(dataResult);
				
				jQuery.LoadingOverlay("hide");
				
				if(dataResult.success==1){
					
					$(".applied_coupon_wrap").show();
					var delivery_fee = $('#delivery_fee').text();
					 
					var after_apply = dataResult.data.total;
					$('#coupon_code').text(coupon_code);
					$('#coupon_amount').html(dataResult.data.discount_amount);
					$('#coupon_amount_input').val(dataResult.data.discount_amount);
					if(after_apply > 0){
						$('#total_amount').text(after_apply);
					}else{
						$('#total_amount').text(0);
					}
					$('#coupon_message').html("Promocode applied successfully !");
					$('.remove_coupon').css('display','block');
					
					check_zemo_amount();
					
					jQuery.LoadingOverlay("hide");
					
				}else{
					$('#coupon_message').html(dataResult.msg);
				}
			}, 
		});
	});
	

	$(document).on("click", '#remove_coupon_code', function(event) {
	
		var delivery_fees = $('#delivery_fees').text();
		 if(delivery_fees != ''){
			 delivery_fees_data = delivery_fees;
		 }
		 else{
			 delivery_fees_data = 0;
		 }
		  
		 var sub_total 	= $('#sub_total').text();
		  
		jQuery.ajax({
			type : "POST",
			url  : '<?php echo base_url('checkout/remove_coupon'); ?>',
			data : {"sub_total":sub_total,"delivery_fees":delivery_fees_data},
			async: false,
			success: function (response) {
				var dataResult = JSON.parse(response);
					console.log(dataResult);			
				jQuery.LoadingOverlay("hide");
				
				if(dataResult.success==1){
					
					$('#coupon_code').text('');
					$('.applied_coupon_wrap').css('display','none');
					$('.remove_coupon').css('display','none');
					$('#coupon_amount').html(""); 
					$('#total_amount').text(dataResult.total_amount);
					$('#coupon_message').html(dataResult.msg);
					
				}else{
					$('#coupon_message').html(dataResult.msg);
				}
			}, 
		});
	});
	
	
	$(document).on("click", '.qty_btn', function(event) {
	
		jQuery(".qty_btn").attr('disabled',true);
		jQuery.LoadingOverlay("show");
		
		var rowid = $(this).closest('li').data('menu_variation');
		var qty = $(".order-list-inner  #tch3_"+rowid+"").val();
		
		var restaurant_id = $("#cart_restaurant_id").val();
		
		jQuery.ajax({
			type : "POST",
			url  : '<?php echo base_url('users/update_cart'); ?>',
			data : {"rowid":rowid,"qty":qty,"restaurant_id":restaurant_id},
			async: false,
			success: function (response) {
				var data = JSON.parse(response);
			 		
				$('#coupon_amount').text(data.data.discount_amount);
				$('#total_amount').text(data.data.total);
				jQuery.LoadingOverlay("hide");
				jQuery(".qty_btn").removeAttr('disabled');
				
			}, 
		});
	});

	$(document).on("click", '.qty_btn_rm', function(event) {
		
		jQuery(".qty_btn_rm").attr('disabled',true);
		jQuery.LoadingOverlay("show");
		
		var rowid = $(this).closest('li').data('menu_variation');
		var qty = $(".order-list-inner  #tch3_"+rowid+"").val();
		
		var restaurant_id = $("#cart_restaurant_id").val();
		
		jQuery.ajax({
			type : "POST",
			url  : '<?php echo base_url('users/update_cart'); ?>',
			data : {"rowid":rowid,"qty":qty,"restaurant_id":restaurant_id},
			async: false,
			success: function (response) {
				console.log(response);
				alert("test"+response.data.discount_amount);
				jQuery.LoadingOverlay("hide");
				jQuery(".qty_btn").removeAttr('disabled');
			}, 
		});
	});
	
	$("ul.order-list-inner li").each(function(i) {
		calculateColumn(i);
	});
	
	
	check_zemo_amount();
	
});

function check_zemo_amount(){
	
	var total_amount_check_zero = $("#total_amount").text();
	if(total_amount_check_zero <= 0){
		$("input[name=payment_method][value='cod']").prop('checked', true);
		$('#payment_method_paytm_li').hide();
	}else{
		$('#payment_method_paytm_li').show();
	}
}

function remove_menu_item(rowid){
	
	jQuery(".qty_btn").attr('disabled',true);
	jQuery.LoadingOverlay("show");
	
	var restaurant_id = $("#restaurant_id").val();
	jQuery.LoadingOverlay("hide");	
	jQuery.ajax({
		type : "POST",
		url  : '<?php echo base_url('users/remove_menu_item'); ?>',
		data : {"rowid":rowid,"restaurant_id":restaurant_id},
		async: false,
		success: function (response) {
			var response_new = JSON.parse(response);
			
			$(".menu_item_"+rowid+"").fadeOut(300, function(){ $(this).remove();});
			
			jQuery.LoadingOverlay("hide");
			jQuery(".qty_btn").removeAttr('disabled');
			
			get_cart_count();
			
			var delivery_fee = $("#delivery_fees").text();
		
			var sub_total = $("#sub_total").text(parseFloat(response_new.data));
			
			coupon_amount = $("#coupon_amount").text();
			if(coupon_amount != ''){
				coupon_amount = $("#coupon_amount").text();
			}
			else{
				coupon_amount = 0;
			}
			var total_amt = parseFloat(response_new.data) - parseFloat(coupon_amount);
			 
			$("#total_amount").text(total_amt + parseFloat(delivery_fee));
		}, 
	});
}
function get_cart_count(){
	$.ajax({
		url: '<?php echo base_url("users/get_cart_count");?>',
		type: 'post',
		dataType: 'json',
		success: function (data) {
			$("#cart_count").text(data);
		},
		error: function () {
			alert("error");
		}
	});	
}

function clear_cart(){
	
	jQuery(".qty_btn").attr('disabled',true);
	jQuery.LoadingOverlay("show");
	
	var restaurant_id = $("#cart_restaurant_id").val();
	
	jQuery.ajax({
		type : "POST",
		url  : '<?php echo base_url('users/clear_cart'); ?>',
		data : {"restaurant_id":restaurant_id},
		async: false,
		success: function (response) {
			$("#orders li").fadeOut(300, function(){ $(this).remove();});
			$("#sub_total").text(0);
			$("#delivery_fee").text(0);
			$("#total_amount").text(0);
			
			$('#RestaurantChangeModal').modal('hide');
			
			jQuery.LoadingOverlay("hide");
			jQuery(".qty_btn").removeAttr('disabled');
			
			window.location.href = '<?php echo base_url(); ?>';
		}, 
	});
}

function calculateColumn(index) {
	
	var total = 0.00;
	
	$("ul.order-list-inner li .price").each(function() {
		var value = parseFloat($(this).text());	
		if (!isNaN(value)) {
			total += value;
		} 
	});
	var delivery_fee = 0;
	var delivery_fees = $("#delivery_fee").text();
	if(delivery_fees != '' ){
		delivery_fee = delivery_fees;
	}
	
	$("#sub_total").text(parseFloat(total));
	
	$("#total_amount").text(0);
	
	var coupon_amount = $("#coupon_amount_input").val();
	
	
	if((coupon_amount.length > 0) && coupon_amount!=null){
		var totalamount = (parseFloat(total)- parseFloat(coupon_amount));
		
		if(totalamount > 0)
			$("#total_amount").text(totalamount + parseFloat(delivery_fee));
		else
			$("#total_amount").text(parseFloat(delivery_fee));
	}else{
		var totalamount = (parseFloat(total));
		
		if(totalamount > 0)
			$("#total_amount").text(totalamount + parseFloat(delivery_fee));
	}
	
	var total_qty=0;
	 
	$('ul.order-list-inner li').each(function(i, obj) {
		var item_id = $(obj).attr('id');
		
		var variation_id = '0';
		if( $(this).data('variation')!=''){
			variation_id = $(this).data('variation');
		}
		
		var item_quantity = $('#tch3_'+item_id+variation_id).val();
		
		total_qty += parseInt(item_quantity);
	});
}

$('#place_order').on('click', function(e) {
	
	e.preventDefault();
	
	var address_id = $("input[name='address_id']:checked").val();
	 
	var count = $('.address_list').length;
	
	if(count==0){
		
		$("#common_model_popup .modal-title").text('Alert');
		$("#common_model_popup .modal-body").text("Seems you don't have any address for delivery, Please Add New Address to place order.");
		
		$(".add-new-btn").focus();
		
		$("#common_model_popup").modal('show');
		return false;
	}else if(address_id==null){  
		
		$("#common_model_popup .modal-title").text('Alert');
		$("#common_model_popup .modal-body").text("Please select delivery address.");
		
		$(".add-new-btn").focus();
		$("#common_model_popup").modal('show');
		return false;
	}else if(address_id!=null || address_id != ''){  
			jQuery.LoadingOverlay("show");
			jQuery.ajax({
				type : "POST",
				url  : '<?php echo base_url('checkout/check_shipping_area'); ?>',
				data :{"address_id":address_id},
				async:false,
				success: function (response) {
					  jQuery.LoadingOverlay("hide");
					if(response == 1){  
					 
						$("#common_model_popup .modal-title").text('Alert');
						$("#common_model_popup .modal-body").text("Sorry we can't delivered order in your shipping address. Please change your shipping address."); 
						$(".add-new-btn").focus();
						$("#common_model_popup").modal('show');
						
						return false;
						 
					}
					else{
						$('#checkout_form').submit();
						return true;
					}
				}, 
			}); 
			  
	}else{
	/* var formdata =$('#checkout_form').serialize();  
	
	jQuery.ajax({
		type : "POST",
		url  : '<?php echo base_url('checkout/process_order'); ?>',
		data : formdata, 
		success: function (response) {
		  var dataResult = JSON.parse(response);
				 	 
			if(dataResult.success==1){
				window.location.href = dataResult.redirect_url;
			}
		}, 
	}); */
	
		$('#checkout_form').submit();
		return true;
	}
 });
 
 function check_shipping_address(address_id){
	 jQuery.LoadingOverlay("show");
		jQuery.ajax({
		type : "POST",
		url  : '<?php echo base_url('checkout/check_shipping_area'); ?>',
		data :{"address_id":address_id},
		success: function (response) {
			 jQuery.LoadingOverlay("hide");
			if(response == 1){  
				$("#common_model_popup .modal-title").text('Alert');
				$("#common_model_popup .modal-body").text("Sorry we can't delivered order in your shipping address. Please change your shipping address."); 
		
				$("#common_model_popup").modal('show');
				$('input[name="address_id"]').attr('checked', false);


				return false;
			}
			else {
				return true;
			}			
		}, 
	}); 
		
 }
</script>