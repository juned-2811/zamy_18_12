<?php 
/* echo "<pre>";
print_r($all_restaurants);
echo "</pre>"; */

$cart_restaurant_id='';

if(!empty($cart_items)){
	foreach($cart_items as $order){
						
		$cart_restaurant_id = $order['restaurant_id'];
	}
}

?>
<input type='hidden' id='cart_restaurant_id' value="<?php echo $cart_restaurant_id;?>">
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.6/dist/loadingoverlay.min.js"></script>
<section>
<div class="block">
	<div class="fixed-bg" style="background-image: url(assets/images/topbg.jpg);"></div>
	<div class="page-title-wrapper text-center">
		<div class="col-md-12 col-sm-12 col-lg-12">
			<div class="page-title-inner">
				<h1 itemprop="headline">Search Your Favourite Food</h1>
				<?php echo form_open(base_url('search'),array('id'=>'search_restaurants','class'=>'restaurant-search-form brd-rd2')); ?>
					<div class="row mrg10">
						<div class="col-md-6 col-sm-5 col-lg-5 col-xs-12">
							<div class="input-field brd-rd2">
							<input class="brd-rd2" name="search_keyword" type="text" placeholder="Search for restaurants or dishes" value="<?php echo !empty($keyword)? $keyword : '';?>">
							</div>
						</div>
						<div class="col-md-4 col-sm-4 col-lg-4 col-xs-12">
							<div class="input-field brd-rd2 select-wrp">
							<?php 
							$area_list = $this->common_model->get_areas();
							
							?>
							<input type="hidden" name="current_url"  value="<?php echo current_url(); ?>">
							<select class="brd-rd2" name="search_area" id="search_area" data-placeholder="Choose Location">
							<option value="">CHOOSE LOCATION</option>
                            <?php
							foreach($area_list as $list){ 
								$selected = '';
								
									if($current_location ==  $list['area']){
										$selected = "selected ='selected'";
									}	
								?>
								<option value="<?php echo $list['area']?>" <?php echo $selected ;?>><?php echo $list['area']?></option>	
								
							<?php } ?>
                        </select>
							</div>
						</div>
						<div class="col-md-2 col-sm-3 col-lg-3 col-xs-12">
							<button class="brd-rd2 red-bg" type="submit">SEARCH</button>
						</div>
					</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>
</section>

<div class="bread-crumbs-wrapper">
<div class="container">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>" title="" itemprop="url">Home</a></li>
		<li class="breadcrumb-item"><a href="#" title="" itemprop="url">Search</a></li>
		<li class="breadcrumb-item active">Restaurants Found</li>
	</ol>
</div>
</div>

