<div class="" id="account-settings">
<div class="tabs-wrp account-settings brd-rd5">
	<h4 itemprop="headline"><?php echo $title;?></h4>
	<div class="account-settings-inner">
		<div class="row">
			<?php echo form_open($form_url,array('name'=>'save_address','class'=>'profile-info-form save_address','id'=>'save_address','method'=>'post')) ?>
			<div class="col-md-12 col-sm-12 col-lg-12">
				<div class="profile-info-form-wrap">
					
						<div class="row mrg20">
							<div class="col-md-6 col-sm-6 col-lg-6">
							 
								<div class="col-md-12 col-sm-12 col-lg-12">
									<label>Complete Name <sup>*</sup></label>
									<input class="brd-rd3" id="name" name="name" type="text" value="<?php echo !empty($address_book['name'])? $address_book['name']: '';?>" placeholder="Enter Your Name" required>
									<span class="error name_error" style="display:none;"></span>
								</div>
								
								<div class="col-md-12 col-sm-12 col-lg-12">
									<label>Email Address <sup>*</sup></label>
									<input class="brd-rd3" id="email" name="email" type="email" value="<?php echo !empty($address_book['email'])? $address_book['email']: '';?>" placeholder="Enter Your Email Address" required>
									<span class="error email_error" style="display:none;"></span>
								</div>
								
								<div class="col-md-12 col-sm-12 col-lg-12">
									<label>Phone No <sup>*</sup></label>
									<input class="brd-rd3" id="phone" name="phone" type="text" value="<?php echo !empty($address_book['phone'])? $address_book['phone']: '';?>" placeholder="Enter Your Phone No" required>
									<span class="error phone_error" style="display:none;"></span>
								</div>
							
							</div>
							
							<div class="col-md-6 col-sm-6 col-lg-6">
							
								<div class="col-md-12 col-sm-12 col-lg-12 zamy-src-inpt">
									<input class="form-control searchInput" type="text" id="searchInput" name="" placeholder="Search for area, street name.." value="" autocomplete="off">
								</div>
								
								<div class="col-md-12 col-sm-12 col-lg-12">
									<div class="map_div">
										<div id="address-location-map"></div>
									</div>
								</div>
								
								<div class="col-md-12 col-sm-12 col-lg-12">
									<div>
										<div class="_3Um38 _9Wk87">
											<input class="_381fS" id="search_address" disabled="" type="text" name="" value="">
												<div class="_2EeI1 _26LFr"></div>
												<label class="_1Cvlf _2tL9P">Address</label>
										</div>
									</div>
								</div>
								
							</div>
							  
							<?php 
							$area_list = $this->common_model->get_areas();
							
							?>
							<div class="col-md-12 col-sm-12 col-lg-12">
								<label>Shipping Area <sup>*</sup></label>
								<div class="select-wrp">
									<select id="shipping_area" name="shipping_area" required>
										<option value="">CHOOSE SHIPPING AREA</option>
										<?php foreach($area_list as $list){
										$selected = '';
										if(!empty($address_book['shipping_area']) && $address_book['shipping_area'] ==  $list['area']){
											$selected = "selected ='selected'";
										}
										?>
											<option value="<?php echo $list['area']?>" <?php echo $selected ;?>><?php echo $list['area']?></option>
										<?php } ?>
									</select>
									<span class="error shipping_area_error" style="display:none;"></span>
								</div>
							</div>
							<div class="col-md-12 col-sm-12 col-lg-12">
								<label>Address 1 <sup>*</sup></label>
								<input class="brd-rd3" id="address_1" name="address_1" type="text" value="<?php echo !empty($address_book['address_1'])? $address_book['address_1']: '';?>" required>
								<span class="error address_1_error" style="display:none;"></span>
							</div>
							<div class="col-md-12 col-sm-12 col-lg-12">
								<label>Address 2 </label>
								<input class="brd-rd3" id="address_2" name="address_2" type="text" value="<?php echo !empty($address_book['address_2'])? $address_book['address_2']: '';?>">
							</div>
							<div class="col-md-12 col-sm-12 col-lg-12 hidden" required>
								<label>Country <sup>*</sup></label>
								<div class="select-wrp">
									<select id="country" name="country">
										<option value="IN" selected>India</option>
									</select>
								</div>
							</div>
							<div class="col-md-4 col-sm-4 col-lg-4">
								<label>State <sup>*</sup></label>
								<input class="brd-rd3" id="state" name="state" type="text" value="<?php echo !empty($address_book['state'])? $address_book['state']: '';?>" readonly required>
							</div>
							<div class="col-md-4 col-sm-4 col-lg-4">
								<label>City <sup>*</sup></label>
								<input class="brd-rd3" id="city" name="city" type="text" value="<?php echo !empty($address_book['city'])? $address_book['city']: '';?>" readonly required>
							</div>
							<div class="col-md-4 col-sm-4 col-lg-4">
								<label>Postcode / Zipcode <sup>*</sup></label>
								<input class="brd-rd3" id="postal_code" name="postcode" type="text" value="<?php echo !empty($address_book['postcode'])? $address_book['postcode']: '';?>" readonly required>
							</div>
							<div class="col-md-6 col-sm-6 col-lg-6 hidden">
								<label>Latitude <sup>*</sup></label>
								<input class="brd-rd3" id="lat" name="address_lat" type="text"  value="<?php echo !empty($address_book['address_lat'])? $address_book['address_lat']: '';?>" required>
							</div>
							<div class="col-md-6 col-sm-6 col-lg-6 hidden">
								<label>Longitude <sup>*</sup></label>
								<input class="brd-rd3" id="lon" name="address_lng" type="text" value="<?php echo !empty($address_book['address_lng'])? $address_book['address_lng']: '';?>" required>
							</div>
							<div class="col-md-6 col-sm-6 col-lg-6">
								<label>Address Type <sup>*</sup></label>
								<div class="select-wrp">
									<select id="address_type" name="address_type" required>
										<option value="">CHOOSE Address Type</option>
										<option value="Home" <?php if (!empty($address_book['address_type']) && $address_book['address_type']=="Home") { ?>selected="selected"<?php } ?>>Home</option>
										<option value="Office" <?php if (!empty($address_book['address_type']) && $address_book['address_type']=="Office") { ?>selected="selected"<?php } ?>>Office</option>
										<option value="Other" <?php if (!empty($address_book['address_type']) && $address_book['address_type']=="Other") { ?>selected="selected"<?php } ?>>Other</option>
									</select>
									<span class="error address_type_error" style="display:none;"></span>
								</div>
							</div>
							<?php if(!empty($address_book['address_type']) && $address_book['address_type']=='Other'){
								$display_class="display:block";
							}else{
								$display_class="display:none;";
							}
							?>
							<div class="col-md-6 col-sm-6 col-lg-6" id="other_address_type_field" style="<?php echo $display_class;?>">
								<label>Other Address Type <sup>*</sup></label>
								<input class="brd-rd3" id="other_address_type" name="other_address_type" type="text" value="<?php echo !empty($address_book['other_address_type'])? $address_book['other_address_type']: '';?>">
								<span class="error other_address_type_error" style="display:none;"></span>
							</div>
						</div>
					
				</div>
			</div>
		  
			<div class="col-md-12 col-sm-12 col-lg-12">
				<div class="loc-map2">
					<div class="loc-srch">
					<input type="submit" name="add_address" id="add_address" class="brd-rd3 red-bg font-white" value="Save Address">
					</div>
				</div>
			</div>
			<input type="hidden" name="current_url" value="<?php echo $this->input->get('redirect', TRUE); ?>">
			<?php echo form_close( ); ?>
		</div>
	</div>
