
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
							<input class="brd-rd2" name="search_keyword" type="text" placeholder="Search for restaurants or dishes">
							</div>
						</div>
						<div class="col-md-4 col-sm-4 col-lg-4 col-xs-12">
							<div class="input-field brd-rd2 select-wrp">
							<?php 
							$area_list = $this->common_model->get_areas();
							
							?>
							<input type="hidden" name="current_url"  value="<?php echo current_url(); ?>">
							<select class="brd-rd2" name="search_area" id="search_area" onChange="area_selection()" data-placeholder="Choose Location">
							<option value="">CHOOSE LOCATION</option>
                            <?php
							foreach($area_list as $list){ 
								$selected = '';
								
									if($current_location ==  $list['area']){
										$selected = "selected ='selected'";
									}	
								?>
								<option class="area_val" value="<?php echo $list['area']?>" <?php echo $selected ;?>><?php echo $list['area']?></option>	
								
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
		<li class="breadcrumb-item"><a href="#" title="" itemprop="url">Home</a></li>
		<li class="breadcrumb-item"><a href="#" title="" itemprop="url">Search</a></li>
		<li class="breadcrumb-item active">Restaurants Found</li>
	</ol>
</div>
</div>

<section>
<div class="block gray-bg bottom-padd210">
	<div class="sec-box bottom-padd140">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-lg-12">
					<div class="sec-wrapper">
						<div class="row">
							
							<div class="col-md-12 col-sm-12 col-lg-12">
								<div class="title2-wrapper">
									<h3 class="marginb-0" itemprop="headline">Order food online in <span id="area_is"></span></h3>
								</div>
								<div class="remove-ext">
									<div class="row">
									<?php 
									if(!empty($all_restaurants)){
									foreach($all_restaurants as $data){ 
									$r_id                   = $data['id'];
									$res_name  				= $data['res_name'];
									$service_type  			= $data['service_type'];
									$approx_delivery_time  	= $data['approx_delivery_time'];
									$approx_cost  			= $data['approx_cost'];
									$res_logo  				= $data['logo'];
									$res_alias  			= $data['res_alias'];


									if(!empty($res_alias) && file_exists( $this->config->item('restaurant_logo_basepath').$data['logo'])){
										  $res_logo = $data['logo']; 
								   }
									else{
										$res_image = base_url('assets/images/resource/most-popular-img1.png');
									}
									
									$city  = $data['city'];
									$area  = $data['area'];
									$landmark  = $data['landmark'];
									
									$address = $city." ".$area." ".$landmark;
									$CI =& get_instance();
							        
									?>
										<div class="col-md-6 col-sm-6 col-lg-6">
											<div class="featured-restaurant-box with-bg style2 brd-rd12 wow fadeIn fr-float" data-wow-delay="0.2s">
												<div class="featured-restaurant-thumb">
													<a href="<?php echo base_url('restaurants/').$res_alias; ?>" title="" itemprop="url">
													<?php if(!empty($res_logo)){?>
													<img src="<?php echo $this->config->item('restaurant_logo_url').$res_logo?>" alt="most-popular-img1.png" itemprop="image">
													<?php }else{ ?>
													<img src="<?php echo $this->config->item('restaurant_logo_url')."no_image_resto.jpg"?>" alt="most-popular-img1.png" itemprop="image">
													<?php } ?>
													</a>
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
													<?php 
												$rating_count = get_rating_restaurant_id($r_id);
												$final =  $rating_count['ratings'] % 5;
												$fav_res_count = get_count_fav_res_by_users($r_id);
													?>
													<span class="post-rate yellow-bg brd-rd2" ><i class="fa fa-star yellow-clr" data-toggle="tooltip" title="Rating"></i> <?php echo $final;?></span>
													<span class="post-likes style2 red-clr"><i class="fa fa-heart-o"></i>
                                                   <?php  
                                                    if (!empty($fav_res_count)) {
                                                    	echo $fav_res_count['total_fav_res'];
                                                    }
                                                    else{
                                                    	echo 0;
                                                    }
                                                   ?>
													</span>
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
				
					<div class="pagination-wrapper text-center">
						<ul class="pagination justify-content-center">
						<?php  
                                  foreach ($links as $page_link) {
                                 	echo '<li class="page-item">';
                                 	echo $page_link;
                                 	echo '</li>';
                                 } 
								?>
						 </ul>
						</div>
				</div>
			</div>
		</div>
	</div><!-- Section Box -->
</div>
</section>
<script type="text/javascript">




function area_selection(){
  var crr_val = $("#search_area").val();
  $("#area_is").text(crr_val);
}     
</script>

<!--
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
				</div>
			</div>
		</div>
	</div>
</div>-
</section>-->
<!-- red section -->