<section>
<div class="block gray-bg bottom-padd210 search_result">
	<div class="sec-box bottom-padd140">
		<div class="container">
			<div class="row">
				<div class="restaurant-detail-tabs">
					 <ul class="nav nav-tabs">
						<li class=""><a href="#Restaurants" data-toggle="tab" aria-expanded="false"><i class="fa fa-cutlery"></i> Restaurants</a></li>
						<li class="active"><a href="#Dishes" data-toggle="tab" aria-expanded="true"><i class="fa fa-cutlery"></i> Dishes</a></li>
					</ul>
				</div>
				<div class="tab-content">
					<div id="Restaurants" class="tab-pane fade">
						<div class="col-md-12 col-sm-12 col-lg-12">
							<div class="sec-wrapper">
								<div class="row">
									<div class="col-md-12 col-sm-12 col-lg-12">
										<div class="title2-wrapper">
										<br>
										<br>
											<h3 class="marginb-0" itemprop="headline">Restaurant's Found <?php echo count($all_restaurants);?></h3>
										</div>
										<div class="remove-ext">
											<div class="row">
											<?php 
											if(!empty($all_restaurants)){
											foreach($all_restaurants as $data){ 
											
											$res_name  				= $data['res_name'];
											$service_type  			= $data['service_type'];
											$approx_delivery_time  	= $data['approx_delivery_time'];
											$approx_cost  			= $data['approx_cost'];
											$images  				= $data['images'];
											$res_alias  			= $data['res_alias'];
											
											if(!empty($images)){
												$res_image =  $this->config->item('restaurant_image_url').$images;
											}else{
												$res_image = base_url('assets/images/resource/most-popular-img1.png');
											}
											
											
											$city  = $data['city'];
											$area  = $data['area'];
											$landmark  = $data['landmark'];
											
											$address = $city." ".$area." ".$landmark;
									
											?>
												<div class="col-md-6 col-sm-6 col-lg-6">
													<div class="featured-restaurant-box with-bg style2 brd-rd12 wow fadeIn" data-wow-delay="0.2s">
														<div class="featured-restaurant-thumb">
															<a href="restaurant-detail.html" title="" itemprop="url"><img src="<?php echo $res_image;?>" alt="most-popular-img1.png" itemprop="image"></a>
														</div>
														<div class="featured-restaurant-info">
															<span class="red-clr"><?php echo $address;?></span>
															<h4 itemprop="headline"><a href="restaurant-detail.html" title="" itemprop="url"><?php echo $res_name;?></a></h4>
															<span class="food-types">Type of food: <?php echo $service_type;?></span>
															<ul class="post-meta">
																<li><i class="fa fa-check-circle-o"></i> <?php echo $approx_cost;?></li>
																<li><i class="flaticon-transport"></i> <?php echo $approx_delivery_time;?></li>
																<li><i class="flaticon-money"></i> Accepts cash & online payments</li>
															</ul>
															<span class="post-rate yellow-bg brd-rd2"><i class="fa fa-star yellow-clr"></i> 4.25</span>
															<span class="post-likes style2 red-clr"><i class="fa fa-heart-o"></i> 12</span>
															<a class="brd-rd30" href="<?php echo base_url('restaurants/'.$data['res_alias']);?>" title="Order Online"><i class="fa fa-angle-double-right"></i> Order Online</a>
														</div>
													</div>
												</div>
												<?php }} ?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12 col-sm-12 col-lg-12">
							<div class="sec-wrapper">
								<div class="row">
									<div class="col-md-12 col-sm-12 col-lg-12">
										<div class="title2-wrapper">
										<br>
										<br>
											<h3 class="marginb-0" itemprop="headline">Other Restaurant's</h3>
										</div>
										<div class="remove-ext">
											<div class="row">
											<?php 
											if(!empty($other_restaurants)){
											foreach($other_restaurants as $or_data){ 
											
											$res_name  				= $or_data['res_name'];
											$service_type  			= $or_data['service_type'];
											$approx_delivery_time  	= $or_data['approx_delivery_time'];
											$approx_cost  			= $or_data['approx_cost'];
											$images  				= $or_data['images'];
											$res_alias  			= $or_data['res_alias'];
											
											if(!empty($images)){
												$res_image =  $this->config->item('restaurant_image_url').$images;
											}else{
												$res_image = base_url('assets/images/resource/most-popular-img1.png');
											}
											
											
											$city  = $or_data['city'];
											$area  = $or_data['area'];
											$landmark  = $or_data['landmark'];
											
											$address = $city." ".$area." ".$landmark;
									
											?>
												<div class="col-md-6 col-sm-6 col-lg-6">
													<div class="featured-restaurant-box with-bg style2 brd-rd12 wow fadeIn" data-wow-delay="0.2s">
														<div class="featured-restaurant-thumb">
															<a href="restaurant-detail.html" title="" itemprop="url"><img src="<?php echo $res_image;?>" alt="most-popular-img1.png" itemprop="image"></a>
														</div>
														<div class="featured-restaurant-info">
															<span class="red-clr"><?php echo $address;?></span>
															<h4 itemprop="headline"><a href="restaurant-detail.html" title="" itemprop="url"><?php echo $res_name;?></a></h4>
															<span class="food-types">Type of food: <?php echo $service_type;?></span>
															<ul class="post-meta">
																<li><i class="fa fa-check-circle-o"></i> <?php echo $approx_cost;?></li>
																<li><i class="flaticon-transport"></i> <?php echo $approx_delivery_time;?></li>
																<li><i class="flaticon-money"></i> Accepts cash & online payments</li>
															</ul>
															<span class="post-rate yellow-bg brd-rd2"><i class="fa fa-star yellow-clr"></i> 4.25</span>
															<span class="post-likes style2 red-clr"><i class="fa fa-heart-o"></i> 12</span>
															<a class="brd-rd30" href="<?php echo base_url('restaurants/'.$or_data['res_alias']);?>" title="Order Online"><i class="fa fa-angle-double-right"></i> Order Online</a>
														</div>
													</div>
												</div>
												<?php }} ?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>					
					</div>
					
					<div id="Dishes" class="tab-pane fade active in">
						<?php 
						if(!empty($all_dishes)){
						foreach($all_dishes as $key=>$res){
							$restaurant_id = $key;

							$restaurant_details = $this->common_model->restaurant_details($restaurant_id);
							
							$res_name 				= $restaurant_details['res_name'];
							$res_alias 				= $restaurant_details['res_alias'];
							$service_type 			= $restaurant_details['service_type'];
							$area 					= $restaurant_details['area'];
							$landmark 				= $restaurant_details['landmark'];
							$city_name 				= $restaurant_details['city_name'];
							$approx_delivery_time 	= $restaurant_details['approx_delivery_time'];
							$approx_cost 			= $restaurant_details['approx_cost'];
						?>
						<div class="dishes-list-wrapper">
							<h4 class="title3" itemprop="headline"><span class="sudo-bottom sudo-bg-red"><?php echo $res_name;?></span></h4>
							<span class="post-rate red-bg brd-rd2"><a href="<?php echo base_url('restaurants/'.$res_alias);?>">See Menu</a></span>
							
							<ul class="dishes-list">
							<?php 
							if(!empty($res)){
								
								$res = array_slice($res,0,5);
							foreach($res as $menu){
								
								$menu_id 		= $menu['foodmenu_id'];
								$menu_name 		= $menu['menu_name'];
								$description 	= $menu['long_description'];
								$price 			= $menu['price'];
								$reduced_price 	= $menu['reduced_price'];
								$tax_price 		= $menu['tax_price'];
								$food_type 		= $menu['food_type'];
								$menu_logo 		= $menu['menu_logo'];
								$veg_class = '';
								if($food_type==1){
									$veg_class = "veg-ic";
								}else{
									$veg_class = "non-veg-ic";
								}
								
								if(!empty($menu['product_variation'])){
											
									$variation_price = array_column($menu['product_variation'], 'variation_price');
									$variation_sale_price = array_column($menu['product_variation'], 'variation_sale_price');
									
									
									$min_price 			= min($variation_price);
									$min_reduced_price 	= min($variation_sale_price);
									
									$max_price 			= max($variation_price);
									$max_reduced_price 	= max($variation_sale_price);
									
									$vminprice = (!empty($min_reduced_price) && $min_reduced_price != '0.00' && $min_reduced_price < $min_price )? $min_reduced_price : $min_price;
									
									if(!empty($min_reduced_price) && $min_reduced_price != '0.00' && ($min_reduced_price < $min_price)){
										
										$vminprice = $min_reduced_price;
										$vmaxprice = $max_reduced_price;
										
									}else{
										$vminprice = $min_price;
										$vmaxprice = $max_price;
									}
								}
							?>
							<li class="wow fadeInUp" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
									<div class="featured-restaurant-box">
										<div class="featured-restaurant-thumb">
											<a href="#" title="" itemprop="url"><img src="<?php echo $menu_logo;?>" alt="dish-img1-1.jpg" itemprop="image"></a>
										</div>
										<div class="featured-restaurant-info">
											<i class="non-veg-ic"></i><h4 itemprop="headline"><a href="#" title="" itemprop="url"><?php echo $menu_name;?></a></h4>
											
											<div>
											<?php if(!empty($menu['product_variation'])){ ?>
											<span class="price"> 
											<?php
											echo "₹".$vminprice." - ₹".$vmaxprice;
											?></span>
											<?php }else{ ?>
												<span class="price">₹ <?php echo $menu['price']?></span>
											<?php } ?>
											</div>
																						
											<p itemprop="description"><?php echo $description;?></p>
											<br>
											<ul class="post-meta">
												<!--<li><i class="fa fa-check-circle-o"></i> Min order $50</li>-->
												<?php if(!empty($menu['minimum_preparation_time'])){?>
												<li><i class="flaticon-transport"></i> <?php echo $menu['minimum_preparation_time'];?></li>
												<?php } ?>
											</ul>
										</div>
										<div class="ord-btn">
											<?php if(!empty($menu['product_variation'])){ ?>
												<button id="addtocart_<?php echo $restaurant_id.$menu_id;?>" class="brd-rd2 variation" title="Order Now" itemprop="url" data-cart-control="load-item" data-menu-id="<?php echo $menu_id ?>" data-quantity="1"  onclick="select_menu_popup(<?php echo $restaurant_id?>,<?php echo $menu_id;?>,0)">CUSTOMIZE</button>
											<?php }else{ ?>
												<button id="addtocart_<?php echo $restaurant_id.$menu_id;?>" class="brd-rd2 btn-cart" title="Order Now" itemprop="url" data-cart-control="add-item" data-menu-id="<?php echo $menu_id ?>" data-quantity="1" onclick="select_menu(<?php echo $restaurant_id?>,<?php echo $menu_id ?>,0)">Order Now</button>
											<?php } ?>
										</div>
									</div>
								</li>
							<?php } }?>
							</ul>
						</div>
						<?php } }?>
					</div>
				</div>

											
			</div>
		</div>
	</div><!-- Section Box -->
