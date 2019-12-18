<div style="margin-top: 30px;padding-top: 30px"></div>
<section> 
	<div class="block">
		<div style="background-image: url(assets/images/topbg.jpg);" class="fixed-bg"></div>
		<div class="restaurant-searching style2  text-center">
			<div class="restaurant-searching-inner">
				<?php echo !empty($info['title']) ? $info['title'] : ''; ?>		
				<?php echo form_open(base_url('search'),array('id'=>'search_restaurants','class'=>'restaurant-search-form2 brd-rd30')); ?>
					<input class="brd-rd30" type="text" name="search_keyword"  placeholder="RESTAURANT OR DISH NAME">
					<button class="brd-rd30 red-bg" type="submit">SEARCH</button>
				<?php echo form_close(); ?>
				<div class="funfacts">
						<div class="col-md-3 col-sm-6 col-lg-3">
							<div class="fact-box">
								<i class="brd-rd50"><img src="<?php echo base_url('pos.zamy.in/uploads/SiteConfig/'.$info['counter_img_1']); ?>" alt="fact-icon1" itemprop="image"></i>
								<div class="fact-inner">
									<strong><span class="counter"><?php echo !empty($res_count['Total_restaurant']) ? $res_count['Total_restaurant'] : ''; ?></span></strong>
									<h5><?php echo !empty($info['counter_title_1']) ? $info['counter_title_1'] : ''; ?></h5>
								</div>
							</div><!-- Fact Box -->
						</div>
						<div class="col-md-3 col-sm-6 col-lg-3">
							<div class="fact-box">
								<i class="brd-rd50"><img src="<?php echo base_url('pos.zamy.in/uploads/SiteConfig/'.$info['counter_img_2']); ?>" itemprop="image"></i>
								<div class="fact-inner">
									<strong><span class="counter"><?php echo !empty($order_user['order_users_count']) ? $order_user['order_users_count'] : ''; ?></span></strong>
									<h5><?php echo !empty($info['counter_title_2']) ? $info['counter_title_2'] : ''; ?></h5>
								</div>
							</div><!-- Fact Box -->
						</div>
						<div class="col-md-3 col-sm-6 col-lg-3">
							<div class="fact-box">
								<i class="brd-rd50"><img src="<?php echo base_url('pos.zamy.in/uploads/SiteConfig/'.$info['counter_img_3']); ?>" itemprop="image"></i>
								<div class="fact-inner">
									<strong><span class="counter"><?php echo !empty($cs_count['cs_count']) ? $cs_count['cs_count'] : ''; ?></span><span></span></strong>
									<h5><?php echo !empty($info['counter_title_3']) ? $info['counter_title_3'] : ''; ?></h5>
								</div>
							</div><!-- Fact Box -->
						</div>
						<div class="col-md-3 col-sm-6 col-lg-3">
							<div class="fact-box">
								<i class="brd-rd50"><img src="assets/images/resource/fact-icon4.png" alt="fact-icon4" itemprop="image"></i>
								<div class="fact-inner">
									<strong><span class="counter"><?php echo !empty($users_count['Total_users']) ? $users_count['Total_users'] : ''; ?></span></strong>
									<h5><?php echo !empty($info['counter_title_4']) ? $info['counter_title_4'] : ''; ?></h5>
								</div>
							</div><!-- Fact Box -->
						</div>
				</div><!-- Fun Facts -->
			</div>
			<img class="left-scooty-mockup" src="<?php echo base_url('pos.zamy.in/uploads/SiteConfig/'.$info['left_image']); ?>" alt="restaurant-mockup1.png" itemprop="image">
			<img class="bottom-clouds-mockup" src="<?php echo base_url('pos.zamy.in/uploads/SiteConfig/'.$info['bottom_image']); ?>" alt="clouds.png" itemprop="image">
		</div><!-- Restaurant Searching -->
	</div>
</section>
<!--Start Top Restaurant Section--> 
<section>
	<div class="block remove-bottom">
		<div class="container">
			<div class="row">
			
			<div class="col-md-12 col-sm-12 col-lg-12">
					<div class="title1-wrapper text-center">
						<div class="title1-inner">
							<span><?php echo !empty($info['tr_sub_title']) ? $info['tr_sub_title'] : ''; ?></span>
							<h2 itemprop="headline"><?php echo !empty($info['tr_title']) ? $info['tr_title'] : ''; ?></h2>
							<p itemprop="description"><?php echo !empty($info['tr_bottom_text']) ? $info['tr_bottom_text'] : ''; ?>.</p>
						</div>

					</div>
					<div class="top-restaurants-wrapper">
						<ul class="restaurants-wrapper style2">
							<?php 
								$resto_name = '';
								if(!empty($get_top_res)){
									foreach($get_top_res as $resto){
										$resto_logo = 'no_image_resto.jpg'; 
										if(!empty( $resto['logo']) && file_exists( $this->config->item('pos_restaurant_logo').$resto['logo'])){
											$resto_logo = $resto['logo']; 
											$resto_name = $resto['res_name']; 
										}
										echo '<li class="wow bounceIn" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: bounceIn;"><div class="top-restaurant"><a class="brd-rd50" href="'.base_url('restaurants/'.$resto['res_alias']).'" title="'.$resto_name.'" itemprop="url"><img src="'.$this->config->item('pos_restaurant_logo'). $resto['logo'].'" alt="'.$resto['logo'].'" itemprop="image"></a></div></li>';
									}
								}  
							?>  
						</ul> 
					</div>

				</div> 
			</div>
			<br><br><br>
			<div class="row text-center">
				<div class="rite-meta">
						    <a href="<?php echo base_url('restaurants');  ?>" title="" class="view-more">view more Restaurant</a>
				</div>
			</div>
		</div>
	</div>
