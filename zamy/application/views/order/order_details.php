<!--<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyD9UPC1UTFH7mwjIxCbF_rYFa4igU9u0xA"></script>-->
<div class="bread-crumbs-wrapper">
	<div class="container">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#" title="" itemprop="url">Home</a></li>
			<li class="breadcrumb-item ">Order</li>
			<li class="breadcrumb-item active">Order Details</li>
		</ol>
	</div>
</div>

<style>
ul.order_details {
    display: flex;
    width: 100%;
    list-style: none;
    margin:20px 0;
    padding:0; 
    /*border: 1px solid #ebebeb;
    justify-content:center;*/
}
ul.order_details li {
    padding: 5px 15px;
    border-right: 1px solid #ebebeb;
    margin-top: 10px;
    margin-bottom: 10px;
}

ul.order_details li:last-child {
	border-right: none;
}
</style>
<?php

$delivery_info = get_delivery_boy_latlong($order_data['order_id']);

$driver_name					= $delivery_info['delivery_boy_name'];
if(!empty($delivery_info['delivery_boy_profile_pic'])){
	$delivery_boy_pic				= "http://pos.zamy.in/uploads/delivery_boy/".$delivery_info['delivery_boy_profile_pic'];
}else{
	$delivery_boy_pic				= "http://pos.zamy.in/uploads/FoodMenu/images4.png";
}

$delivery_boy_latitude			= $delivery_info['delivery_boy_latitude'];
$delivery_boy_longitude			= $delivery_info['delivery_boy_longitude'];
$delivery_boy_angle				= $delivery_info['delivery_boy_angle'];
$delivery_boy_mobile			= $delivery_info['delivery_boy_phone'];

$customer_lat					= $delivery_info['customer_latitude'];
$customer_lng					= $delivery_info['customer_longitude'];
$customer_address				= $delivery_info['customer_address'];

?>
<section>
<div class="block less-spacing gray-bg top-padd30">