</div>
</section>

<section>
<div class="block no-padding red-bg">
	<img class="bottom-clouds-mockup" src="assets/images/resource/clouds2.png" alt="clouds2.png" itemprop="image">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-lg-12">
				<div class="app-sec">
					<div class="row">
						<div class="col-md-4 hidden-sm col-md-offset-1 col-sm-4 col-sm-offset-0 col-lg-4 col-lg-offset-1">
							<div class="app-mockup text-right overlape-110 wow fadeInUp" data-wow-delay="0.2s"><img src="assets/images/resource/app-mockup.png" alt="app-mockup.png" itemprop="image"></div>
						</div>
						<div class="col-md-6 col-md-offset-1 col-sm-12 col-sm-offset-0 col-lg-6 col-lg-offset-1">
							<div class="app-info">
								<h4 itemprop="headline">The Best Food Delivery App</h4>
								<p itemprop="description">We have a launch team that focuses on one city at a time. At the end of the day, we're a marketplace. In order to make an effective marketplace, you need critical mass. We need enough restaurants that  quality and variety</p>
								<div class="app-download-btns">
									<a class="wow zoomInUp" data-wow-delay="0.2s" href="#" title="Google Play Store" itemprop="url" target="_blank"><img src="assets/images/resource/app-download-btn1.png" alt="app-download-btn1.png" itemprop="image"></a>
									<a class="wow zoomInUp" data-wow-delay="0.4s" href="#" title="Apple App Store" itemprop="url" target="_blank"><img src="assets/images/resource/app-download-btn2.png" alt="app-download-btn2.png" itemprop="image"></a>
								</div>
							</div>
						</div>
					</div>
				</div><!-- App Section -->
			</div>
		</div>
	</div>