</section><!-- top resturents -->
<?php if($this->session->has_userdata('cust_id')) { ?>
<section>
	<div class="block top-padd80">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-lg-12">
					<div class="title1-wrapper text-center">
						<div class="title1-inner">
							<span><?php echo !empty($info['ce_sub_title']) ? $info['ce_sub_title'] : ''; ?></span>
							<h2 itemprop="headline"><?php echo !empty($info['ce_title']) ? $info['ce_title'] : ''; ?></h2>
						</div>
					</div>
					<div class="remove-ext">
						<div class="row"> 
						<?php  
						 
						if(!empty($fav_food_by_user)){ 
						 
							foreach($fav_food_by_user as $fav_food){
                                $food_menu_id = $fav_food['food_id'];
								$food_count = get_count_fav_food_by_users($food_menu_id);
								$menu_logo = 'no_image_food.png';
								//echo $this->config->item('foodMenu_image_basepath').$fav_food['menu_logo']; echo "<br>";
								if(!empty( $fav_food['menu_logo']) && file_exists($this->config->item('foodMenu_image_basepath').$fav_food['menu_logo'])){
									$menu_logo =  $fav_food['menu_logo'] ;
								}
								$resto_logo = 'no_image_resto.jpg'; 
								if(!empty( $fav_food['kitchen_image']) && file_exists( $this->config->item('restaurant_image_basepath').$fav_food['kitchen_image'])){
									$resto_logo = $fav_food['kitchen_image']; 
								} 
						?>
							<div class="col-md-4 col-sm-6 col-lg-4">
								<div class="popular-dish-box wow fadeIn" data-wow-delay="0.2s">
									<div class="popular-dish-thumb">
										<a href="<?php echo base_url('restaurants/'.$fav_food['res_alias']) ?>" title="" itemprop="url"><img src="<?php echo $this->config->item('foodMenu_image_url').$menu_logo;?>" alt="<?php echo $menu_logo ?>" itemprop="image"></a>
										<span class="post-rate yellow-bg brd-rd2"><i class="fa fa-star yellow-clr"></i> 4.25</span>
										<span class="post-likes brd-rd4"><i class="fa fa-heart-o"></i><?php 
                                           if (!empty($food_count)) {
                                           	echo $food_count['total_fav_res'];
                                           }
                                           else{
                                            echo 0;
                                           }
										 ?></span>
									</div>
									<div class="popular-dish-info">
										<h2 itemprop="headline"><a href="<?php echo base_url('restaurants/'.$fav_food['res_alias']) ?>" title="" itemprop="url"><?php echo $fav_food['menu_name'] ?></a></h2>
										<p itemprop="description"> <?php echo $fav_food['long_description'] ?>  </p>
										<span class="price"><i class="fa fa-inr"></i><?php echo ( !empty($fav_food['reduced_price']) && $fav_food['reduced_price'] != '0.00') ? $fav_food['reduced_price'] : $fav_food['price'] ?></span>
										<a class="brd-rd2" href="<?php echo base_url('restaurants/'.$fav_food['res_alias']) ?>" title="Order Now" itemprop="url">Order Now</a>
										<div class="restaurant-info">
											<img src="<?php echo $this->config->item('restaurant_image_url').$resto_logo;?>" alt="<?php echo $resto_logo;?>" itemprop="image">
											<div class="restaurant-info-inner">
												<h6 itemprop="headline"><a href="<?php echo base_url('restaurants/'.$fav_food['res_alias']) ?>" title="" itemprop="url"><?php echo  $fav_food['res_name'] ?></a></h6>
												<span class="red-clr"><?php echo  $fav_food['address'] ?></span>
											</div>
										</div>
									</div>
								</div><!-- Popular Dish Box -->
							</div>
						<?php 
							}
						}
						?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section><!-- choose and enjoy meal -->
<?php   } ?>

