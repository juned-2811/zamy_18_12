<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.6/dist/loadingoverlay.min.js"></script>
<div class="bread-crumbs-wrapper">
	<div class="container">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?php echo base_url();?>" title="" itemprop="url">Home</a></li>
			<li class="breadcrumb-item"><a href="<?php echo base_url('restaurants');?>" title="" itemprop="url">Restaurant</a></li>
			<li class="breadcrumb-item active">Restaurant Details</li>
		</ol>
	</div>
</div>
<style>
.restaurant-detail-wrapper .ord-btn {
     padding: 0 0px;
    text-align: center;
    width: 30%;
}
</style>

<section>
<div class="block gray-bg">
<div class="sec-box">
<div class="container">
<div class="row">
<div class="col-md-12 col-sm-12 col-lg-12">
<div class="sec-wrapper">
<div class="row">
	<div class="col-md-8 col-sm-12 col-lg-8">
		<div class="restaurant-detail-wrapper">
			<div class="restaurant-detail-info">
				<div class="restaurant-detail-thumb">
					<ul class="restaurant-detail-img-carousel">
						<!--<li><img class="brd-rd3" src="<?php //echo base_url()?>assets/images/resource/restaurant-detail-big-img1-1.jpg" alt="restaurant-detail-big-img1-1.jpg" itemprop="image"></li>
						<li><img class="brd-rd3" src="<?php //echo base_url()?>assets/images/resource/restaurant-detail-big-img1-2.jpg" alt="restaurant-detail-big-img1-2.jpg" itemprop="image"></li>
						<li><img class="brd-rd3" src="<?php //echo base_url()?>assets/images/resource/restaurant-detail-big-img1-3.jpg" alt="restaurant-detail-big-img1-3.jpg" itemprop="image"></li>-->
						<?php  
						$gallery_image = '';
						if (!empty($image_gallery_info)) {
 
                        foreach ($image_gallery_info as $images) {
							if(isset($images['gallery']) && $images['gallery']!=''){
								$gallery_image = 'http://pos.zamy.in/uploads/kitchen/gallery/'.$images['gallery'];
							}
                        ?>
						<li><img class="brd-rd3" src="<?php echo $gallery_image;  ?>"  itemprop="image" ></li>
					<?php  }  
                      }
					?>

					</ul>
					<ul class="restaurant-detail-thumb-carousel">
						<!--<li><img class="brd-rd3" src="<?php //echo base_url()?>assets/images/resource/restaurant-detail-small-img1-1.jpg" alt="restaurant-detail-small-img1-1.jpg" itemprop="image"></li>
						<li><img class="brd-rd3" src="<?php //echo base_url()?>assets/images/resource/restaurant-detail-small-img1-2.jpg" alt="restaurant-detail-small-img1-2.jpg" itemprop="image"></li>
						<li><img class="brd-rd3" src="<?php //echo base_url()?>assets/images/resource/restaurant-detail-small-img1-3.jpg" alt="restaurant-detail-small-img1-3.jpg" itemprop="image"></li>-->
						<?php
						$images_thumb = '';
                      if (!empty($image_gallery_info)) {
                        foreach ($image_gallery_info as $images_thumb) {
						
						if(isset($images_thumb['gallery']) && $images_thumb['gallery']!=''){
						
						$images_thumb = 'http://pos.zamy.in/uploads/kitchen/gallery/'.$images_thumb['gallery'];
						}
                        ?>
						<li><img class="brd-rd3" src="<?php echo $images_thumb;  ?>" height="50" width="50" itemprop="image"></li>
						<?php  }
                          }
						?>
					</ul>
				</div>
				<div class="restaurant-detail-title">
					<h1 itemprop="headline"><?php echo $restaurant_details['res_name']?></h1>
					<div class="info-meta">
						<span><?php echo $restaurant_details['area'].", ".$restaurant_details['landmark']?></span>
						<span><?php echo $restaurant_details['service_type']?></span>
					</div>
				</div>

				<div class="restaurant-detail-tabs">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#tab1-1" data-toggle="tab"><i class="fa fa-cutlery"></i> Menu</a></li>
						<li><a href="#tab1-2" data-toggle="tab"><i class="fa fa-picture-o"></i> Gallery</a></li>
						
						<li><a href="#tab1-5" data-toggle="tab"><i class="fa fa-info"></i> Restaurant Info</a></li>
						<li class="filter_veg">
								<div class="check-box">
									<input type="checkbox" name="filter" id="veg_only" value="1">
									<label for="veg_only">Veg Only</label>
								</div>
						</li>
						<li>
							<?php  
							   if ($this->session->has_userdata('cust_id')) {
                               $customer_id = $this->session->userdata('cust_id');

                             ?>
							<a href="JavaScript:Void(0)" type="button" id="add_this_res_to_fav" onclick="restaurants_favourite(<?php echo $restaurant_id;?>);"><i class="fa fa-heart-o" id="h_heart"></i>Favorite</a>		    			
						    <?php  } ?>		 
						</li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane fade in active" id="tab1-1">
							<form class="search-dish">
								<input type="hidden" id="restaurant_id" value="<?php echo $restaurant_id;?>">
								<input type="text" id="search" placeholder="Search for dishes...">
								<button type="submit"><i class="fa fa-search"></i></button>
							</form>
							
							<div class="col-md-4 col-sm-12 col-lg-4">
								<div class="sidebar left">
									<div class="widget style2 Search_filters">
										<h4 class="widget-title2 sudo-bg-red" itemprop="headline">Category Filters</h4>
										<div class="widget-data">
											<ul>
											<?php
											$total_items = 0;
											if(!empty($all_categories)){
											foreach($all_categories as $cat){
											$category_id = $cat['cat_id'];
											
											$total_items += count($cat['menu_items']);
											
											$name 	= get_field('food_category','cat_name',array('cat_id'=>$cat['cat_id']));
											?>
											 <li id="cat_list_dis_<?php echo $cat['cat_id'];?>" counter_li="<?php echo $cat['cat_id'];?>" class="cat_calss"><a href="javascript:" onclick="show_cat_menu_items(<?php echo $cat['cat_id'];?>)" title="<?php echo $name;?>" itemprop="url"><?php echo $name;?></a> 
											 <span>
												<div class="cat_item_count" id="cat_item_count_<?php echo $category_id;?>">
													<?php echo count($cat['menu_items'])?>
												</div>
												<div class="hidden cat_item_count_filter" id="cat_item_count_filter_<?php echo $category_id;?>">
												</div>
												<div count_cat_id="<?php echo $category_id;?>" class='veg_display'><b  class="current_counters" id="counter_cat_val_<?php echo $category_id;?>"></b></div>
											 </span>
											 </li>
											<?php } } ?>
											
											<li counter_li="<?php echo $cat['cat_id'];?>" class="cat_calss">
											<a href="javascript:" id="cat_list_dis_0" class="side_cat_view_all" title="View All" onclick="view_all_menus();">View All </a>
											
											 <span>
												<div class="cat_item_count_total" id="view_all_menuss">
													<?php echo $total_items?>
												</div>
												<div class="hidden cat_item_count_filter" id="all_veg_items">
												</div>
											 </span>
											 </li>
											</ul>
										</div>
									</div>
								</div><!--Sidebar -->
							</div>
								
							<div class="col-md-8">
							<div class="search_div" style="display:none;">
							<h4 class="title3">Search Results</h4>
							<div class="search_count"></div>
							</div>
							<div id="search_out">
							
							</div>
							<div id="list_all_menus">
							<?php 
								if(!empty($all_items)){
								foreach($all_items as $item){
								
								$category_id = $item['cat_id'];
								$cat_name 	= get_field('food_category','cat_name',array('cat_id'=>$category_id));

							?>
								
									<div class="dishes-list-wrapper">
									<div id="menu_cat_<?php echo $category_id;?>" data-cat_id="<?php echo $category_id;?>" class="category_div">
										<h4 class="title3" itemprop="headline"><span class="sudo-bottom sudo-bg-red"><?php echo $cat_name;?></span></h4>
									
										<ul class="dishes-list">
										<?php 
											if(!empty($item['menu_items'])){
											$i=1;
											foreach($item['menu_items'] as $menu){
											
											$menu_id 		= $menu['foodmenu_id'];
											
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
											<li id="cat_item_" class="wow fadeInUp cat_item pure_veg_<?php echo $menu['food_type'];?>" data-wow-delay="0.<?php echo $i;?>s">
												<div class="featured-restaurant-box">
													<div class="featured-restaurant-thumb">
														<a href="#" title="" itemprop="url"><img src="<?php echo $menu['menu_logo'] ; ?> " alt="<?php echo $menu['menu_logo'] ?>" itemprop="image"></a>
													</div>
													<div class="featured-restaurant-info">
														<h4 itemprop="headline" class="item_name"><?php echo $menu['menu_name']?></h4>
										<?php 
										$food_id = $menu['foodmenu_id'];
                                     	$CI =& get_instance();
				                        $rating_count = get_rating_for_food($food_id);
				                        $total_avg = $rating_count['ratings_sum']/5;
                                        $stock_status 	= get_field('foodmenu','stock_status',array('foodmenu_id'=>$food_id));
										?>	
										<input type="hidden" name="food_id_get" id="food_id_get" value="<?php echo $food_id;  ?>">			
														
														<p itemprop="description"><?php echo $menu['long_description']?></p>
														<ul class="post-meta">
															<li><i class="flaticon-transport" data-toggle="tooltip" title="Dellivery Time"></i> 30min</li>
															<li><span class="post-rate yellow-bg brd-rd2"><i class="fa fa-star yellow-clr" data-toggle="tooltip" title="Rating"></i><?php echo $total_avg; ?></span></li>
															<li>
																<a href="JavaScript:Void(0)" type="button" title="Favourit Food" id="add_this_food_to_fav_<?php echo $food_id; ?>" onclick="food_favourite(<?php echo $food_id; ?>);"><i class="fa fa-heart-o" id="hh_heart"></i></a>
															</li>
														</ul>
													</div>
													<div class="ord-btn">
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
					    <?php 
					          
					         if($stock_status == 3) {
						?>
						<button id="not_avilable" title="stock is not avilable" class="btn btn-info not_avilable">Not Available</button>			
						<?php 
						    }
						    else{

						?>		
														<?php if(!empty($menu['product_variation'])){ ?>
															<button id="addtocart_<?php echo $restaurant_id.$menu_id;?>" class="brd-rd2 variation" title="Order Now" itemprop="url" data-cart-control="load-item" data-menu-id="<?php echo $menu_id ?>" data-quantity="1"  onclick="select_menu_popup(<?php echo $restaurant_id?>,<?php echo $menu_id;?>,0)">CUSTOMIZE</button>
														<?php }else{ ?>
															<button id="addtocart_<?php echo $restaurant_id.$menu_id;?>" class="brd-rd2 btn-cart" title="Order Now" itemprop="url" data-cart-control="add-item" data-menu-id="<?php echo $menu_id ?>" data-quantity="1" onclick="select_menu(<?php echo $restaurant_id?>,<?php echo $menu_id ?>,0)">Order Now</button>
														<?php } ?>
                                        <?php  }  ?>
													</div>
												</div>
											</li>
											<?php
											$i++;
												}
											}
											?>
										</ul>
									</div>
								</div>
							<?php 
								} 
								}
							?>
							
							</div>
							</div>
							
							
						</div>
						<div class="tab-pane fade" id="tab1-2">
							<div class="restaurant-gallery">
								<h4 class="title3" itemprop="headline"><span class="sudo-bottom sudo-bg-red"><?php echo $restaurant_details['res_name'] ?> Gallery</h4>
								<div class="remove-ext">
									<div class="row">
										<!--<div class="col-md-6 col-sm-6 col-lg-6">
											<div class="restaurant-gallery-img"><a href="<?php //echo base_url()?>assets/images/resource/restaurant-gallery-img1.jpg" data-fancybox="gallery" title="" itemprop="url"><img src="<?php //echo base_url()?>assets/images/resource/restaurant-gallery-img1.jpg" alt="restaurant-gallery-img1.jpg" itemprop="image"></a></div>
										</div>
										<div class="col-md-6 col-sm-6 col-lg-6">
											<div class="restaurant-gallery-img"><a href="<?php //echo base_url()?>assets/images/resource/restaurant-gallery-img2.jpg" data-fancybox="gallery" title="" itemprop="url"><img src="<?php //echo base_url()?>assets/images/resource/restaurant-gallery-img1.jpg" alt="restaurant-gallery-img1.jpg" itemprop="image"></a></div>
										</div>-->
						<?php  
                          //$i = 1;
						$image_gallery ='';
                        foreach ($image_gallery_info as $images_gallery) {
						
						if(isset($images_gallery['gallery']) && $images_gallery['gallery']!=''){
							$image_gallery = 'http://pos.zamy.in/uploads/kitchen/gallery/'.$images_gallery['gallery'];
						}
                        ?>
										<div class="col-md-12 col-sm-12 col-lg-12">
											<div class="restaurant-gallery-img"><a href="<?php echo $image_gallery;  ?>" data-fancybox="gallery" title="" itemprop="url"><img src="<?php echo $image_gallery;  ?>" itemprop="image"></a></div>
										</div>
						<?php  }  ?>				
										<!--<div class="col-md-6 col-sm-6 col-lg-6">
											<div class="restaurant-gallery-img"><a href="<?php //echo base_url()?>assets/images/resource/restaurant-gallery-img4.jpg" data-fancybox="gallery" title="" itemprop="url"><img src="<?php //echo base_url()?>assets/images/resource/restaurant-gallery-img4.jpg" alt="restaurant-gallery-img4.jpg" itemprop="image"></a></div>
										</div>
										<div class="col-md-6 col-sm-6 col-lg-6">
											<div class="restaurant-gallery-img"><a href="<?php //echo base_url()?>assets/images/resource/restaurant-gallery-img5.jpg" data-fancybox="gallery" title="" itemprop="url"><img src="<?php //echo base_url()?>assets/images/resource/restaurant-gallery-img5.jpg" alt="restaurant-gallery-img5.jpg" itemprop="image"></a></div>
										</div>-->
									</div>
								</div>
							</div>
						</div>
						
						
						<div class="tab-pane fade" id="tab1-5">
							<div class="restaurant-info-wrapper">
								<h3 class="title3" itemprop="headline">Restaurant Info</h3>
								<div class="loc-map" id="loc-map"></div>
								<ul class="restaurant-info-list">
									<li>
										<i class="fa fa-map-marker red-clr"></i>
										<strong>Address :</strong>
										<span>2nd Street, East-West Mansion Flat A2 231 Newyork NY 10003</span>
									</li>
									<li>
										<i class="fa fa-phone red-clr"></i>
										<strong>Call us & Hire us</strong>
										<span>+32 (0) 598 65 8968</span>
									</li>
									<li>
										<i class="fa fa-envelope-o red-clr"></i>
										<strong>Have any questions?</strong>
										<span>Support@webinane.com</span>
									</li>
									<li>
										<i class="fa fa-fax red-clr"></i>
										<strong>Fax</strong>
										<span>+652 235 89658965</span>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-4 col-sm-12 col-lg-4">
		<div class="order-wrapper wow fadeIn" data-wow-delay="0.2s" id="myScrollspy">
			<div class="order-inner gradient-brd" data-spy="affix" data-offset-top="205">
				<span class="clear_cart_span pull-right">
				<button class="brd-rd2 clear_cart_span" onclick="clear_cart()">CLEAR CART</button>
				</span>
				<h4 itemprop="headline">Your Order</h4>
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
						$veg_class ='';
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
								<?php /*<i>.<span class="sr_no"><?php echo $item_count;?></span></i>*/?>
								<i class="<?php echo $veg_class;?>"></i>
								<h6 itemprop="headline"><?php echo $order["menu_name"].$variation_name; ?></h6>
								<span class="price"><i class="fa fa-rupee"></i><span class="item_price_<?php echo $foodmenu_id.$variation_id ?>"><?php echo $order["subtotal"]; ?></span></span>
							</div>
							<div class="qty-wrap mor-ingredients">
							<input type="hidden" name="coupon_code" id="coupon_code" value="<?php echo $coupon_code ?>">
								<input id="tch3_<?php echo $foodmenu_id.$variation_id;?>" data-rowid="<?php echo $foodmenu_id.$variation_id ?>" type="text" value="<?php echo $order["qty"]; ?>" class="qty" name="tch3_23" data-bts-button-down-class="qty_btn btn btn-secondary btn-outline" data-bts-button-up-class="qty_btn btn btn-secondary btn-outline">
								
								<button class="brd-rd2 qty_btn btn btn-secondary btn-outline bootstrap-touchspin-down" onclick="remove_menu_item(<?php echo $foodmenu_id.$variation_id ?>)"><i class="fa fa-trash"></i></button>
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
					
					$(document).ready(function(){
						$("ul.order-list-inner li").each(function(i) {
							calculateColumn(i);
						}); 
					});
					</script>';
						
						$item_count++;
						}
						}
						echo "<input type='hidden' id='cart_restaurant_id' value='".$cart_restaurant_id."'>";
						?>
						
					</ul>
					<ul class="order-total">
						<li><span>SubTotal    </span> <i class="fa fa-rupee"><span id="sub_total"><?php echo $cart_total;?></span></i></li> 
						<li><span>Delivery fee</span> <i class="fa fa-rupee"><span id="delivery_fee"><?php echo $delivery_charge;?></span></i></li>
						<!--<li><span>Tax</span> <i>$12</i></li>-->
					</ul>
					<ul class="order-method brd-rd2 red-bg">
						<li><span>Total</span> <span class="price"><i class='fa fa-rupee'></i><span id="total_amount"><?php echo $cart_total + $delivery_charge ?></span></span></li>
						<!--<li><span class="radio-box cash-popup-btn"><input type="radio" name="method" id="pay1-1"><label for="pay1-1"><i class="fa fa-money"></i> Cash</label></span> <span class="radio-box card-popup-btn"><input type="radio" name="method" id="pay1-2"><label for="pay1-2"><i class="fa fa-credit-card-alt"></i> Card</label></span></li>-->
						<!--<li><a class="brd-rd2" href="#" title="" itemprop="url">CONFIRM ORDER</a></li>-->
						<li>
						<?php if($this->session->has_userdata('cust_id')) {?>
                        <a class="" href="<?php echo base_url('checkout');?>" title="CART" itemprop="url">CHECKOUT</a>
						<?php }else{ ?>
						<a class="log-popup-btn" href="#" title="CART" itemprop="url">CHECKOUT</a>
						<?php } ?>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