<div class="container">
<div class="row">
	<div class="col-md-12 col-sm-12 col-lg-12">
	<div class="sec-box">
		<div class="entry-header">
			<h1 class="entry-title">Order Details</h1>
		</div>
		<p itemprop="description">Thank you. Your order has been received.</p>
		
		

		<ul class="order_details">

				<li class="order-overview__order order">
					Order number: <strong><?php echo $order_data['order_id']?></strong>
				</li>

				<li class="order-overview__date date">
					Date: <strong><?php echo $order_data['order_date']?></strong>
				</li>
					<li class="order-overview__email email">
						Email: <strong><?php echo $order_data['billing']['billing_email']?></strong>
					</li>
				
				<li class="order-overview__total total">
					Total: <strong><span class="Price-amount amount"><span class="Price-currencySymbol">Rs.</span>
					<?php 
					$order_total = $order_data['order_total'];
					
					if($order_total > 0){
						$order_total = $order_total ;
					} else{
						$order_total = 0;
					}
					//echo $order_total + $order_data['delivery_charge'];
					echo $order_total;
					
					?></span></strong>
				</li>
				<li class="order-overview__payment-method method">
					Payment method:	<strong><?php echo $order_data['payment_method']?></strong>
				</li>
				
			</ul>
			<div class="order-dlvry-track">
				<div class="row">
					<div class="col-md-6 col-sm-12">
						<?php if($order_data['payment_method']=='cod'){?>
							<p>Pay with cash upon delivery.</p>
						<?php } ?>
					</div>
					<div class="col-md-6 col-sm-12">
						<?php 
						if(!empty($delivery_info['job_accepted_status']) && $delivery_info['job_accepted_status']=='On the way'){
						?>
						<a class="track_order_link odr-dtl-btn" href="javascript:void(0)" data-toggle="modal" id="track_order_link" data-lat1="<?php echo $customer_lat; ?>"  data-lng1="<?php echo $customer_lng; ?>" data-lat2="<?php echo $delivery_boy_latitude; ?>"  data-lng2="<?php echo $delivery_boy_longitude; ?>"  data-mobile="<?php echo $delivery_boy_mobile; ?>" data-angle="<?php echo $delivery_boy_angle; ?>"  data-profilepic="<?php echo $delivery_boy_pic; ?>" data-drivername="<?php echo $driver_name; ?>">
						Tracking</a>
						<?php }else{
							echo $order_data['order_status'];
						} ?>
						
						<a href="javascript:void(0)" class="odr-dtl-btn" id="customer_model" onClick="customer_submit_review(<?php echo $order_data['order_id'];  ?>)">Customer Support</a>
					</div>					
				</div>
			</div>

		
		<div class="order-details">

			<h2 class="order-details__title">Order details</h2>

			<table class="table table--order-details shop_table order_details">

				<thead>
					<tr>
						<th class="table__product-name product-name">Product</th>
						<th class="table__product-name product-name">Price</th>
						<th class="table__product-table product-total">Total</th>
					</tr>
				</thead>

				<tbody>
					<?php
				
					if(!empty($order_data['order_items'])){
					foreach($order_data['order_items'] as $item){
			
						$variation_name = '';
						if($item['variation_name']!=''){
							$variation_name = ", ".$item['variation_name'];
						}
						$food_menu_id = $item['food_menu_id'];
					?>
					<tr class="table__line-item order_item">
						<td class="table__product-name product-name">
							<a href=""><?php echo $item['menu_name'].$variation_name?></a><?php echo $item['qty'];?>
							<?php 
							$get_rating = get_rating_status($order_data['order_id'],$food_menu_id);
							if(empty($get_rating)){
							?>
							<div class="rating-wrapper menu_rate_<?php echo $food_menu_id; ?>">
								<a class="gradient-brd brd-rd2 rt_call" food_id="<?php echo $food_menu_id; ?>" href="#" title="" itemprop="url" onclick="rate_model_call(<?php echo $food_menu_id; ?>)" id="rating_call_<?php echo $food_menu_id; ?>"><i class="fa fa-star"></i> Rate</a>
                            </div>
							<?php } ?>
						</td>
						<td class="table__product-name product-name">
							<?php echo $item['price'];?>
						</td>
						<td class="table__product-total product-total">
							<span class="Price-amount amount"><span class="Price-currencySymbol">Rs.</span><?php echo $item['subtotal'];?></span>
						</td>
					</tr>
					<?php }} ?>
				</tbody>
				<tfoot>
					<tr>
						<th scope="row">Subtotal:</th>
						<th scope="row"></th>
						<td><span class="Price-amount amount"><span class="Price-currencySymbol">Rs.</span><?php echo $order_data['sub_total']?></span>
						</td>
					</tr>
					<tr>
						<th scope="row">Delivery Charge:</th>
						<th scope="row"></th>
						<td>Rs. <span><?php echo $order_data['delivery_charge'];?></span></td>
					</tr>
					<tr>
						<th scope="row">Payment method:</th>
						<th scope="row"></th>
						<td><?php echo $order_data['payment_method'];?></td>
					</tr>
					<tr>
						<th scope="row">Coupon Code:</th>
						<th scope="row"></th>
						<td><?=!empty($order_data['coupon_code']) ? $order_data['coupon_code'] : 'No Coupon Applied'; ?></td>
					</tr>
					<tr>
						<th scope="row">Total:</th>
						<th scope="row"></th>
						<td><span class="Price-amount amount"><span class="Price-currencySymbol">Rs.</span>
						<?php 
						
						$order_total = $order_data['order_total'];
					
						if($order_total > 0){
							$order_total = $order_total ;
						} else{
							$order_total = 0;
						}
						//echo $order_total + $order_data['delivery_charge'];
						echo $order_total;
						?>
						</span>
						</td>
					</tr>
				</tfoot>
			</table>
		</div>
		<div class="row">		
			<div class="customer-details col-md-6">
				<div class="order-details-box wow fadeIn">
					<h2 itemprop="headline">Billing Information</h2>
					<div class="order-details-address">
						<?php echo $order_data['billing']['billing_name'] ?><br>
						<?php //echo $order_data['billing']['billing_address'] ?>
						<p class="customer-details--phone"><?php echo $order_data['billing']['billing_phone'] ?></p></br>
						<p class="customer-details--email"><?php echo $order_data['billing']['billing_email'] ?></p>
						</br>
						</br>
						</br>
					</div>
				</div>
			</div>
			
			<div class="customer-details col-md-6">
				<div class="order-details-box wow fadeIn">
					<h2 itemprop="headline">Shipping address</h2>
					<div class="order-details-address">
						<?php echo $order_data['shipping']['shipping_name'] ?><br>
						<?php echo $order_data['shipping']['shipping_address'] ?></br>
						<p class="customer-details--phone"><?php echo $order_data['shipping']['shipping_phone'] ?></p></br>
						<p class="customer-details--email"><?php echo $order_data['shipping']['shipping_email'] ?></p>
					</div>
				</div>
			</div>
			<div class="menu-sec"><a class="red-bg brd-rd4" href="<?php echo base_url();?>" title="Register" itemprop="url">Keep Ordering</a></div>
		</div>
	</div>
