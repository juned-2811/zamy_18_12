<div class="bread-crumbs-wrapper">
	<div class="container">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#" title="" itemprop="url">Home</a></li>
			<li class="breadcrumb-item ">Order</li>
			<li class="breadcrumb-item active">Order Received</li>
		</ol>
	</div>
</div>
<style>
ul.order_details {
    display: flex;
    width: 100%;
    list-style: none;
}
ul.order_details li {
    padding: 14px;
}
</style>
<section>
<div class="block less-spacing gray-bg top-padd30">

<div class="container">
<div class="row">
	<div class="col-md-12 col-sm-12 col-lg-12">
	<div class="sec-box">
		<div class="entry-header">
			<h1 class="entry-title">Order received</h1>
		</div>
		
		
		<p itemprop="description">Thank you. Your order has been received.</p>
		
		<a class="action-link create_ticket_link" href="javascript:void(0);" data-toggle="modal" id="create_ticket_link" data-orderid="15662" data-suborderid="<?php echo $order_data['order_id']?>">
			<i class="fa fa-ticket" aria-hidden="true"></i> Create Support Ticket
		</a>
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
					<?php echo $order_data['order_total']?></span></strong>
				</li>
				<li class="order-overview__payment-method method">
					Payment method:	<strong><?php echo $order_data['payment_method']?></strong>
				</li>
				
			</ul>
		<?php if($order_data['payment_method']=='cod'){?>
		<p>Pay with cash upon delivery.</p>
		<?php } ?>
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
					?>
					<tr class="table__line-item order_item">
						<td class="table__product-name product-name">
							<a href=""><?php echo $item['menu_name'].$variation_name?></a><?php echo $item['qty'];?>
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
						<td><?php echo $order_data['delivery_charge']?></td>
					</tr>
					<tr>
						<th scope="row">Payment method:</th>
						<th scope="row"></th>
						<td><?php echo $order_data['payment_method']?></td>
					</tr>
					<tr>
						<th scope="row">Total:</th>
						<th scope="row"></th>
						<td><span class="Price-amount amount"><span class="Price-currencySymbol">Rs.</span><?php echo $order_data['order_total']?></span>
						</td>
					</tr>
				</tfoot>
			</table>

		</div>
		<div class="row">
		
			<div class="customer-details col-md-6">
				<h2 class="column__title">Billing address</h2>
				<div>
					<?php echo $order_data['billing']['billing_name'] ?><br>
					<?php echo $order_data['billing']['billing_address'] ?></br>
					<p class="customer-details--phone"><?php echo $order_data['billing']['billing_phone'] ?></p></br>
					<p class="customer-details--email"><?php echo $order_data['billing']['billing_email'] ?></p>
				</div>
			</div>
			
			<div class="customer-details col-md-6">
				<h2 class="column__title">Shipping address</h2>
				<div>
					<?php echo $order_data['shipping']['shipping_name'] ?><br>
					<?php echo $order_data['shipping']['shipping_address'] ?></br>
					<p class="customer-details--phone"><?php echo $order_data['shipping']['shipping_phone'] ?></p></br>
					<p class="customer-details--email"><?php echo $order_data['shipping']['shipping_email'] ?></p>
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