</div>
</div>
</div><!-- Section Box -->
</div>
</section>
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
				 
				jQuery.LoadingOverlay("hide");
				jQuery(".qty_btn").removeAttr('disabled');

				var delivery_fee = $("#delivery_fee").text();
				
				$("#sub_total").text(parseFloat(data.data.total));
				$("#total_amount").text(parseFloat(total) + parseFloat(delivery_fee));
				 
			}
		});
	});
	 
	
	$("ul.order-list-inner li").each(function(i) {
			calculateColumn(i);
	}); 
});
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
			
			var delivery_fee = $("#delivery_fee").text();
	
			$("#sub_total").text(parseFloat(response_new.data));
			$("#total_amount").text(parseFloat(response_new.data) + parseFloat(delivery_fee));
		}, 
	});
}
function clear_cart(){
	var restaurant_id = $("#restaurant_id").val();
	
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
			$("#cart_restaurant_id").val('');
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
			$("#menu_variation_popup").html(''); 
			$("#menu_variation_popup").append(response); 
			
			$('#VariationModal').modal('show');
		}, 
	});
}

$(document).on('click', '.variance_box', function(){
	var id = ($(this).attr("id"));  
	
	var restaurant_id = $("#restaurant_id").val();
	  
	var foodmenu_id 	= ($(".variance_select_"+id+"").data("foodmenu_id"));  
	var variation_id 	= ($(".variance_select_"+id+"").data("variation_id"));
	
	select_menu(restaurant_id,foodmenu_id, variation_id);
});

