<div class="" id="account-settings">
	<div class="tabs-wrp account-settings brd-rd5">
	  <h4 itemprop="headline">Favourites Food</h4>
	  <div class="account-settings-inner">
		<section>
			<div class="block gray-bg bottom-padd210">
				<div class="sec-box bottom-padd140">
					<div class="container">
						<div class="row">
							<div class="col-md-12 col-sm-12 col-lg-12">
								<div class="sec-wrapper">
									<div class="row">							
										<div class="col-md-6 col-sm-6 col-lg-6">
											<!--<div class="title2-wrapper">
												<h3 class="marginb-0" itemprop="headline">Order food online in <?php //echo $current_location?></h3>
											</div>-->
											<div class="remove-ext">
												<div class="row">
												<?php 
												if(!empty($food)){
												foreach($food as $data){ 
												$foodmenu_id            = $data['foodmenu_id'];
												$menu_name  			= $data['menu_name'];
												$images  				= $data['menu_logo'];
												$price  				= $data['price'];
												$res_alias				= $data['res_alias'];

												if(!empty($images) && file_exists( $this->config->item('foodMenu_image_basepath').$images)){
													$res_logo = $images;
											    }
												else{
													$res_logo = base_url('assets/images/resource/most-popular-img1.png');	
												}												
												?>
													<div class="col-md-12 col-sm-12 col-lg-12">
														<div class="featured-restaurant-box with-bg style2 brd-rd12 wow fadeIn" data-wow-delay="0.2s">
															<div class="featured-restaurant-thumb">
																<a href="<?php echo base_url('restaurants/').$res_alias; ?>" title="" itemprop="url"><img src="<?php echo $this->config->item('foodMenu_image_url').$res_logo?>" alt="<?php echo $res_logo;  ?>" itemprop="image"></a>
															</div>
															<div class="featured-restaurant-info">
																<!-- <span class="red-clr"><?php echo "address";?></span> -->
																<h4 itemprop="headline"><a href="<?php echo base_url('restaurants/').$res_alias; ?>" title="" itemprop="url"><?php echo $menu_name;?></a></h4>
																<!-- <span class="food-types">Type of food: <?php echo "service_type";?></span> -->
																<ul class="post-meta">
																	<li><i class="fa fa-check-circle-o"></i> <?php echo $price;?></li>
																	
																	<li><i class="flaticon-money"></i> Accepts cash & online payments</li>
																</ul>
					
																<span class="post-likes style2 red-clr"><a href="JavaScript:Void(0)" id="remove_fav_food" onclick="remove_favourite_food(<?php echo $foodmenu_id ;  ?>)"><i class="fa fa-heart" id="heart_h"></i></a></span>
																<a class="brd-rd30" href="<?php echo base_url('restaurants/'.$data['res_alias']);?>" title="Order Online"><i class="fa fa-angle-double-right"></i> Order Online</a>
															</div> 
														</div>
													</div>
													<?php } } ?>
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
	  </div>	
	</div>
</div>

<script type="text/javascript">
function remove_favourite_food(foodmenu_id)
{
$.ajax({
	url: '<?php echo base_url("my_account/Favorite_food/remove_fav_food");?>',
	type: 'post',
	data: {foodmenu_id:foodmenu_id},
	success: function(data){
		
		alert(data);
        $("#heart_h").removeClass('fa');
		$("#heart_h").addClass('far'); 

		window.location.reload(); 
	},

	error: function(){
		console.log("error");
		window.location.reload(); 
	}
});	
}
</script> 	  