</div>
</section><!-- red section -->
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
<div id="menu_variation_popup"></div>	
<script>
$(document).ready(function(){

	$(document).on("click", '.qty_btn', function(event) {
		
		jQuery(".qty_btn").attr('disabled',true);
		jQuery.LoadingOverlay("show");
		
		var rowid = $(this).closest('li').data('menu_variation');
		var qty = $(".order-list-inner  #tch3_"+rowid+"").val();
		
		var restaurant_id = $("#restaurant_id").val();
		
		jQuery.ajax({
			type : "POST",
			url  : '<?php echo base_url('users/update_cart'); ?>',
			data : {"rowid":rowid,"qty":qty,"restaurant_id":restaurant_id},
			async: false,
			success: function (response) {
				console.log(response);
				jQuery.LoadingOverlay("hide");
				jQuery(".qty_btn").removeAttr('disabled');
			}
		});
	});
	
	/* $("ul.order-list-inner li").each(function(i) {
			calculateColumn(i);
	});  */
});
function remove_menu_item(rowid){
	
	jQuery(".qty_btn").attr('disabled',true);
	jQuery.LoadingOverlay("show");
	
	var restaurant_id = $("#restaurant_id").val();
		
	jQuery.ajax({
		type : "POST",
		url  : '<?php echo base_url('users/remove_menu_item'); ?>',
		data : {"rowid":rowid,"restaurant_id":restaurant_id},
		async: false,
		success: function (response) {
			$(".menu_item_"+rowid+"").fadeOut(300, function(){ $(this).remove();});
			
			jQuery.LoadingOverlay("hide");
			jQuery(".qty_btn").removeAttr('disabled');
			
			get_cart_count();
		}, 
	});
}
function clear_cart(restaurant_id){
	
	if(restaurant_id==null){
		var restaurant_id = $("#restaurant_id").val();
	}
	
	jQuery(".qty_btn").attr('disabled',true);
	jQuery.LoadingOverlay("show");
		
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
			
			get_cart_count();
		}, 
	});
}
function select_menu_popup(restaurant_id,foodmenu_id,variation_id){
	
	jQuery.ajax({
		type : "POST",
		url  : '<?php echo base_url('users/menu_variation'); ?>',
		data : {"foodmenu_id":foodmenu_id,"restaurant_id":restaurant_id,"variation_id":variation_id },
		async: false,
		success: function (response) {
			/*var response = JSON.parse(response);*/
			$("#menu_variation_popup").append(response); 
			
			$('#VariationModal').modal('show');
		}, 
	});
}

