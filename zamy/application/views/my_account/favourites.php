<div class="" id="account-settings">



	<div class="tabs-wrp account-settings brd-rd5">
	  <h4 itemprop="headline">Favourites Restaurant</h4>
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
									if(!empty($restaurants)){
									foreach($restaurants as $data){ 
									$r_id                   = $data['restaurant_id'];
									$res_name  				= $data['res_name'];
									$service_type  			= $data['service_type'];
									$approx_delivery_time  	= $data['approx_delivery_time'];
									$approx_cost  			= $data['approx_cost'];
									$images  				= $data['logo'];
									$res_alias  			= $data['res_alias'];
									
									if(!empty($images)){
										$res_image =  $this->config->item('restaurant_logo_url').$images;
									}else{
										$res_image = base_url('assets/images/resource/most-popular-img1.png');
									}
									
									
									$city  = $data['city'];
									$area  = $data['area'];
									$landmark  = $data['landmark'];
									
									$address = $city." ".$area." ".$landmark;
							
									?>
										<div class="col-md-12 col-sm-12 col-lg-12">
											<div class="featured-restaurant-box with-bg style2 brd-rd12 wow fadeIn" data-wow-delay="0.2s">
												<div class="featured-restaurant-thumb">
													<a href="<?php echo base_url('restaurants/').$res_alias; ?>" title="" itemprop="url"><img src="<?php echo $res_image;?>" alt="most-popular-img1.png" itemprop="image"></a>
												</div>
												<div class="featured-restaurant-info">
													<span class="red-clr"><?php echo $address;?></span>
													<h4 itemprop="headline"><a href="<?php echo base_url('restaurants/').$res_alias; ?>" title="" itemprop="url"><?php echo $res_name;?></a></h4>
													<span class="food-types">Type of food: <?php echo $service_type;?></span>
													<ul class="post-meta">
														<li><i class="fa fa-check-circle-o"></i> <?php echo $approx_cost;?></li>
														<li><i class="flaticon-transport"></i> <?php echo $approx_delivery_time;?></li>
														<li><i class="flaticon-money"></i> Accepts cash & online payments</li>
													</ul>
		
													<span class="post-likes style2 red-clr"><a href="JavaScript:Void(0)" id="remove_fav_res" onclick="remove_restaurants_favourite(<?php echo $r_id ;  ?>)"><i class="fa fa-heart" id="heart_h"></i></a></span>
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
function remove_restaurants_favourite(restaurant_id)
{
$.ajax({
	url: '<?php echo base_url("my_account/Favorite_res/remove_fav_res");?>',
	type: 'post',
	data: {restaurant_id:restaurant_id},
	dataType: 'json',
	success: function(data){
		
        alert(data);
        $("#heart_h").removeClass('fa');
		$("#heart_h").addClass('far'); 

		window.location.reload();
	},
	error: function () {
		console.log("error");
	}
});	
}

</script>
	  