</div>
</div>
</div>
</div>
</section>

<div id="track_order_popup" class="modal fade in chkmenu-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h4 class="modal-title">Track Order Delivery</h4>
		  </div>
		<div class="modal-body">
		
		<div class="row profile">
			<div class="col-md-12">
				<div class="profile-sidebar">
					<!-- SIDEBAR USERPIC -->
					<div class="profile-userpic col-md-4">
						<img src="<?php echo $delivery_boy_pic; ?>" class="img-responsive img-circle" alt="" id='delivery_profile_pic'>
						<p><i class="fa fa-user"></i>&nbsp;<span id='drivername_popup' ></span></p>
						<p><i class="fa fa-mobile"></i>&nbsp;<span id='delivery_boy_mobile_popup'></span></p>
					</div>
					<div class="profile-usermenu col-md-8">
						
						<p><span>Shipping Address : </span><br><span id='customer_address'><?php echo $customer_address;?></span></p>
					</div>
					<!-- END MENU -->
				</div>
			</div>
			<div class="col-md-12">
				<div class="profile-content">
					<?php /*<div id="directions" style="width:100px;height:100px;float:left"></div>*/?>
				   <div id="map_canvas" style="width:100%;height:500px;"></div>
				</div>
			</div>
		</div>
	
		</div>
		<div class="clearfix"></div>
		<div class="modal-footer">			
				<!--<input type="submit" name="compose" value="Submit" id="create_ticket" class="btn btn-success submit-btn"/>-->
						
				<input type="hidden" name="customer_lat" id="customer_lat" value=""/>
				<input type="hidden" name="customer_lng" id="customer_lng" value=""/>
				<input type="hidden" name="delivery_boy_latitude" id="delivery_boy_latitude" value=""/>
				<input type="hidden" name="delivery_boy_longitude" id="delivery_boy_longitude" value=""/>
				<input type="hidden" name="delivery_boy_angle" id="delivery_boy_angle" value=""/>
				<input type="hidden" name="delivery_boy_mobile" id="delivery_boy_mobile" value=""/>
				<input type="hidden" name="delivery_boy_pic" id="delivery_boy_pic" value=""/>
				<input type="hidden" name="drivername" id="drivername" value=""/>
		  </div>
    </div>
  </div>
</div>
<!--Rating Hiddens --->
<input type="hidden" name="res_d" id="r_id" value="<?php echo $order_data['restaurant_id'];  ?>">
<!--START MODEL-->
<div class="modal" tabindex="-1" role="dialog" id="rate_model">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Your Rating</h5>
        <button type="button" class="close cls" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
			
			<div class="rating-box-wrapper">
				<span>Rate</span>
				<div class="rating-box">                                            
					<span class="rv brd-rd2 clr1 off" rate_attr="1.0" id="clr1" data-rat_val="1"></span>
					<span class="rv brd-rd2 clr2 off" rate_attr="2.0" id="clr2" data-rat_val="2"></span>
					<span class="rv brd-rd2 clr3 off" rate_attr="3.0" id="clr3" data-rat_val="3"></span>
					<span class="rv brd-rd2 clr4 off" rate_attr="4.0" id="clr4" data-rat_val="4"></span>
					<span class="rv brd-rd2 clr5 off" rate_attr="5.0" id="clr5" data-rat_val="5"></span>      
					<i id="rat_val">5.0</i>
				</div>
			</div>
			<div class="clearfix"></div>
              <form method="post" id="rating_form">
                <div class="form-group">
                  <textarea class="form-control" id="comment" placeholder="comment" name="comment"></textarea>
                </div>
               
				<input type="hidden" name="user_id" id="user_id" class="form-control" value="<?php echo $order_data['user_id']; ?>" /> 
				<input type="hidden" name="order_id" id="order_id" class="form-control" value="<?php echo $order_data['order_id'];  ?>"/> 
				<input type="hidden" name="food_menu_id" id="f_id" class="form-control" value=""/>
				<input type="hidden" name="restaurant_id" id="res_id" class="form-control" value=""/>
				<input type="hidden" name="rating" id="rating" class="form-control" value=""/>
              </form>
          
	   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="save_ratings">Save Rating</button>
        <button type="button" class="btn btn-secondary cls" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="customer_model_call">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Customer Support</h4>
        <button type="button" class="close rmv" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      	<!--Form Start -->