<div id="create_ticket_popup" class="modal fade chkmenu-popup" role="dialog" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
		<div class="modal-header">
			<h4 class="modal-title">Create New Ticket</h4>
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		  </div>
		<div class="modal-body">
			<div class="ticket-form">
				<div class="form-group">
					<label for="subject">Subject:</label>							
					<input type="text" class="form-control" name="subject" id="ticket_subject" placeholder="Enter subject" required="" minlength="1">		
					<span class="errorsubject err"></span>
				</div>
				<div class="form-group clearfix">
					<label for="sp_ship_add">Ticket Category:</label>
					  <div class="row">
							<div class="col-md-12">
								<select class="" name="ticketTitle" id="ticketTitle">
								<option value="">Select Ticket Category</option>
									<option value="1">Payment Issue </option>
									<option value="2">Delivery Issue </option>
									<option value="3">Food Issue </option>
								</select>
								<span class="errorticketTitle err"></span>
							</div>
					  </div>
				</div>
				<div class="form-group">
					<label for="sp_ship_add">Description:</label>
					<textarea class="form-control" rows="7" name="description" id="ticket_description" placeholder="Enter Description" required="" minlength="1" maxlength="250" spellcheck="false"> </textarea> 
					<span class="errordescription err"></span>
				</div>
				<!--<p class="error"></p>-->
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="modal-footer">			
			<input type="submit" name="compose" value="Submit" id="create_ticket" class="btn btn-success submit-btn">
			<input type="hidden" name="ticket_orderid" id="ticket_orderid" value="">
		</div>
    </div>
  </div>
</div>
<div id="success_ticket_popup" class="chkmenu-popup modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">success</h4>
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body">
        <p>Ticket Created successfully</p>
      </div>
	  <div class="clearfix"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" onclick="location.reload();" data-dismiss="modal">Ok</button>
      </div>
    </div>

  </div>
</div>
<script>
jQuery(".create_ticket_link").click(function(){
	var order_id=jQuery(this).attr("data-orderid");
	jQuery('#ticket_orderid').val(order_id);
	jQuery("#create_ticket_popup").modal("show");
	
});
function isNullOrEmpty(str){
    return !str||!str.trim();
} 
jQuery("#create_ticket").click(function(){
	
	var subject=jQuery("#ticket_subject").val();

	var category = jQuery("#ticketTitle").val();

	var description =jQuery("#ticket_description").val();

	var order_id = jQuery('#ticket_orderid').val();
	var return_status='';
	
		if(subject=='' || isNullOrEmpty(subject)){
			
			jQuery(".errorsubject").html("Ticket subject is required");
			return_status = 'fail';
			jQuery("#ticket_subject").val('');
		}else{
			if(subject.length<15){
				jQuery(".errorsubject").html("Ticket subject must be at least 15 characters long.");
				return_status = 'fail';
			}else{
				jQuery(".errorsubject").html("");
			}
		}
		if(category==''){
			jQuery(".errorticketTitle").html("Ticket Title is required");
			return_status = 'fail';
		}else{
			jQuery(".errorticketTitle").html("");
		}
		
		if(description==''|| isNullOrEmpty(description)){
			jQuery(".errordescription").html("Description is required");
			return_status = 'fail';
		}else{
			if(description.length<50)
			{
				jQuery(".errordescription").html("Tickerrordescriptionet subject must be at least 50 characters long.");
				return_status = 'fail';
			}else{
				jQuery(".errordescription").html("");
			}
		}
		if(return_status == 'fail'){
			return false;
		}else{
			jQuery.ajax({
			type:"POST",
			url:'<?php echo base_url("orders/create_ticket");?>',
			data:"subject="+subject+"&ticketTitle="+category+"&description="+description+"&order_id="+order_id,
			success:function(data){
				console.log(data);
				jQuery("#create_ticket_popup").modal("hide");
				if(data==1)
				{
					jQuery("#success_ticket_popup .modal-title").html("Success");
					jQuery("#success_ticket_popup .modal-body").html("<p class='text-center'>Ticket Created Successfully.</p>");
					
					jQuery('#ticket_subject').val('');
					jQuery('#ticketTitle').prop('selectedIndex',0);
					jQuery('#ticket_description').val('');
				}else
				{
					jQuery("#success_ticket_popup .modal-title").html("Error");
					jQuery("#success_ticket_popup .modal-body").html("<p class='text-center'>Ticket Not Created!!</p>");
				}
				jQuery("#success_ticket_popup").modal("show");
			}
			});
		}
});
function responseMessage(msg) {
  jQuery('.success-box').fadeIn(200);  
  jQuery('.success-box div.text-message').html("<span>" + msg + "</span>");
}
</script>