</div>
</div>
<script>
$(document).ready(function(){
	getLocation();
});

</script>
 
<script>
jQuery('#shipping_area').on('change', function() {
	var area = jQuery('#shipping_area').val();
	jQuery.ajax({
		type:"post",
		url:'<?php echo base_url('my_account/addresses/retrievezipcode'); ?>',
		data:'area='+area,
		dataType: 'JSON',

		success:function(data){
			
			jQuery('#city').val(data.city);
			jQuery('#state').val(data.state);
			jQuery('#country').val(data.country);
			jQuery('#postcode').val(data.zipcode);
			
			billing_geocodeupdate();
		}
	});
});
jQuery('#address_type').on('change', function() {
	
	var selected_address_type = jQuery('#address_type').val();
	
    if(selected_address_type != 'Other'){
		jQuery("#other_address_type_field").hide();
		jQuery("#other_address_type").prop('required',false);
	}else{
		jQuery("#other_address_type_field").show();
		jQuery("#other_address_type").prop('required',true);
	}
	
});


$('#add_address').on('click', function(e){	
	//e.preventDefault();
	
	var name 				= $('#name').val();
	var email 				= $('#email').val();
	var phone 				= $('#phone').val();
	var shipping_area 		= $("#shipping_area option:selected").val();
	var address_1 			= $('#address_1').val();
	var address_type 		= $('#address_type option:selected').val();
	var other_address_type 	= $('#other_address_type').val();
	var address_lat 		= $('#address_lat').val();
	var address_lng 		= $('#address_lng').val();
	
	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	
	if(name==''){
		$(".name_error").show();
		$(".name_error").text('Please enter your name.');
		return false;
	}
	$(".name_error").hide();
	
	if(email==''){
		$(".email_error").show();
		$(".email_error").text("Please enter your email address.");
		return false;
	} else if(!emailReg.test(email)) {
		$(".email_error").show();
		$(".email_error").text("Enter a valid email address.");
		return false;
	}
	$(".email_error").hide();
	
	if(phone==''){
		$(".phone_error").show();
		$(".phone_error").text("Please enter Phone number.");
		return false;
	}else  if(!phone.match('[0-9]{10}'))  {
		$(".phone_error").show();
		$(".phone_error").text("Enter 10 Digit Phone number.");
		return false;
	}
	$(".phone_error").hide();
	
	if(shipping_area==''){
		$(".shipping_area_error").show();
		$(".shipping_area_error").text('Please select your shipping area.');
		return false;
	}
	$(".shipping_area_error").hide();
	
	if(address_1==''){
		$(".address_1_error").show();
		$(".address_1_error").text('Please enter your address.');
		return false;
	}
	$(".address_1_error").hide();
	
	if(address_type==''){
		$(".address_type_error").show();
		$(".address_type_error").text('Please select type.');
		return false;
	}else if(address_type=='Other' && other_address_type==''){
		$(".other_address_type_error").show();
		$(".other_address_type_error").text('Please enter other address type.');
		return false;
	}
	$(".other_address_type_error").hide();
	
	if(address_lat=='' || address_lng==''){
		$(".address_type_error").show();
		$(".address_type_error").text('Latitude and longitude not fount please enter proper address or move marker on map for exact cordinate of you address.');
		return false;
	}
	$(".address_type_error").hide();
	
	//$('#save_address').submit();
	return true;
	
 });
</script>