$(document).on('click', '.variance_box', function(){
	var id = ($(this).attr("id"));  
	
	//var restaurant_id = $("#restaurant_id").val();
	  
	var restaurant_id 	= ($(".variance_select_"+id+"").data("restaurant_id"));  
	var foodmenu_id 	= ($(".variance_select_"+id+"").data("foodmenu_id"));  
	var variation_id 	= ($(".variance_select_"+id+"").data("variation_id"));
	
	select_menu(restaurant_id,foodmenu_id, variation_id);
});

function select_menu(restaurant_id,foodmenu_id, variation_id){
	
	jQuery(".qty_btn").attr('disabled',true);
	jQuery.LoadingOverlay("show");

	var cart_restaurant_id = $("#cart_restaurant_id").val();
	var cart_count = $("#cart_count").text();
	
	if(cart_count > 0){
		if(cart_restaurant_id!='' && (restaurant_id != cart_restaurant_id)){
			$('#VariationModal').modal('hide');
			$('#RestaurantChangeModal .yes').attr('onclick',"clear_cart("+restaurant_id+")");
			$('#RestaurantChangeModal').modal('show');
			jQuery.LoadingOverlay("hide");
			return false;
		}
	}
	
	var item_id = new Array(); 
	var menu_variation = ""+foodmenu_id+""+""+variation_id+"";
	var menu_and_variation = parseInt(menu_variation);
	
	$('.order-list-inner li').each(function() {
		item_id.push($(this).data('menu_id')); 
	});
	
	var variation_item_id = [];
	$('.order-list-inner li').each(function() {
		variation_item_id.push($(this).data('menu_variation'));
	});
	
	
	if(jQuery.inArray(foodmenu_id, item_id) !== -1 && (variation_id==null || variation_id==0) ){
		
		var current_qty = $(".order-list-inner  #tch3_"+menu_variation+"").val();
		
		var new_qty = parseInt(current_qty) + 1;
		
		var rowid = parseInt(foodmenu_id)+""+parseInt(variation_id); 
		
		jQuery.ajax({
			type : "POST",
			url  : '<?php echo base_url('users/update_cart'); ?>',
			data : {"rowid":rowid,"qty":new_qty,"restaurant_id":restaurant_id},
			async: false,
			success: function (response) {
				
				var response1 = JSON.parse(response);
				
				if(response1.success==1){
					
					/*On menu click update qty and update total*/
					
					
					var i = $("#tch3_"+rowid).TouchSpin({
						min: 1,
					});
					 
					$("#tch3_"+rowid).trigger("touchspin.uponce");
					$("#tch3_"+rowid).trigger("touchspin.updatesettings", {min: 1});
					
					var food_price = $(".menu_item_"+rowid).data('menu_price');
					
					var current_qty1 = $(".order-list-inner  #tch3_"+rowid+"").val();
		
					var new_qty1 = parseInt(current_qty1) + 1;
					var price1 =   (new_qty1 * parseFloat(food_price)) - food_price;
					
				
					$(".item_price_"+rowid).text(price1.toFixed(2));
					
					$("ul.order-list-inner li").each(function(i) {
						calculateColumn(i);
					});
				}
				jQuery.LoadingOverlay("hide");
				jQuery(".qty_btn").removeAttr('disabled');
			}, 
		});
		
	}else if(jQuery.inArray(menu_and_variation, variation_item_id) !== -1 && (menu_and_variation!=null || menu_and_variation!='')){
		
		var current_qty = $(".order-list-inner  #tch3_"+menu_variation+"").val();
		
		var new_qty = parseInt(current_qty) + 1;
		
		var rowid = parseInt(foodmenu_id)+""+parseInt(variation_id); 
		
		jQuery.ajax({
			type : "POST",
			url  : '<?php echo base_url('users/update_cart'); ?>',
			data : {"rowid":rowid,"qty":new_qty,"restaurant_id":restaurant_id},
			async: false,
			success: function (response) {
				
				var response1 = JSON.parse(response);
				
				if(response1.success==1){
					
					$("#addtocart_"+restaurant_id+foodmenu_id+"").after('<p class="addedtocart">Added to cart</p>');
					
					var i = $("#tch3_"+rowid).TouchSpin({
						min: 1,
					});
					 
					$("#tch3_"+rowid).trigger("touchspin.uponce");
					$("#tch3_"+rowid).trigger("touchspin.updatesettings", {min: 1});
					
					var food_price = $(".menu_item_"+rowid).data('menu_price');
					
					var current_qty1 = $(".order-list-inner  #tch3_"+rowid+"").val();
		
					var new_qty1 = parseInt(current_qty1) + 1;
					var price1 =   (new_qty1 * parseFloat(food_price)) - food_price;
					
				
					$(".item_price_"+rowid).text(price1.toFixed(2));
					
					$("ul.order-list-inner li").each(function(i) {
						calculateColumn(i);
					});
				}
				$('#VariationModal').modal('hide');
				jQuery.LoadingOverlay("hide");
				jQuery(".qty_btn").removeAttr('disabled');
			}, 
		});
		
	}else{
		
		var last_sr_no = $('ul.order-list-inner li').length;
		
		jQuery.ajax({
			type : "POST",
			url  : '<?php echo base_url('users/add_to_cart'); ?>',
			data : {"foodmenu_id":foodmenu_id,"variation_id":variation_id,"restaurant_id":restaurant_id,"last_sr_no":last_sr_no},
			async: false,
			success: function (response) {
				//var response = JSON.parse(response);.
				$(".addedtocart").remove();
				$("#cart_restaurant_id").val(restaurant_id);
				$("#addtocart_"+restaurant_id+foodmenu_id+"").after('<p class="addedtocart">Added to cart</p>');
				$("#orders").append(response);
				//$("#orders").prepend(response);
				$('#VariationModal').modal('hide');
				
				jQuery.LoadingOverlay("hide");
				jQuery(".qty_btn").removeAttr('disabled');
				
				get_cart_count();
			}, 
		});
	}
}

function calculateColumn(index) {
	
	var total = 0.00;
	$("ul.order-list-inner li .price").each(function() {
		var value = parseFloat($(this).text());	
		if (!isNaN(value)) {
			total += value;
		} 
	});
	
	var delivery_fee = $("#delivery_fee").text();
	
	$("#sub_total").text(parseFloat(total));
	$("#total_amount").text(parseFloat(total) + parseFloat(delivery_fee));
	
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

function restaurants_favourite(restaurant_id){
	$.ajax({
		url: '<?php echo base_url("Restaurants/fav_restaurants");?>',
		type: 'post',
		data: {restaurant_id:restaurant_id},
		dataType: 'json',
		success: function (data) {
			console.log(data);
			
			$("#h_heart").removeClass('far');
			$("#h_heart").addClass('fa');
		},
		error: function () {
			alert("error");
		}
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
</script>