<?php 
 if (!empty($get_populer_this_month)) {
 ?>
<section>
	<div class="block gray-bg">
		<div class="top-mockup"><img src="assets/images/resource/mockup2.png" alt=""></div>
		<div class="container">

			<div class="row">
				<div class="col-md-12 col-sm-12 col-lg-12 col-xs-12 text-center">
					<div class="filters-wrapper">
						<div class="title1-wrapper">
							<!--<i><img alt="" src="assets/images/resource/icon.png"></i>-->
							<div class="title1-inner">
								<span><?php echo !empty($info['popular_sub_title']) ? $info['popular_sub_title'] : ''; ?></span>
								<h2 itemprop="headline"><?php echo !empty($info['popular_title']) ? $info['popular_title'] : ''; ?></h2>
								<b><?php echo !empty($info['bottom_sub_title']) ? $info['bottom_sub_title'] : ''; ?></b>
							</div>
						</div>

					</div>
				</div>
				<div class="col-md-4 col-xs-12">
					<div class="dishes-caro">
					 
						<?php 
						$foodmenu_ids = array(); 
						if(!empty($get_populer_this_month)){ 
						
							foreach($get_populer_this_month as $fav_food){
								$CI =& get_instance();
								$foodmenu_ids[] = $fav_food['food_menu_id'];
                                
								$fav_foodmenu = get_food_menu($fav_food['food_menu_id']);

								$variance = get_food_menu_variance_for_price($fav_food['food_menu_id']);

//$variation_result = array();
if(!empty($variance))
{
 $variation_price = array_column($variance , 'vprice');
 $variation_sale_price = array_column($variance, 'vreduced_price');
 
$min_price = min($variation_price);
$min_reduced_price = min($variation_sale_price);

$max_price = max($variation_price);
$max_reduced_price = max($variation_sale_price);

$vminprice = (!empty($min_reduced_price) && $min_reduced_price != '0.00' && $min_reduced_price < $min_price )? $min_reduced_price : $min_price;

if(!empty($min_reduced_price) && $min_reduced_price != '0.00' && ($min_reduced_price < $min_price))
{

$vminprice = $min_reduced_price;
$vmaxprice = $max_reduced_price;

}
else
{
$vminprice = $min_price;
$vmaxprice = $max_price;
}
$var_price = $vminprice.'-'.$vmaxprice;  
}  

//variations

								$menu_logo = 'no_image_food.png';
								if(!empty( $fav_foodmenu['menu_logo'] ) && file_exists($this->config->item('foodMenu_image_basepath').$fav_foodmenu['menu_logo']) ){
									$menu_logo =  $fav_foodmenu['menu_logo'] ;
								}
								$resto_logo = 'no_image_resto.jpg'; 
								if(!empty( $fav_food['logo']) && file_exists( $this->config->item('restaurant_logo_basepath').$fav_food['logo'])){
									$resto_logo = $fav_food['logo']; 
								}
						?>
						<div class="dish-item">
							<figure><img src="<?php echo $this->config->item('foodMenu_image_url').$menu_logo;?>" alt=""></figure>
							<div class="item-meta">
								<img src="<?php echo $this->config->item('restaurant_logo_url').$resto_logo;?>" alt="">
								<div>
									<span><?php echo $fav_food['res_name'];?></span>
									<p><?php echo $fav_food['address'];?></p>
								</div>
							</div>
							<div class="caro-dish-name">
								<a href="<?php echo base_url('restaurants/'.$fav_food['res_alias']);?>"><h4><?php echo $fav_foodmenu['menu_name'];?></h4></a>
								<span><i class="fa fa-inr"></i><?php echo ( !empty($fav_foodmenu['reduced_price']) && $fav_foodmenu['reduced_price'] != '0.00') ? $fav_foodmenu['reduced_price'] : $fav_foodmenu['price'] 
                                 
								?>
								
								
								</span>
								<span><?php 
                                    if (!empty($var_price)) {
                                    	echo $var_price;
                                    }
								 ?></span>
							</div>
						</div>
						<?php						
							}
						}
						
						
						?> 
					</div>
				</div>
				<div class="col-md-8 col-xs-12">
					<div class="popular-of-month">
						<?php 
							
						$populer_this_month_food = populer_this_month_food($foodmenu_ids);
						
						if(!empty($populer_this_month_food)){ 
						
							foreach($populer_this_month_food as $fav_food){
								
								$fav_foodmenu = get_food_menu($fav_food['food_menu_id']);
							    $food_var = get_food_menu_variance_for_price($fav_food['food_menu_id']);
							    /**/
							//$variation_result = array();
if(!empty($food_var))
{
 $variation_price_n = array_column($food_var , 'vprice');
 $variation_sale_price_n = array_column($food_var, 'vreduced_price');
 
$min_price_n = min($variation_price_n);
$min_reduced_price_n = min($variation_sale_price_n);

$max_price_n = max($variation_price_n);
$max_reduced_price_n = max($variation_sale_price_n);

$vminprice_n = (!empty($min_reduced_price_n) && $min_reduced_price_n != '0.00' && $min_reduced_price_n < $min_price_n )? $min_reduced_price_n : $min_price_n;

if(!empty($min_reduced_price_n) && $min_reduced_price_n != '0.00' && ($min_reduced_price_n < $min_price_n))
{

$vminprice_n = $min_reduced_price_n;
$vmaxprice_n = $max_reduced_price_n;

}
else
{
$vminprice_n = $min_price_n;
$vmaxprice_n = $max_price_n;
}
$var_price_n = $vminprice_n.'-'.$vmaxprice_n;  
}  

//variations
							    /**/
								$menu_logo = 'no_image_food.png';
								if(!empty( $fav_foodmenu['menu_logo'] ) && file_exists($this->config->item('foodMenu_image_basepath').$fav_foodmenu['menu_logo'])){
									$menu_logo =  $fav_foodmenu['menu_logo'] ;
								}
								$resto_logo = 'no_image_resto.jpg'; 
								if(!empty( $fav_food['logo']) && file_exists( $this->config->item('restaurant_logo_basepath').$fav_food['logo'])){
									$resto_logo = $fav_food['logo']; 
								}
						?>
							<div class="pop-dish wow fadeIn" data-wow-delay="0.1s">
								<div class="poplr-dish">
									<img src="<?php echo $this->config->item('foodMenu_image_url').$menu_logo;?>" alt="">
									<div class="dish-meta">
										<h4><a href="<?php echo base_url('restaurants/'.$fav_food['res_alias']);?>" title=""><?php echo  $fav_foodmenu['menu_name'] ?></a></h4>
										<span><i class="fa fa-inr"></i></span>
										<span>
											<?php 
                                            if ($fav_foodmenu['reduced_price']) {

										    echo ( !empty($fav_foodmenu['reduced_price']) && $fav_foodmenu['reduced_price'] != '0.00') ? $fav_foodmenu['reduced_price'] : $fav_foodmenu['price'] 

										    ?>
										    	
										    </span>
                                            <?php 
                                            }
                                            else{
                                              if (!empty($var_price_n)) {

                                          ?>
										<span>
											<?php  echo $var_price_n;   ?>
										</span>
										<?php 
                                          }
                                        }
										?>
										
									</div>
								</div>
								<div class="item-meta">
									<img alt="" src="<?php echo $this->config->item('restaurant_logo_url').$resto_logo;?>">
									<div>
										<span><?php echo $fav_food['res_name'];?></span>
										<p><?php echo $fav_food['address'];?> </p>
									</div>
								</div>
							</div>
						<?php
							}
						}
						?> 
					</div>
				</div>
			</div>
			<div class="row">
				<div class="rite-meta pull-right">
						<a href="<?php echo base_url('restaurants');  ?>" title="" class="view-more">view more food</a>
				</div>
			</div>
		</div>
		<div class="bottom-mockup"><img src="<?php echo base_url('pos.zamy.in/uploads/SiteConfig/'.$info['populer_bottom_right_img']); ?>" alt=""></div>
	</div>
</section>
<?php  }  ?>
<section>
	<div class="block blackish opac35">
		<div class="fixed-bg" style="background-image: url('<?php echo base_url('pos.zamy.in/uploads/SiteConfig/'.$info['order_steps_bck_img']); ?>');"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-lg-12">
					<div class="title1-wrapper text-center">
						<div class="title1-inner">
							<span><?php echo !empty($info['order_steps_sub_title']) ? $info['order_steps_sub_title'] : ''; ?></span>
							<h2 class="text-white" itemprop="headline"><?php echo !empty($info['order_steps_title']) ? $info['order_steps_title'] : ''; ?></h2>
						</div>
					</div>
					<div class="remove-ext text-center">
						<div class="row">
							<div class="col-md-4 col-sm-4 col-lg-4">
								<div class="step-box wow fadeInUp" data-wow-delay="0.2s">
									<i><img src="assets/images/resource/setp-img1.png" alt="setp-img1.png" itemprop="image"> <span class="brd-rd50 red-bg">1</span></i>
									<div class="setp-box-inner">
										<h4 itemprop="headline">EXPLORE RESTAURANTS</h4>
										<p itemprop="description" align="justify">The <?php echo strtolower('ZAMY APP PROVIDES YOU A WHOLE CATALOGUE OF RESTAURANTS WITHIN 5 KM
RADIUS OF YOUR LOCATION TO HAVE FOOD DELIVERED. PLUS, YOU CAN SEARCH ALSO
FOR OTHER FOOD OUTLETS OF YOUR PREFERENCE ANYWHERE IN THE CITY FROM ZAMY’S EXHAUSTIVE LIST OF AHMEDABAD’S RESTAURANTS.');  ?></p>
									</div>
								</div><!-- Step Box -->
							</div>
							<div class="col-md-4 col-sm-4 col-lg-4">
								<div class="step-box wow fadeInUp" data-wow-delay="0.4s">
									<i><img src="assets/images/resource/setp-img2.png" alt="setp-img2.png" itemprop="image"> <span class="brd-rd50 red-bg">2</span></i>
									<div class="setp-box-inner">
										<h4 itemprop="headline">CHOOSE A TASTY DISH</h4>
										<p itemprop="description" align="justify">Select <?php echo strtolower(" FROM AN ARRAY OF DISHES FROM THE MENU OF YOUR CHOSEN RESTAURANT –
GET DELIVERED ANY FINGER-LICKING STARTERS OR LIP-SMACKING MAIN COURSE,AND SOME CAN’T-SAY-NO-TO DESSERTS AND SWEETS.");  ?></p>
									</div>
								</div><!-- Step Box -->
							</div>
							<div class="col-md-4 col-sm-4 col-lg-4">
								<div class="step-box wow fadeInUp" data-wow-delay="0.6s">
									<i><img src="assets/images/resource/setp-img3.png" alt="setp-img3.png" itemprop="image"> <span class="brd-rd50 red-bg">3</span></i>
									<div class="setp-box-inner">
										<h4 itemprop="headline">FOLLOW THE STATUS</h4>
										<p itemprop="description" align="justify">The <?php echo strtolower("ZAMY APP TRACKS OUR DELIVERY BOYS AND GIVE YOU LIVE UPDATES OF THE
PROGRESS OF THE ORDERED MEAL RIGHT TO YOUR DOORSTEP. YOU CAN ALSO TALK
TO THE DELIVERY BOY FROM THE APP ABOUT THE STATUS, IF NEED BE."); ?></p>
									</div>
								</div><!-- Step Box -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section>
	<div class="block">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-lg-12">
					<div class="title1-wrapper text-center">
						<div class="title1-inner">
							<span><?php echo !empty($info['fr_sub_title']) ? $info['fr_sub_title'] : ''; ?></span>
							<h2 itemprop="headline"><?php echo !empty($info['fr_title']) ? $info['fr_title'] : ''; ?></h2>
						</div>
					</div>
					<div class="featured-restaurants-wrapper">
						<div class="row">
							<div class="col-md-6 col-sm-12 col-lg-6">
								<div class="featured-restaurants-list">
									<?php  
									if(!empty($home_topres)){
									
										foreach($home_topres as $fav_food){
											
											$menu_logo = 'no_image_food.png';
											if(!empty( $fav_food['menu_logo'] ) && file_exists($this->config->item('foodMenu_image_basepath').$fav_food['menu_logo'])){
												$menu_logo =  $this->config->item('foodMenu_image_url').$fav_food['menu_logo'];
											}
											$resto_logo = 'no_image_resto.jpg'; 
											if(!empty( $fav_food['kitchen_image']) && file_exists( $this->config->item('restaurant_image_basepath').$fav_food['kitchen_image'])){
												$resto_logo = $fav_food['kitchen_image']; 
											}
								$fav_foodmenu = get_food_menu($fav_food['food_menu_id']);
								$restaurant = $fav_food['res_name'];
							    $food_var_fr = get_food_menu_variance_for_price($fav_food['food_menu_id']);
							    /**/
							//$variation_result = array();
if(!empty($food_var_fr))
{
 $variation_price_fr = array_column($food_var_fr , 'vprice');
 $variation_sale_price_fr = array_column($food_var_fr, 'vreduced_price');
 
$min_price_fr = min($variation_price_fr);
$min_reduced_price_fr = min($variation_sale_price_fr);

$max_price_fr = max($variation_price_fr);
$max_reduced_price_fr = max($variation_sale_price_fr);

$vminprice_fr = (!empty($min_reduced_price_fr) && $min_reduced_price_fr != '0.00' && $min_reduced_price_fr < $min_price_fr )? $min_reduced_price_fr : $min_price_fr;

if(!empty($min_reduced_price_fr) && $min_reduced_price_fr != '0.00' && ($min_reduced_price_fr < $min_price_fr))
{

$vminprice_fr = $min_reduced_price_fr;
$vmaxprice_fr = $max_reduced_price_fr;

}
else
{
$vminprice_fr = $min_price_fr;
$vmaxprice_fr = $max_price_fr;
}
$var_price_fr = $vminprice_fr.'-'.$vmaxprice_fr;  
}  											
										?>
										<div class="featured-restaurant-box wow fadeInUp" data-wow-delay="0.3s">
											<div class="featured-restaurant-thumb">
												<a href="#" title="" itemprop="url"><img class="brd-rd2" src="<?php echo $menu_logo; ?>" alt="<?php echo $menu_logo; ?>" itemprop="image"></a>
											</div>
											<div class="featured-restaurant-info">
												<h3><span class="red-clr"><?php echo $restaurant; ?></span></h3>
												<h4 itemprop="headline"><a href="<?php echo base_url('restaurants/'.$fav_food['res_alias']);?>" title="" itemprop="url"><?php echo $fav_food['menu_name']; ?></a></h4>
												<span class="price"><i class="fa fa-inr"></i>
                                        <?php 
                                            if ($fav_foodmenu['reduced_price']) {

										    echo ( !empty($fav_foodmenu['reduced_price']) && $fav_foodmenu['reduced_price'] != '0.00') ? $fav_foodmenu['reduced_price'] : $fav_foodmenu['price'] 

										    ?>
										    	
										    </span>
                                            <?php 
                                            }
                                            else{
                                              if (!empty($var_price_fr)) {

                                          ?>
										<span>
											<?php  echo $var_price_fr;   ?>
										</span>
										<?php 
                                          }
                                        }
										?>
												</span>
												<p itemprop="description"><?php echo $fav_food['long_description']; ?> </p>
												<ul class="post-meta">
													<li><i class="fa fa-check-circle-o"></i> Min order <?php echo $fav_food['approx_cost']; ?></li>
													<li><i class="flaticon-transport"></i><?php echo $fav_food['approx_delivery_time']; ?>   </li>
													
												</ul>
												
												
													
											</div>
											<div ><span class="post-rate yellow-bg brd-rd2"><i class="fa fa-star yellow-clr"></i> 5.00</span></div>
										</div>
										<?php 
										}
									}											
									?> 
								</div><!-- Featured Restaurants List -->
							</div>
							<div class="col-md-6 col-sm-12 col-lg-6">
								<div class="featured-restaurant-gallery">
									<div class="featured-restaurant-carousel">
										<div class="featured-restaurant-thumb"><img class="brd-rd2" src="assets/images/resource/featured-restaurant-gallery1.jpg" alt="featured-restaurant-gallery1.jpg" itemprop="image"></div>
										<div class="featured-restaurant-thumb"><img class="brd-rd2" src="assets/images/resource/featured-restaurant-gallery2.jpg" alt="featured-restaurant-gallery2.jpg" itemprop="image"></div>
									</div>
									<div class="featured-restaurant-box">
										<div class="featured-restaurant-thumb">
											<a class="red-bg brd-rd2" data-fancybox href="https://vimeo.com/49674259" title="Click To Play" itemprop="url"><i class="flaticon-play-button"></i></a>
											<span class="video-time">15mint</span>
										</div>
										<div class="featured-restaurant-info">
											<span class="red-clr">Sarkhej, Ahmedabad, Gujarat, India</span>
											<h4 itemprop="headline"><a href="https://zamy.in/restaurants/hop-meal-restaurant-makarba-ahmedabad-380051" title="" itemprop="url">Hop Meal Restaurant</a></h4>
											<!--<span class="price"><i class="fa fa-inr"></i> 85.00</span>-->
											<p itemprop="description"></p>
											<ul class="post-meta">
												<li><i class="fa fa-check-circle-o"></i> <i class="fa fa-inr"></i> 500 FOR TWO</li>
												<li><i class="flaticon-transport"></i> 30min</li>
											</ul>
											<span class="post-rate yellow-bg brd-rd2"><i class="fa fa-star yellow-clr"></i> 4.25</span>
										</div>
									</div>
								</div><!-- Featured Restaurant Gallery -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!--Restaurant Filter  -->
<section>
	<div class="block gray-bg low-opacity">
		<div class="container">
            <div class="row text-center">
            	<div class="title1-wrapper">
                         <div class="title1-inner">
								<span><?php echo !empty($info['cyf_sub_title']) ? $info['cyf_sub_title'] : ''; ?></span>
								<h2 itemprop="headline"><?php echo !empty($info['cyf_title']) ? $info['cyf_title'] : ''; ?></h2>
					       </div>
                </div>
            </div>
            <div class="text-center">
           <!--
           	<ul class="filter-buttons center ext-btm20">
                <li class="active"><a class="brd-rd30" data-filter="*" href="#" itemprop="url">All</a></li>
                <li class=""><a class="brd-rd30" data-filter=".filter-item3" href="#" itemprop="url">Beverages</a></li>
                <li class=""><a class="brd-rd30" data-filter=".filter-item29" href="#" itemprop="url">Chinese</a></li>
                <li class=""><a class="brd-rd30" data-filter=".filter-item39" href="#" itemprop="url">Indian</a></li>
            </ul>
           -->
            <ul class="filter-buttons ext-btm20">
							
							<li class="active"><a class="brd-rd30" data-filter="*" href="#" itemprop="url" id="all_rec">All</a></li>
                            <?php    $cat_choice  = array();
                             if (!empty($Home_res_cat_filter)) {
								 
                             	foreach ($Home_res_cat_filter as $cat_rec) {
								$cat_choice[] = $cat_rec['choice'];
                                $cat_title = $cat_rec['food_cate_title'];
                                $cat_id = $cat_rec['id'];
                                $choice = $cat_rec['choice'];
								                               
                            ?>
							<li><a class="brd-rd30 data_filter" id="<?php echo $cat_id; ?>" data-filter=".filter-item-<?php echo $choice; ?>" href="#" itemprop="url"><?php echo $cat_title; ?></a></li>
 
							<?php
							   
							 }
							}    
							?>

				</ul>
			<div>	
			<div class="row">
				<div class="col-md-12 col-sm-12 col-lg-12">
					<div class="filters-wrapper">
                        
                       
						<div class="filters-inner">
							<div id="all_cat">
							<div class="row">
								<div class="masonry">
								<?php
                                $CI =& get_instance();

								//$filter    = restaurant_filter_by_food_category();
								 	 
								$filter_by_food = get_food_filter_food_category();
					 
                                if ($filter_by_food) {
								 
                                 foreach ($filter_by_food as $filter_res) {
									 
                                  $res_cat_title = $filter_res['food_cate_title'];
                                  $res_name      = $filter_res['menu_name'];
                                  $restaurant_id = $filter_res['id'];
                                  $add           = $filter_res['address'];
                                  $ser_type      = $filter_res['service_type'];
                                  $res_alias     = $filter_res['res_alias'];
                                  $approx_amt    = $filter_res['approx_cost'];
                                  $restaurant    = $filter_res['res_name']; 
								  $choice		 = explode(',',$filter_res['food_menu_choice']);
								  
								  $result=array_intersect($cat_choice,$choice);
									  
                                  $fav_res = get_count_fav_res_by_users($restaurant_id);
                                  $res_ratings = get_rating_restaurant_id($restaurant_id);
						
								  $menu_logo = 'no_image_resto.jpg'; 
								  if(!empty($res_alias) && file_exists( $this->config->item('foodMenu_image_basepath').$filter_res['menu_logo'])){
										  $menu_logo = $filter_res['menu_logo']; 
								   }

								?>	
									<div class="col-md-6 col-sm-6 col-lg-6 filter-item filter-item-<?php echo $res_cat_title; ?>">
										<div class="featured-restaurant-box style2 brd-rd12 wow fadeInUp" data-wow-delay="0.1s">
											<div class="featured-restaurant-thumb">
												<a href="<?php echo base_url('restaurants/'.$res_alias);?>" title="" itemprop="url">
												<?php if(!empty($menu_logo)){?>
												<img src="<?php echo $this->config->item('foodMenu_image_url').$menu_logo?>" alt="<?php echo $res_name; ?>" itemprop="image"></a>
												<?php } ?>
											</div>
											<div class="featured-restaurant-info">
												<h2><span class="red-clr"><?php echo $restaurant; ?></span></h2>
												<h4 itemprop="headline"><a href="<?php echo base_url('restaurants/'.$res_alias);?>" title="" itemprop="url"><?php echo $res_name; ?></a></h4>
												<span class="food-types">Type of food: <a href="<?php echo base_url('restaurants/'.$res_alias);?>" title="" itemprop="url"><?php echo $ser_type; ?></a></span>
												<ul class="post-meta">
													<li><i class="fa fa-check-circle-o"></i>Rs<?php echo $approx_amt  ?></li>
													<li><i class="flaticon-transport"></i> 30min</li>
													<li><i class="flaticon-money"></i> Accepts cash & online payments</li>
												</ul>
												<span class="post-rate yellow-bg brd-rd2"><i class="fa fa-star yellow-clr"></i>
                                                <?php
                                                if ($res_ratings) {
                                                	echo $res_ratings['ratings'] % 5;
                                                }
                                                else{
                                                	echo 0;
                                                }
                                                ?>
												</span>
												<span class="post-likes style2 red-clr"><i class="fa fa-heart-o" ></i>
                                                  <?php  
                                                  if (!empty($fav_res)) {
                                                  	echo $fav_res['total_fav_res'];
                                                  }
                                                  else{
                                                  	echo 0;
                                                  }
                                                  ?>
												</span>
												<a class="brd-rd5" href="<?php echo base_url('restaurants/'.$res_alias);?>" title="Order Online">Order Now</a>
											</div>
										</div>
									</div>
								<?php  
							          }
								    }
								 ?>
	
								</div>
							</div>
						    </div>
							<div id="filtercategory">

						    </div>
						</div>
					</div><!-- Filters Wrapper -->
				</div>
			</div>
			<div class="row text-center">
				<div class="rite-meta">
						    <a href="<?php echo base_url('restaurants');  ?>" title="" class="view-more">view more Restaurant</a>
				</div>
			</div>
		</div>
	</div>
</section>
<!--  -->
<?php 
if (!empty($bottom_featured_restaurant)) {
?>
<section>
	<div class="block bottom-padd210">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-lg-12">
					<div class="title1-wrapper text-center">
						<div class="title1-inner">
							<span><?php echo !empty($info['featured_sub_title']) ? $info['featured_sub_title'] : ''; ?></span>
							<h2 itemprop="headline"><?php echo !empty($info['featured_title']) ? $info['featured_title'] : ''; ?></h2>
						</div>
					</div>
					 <?php   
						if(!empty($bottom_featured_restaurant)){
							foreach($bottom_featured_restaurant as $resto){
							$fav_res = get_count_fav_res_by_users($resto['id']);
							 $CI =& get_instance();
							?> 
							<div class="col-md-4 col-sm-6 col-lg-4">
								<div class="article-dev wow fadeInUp cmn-logo-hgt" data-wow-delay="0.4s">
									<figure>
									<?php
										$resto_logo = 'no_image_resto.jpg'; 
										if(!empty( $resto['res_alias']) && file_exists( $this->config->item('restaurant_logo_basepath').$resto['logo'])){
										  $resto_logo = $resto['logo']; 
										}
										
									?>
										<img src="<?php echo $this->config->item('restaurant_logo_url').$resto_logo?>" alt="">
									</figure>
									<div class="article-data">
										<div class="article-info-meta">
											<span>Mon</span>
											<a href="#" title="">25 Sep 2018</a>
											<a href="#" title="">By webinane</a>
										</div>
										<div class="article-meta">
											<h3><a href="<?php echo base_url('restaurants/'.$resto['res_alias']);?>" title="">
													<?php echo $resto['res_name']?>
												</a>
											</h3>
											<div class="like-meta">
												<span><i class="fa fa-heart-o"></i><span>
													<?php
                                                     if (!empty($fav_res)) {
                                                     	echo $fav_res['total_fav_res'];
                                                     } else {
                                                     	echo 0;
                                                     }
                                                     
													?>
												</span></span> 
												<!--<span><i class="fa fa-comment-o"></i> 7</span>-->
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php
							}
						} 
					?>   
				</div>
			</div>
		</div>
	</div>
</section>
<?php  } ?>
<section>
	<div class="block no-padding red-bg">
		<img class="bottom-clouds-mockup" src="assets/images/resource/clouds2.png" alt="clouds2.png" itemprop="image">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-lg-12">
					<div class="app-sec">
						<div class="row">
							<div class="col-md-4 hidden-sm col-md-offset-1 col-sm-4 col-sm-offset-0 col-lg-4 col-lg-offset-1">
								<div class="app-mockup text-right overlape-110 wow fadeInUp" data-wow-delay="0.2s"><img src="<?php echo base_url('pos.zamy.in/uploads/SiteConfig/'.$info['img_1']); ?>" alt="app-mockup.png" itemprop="image"></div>
							</div>
							<div class="col-md-6 col-md-offset-1 col-sm-12 col-sm-offset-0 col-lg-6 col-lg-offset-1">
								<div class="app-info">
									<h4 itemprop="headline"><?php echo !empty($info['bs_title']) ? $info['bs_title'] : ''; ?></h4>
									<p itemprop="description"><?php echo !empty($info['bs_text']) ? $info['bs_text'] : ''; ?></p>
									<div class="app-download-btns">
										<a class="wow zoomInUp" data-wow-delay="0.2s" href="https://play.google.com/store/apps/details?id=com.attune.zamy" title="Google Play Store" itemprop="url" target="_blank"><img src="<?php echo base_url('pos.zamy.in/uploads/SiteConfig/'.$info['img_2']); ?>" alt="app-download-btn1.png" itemprop="image"></a>
										<a class="wow zoomInUp" data-wow-delay="0.4s" href="https://apps.apple.com/us/app/zamy/id1487781178" title="Apple App Store" itemprop="url" target="_blank"><img src="<?php echo base_url('pos.zamy.in/uploads/SiteConfig/'.$info['img_3']); ?>" itemprop="image"></a>
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
<script type="text/javascript">
	$(".data_filter").click(function(){
      var id = $(this).attr('id');
      $.ajax({
        url : '<?php echo base_url('Home/filter_res_foods');  ?>',
        data : {'id' : id},
        type : 'POST',
        success : function(data){
           console.log(data);
           $("#all_cat").hide();
           $("#filtercategory").show();
           $("#filtercategory").html(data);
        },
        error : function(data){
        	console.log("ERROR! Something went to wrong");
        }
      });
	});
	$("#all_rec").click(function(){
        $("#all_cat").show();
        $("#filtercategory").hide();
	});
</script>
<?php
/*
echo '<pre>';
print_r($filter_by_food);
echo '</pre>';*/
?>