function select_menu(restaurant_id,foodmenu_id, variation_id){
	
	jQuery(".qty_btn").attr('disabled',true);
	jQuery.LoadingOverlay("show");

	var cart_restaurant_id = $("#cart_restaurant_id").val();

	if(cart_restaurant_id!='' && (restaurant_id != cart_restaurant_id)){
		jQuery.LoadingOverlay("hide");
		
		$('#VariationModal').modal('hide');
		$('#RestaurantChangeModal').modal('show');
		
		return false;
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
function apply_coupon(sub_total,coupon_code,restaurant_id){
	
		jQuery.ajax({
			type : "POST",
			url  : '<?php echo base_url('checkout/apply_coupon'); ?>',
			data : {"sub_total":sub_total,"coupon_code":coupon_code,"restaurant_id":restaurant_id},
			async: false,
			success: function (response) {
				var dataResult = JSON.parse(response);
				
				
				
				jQuery.LoadingOverlay("hide");
				
				if(dataResult.success==1){
					 
					 
					 
					var after_apply = dataResult.data.total;
					 
					$('#coupon_code').text(coupon_code);
					//$('#coupon_amount').text(dataResult.data.discount_amount);
					//$('#coupon_amount_input').val(dataResult.data.discount_amount);
					if(after_apply > 0){
						$('#total_amount').text(after_apply);
					}else{
						$('#total_amount').text(0);
					}
					$('#coupon_message').html("Promocode applied successfully !");
					$('.remove_coupon').css('display','block');
					
					
					
					
					
				}else{
					$('#coupon_message').html(dataResult.msg);
				}
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
$(document).ready(function() {
	var restaurant_id = $("#restaurant_id").val();
   	$.ajax({
		url: '<?php echo base_url("Restaurants/chek_res_fav_status");?>',
		type: 'post',
		data: {restaurant_id:restaurant_id},
		success: function (data) {
			if (data == 1) {
			$("#h_heart").removeClass('fa-heart-o');
			$("#h_heart").addClass('fa-heart');
			$("#h_heart").css("color", "red");
		    }
		},
		error: function () {
			alert("error");
		}
	});	 
});
$(document).ready(function() {
	var restaurant_id = $("#restaurant_id").val();
	var foodmenu_id = $("#food_id_get").val();
   	$.ajax({
		url: '<?php echo base_url("Restaurants/chek_food_fav_status");?>',
		type: 'post',
		data: {'foodmenu_id':foodmenu_id,'restaurant_id':restaurant_id},
		success: function (data) {
			if (data == 1) {
			$("#hh_heart").removeClass('fa-heart-o');
			$("#hh_heart").addClass('fa-heart');
			$("#hh_heart").css("color", "red");
		    }
		},
		error: function () {
			alert("error");
		}
	});	 
});
function restaurants_favourite(restaurant_id){
	$.ajax({
		url: '<?php echo base_url("Restaurants/fav_restaurants");?>',
		type: 'post',
		data: {restaurant_id:restaurant_id},
		dataType: 'json',
		success: function (data) {
			console.log(data);
			$("#h_heart").removeClass('fa-heart-o');
			$("#h_heart").addClass('fa-heart');
			$("#h_heart").css("color", "red");
		},
		error: function () {
			alert("error");
		}
	});	
}
function food_favourite(foodmenu_id){
	var restaurant_id = $("#restaurant_id").val();
		jQuery.LoadingOverlay("show");
 	
	$.ajax({
		url: '<?php echo base_url("Restaurants/fav_food");?>',
		type: 'post',
		data: {'foodmenu_id':foodmenu_id,'restaurant_id':restaurant_id},
		dataType: 'html',
		success: function (data) {
			  
			$("#hh_heart").removeClass('fa-heart-o');
			$("#hh_heart").addClass('fa-heart');
			$("#hh_heart").css("color", "red");
            jQuery.LoadingOverlay("hide");
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

function show_cat_menu_items(cat_id){
	
	var restaurant_id = $("#restaurant_id").val();
	jQuery.LoadingOverlay("show");
	$.ajax({
		url: '<?php echo base_url("Restaurants/filter_cate_item");?>',
		type: 'post',
		data: {'cat_id':cat_id,'restaurant_id':restaurant_id},
		dataType: 'html',
		success: function (data) {
			console.log(data);
			
			$("#list_all_menus").html(data);
			
			if($('#veg_only').prop("checked") == true){
				$("#veg_only").prop('checked', false);
				$("#veg_only").trigger("click");
            }else{
				$( ".category_div" ).each(function( index ) {
					var cat_id= $( this).data('cat_id');
					$("#menu_cat_"+cat_id+"").show();
					$(".side_cat_"+cat_id+"").show();
					var cat_item = $("#menu_cat_"+cat_id+" .cat_item").length;
						
					$("#cat_item_count_"+cat_id+"").removeClass("hidden");
					$("#cat_item_count_filter_"+cat_id+"").addClass("hidden");
					$("#cat_item_count_filter_"+cat_id+"").text('');
				});

				$(".pure_veg_2").removeClass("hidden");
				$('.pure_veg_1').removeClass("hidden");
			}
            
			jQuery.LoadingOverlay("hide");
		},
		error: function () {
			alert("error");
		}
	});
}
function view_all_menus(){
	
	var restaurant_id = $("#restaurant_id").val();
	
	jQuery.LoadingOverlay("show");
	
	$.ajax({
		url: '<?php echo base_url("Restaurants/view_all_menus");?>',
		type: 'post',
		data: {restaurant_id:restaurant_id},
		dataType: 'html',
		success: function (data) {
			console.log(data);
			
			$("#list_all_menus").html(data);
			
			$("#veg_only").prop('checked', false);
			
			jQuery.LoadingOverlay("hide");
		},
		error: function () {
			alert("error");
		}
	});
}

$("#veg_only").on('click',function(){

if($(this).is(':checked')){
  
	$(".pure_veg_2").addClass("hidden");
	$('.pure_veg_1').removeClass("hidden");
	

	$( ".category_div" ).each(function( index ) {
		 
		var cat_id= $( this).data('cat_id');
		
		
		/*$("#cat_item_count_"+cat_id+"").addClass("hidden");
		$("#cat_item_count_filter_"+cat_id+"").removeClass("hidden");*/
		
		var cat_item = $("#menu_cat_"+cat_id+" .pure_veg_1").length;
		if(cat_item==0){
			$("#menu_cat_"+cat_id+"").hide();
			$(".side_cat_"+cat_id+"").hide();
		}else{
			$("#menu_cat_"+cat_id+"").show();
			$(".side_cat_"+cat_id+"").show();
		}
		
		$("#cat_item_count_filter_"+cat_id+"").text('');
		$("#cat_item_count_filter_"+cat_id+"").text(cat_item);
		
	});
	
	
}else{
	$( ".category_div" ).each(function( index ) {
		var cat_id= $( this).data('cat_id');
		$("#menu_cat_"+cat_id+"").show();
		$(".side_cat_"+cat_id+"").show();
		var cat_item = $("#menu_cat_"+cat_id+" .cat_item").length;
			
		/*$("#cat_item_count_"+cat_id+"").removeClass("hidden");
		$("#cat_item_count_filter_"+cat_id+"").addClass("hidden");*/
		$("#cat_item_count_filter_"+cat_id+"").text('');
	});
	
	$(".pure_veg_2").removeClass("hidden");
	$('.pure_veg_1').removeClass("hidden");
	
	/*$(".cat_item_count").removeClass("hidden");
	$(".cat_item_count_filter").addClass("hidden");*/
}
});

$("#veg_only").click(function(){
    if($(this).prop("checked") == true){
        var restaurant_id = $("#restaurant_id").val();
        $.ajax({
          url : '<?php echo base_url("Restaurants/get_food_menu_for_filter_count");?>',
          data : {restaurant_id,restaurant_id},
          type : 'POST',
          success : function(data){
          	 
           var obj = JSON.parse(data);
           var menu_list  = obj;
			var yourArray = new Array;
			var foodcountArray = new Array;
           for (var i = 0; i < menu_list.length; i++) {
           	//alert(menu_list[i]['food_category_id']);
            var cat_id = menu_list[i]['food_category_id'];
            yourArray.push(cat_id);
           	var foodcount   = menu_list[i]['total_category_count'];
            foodcountArray.push(foodcount);
            //$("#cat_item_count_"+cat_id+"").addClass("hidden");       
            //$("#cat_item_count_filter_"+cat_id+"").addClass("hidden");
            //$("#counter_cat_val_"+cat_id+"").text(foodcount);
            //$("#counter_cat_val_"+cat_id+"").removeClass("hidden");
           	$("#counter_cat_val_"+cat_id+"").text(foodcount);

            
           	


           }
			$(".cat_calss").each(function(){
                  var id  = $(this).attr('counter_li');
 
                
                if(jQuery.inArray(id, yourArray) == -1){
                	 $("#cat_item_count_"+id+"").addClass("hidden");	
            		$("#counter_cat_val_"+id+"").text(0);
            	}
            	
               
            });
           
            $(".cat_item_count").addClass("hidden");
    	    $(".veg_display").removeClass("hidden");  
          },
          error : function(){
          	alert("ERROR");
          }
        });
    }
    else if($(this).prop("checked") == false){
    	$(".cat_item_count").removeClass("hidden");
    	$(".veg_display").addClass("hidden");
 
    }

});
$(".not_avilable").click(function(){
alert('Product is Not Available right now');
});
</script>