<form method="post"  id="customer_supp_form">
  <div class="form-group">
  	<label for="subject" class="title">Subject</label>
  	<input type="text" name="subject" class="form-control" value="" id="subject">
  </div>
   <div class="form-group">
  	<label for="ticketTitle" class="title">Category Issue</label>
    <select class="form-control" id="ticketTitle" name="ticketTitle">
         <option value=""></option>
         <option value="1">Payment Issue</option>
         <option value="2">Food Issue</option>
         <option value="3">Delivery Issue</option>
         <option value="4">Other</option>
    </select>   
   </div>
   <div class="form-group">
  	<label for="ticketTitle">Message</label>
    <textarea name="ticketBody" class="form-control" rows="6" placeholder="Message"></textarea>
   </div>
   <div class="form-group">
   	<input type="hidden" name="ticketChatID" id="ticketChatID" value="" class="form-control">
   	<label for="or_id"></label>
   	<input type="hidden" name="order_id" value="" id="or_id" class="form-control">

   	<label for="ticketSenderID"></label>
   	<input type="hidden" name="ticketSenderID" id="ticketSenderID" value="<?php echo $customer_id;  ?>" class="form-control">

   	<label for="ticketReceiverID"></label>
   	<input type="hidden" name="ticketReceiverID" id="ticketReceiverID" value="1" class="form-control">
   </div>
   <div class="form-group">
  	  <button type="button" id="save_cust_details" class="btn btn-primary">Submit</button>
   </div>

</form>
    <!-- END Form  -->
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger rmv" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<!--END MODEL-->
<script>

$(".cls").click(function () {
	$("#rate_model").modal('hide');
});

function rate_model_call(index){
	$("#rate_model").modal('show');
	$("#f_id").val(index);
	var res_id = $("#r_id").val();
	$("#res_id").val(res_id);
}
$(".rating-box .rv").click(function(){
	
   var attr_val = $(this).attr('rate_attr');
   
   var id = $(this).attr('id');
   $("#rating").val(attr_val);
   $('#rat_val').text(attr_val);
   $('#front_rate').text(attr_val);
  
   var rate_val = $(this).data('rat_val');
   
	$('.rating-box .rv').addClass('off');
	$('.rating-box .rv').removeClass('on');
	 
	var i;
	for (i = 1; i <= rate_val; i++) {
	  $('.clr'+i+'').removeClass('off');
	  $('.clr'+i+'').addClass('on');
	}
});

$("#save_ratings").click(function(){
	var food_menu_id = $('#f_id').val();
	
	var form = $('#rating_form').serialize();
 
	$.ajax({
		url : '<?php echo base_url('my_account/orders/save_ratings/') ?>',
		data : form,
		method : 'POST',
		success: function(data){
			alert(data);
			$("#rate_model").modal('hide');
			$("#rating_call_" + food_menu_id).remove();
			$(".menu_rate_" + food_menu_id).text('Thanks for rate this item.');
		},
		error: function(){
			console.log("ERROR!Something went to wrong");
		}
	});
});

function customer_submit_review(index){
 var order_id = index;
 $("#or_id").val(order_id);
 $("#ticketChatID").val(order_id);
 $('#customer_model_call').modal('show');
}
$("#save_cust_details").click(function(){
    var cust_form  = $("#customer_supp_form").serialize();

   	$.ajax({
		url : '<?php echo base_url('my_account/orders/save_customer_ticket/') ?>',
		data : cust_form,
		method : 'POST',
		success: function(data){
			alert(data);
		},
		error: function(){
			console.log("ERROR!Something went to wrong");
		}
	});
});
</script>
