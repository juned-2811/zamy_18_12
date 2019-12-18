<?php
$array_items = array('location', 'pincode','current_area' );

 //$this->session->unset_userdata($array_items);
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <title>Zamy | Food Ordering</title>
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/Favicon.ico');?>" type="image/x-icon">
    
    <link rel="stylesheet" href="<?php echo base_url('assets/css/icons.min.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/animate.min.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/main.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/red-color.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/yellow-color.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/responsive.css');?>">
	
	<link rel="stylesheet" href="<?php echo base_url('assets/swiggy/css/swiggy.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/address_selection.css');?>">
	
	<script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>
	<script src="<?php echo base_url('assets/js/bootstrap.min.js')?>"></script>
	<script src="<?php echo base_url('assets/js/plugins.js')?>"></script>
	<script src="<?php echo base_url('assets/js/jquery.bootstrap-touchspin.js')?>"></script>
	<script src="<?php echo base_url('assets/js/main.js')?>"></script>
</head>
<body itemscope>

	<main>
		<div class="preloader">
            <div id="cooking">
                <div class="bubble"></div>
                <div class="bubble"></div>
                <div class="bubble"></div>
                <div class="bubble"></div>
                <div class="bubble"></div>
                <div id="area">
                    <div id="sides">
                        <div id="pan"></div>
                        <div id="handle"></div>
                    </div>
                    <div id="pancake">
                        <div id="pastry"></div>
                    </div>
                </div>
            </div>
        </div>
		<?php
		$current_area 		= '';
		$current_address 	= '';
		if($this->session->has_userdata('current_area')){
			$current_area = $this->session->userdata('current_area');
		}
		
		if($this->session->has_userdata('location')){
			$current_address = $this->session->userdata('location');
		}
		?>
		<header class="stick">
            <div class="topbar">
                <div class="container">
					 <div class="col-md-6 _2z2N5" onclick="getCurrentLocation();"> 
						<div class="fa fa-crosshairs crosshairs" style="color:#fff;margin-right: 10px;"></div>
						<span class="_1tcx6"><span class="_3odgy" id="current_area"> 
						<?php echo !empty($current_area) ? $current_area :'Choose Location';?></span></span>
						<span class="_3HusE" id="current_address"><?php echo $current_address;?></span>
						<!-- <span class="fa fa-angle-down	 kVKTT"></span>-->
					</div>
                   <!-- <div class="select-wrp">
                        <select data-placeholder="Feel Like Eating">
                            <option>FEEL LIKE EATING</option>
                            <option>Burger</option>
                            <option>Pizza</option>
                            <option>Fried Rice</option>
                            <option>Chicken Shots</option>
                        </select>
                    </div>-->
                    <div class="select-wrp hidden">
					<?php 
					$current_location = $this->session->userdata('location');
					
					$area_list = $this->common_model->get_areas();
					
					$check_saved_locaion = $this->common_model->get_field_by_id('online_customer','location',array('id'=>$this->customer_id));
					?>
						<?php echo form_open(base_url()); ?>
						<input type="hidden" name="current_url" id="current_url"  value="<?php echo current_url(); ?>">
                        <select name="location" data-placeholder="Choose Location" onchange="this.form.submit()">
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
						<?php echo form_close(); ?>
                    </div>
					 
					<?php
					if($this->session->has_userdata('cust_id')){
						$cart_count = get_cart_count($this->session->userdata('cust_id'));
					}else{
						$cart_count = get_cart_count();
					}
					?>
                    <div class="topbar-register">
                        <?php 
                        if($this->session->has_userdata('cust_id')){ ?>
                        <ul>
                            <li class="menu-item-has-children">
                                <a href="<?php echo base_url('my_account/edit_profile');?>" title="My Account"> My Account</a>
                                <ul class="sub-dropdown">
                                    <li class="<?php if($this->uri->uri_string() == 'my_account') { echo 'active'; } ?>"><a href="<?php echo base_url('my_account/Edit_profile');?>"><i class="fa fa-cog"></i>  ACCOUNT SETTINGS</a></li>
                                    <li class="<?php if($this->uri->uri_string() == 'my_account/orders') { echo 'active'; } ?>"><a href="<?php echo base_url('my_account/orders');?>"><i class="fa fa-shopping-basket"></i> MY ORDERS</a></li>
                                    <li class="<?php if($this->uri->uri_string() == 'my_account/favourites') { echo 'active'; } ?>"><a href="<?php echo base_url('my_account/favorite_res');?>"><i class="fa fa-heart"></i> Favourites Restaurant</a></li>
                                    <li class="<?php if($this->uri->uri_string() == 'my_account/favourites') { echo 'active'; } ?>"><a href="<?php echo base_url('my_account/favorite_food');?>"><i class="fa fa-heart"></i> Favourites Food</a></li>
                                    <li class="<?php if($this->uri->uri_string() == 'my_account/addresses') { echo 'active'; } ?>"><a href="<?php echo base_url('my_account/addresses');?>"><i class="fa fa-wpforms"></i> Addresses</a></li>
                                    <li class="<?php if($this->uri->uri_string() == 'my_account/referral') { echo 'active'; } ?>"><a href="<?php echo base_url('my_account/referral');?>"><i class="fa fa-code"></i>Referral Code</a></li>
                                    <li><a href="<?php echo base_url('logout');?>" title="Login" ><i class="fa fa-sign-out"></i> Logout</a></li>
                                </ul>
                            </li>                                
                        </ul> 
                        <?php }else{?>

						<a class="log-popup-btn" href="#" title="Login" itemprop="url">LOGIN</a> / 
						<a class="sign-popup-btn" href="#" title="Register" itemprop="url">REGISTER</a>
						<?php } ?>
						<?php /*if($this->session->has_userdata('cust_id')) { ?>
                        | <a class="" href="<?php echo base_url('checkout');?>" title="CART" itemprop="url">CART <span id="cart_count"><?php echo $cart_count;?></span></a>
						<?php }else{ ?>
						| <a class="log-popup-btn" href="#" title="CART" itemprop="url">CART 
						<span id="cart_count"><?php echo $cart_count;?></span></a>
						<?php } */?>
						| <a class="" href="<?php echo base_url('checkout');?>" title="CART" itemprop="url">CART <span id="cart_count"><?php echo $cart_count;?></span></a>
                    </div>
                    <div class="social1">
                        <a href="https://www.facebook.com/zamyindia/" title="Facebook" itemprop="url" target="_blank"><i class="fa fa-facebook-square"></i></a>
                        <a href="https://twitter.com/zamy_india" title="Twitter" itemprop="url" target="_blank"><i class="fa fa-twitter"></i></a>
                        <a href="https://www.instagram.com/zamyindia/" title="Instagram" itemprop="url" target="_blank"><i class="fa fa-instagram"></i></a>
                        <a href="https://www.linkedin.com/company/zamyindia/" title="Linked-In" itemprop="url" target="_blank"><i class="fa fa-linkedin"></i></a>
                        <a href="https://www.youtube.com/channel/UCUFbvEIWQhOD0OEWGutXx_w/" title="Youtube" itemprop="url" target="_blank"><i class="fa fa-youtube"></i></a>
                    </div>
                </div>                
            </div><!-- Topbar -->
            <div class="logo-menu-sec">
                <div class="container">
                    <div class="logo"><h1 itemprop="headline"><a href="<?php echo base_url();?>" title="Home" itemprop="url"><img src="<?php echo base_url()?>assets/images/zamy_logo.png" alt="logo.png" itemprop="image"></a></h1></div>
                    <nav>
                        <div class="menu-sec">
                            <ul>

                                <li><a href="<?php echo base_url();?>" title="HOMEPAGES" itemprop="url"><!-- <span class="red-clr">FOOD ORDERING</span> -->HOME</a>
                                </li>
                                <li class="menu-item-has-children">
								<?php 
								if($this->session->has_userdata('location')){
								?>
								<a href="<?php echo base_url('restaurants');?>" title="RESTAURANTS" itemprop="url">RESTAURANTS</a>
								<?php 
								}else{
								?>
								<a class="rest-popup-btn" href="#" data-toggle="modal" data-target="#rest_popup_model" title="RESTAURANTS" itemprop="url">RESTAURANTS</a>
								<?php 
								}
								?>
								
                                </li>
                                <li class="menu-item-has-children">
                                <?php 
                                if($this->session->has_userdata('location')){
                                ?>
                                <a href="<?php echo base_url('blog');?>" title="BLOG" itemprop="url">BLOG</a>
                                <?php 
                                }else{
                                ?>
                                <a class="rest-popup-btn" href="<?php echo base_url('blog');?>" data-toggle="modal" data-target="#rest_popup_model" title="BLOG" itemprop="url">BLOG</a>
                                <?php 
                                }
                                ?>
                                
                                </li>

                                <!-- <li class="menu-item-has-children"><a href="#" title="PAGES" itemprop="url">PAGES</a>
                                    <ul class="sub-dropdown">
                                        <li class="menu-item-has-children"><a href="#" title="BLOG" itemprop="url">BLOG</a>
                                            <ul class="sub-dropdown">
                                                <li class="menu-item-has-children"><a href="#" title="BLOG LAYOUTS" itemprop="url">BLOG LAYOUTS</a>
                                                    <ul class="sub-dropdown">
                                                        <li><a href="blog-right-sidebar.html" title="BLOG WITH RIGHT SIDEBAR" itemprop="url">BLOG (W.R.S)</a></li>
                                                        <li><a href="blog-left-sidebar.html" title="BLOG WITH LEFT SIDEBAR" itemprop="url">BLOG (W.L.S)</a></li>
                                                        <li><a href="blog.html" title="BLOG WITH NO SIDEBAR" itemprop="url">BLOG</a></li>
                                                    </ul> 
                                                </li>
                                                <li class="menu-item-has-children"><a href="#" title="BLOG DETAIL" itemprop="url">BLOG DETAIL</a>
                                                    <ul class="sub-dropdown">
                                                        <li><a href="blog-detail-right-sidebar.html" title="BLOG DETAIL WITH RIGHT SIDEBAR" itemprop="url">BLOG DETAIL (W.R.S)</a></li>
                                                        <li><a href="blog-detail-left-sidebar.html" title="BLOG DETAIL WITH LEFT SIDEBAR" itemprop="url">BLOG DETAIL (W.L.S)</a></li>
                                                        <li><a href="blog-detail.html" title="BLOG DETAIL WITH NO SIDEBAR" itemprop="url">BLOG DETAIL</a></li>
                                                    </ul>
                                                </li>
                                                <li class="menu-item-has-children"><a href="#" title="BLOG FORMATES" itemprop="url">BLOG FORMATES</a>
                                                    <ul class="sub-dropdown">
                                                        <li><a href="blog-detail-video.html" title="BLOG DETAIL WITH VIDEO" itemprop="url">BLOG DETAIL (VIDEO)</a></li>
                                                        <li><a href="blog-detail-audio.html" title="BLOG DETAIL WITH AUDIO" itemprop="url">BLOG DETAIL (AUDIO)</a></li>
                                                        <li><a href="blog-detail-carousel.html" title="BLOG DETAIL WITH CAROUSEL" itemprop="url">BLOG DETAIL (CAROUSEL)</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="menu-item-has-children"><a href="#" title="SPECIAL PAGES" itemprop="url">SPECIAL PAGES</a>
                                            <ul class="sub-dropdown">
                                                <li><a href="404.html" title="404 ERROR" itemprop="url">404 ERROR</a></li>
                                                <li><a href="search-found.html" title="SEARCH FOUND" itemprop="url">SEARCH FOUND</a></li>
                                                <li><a href="search-not-found.html" title="SEARCH NOT FOUND" itemprop="url">SEARCH NOT FOUND</a></li>
                                                <li><a href="coming-soon.html" title="COMING SOON" itemprop="url">COMING SOON</a></li>
                                                <li><a href="login-register.html" title="LOGIN & REGISTER" itemprop="url">LOGIN & REGISTER</a></li>
                                                <li><a href="price-table.html" title="PRICE TABLE" itemprop="url">PRICE TABLE</a></li>
                                            </ul>
                                        </li>
                                        <li class="menu-item-has-children"><a href="#" title="GALLERY" itemprop="url">GALLERY</a>
                                            <ul class="sub-dropdown">
                                                <li><a href="gallery.html" title="FOOD GALLERY" itemprop="url">FOOD GALLERY</a></li>
                                                <li><a href="gallery-detail.html" title="GALLERY DETAIL" itemprop="url">GALLERY DETAIL</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="register-reservation.html" title="REGISTER RESERVATION" itemprop="url">REGISTER RESERVATION</a></li>
                                        <li><a href="how-it-works.html" title="HOW IT WORKS" itemprop="url">HOW IT WORKS</a></li>
                                        <li><a href="dashboard.html" title="USER PROFILE" itemprop="url">USER PROFILE</a></li>
                                        <li><a href="about-us.html" title="ABOUT US" itemprop="url">ABOUT US</a></li>
                                        <li><a href="food-detail.html" title="FOOD DETAIL" itemprop="url">FOOD DETAIL</a></li>
                                    </ul>
                                </li> -->
                                <li><a href="<?php echo base_url('contact_us'); ?>" title="CONTACT US" itemprop="url">CONTACT US</a></li>
                            </ul>
		
                            <a class="red-bg brd-rd4" href="<?php echo base_url('restaurant_reservation'); ?>" title="Register" itemprop="url">REGISTER RESTAURANT</a>

                        </div>
                    </nav><!-- Navigation -->
                </div>
            </div><!-- Logo Menu Section -->
        </header><!-- Header -->
		
		<div class="responsive-header">
            <div class="responsive-topbar">
            
			<?php /*<div class="select-wrp">
					<select name="location" data-placeholder="Choose Location" onchange="this.form.submit()">
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
                </div>  */?>
				
				 <div class="select-wrp" onclick="getCurrentLocation();"> 
						<div class="fa fa-crosshairs crosshairs" style="color:#fff;margin-right: 10px;"></div>
						<span class="_1tcx6"><span class="_3odgy" id="current_area"> 
						<?php echo !empty($current_area) ? $current_area :'Choose Location';?></span></span>
						<span class="_3HusE" id="current_address"><?php echo $current_address;?></span>
						<!-- <span class="fa fa-angle-down	 kVKTT"></span>-->
					</div>
				
                <?php /*<div class="select-wrp">
                    <select data-placeholder="Choose Location">
                        <option>CHOOSE LOCATION</option>
                        <option>Multan</option>
                        <option>Lahore</option>
                        <option>Karachi</option>
                        <option>Islamabad</option>
                    </select>
                </div>*/?>
            </div> 
   
            <div class="responsive-logomenu">
                <div class="logo"><h1 itemprop="headline"><a href="<?php echo base_url();?>" title="Home" itemprop="url"><img src=" <?php echo base_url('pos.zamy.in/uploads/SiteConfig/Zamy-Logo-2.png') ?>" alt="logo.png" itemprop="image"></a></h1></div>
                <span class="menu-btn yellow-bg brd-rd4"><i class="fa fa-align-justify"></i></span>
            </div>
            <div class="responsive-menu">
                <span class="menu-close red-bg brd-rd3"><i class="fa fa-close"></i></span>
				<div class="topbar-register">
				
                    <?php 
					if($this->session->has_userdata('cust_id')){ ?>
					<ul>
						<li class="menu-item-has-children">
							<a href="<?php echo base_url('my_account/edit_profile');?>" title="My Account"> My Account</a>
							<ul class="sub-dropdown">
								<li class="<?php if($this->uri->uri_string() == 'my_account') { echo 'active'; } ?>"><a href="<?php echo base_url('my_account/Edit_profile');?>"><i class="fa fa-cog"></i>  ACCOUNT SETTINGS</a></li>
								<li class="<?php if($this->uri->uri_string() == 'my_account/orders') { echo 'active'; } ?>"><a href="<?php echo base_url('my_account/orders');?>"><i class="fa fa-shopping-basket"></i> MY ORDERS</a></li>
								<li class="<?php if($this->uri->uri_string() == 'my_account/favourites') { echo 'active'; } ?>"><a href="<?php echo base_url('my_account/favorite_res');?>"><i class="fa fa-heart"></i> Favourites Restaurant</a></li>
                                <li class="<?php if($this->uri->uri_string() == 'my_account/favourites') { echo 'active'; } ?>"><a href="<?php echo base_url('my_account/favorite_food');?>"><i class="fa fa-heart"></i> Favourites Food</a></li>
								<li class="<?php if($this->uri->uri_string() == 'my_account/addresses') { echo 'active'; } ?>"><a href="<?php echo base_url('my_account/addresses');?>"><i class="fa fa-wpforms"></i> Addresses</a></li>
								<li><a href="<?php echo base_url('logout');?>" title="Login" ><i class="fa fa-sign-out"></i> Logout</a></li>
							</ul>
						</li>                                
					</ul>  
					<?php }else{?>    

					
					<a class="log-popup-btn" href="#" title="Login" itemprop="url">LOGIN</a> / 
					<a class="sign-popup-btn" href="#" title="Register" itemprop="url">REGISTER</a>
					<?php } ?>
					
					<?php if($this->session->has_userdata('cust_id')) {?>
					| <a class="" href="<?php echo base_url('checkout');?>" title="CART" itemprop="url">CART <span id="cart_count"><?php echo $cart_count;?></span></a>
					<?php }else{ ?>
					| <a class="log-popup-btn" href="#" title="CART" itemprop="url">CART 
					<span id="cart_count"><?php echo $cart_count;?></span></a>
					<?php } ?>
                </div>
                <div class="menu-lst">
                    <ul>
                        <li class=""><a href="<?php echo base_url();?>" title="HOMEPAGES" itemprop="url">HOME</a>
                        </li>
                        <li class="">
                           <?php 
							if($this->session->has_userdata('location')){
							?>
							<a href="<?php echo base_url('restaurants');?>" title="RESTAURANTS" itemprop="url">RESTAURANTS</a>
							<?php 
							}else{
							?>
							<a class="rest-popup-btn" href="#" data-toggle="modal" data-target="#rest_popup_model" title="RESTAURANTS" itemprop="url">RESTAURANTS</a>
							<?php 
							} 
							?>

                        </li>
                        <li><a href="<?php echo base_url('blog');?>" title="PAGES" itemprop="url">BLOG</a>
                        </li>
                        <li><a href="<?php echo base_url('contact_us');?>" title="CONTACT US" itemprop="url">CONTACT US</a></li>
                    </ul>
                </div>
                
				
                <div class="social1">
                     <?php   if (!empty($info['social_link_1'])) {  ?>
					<a class="brd-rd50" href="<?php echo !empty($info['social_link_1']) ? $info['social_link_1'] : ''; ?>" title="Facebook" itemprop="url" target="_blank"><i class="fa fa-facebook"></i></a>
					<?php  } ?>

					<?php   if (!empty($info['social_link_2'])) {  ?>
					<a class="brd-rd50" href="<?php echo !empty($info['social_link_2']) ? $info['social_link_2'] : ''; ?>" title="instagram Plus" itemprop="url" target="_blank"><i class="fa fa-instagram"></i></a>

					 <?php  } ?>

					 <?php   if (!empty($info['social_link_3'])) {  ?>
					<a class="brd-rd50" href="<?php echo !empty($info['social_link_3']) ? $info['social_link_3'] : ''; ?>" title="Twitter" itemprop="url" target="_blank"><i class="fa fa-twitter"></i></a>
					 <?php  } ?>

					 <?php   if (!empty($info['social_link_4'])) {  ?>
					<a class="brd-rd50" href="<?php echo !empty($info['social_link_4']) ? $info['social_link_4'] : ''; ?>" title="Pinterest" itemprop="url" target="_blank"><i class="fa fa-pinterest"></i></a>
					<?php  } ?> 
                </div>
                <div class="register-btn">
					<?php if(!$this->session->has_userdata('cust_id')) {?>
					<a class="yellow-bg brd-rd4" href="<?php echo base_url('restaurant_reservation'); ?>" title="Register" itemprop="url">REGISTER RESTAURANT</a>
					<?php } ?> 
                </div>
            </div><!-- Responsive Menu -->
        </div><!-- Responsive Header -->
		
		<?php if($this->session->flashdata('msg') != ''): ?>
			<div class="alert alert-warning flash-msg alert-dismissible">
			  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			  <h4> Success!</h4>
			  <?= $this->session->flashdata('msg'); ?> 
			</div>
		<?php endif; ?> 
		
		<?php $this->load->view($view);?>
		
		<footer>
            <div class="block top-padd80 bottom-padd80 dark-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-lg-12">
                            <div class="footer-data">
                                <div class="row">
								<?php
								$newdata = $this->common_model->get_field_by_id('site_config','data',array('id' => 1));
								$info   = unserialize($newdata);
								?>
                                    <div class="col-md-3 col-sm-6 col-lg-3">
                                        <div class="widget about_widget wow fadeIn" data-wow-delay="0.1s">
                                            <div class="logo"><h1 itemprop="headline"><a href="#" title="Home" itemprop="url"><img src="<?php echo base_url('pos.zamy.in/uploads/SiteConfig/').$info['footer_logo']; ?>" alt="logo.png" itemprop="image"></a></h1></div>
                                            <p itemprop="description"><?php echo !empty($info['footer_text']) ? $info['footer_text'] : ''; ?></p>
                                            <div class="social2">
                                                <?php   if (!empty($info['social_link_1'])) {  ?>
                                                <a class="brd-rd50" href="<?php echo !empty($info['social_link_1']) ? $info['social_link_1'] : ''; ?>" title="Facebook" itemprop="url" target="_blank"><i class="fa fa-facebook"></i></a>
                                                <?php  } ?>

                                                <?php   if (!empty($info['social_link_2'])) {  ?>
                                                <a class="brd-rd50" href="<?php echo !empty($info['social_link_2']) ? $info['social_link_2'] : ''; ?>" title="instagram Plus" itemprop="url" target="_blank"><i class="fa fa-instagram"></i></a>

                                                 <?php  } ?>

                                                 <?php   if (!empty($info['social_link_3'])) {  ?>
                                                <a class="brd-rd50" href="<?php echo !empty($info['social_link_3']) ? $info['social_link_3'] : ''; ?>" title="Twitter" itemprop="url" target="_blank"><i class="fa fa-twitter"></i></a>
                                                 <?php  } ?>

                                                 <?php   if (!empty($info['social_link_4'])) {  ?>
                                                <a class="brd-rd50" href="<?php echo !empty($info['social_link_4']) ? $info['social_link_4'] : ''; ?>" title="Pinterest" itemprop="url" target="_blank"><i class="fa fa-pinterest"></i></a>
                                                <?php  } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-lg-3">
                                        <div class="widget information_links wow fadeIn" data-wow-delay="0.2s">
                                            <h4 class="widget-title" itemprop="headline">INFORMATION</h4>
                                            <ul>
                                                <li><a href="<?php echo base_url('home/privacy_policy');  ?>" title="" itemprop="url">Privacy & Policy</a></li>
                                                <li><a href="#" title="" itemprop="url">Investor Relations</a></li>
                                                <li><a href="#" title="" itemprop="url">Press Releases</a></li>
                                                <li><a href="#" title="" itemprop="url">Shop with Points</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-lg-3">
                                        <div class="widget customer_care wow fadeIn" data-wow-delay="0.3s">
                                            <h4 class="widget-title" itemprop="headline">CUSTOMER CARE</h4>
                                            <ul>
                                                <li><a href="#" title="" itemprop="url">Returns</a></li>
                                                <li><a href="#" title="" itemprop="url">Shipping Info</a></li>
                                                <li><a href="#" title="" itemprop="url">Gift Cards</a></li>
                                                <li><a href="#" title="" itemprop="url">Size Guide</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-lg-3">
                                        <div class="widget get_in_touch wow fadeIn" data-wow-delay="0.4s">
                                            <h4 class="widget-title" itemprop="headline">GET IN TOUCH</h4>
                                            <ul>
                                               <li><i class="fa fa-map-marker"></i><?php echo !empty($info['footer_add_1']) ? $info['footer_add_1'] : ''; ?>,
                                                <?php echo !empty($info['footer_add_2']) ? $info['footer_add_2'] : ''; ?></li>
                                               <li><i class="fa fa-phone"></i><?php echo !empty($info['footer_phone']) ? $info['footer_phone'] : ''; ?></li>
                                               <li><i class="fa fa-envelope"></i> <a href="#" title="" itemprop="url"><?php echo !empty($info['footer_email']) ? $info['footer_email'] : ''; ?></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- Footer Data -->
                        </div>
                    </div>
                </div>
            </div>
        </footer>
		
		<div class="bottom-bar dark-bg text-center">
            <div class="container">
                <p itemprop="description">&copy; 2019 <a class="red-clr" href="<?php  echo base_url();?>" title="Zamy" itemprop="url" target="_blank">ZAMY</a>. All Rights Reserved</p>
            </div>
        </div><!-- Bottom Bar -->
		
		<!--<div class="newsletter-popup-wrapper text-center">
            <div class="newsletter-popup-inner" style="background-image: url(<?php echo base_url()?>assets/images/newsletter-bg.jpg);">
                <a class="close-btn brd-rd50" href="#" title="Close Button" itemprop="url"><i class="fa fa-close"></i></a>
                <h3 itemprop="headline"><i class="fa fa-envelope-open red-clr"></i> SIGN UP FOR RECENT UPDATES</h3>
                <p itemprop="description">Join our Subscribers list to get the latest news, updates and special offers delivered directly in your inbox.</p>
                <form class="newsletter-frm brd-rd30">
                    <input class="brd-rd30" type="email" placeholder="ENTER YOUR EMAIL">
                    <button class="brd-rd30 red-bg" type="submit">SUBSCRIBE</button>
                </form>
                <span class="red-clr"><i class="fa fa-check"></i> Thanks, your address has been added.</span>
            </div>
        </div>--><!-- Newsletter Popup Wrapper -->
		<?php if(!$this->session->has_userdata('cust_id')){?>
		<div class="log-popup text-center">
            <div class="sign-popup-wrapper brd-rd5">
                <div class="sign-popup-inner brd-rd5">
                    <a class="log-close-btn" href="#" title="" itemprop="url"><i class="fa fa-close"></i></a>
                    <div class="sign-popup-title text-center">
                        <h4 itemprop="headline">SIGN IN</h4>
                       <!-- <span>with your social network</span>-->
                    </div>
                    <!--<div class="popup-social text-center">
                        <a class="facebook brd-rd3" href="#" title="Facebook" itemprop="url" target="_blank"><i class="fa fa-facebook"></i> Facebook</a>
                        <a class="google brd-rd3" href="#" title="Google Plus" itemprop="url" target="_blank"><i class="fa fa-google-plus"></i> Google</a>
                        <a class="twitter brd-rd3" href="#" title="Twitter" itemprop="url" target="_blank"><i class="fa fa-twitter"></i> Twitter</a>
                    </div>
                    <span class="popup-seprator text-center"><i class="brd-rd50">or</i></span>-->
                    <?php echo form_open('',array('id'=>'login','class'=>'sign-form login')); ?>
						<input type="hidden" id="login_current_url"  value="<?php echo current_url(); ?>">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-lg-12">
                                <input class="brd-rd3" name="username" id="username" type="text" placeholder="Phone number or Email">
								<span class="error login_username_error" style="display:none;"></span>
                            </div>
                            <div class="col-md-12 col-sm-12 col-lg-12">
                                <input class="brd-rd3" name="login_password" id="login_password" type="password" placeholder="Password">
								<span class="error login_password_error" style="display:none;"></span>
                            </div>
                            <div class="col-md-12 col-sm-12 col-lg-12">
                                <button class="red-bg brd-rd3" type="submit" id="sign_in">SIGN IN</button>
                            </div>
                            <div class="col-md-12 col-sm-12 col-lg-12">
								<a class="sign-popup-btn sign-btn" href="#" title="Not a member? Sign up" itemprop="url">Not a member? Sign up</a>
                                <a class="recover-btn" href="<?php echo base_url('my_account/ForgetPassword/index'); ?>" title="" itemprop="url">Recover my password</a>
                            </div>
                        </div>
					<?php echo form_close(); ?>
                </div>
            </div>
        </div>
		
		<div class="sign-popup text-center">
            <div class="sign-popup-wrapper brd-rd5">
                <div class="sign-popup-inner brd-rd5">
                    <a class="sign-close-btn" href="#" title="" itemprop="url"><i class="fa fa-close"></i></a>
                    <div class="sign-popup-title text-center">
                        <h4 itemprop="headline">SIGN UP</h4>
                       <!-- <span>with your social network</span>-->
                    </div>
                    <!--<div class="popup-social text-center">
                        <a class="facebook brd-rd3" href="#" title="Facebook" itemprop="url" target="_blank"><i class="fa fa-facebook"></i> Facebook</a>
                        <a class="google brd-rd3" href="#" title="Google Plus" itemprop="url" target="_blank"><i class="fa fa-google-plus"></i> Google</a>
                        <a class="twitter brd-rd3" href="#" title="Twitter" itemprop="url" target="_blank"><i class="fa fa-twitter"></i> Twitter</a>
                    </div>
                    <span class="popup-seprator text-center"><i class="brd-rd50">or</i></span>-->
					<?php echo form_open('',array('id'=>'verify_otp_form','class'=>'sign-form verify_otp_form')); ?>
                        <div class="row">
							<div class="col-md-12 col-sm-12 col-lg-12">
                                <input class="brd-rd3" type="text" name="phone" id="phone" placeholder="Phone number">
								<span class="error phone_error" style="display:none;">Phone number is required</span>
                            </div>
                            <div class="col-md-12 col-sm-12 col-lg-12">
                                <input class="brd-rd3" type="text" name="name" id="name" placeholder="Name" required>
								<span class="error name_error" style="display:none;">Name is required</span>
                            </div>
                            <div class="col-md-12 col-sm-12 col-lg-12">
                                <input class="brd-rd3" type="email" name="email" id="email" placeholder="Email" required>
								<span class="error email_error" style="display:none;">Email is required</span>
                            </div>
                            <div class="col-md-12 col-sm-12 col-lg-12">
                                <input class="brd-rd3" type="password" name="password" id="password" placeholder="Password" required>
								<span class="error password_error" style="display:none;">Password is required</span>
                            </div>

                            <div class="col-md-12 col-sm-12 col-lg-12">
                                <input class="brd-rd3" type="text" name="referral" id="referral" placeholder="Referral Code">
                            </div>

							<div class="col-md-12 col-sm-12 col-lg-12" id="one_time_password" style="display:none;">
								<input class="brd-rd3" type="text" name="otp" id="otp" placeholder="One time password">
								<span class="error otp_error" style="display:none;">OTP is required</span>
							</div>

                            <div class="col-md-12 col-sm-12 col-lg-12" id="send_otp_div">
                                <button class="red-bg brd-rd3" id="send_otp">Request OTP</button>
                            </div>
							<div class="col-md-12 col-sm-12 col-lg-12" id="verify_otp_div" style="display:none;">
                                <button class="red-bg brd-rd3" type="button" id="verify_otp">Verify OTP</button>
                            </div>
							<div class="col-md-12 col-sm-12 col-lg-12" id="register_now" style="display:none">
                                <button class="red-bg brd-rd3" type="submit" id="register">REGISTER NOW</button>
                            </div>
                            <div class="col-md-12 col-sm-12 col-lg-12">
                                <a class="log-popup-btn sign-btn" href="#" title="Already Registered? Sign in" itemprop="url">Already Registered? Sign in</a>
								
                                <a class="recover-btn" href="<?php echo base_url('my_account/ForgetPassword/index'); ?>" title="Recover my password" itemprop="url">Recover my password</a>
                            </div>
                        </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
		<?php } ?>
	</main>

<div id="common_model_popup" class="modal fade" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close cls" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary cls" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div id="rest_popup_model" class="modal fade" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">CHOOSE LOCATION</h5>
        <button type="button" class="close cls" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<div class="text-center" style="display:flex;">
			<div class="col-md-8 col-md-offset-2">
				<?php echo form_open(base_url()); ?>
					<div class="row">
					<div class=" cmn-box-dsgn">
						<div class="location-gtbx">
							<div class="get-cmn-box" onclick="getCurrentLocation();">
								<div class="fa fa-crosshairs crosshairs"></div>
								<div class="get-cmn-box">
									<div class="lctn-txt-ttl">Get current location</div>
									<div class="using-gps">Using GPS</div>
								</div>
							</div>
						</div>
					</div>
					<?php /*	<div class="select_location_wrap">
						<div class="select_location_row">
							<div class=" location_input select-wrp">
								<input type="hidden" name="current_url"  value="<?php echo current_url(); ?>">
								<select name="location" data-placeholder="Choose Location" onchange="this.form.submit()">
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
						<input type="submit" class="find_btn" name="search_location" value="FIND FOOD">
						</div> */?>
					</div>
				<?php echo form_close(); ?>
			</div>
		</div>
		<div class="clearfix"></div>
	  </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary cls" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>	
<?php
echo $this->uri->segment('2');
if($this->uri->segment('2') != 'addresses'){
?>
 
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD9UPC1UTFH7mwjIxCbF_rYFa4igU9u0xA&libraries=places"></script>
<!-- <script src="<?php echo base_url('assets/js/custommap.js');?>"></script> -->
<?php	
}
 ?>
 

<?php 
if($this->session->has_userdata('location')){
}else{
	$display_default_map_sidebar = "display: none;";
	echo "<script>
	$(document).ready(function(){
		getCurrentLocation();
	});
	</script>";
}
 /*?>
<div id="overlay-sidebar-root" style="display: none;">
<div class="cmn-zamy-sdbr">
	<div class="position-relative">
		<div class="cmn-sgy-div">
			<div class="zamy-srch">
				<div class="zamy-clse" onclick="close_map_address();">
					<span class="SSFcO fa fa-close"></span>
					<!-- <div class="_2Joay"></div> -->
				</div>
				<div class="_1L8WG" id="set_delivery_location_wrap" onclick="set_delivery_location();" style="display:none;">
					<span class="SSFcO fa fa-arrow-left"></span>
					<div class="_2Joay">Set delivery location</div>
				</div>
				<ul id="geoData hidden" style="display:none;">
					<li>Full Address: <span id="location"></span></li>
					<li>Area: <span id="searched_area"></span></li>
					<li>Postal Code: <span id="postal_code"></span></li>
					<li>Country: <span id="country"></span></li>
					<li>Latitude: <span id="lat"></span></li>
					<li>Longitude: <span id="lon"></span></li>
				</ul>
				<p style="font-size: 14px;color:orange;">location service must be enable in your browser to access your current location.</p>
				<div class="zamy-src-inpt">
					<input class="form-control searchInput" type="text" id="searchInput" type="text"  name="" placeholder="Search for area, street name.." value="">
				</div>
			</div>
			<div id="map_wrap" style="padding-left: 75px; padding-right: 40px;display:none;">
			<div class="map_div">
				<div id="address-location-map"></div>
			</div>
			<div>
				<div class="_3Um38 _9Wk87">
					<input class="_381fS" id="search_address" disabled="" type="text" name="" value="Unnamed Road, Makarba, Ahmedabad, Gujarat 380051, India">
						<div class="_2EeI1 _26LFr"></div>
						<label class="_1Cvlf _2tL9P">Address</label>
				</div>
			</div>
				<?php
				if($this->session->has_userdata('cust_id')){
				?>
				<a class="achr-btn" id="add_more_details_btn" onclick="add_more_details();" style="display:none;">
						<div class="">ADD MORE DETAILS</div>
				</a>
				
				<div class="margin-bottom" id="add_more_details"  style="display:none;">
					<div>
						<div class="_3Um38 _23P1X">
							<input class="_381fS" type="text" name="building" id="building" tabindex="1" autocomplete="off" value="">
							<label class="_1Cvlf _2tL9P A7Y41" for="building">Door / Flat no. can not be empty</label>
						</div>
					</div>
					<div>
						<div class="_3Um38 _23P1X">
							<input class="_381fS" type="text" name="landmark" id="landmark" tabindex="1" autocomplete="off" value="">
							<label class="_1Cvlf" for="landmark">Landmark</label>
						</div>
					</div>
					<div class="_2i256 save-adr-box-wrap">
						<div class="_1dzL9 save-adr-box" id="home_type_address" onclick="map_address_type('home');">
						<span class="_3Ey3V fa fa-home"></span>
							<div class="sf8jl">Home</div>
						</div>
						<div class="_1dzL9 save-adr-box" id="work_type_address" onclick="map_address_type('work');"><span class="_3Ey3V fa fa-building"></span>
							<div class="sf8jl">Work</div>
						</div>
						<div class="_1dzL9 save-adr-box" id="other_type_address" onclick="map_address_type('other');"><span class="_3Ey3V fa fa-map-marker"></span>
							<div class="sf8jl">Other</div>
						</div>
						
						<div class="_1qe1S _1I3pI" id="other_map_address" style="display:none;">
							<div class="_3Um38 _3vwW5">
								<input class="_381fS _1oTLG _2VYMY" type="text" name="other_address_type" id="other_address_type" tabindex="1" placeholder="Dad’s home, my man cave" maxlength="20" value="">
								<div class="_2EeI1 _26LFr"></div>
								<label class="_1Cvlf _2tL9P" for="annotation"></label>
							</div>
							<div class="_3RRl6 cancel_address_btn" onclick="map_address_type('cancel');">Cancel</div>
						</div>
					</div>
				</div>
				<?php }?>
				<input type="hidden" id="latitude" name="latitude" value="">
				<input type="hidden" id="longitude" name="longitude" value="">
				<a class="_2YQkO bg-theme mb20 skip-later map-red-btn" onclick="skip_map_address();">
					<div class="">SKIP &amp; ADD LATER</div>
				</a>
			</div>
			<div class="zmy-src-lctn">
				<div>
					<div class=" cmn-box-dsgn">
						<div class="location-gtbx">
							<div class="get-cmn-box get-location" onclick="getCurrentLocation();">
								<div class="fa fa-crosshairs crosshairs"></div>
								<div class="get-cmn-box">
									<div class="lctn-txt-ttl">Get current location</div>
									<div class="using-gps">Using GPS</div>
								</div>
							</div>
						</div>
					</div>
					<div></div>
					<?php
					
					if($this->session->has_userdata('cust_id')){
					
					$req_param['conditions'] = array('user_id'=>$this->customer_id);
					$address_book = $this->common_model->getRows('address_book',$req_param);
					if(!empty($address_book)){
					?>
					<div class="cmn-box-dsgn saved_address_list">
						<div class="save-address">SAVED ADDRESSES</div>
						<div class="rct-adrs">
						<?php 	
							
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
								$address .= $data['address_2'].", ";
							}
							$address .= $data['shipping_area'].", ";
							$address .= $data['city'].", ";
							$address .= $data['state']."-";
							$address .= $data['postcode'].", ";
							$address .= $data['country'];
							?>
							
							<div class="">
								<div class="svd-adrs" onclick='set_current_location("<?php echo $data['postcode'];?>","<?php echo $data['shipping_area'];?>","<?php echo $address;?>")'>
									<div class="<?php echo $address_class;?>"></div>
									<div class="address-wrap">
										<div class="adrs-txt"><?php echo $address_type;?></div>
										<div class="address-desc"><?php echo $address;?></div>
									</div>
								</div>
							</div>
							
							<?php 
							}
							
							?>
							
						</div>
						
						<a href="<?php echo base_url('my_account/addresses');?>" class="_3Gwq1">View More</div>
					</div>
					<?php } }else{
						echo "<div class='saved_address_list'></div>";
					}?>
					<div class="hidden  cmn-box-dsgn">
						<div class="recent-search">RECENT SEARCHES</div>
						<div class="rct-adrs">
							<div class="svd-adrs">
								<div class="fa fa-clock-o"></div>
								<div class="address-wrap">
									<div class="adrs-txt">Siddhivinayak business tower- Makarba</div>
									<div class="address-desc">Kataria Automobiles Road, Makarba, Ahmedabad, Gujarat, India</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div id="" class="_3Za6N save-address-btn" style="display:none;">
					<div class="gbzB0 _2sd1x">
						<div class="_25qBi ">
							<input type="button" style="display: none;" onclick="save_address();">SAVE ADDRESS &amp; PROCEED
						</div>
					</div>
				</div>
			</div>
			
			
		</div>
		
	</div>
	
	
</div>
*/?>
<style>
#address-location-map {
    width: 100%;
    height: 250px;
}

.cmn-zamy-sdbr {
    z-index: 999; 
}
</style>

<script>
function showError(error) {
  switch(error.code) {
    case error.PERMISSION_DENIED:
	  alert('You denied the request for Geolocation, please enable location service from your browser.');
      break;
    case error.POSITION_UNAVAILABLE:
	  alert('Location information is unavailable.');
      break;
    case error.TIMEOUT:
	alert('The request to get user location timed out.');
      break;
    case error.UNKNOWN_ERROR:
	  alert('An unknown error occurred.');
      break;
  }
}

function getCurrentLocation() {
	  
	 if ("geolocation" in navigator) {
		 
		  // check if geolocation is supported/enabled on current browser
		  navigator.geolocation.getCurrentPosition(
		   function success(position) {
			 // for when getting location is a success
			 console.log('latitude', position.coords.latitude, 
						 'longitude', position.coords.longitude);
						 
				var lat = parseFloat(position.coords.latitude);
				var lng = parseFloat(position.coords.longitude);			 
				var latlng = new google.maps.LatLng(lat, lng);
				var geocoder = geocoder = new google.maps.Geocoder();
				geocoder.geocode({ 'latLng': latlng }, function (responses, status) {
					if (status == google.maps.GeocoderStatus.OK) {
					   /* if (responses[0]) {
							
							 document.getElementById('current_area').innerHTML = responses[0].formatted_address;
							 
						}*/
						for (var i = 0; i < responses[0].address_components.length; i++) {
				
							/* console.log(responses[0].address_components[i].types[0]);
							 console.log(responses[0].address_components[i].long_name);*/
							
							 if(responses[0].address_components[i].types[0] == 'political'){
							 
								current_area = responses[0].address_components[i].long_name;
								 
							}
							if(responses[0].address_components[i].types[0] == 'postal_code'){
							 
								pincode = responses[0].address_components[i].long_name;
								 
							} 
						}
							var current_address = responses[0].formatted_address; 
							update_location(pincode,current_area,current_address);	 
					}
				});		 	 
		   },
		  function error(error_message) {
			// for when getting location results in an error
			console.error('An error has occured while retrieving  location', error_message)
			 ipLookUp()
		  } ,
			{
				enableHighAccuracy: true,

			}		  
		);
		} else {
		  // geolocation is not supported
		  // get your location some other way
		  console.log('geolocation is not enabled on this browser')
		   ipLookUp()
		}
			 
	/*if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(updatePositionAdd,showError);
	} else {
		alert('Geolocation is not supported by this browser.');
		return false;
	}

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(updatePositionAdd);
    }
    return null; */
}
function ipLookUp () {
  $.ajax('http://ip-api.com/json')
  .then(
      function success(response) {
          console.log('User\'s Location Data is ', response);
          console.log('User\'s Country', response.country);
          getAdress(response.lat, response.lon)
},

      function fail(data, status) {
          console.log('Request failed.  Returned status of',
                      status);
      }
  );
}

function update_location(live_pincode,live_area,live_address){
	 	 
	var site_url = "https://zamy.in/";
	
	var current_area = '';
	var current_address = '';
	var pincode = '';
	
	if(live_pincode!=''){
		pincode = live_pincode;
	}
	
	if(live_area!=''){
		current_area = live_area;
	}
	if(live_address!=''){
		current_address = live_address;
	}
	
	
	if(live_area!=''){
		
		jQuery.ajax({
			type: "POST",
			dataType: 'html',
			url: site_url + "home/save_location",
			data: {'pincode':pincode,'current_area':current_area,'current_address':current_address},
			success: function (response) {
			 
				
				var response1 = JSON.parse(response);
				
				if(response1.status==1){
					 
					$("#rest_popup_model").modal('hide');
					
					$("#current_area").text(response1.current_area);
					$("#current_address").text(response1.location);
					$(".rest-popup-btn").attr('href',site_url+'restaurants');
					$(".rest-popup-btn").removeAttr('data-toggle');
					$(".rest-popup-btn").removeAttr('data-target');
					
					
					
				}else{
					
					$("#current_area").text();
					$("#current_address").text('Choose Your Location');
					
					$("#common_model_popup").modal('show');
					$("#common_model_popup .modal-body").text(response1.message);
					
					
					
				}
			},
			error: function (xhr, extStatus, errorThrown) {
				alert('An error occurred! ' + errorThrown);
			}
		});
	}
}
 
function set_delivery_location(){
	$("#set_delivery_location_wrap").hide();
	$("#map_wrap").hide();
	$(".map_div").hide();
	$(".skip-later").hide();
	
	$(".zamy-clse").show();
	$(".get-location").show();
	$(".saved_address_list").show();	
}
function show_map_sidebar(){
	$("#overlay-sidebar-root").show();
}
function add_more_details(){
	$("#add_more_details").show();
	$(".save-address-btn").show();
	$("#add_more_details_btn").hide();
	$(".skip-later").hide();
}
function skip_map_address(){
	$("#overlay-sidebar-root").hide();
}
function close_map_address(){
	$("#overlay-sidebar-root").hide();
}
</script>
<script type="text/javascript">
$(document).ready(function() {
	$('#send_otp').click(function (e) {
		e.preventDefault();
		var phone = $('#phone').val();
		var site_url = "<?php echo base_url();?>";
		
		if(phone==''){
			$(".phone_error").show();
			return false;
		}else  if(!phone.match('[0-9]{10}'))  {
			$(".phone_error").show();
			$(".phone_error").text("Enter 10 Digit Phone number");
			return false;
		}
		
		$(".phone_error").hide();
		
		jQuery.ajax({
			type: "POST",
			dataType: 'html',
			url: site_url + "home/sent_otp",
			data: {'mobile':phone},
			success: function (response) {
				var response1 = JSON.parse(response);
				
				if(response1.success==1){
					$('#send_otp_div').hide();
					$('#one_time_password').show();
					$('#verify_otp_div').show();
					
					$("#one_time_password #otp").val('');
					$(".otp_error").hide();
					
				}else{
					alert(response1.message);
				}
				console.log(response1.message);
			},
			error: function (xhr, extStatus, errorThrown) {
				alert('An error occurred! ' + errorThrown);
			}
		});
	});
	
	$('#verify_otp').click(function(e){
		e.preventDefault();
		var site_url = "<?php echo base_url();?>";
		
		var otp = $('#otp').val();
		
		var phone = $('#phone').val();
		var name = $('#name').val();
		var email = $('#email').val();
		var password = $('#password').val();
        var referral = $('#referral').val();

		if(referral == ''){
            var referral = ''; 
        }
		
		if(phone==''){
			$(".phone_error").show();
			return false;
		}else  if(!phone.match('[0-9]{10}'))  {
			$(".phone_error").show();
			$(".phone_error").text("Enter 10 Digit Phone number.");
			return false;
		}
		$(".phone_error").hide();
		
		if(otp==''){
			$(".otp_error").show();
			$(".otp_error").text("Please enter otp number.");
			return false;
		}
		$(".otp_error").hide();
		
		if(name==''){
			$(".name_error").show();
			$(".name_error").text("Please enter your name.");
			return false;
		}
		$(".name_error").hide();
		
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
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
		
		if(password==''){
			$(".password_error").show();
			$(".password_error").text("Please enter your password.");
			return false;
		}
		$(".password_error").hide();
		
		
		jQuery.ajax({
			type: "POST",
			dataType: 'html',
			url: site_url + "home/verify_otp",
			data: {'phone':phone,'name':name,'email':email,'password':password,'otp':otp ,'referral' : referral},
			success: function (data) {
				var response = JSON.parse(data);
				
				console.log(response);
				
				if(response.success==1){
					$('#send_otp_div').hide();
					$('#one_time_password').show();
					$('#verify_otp_div').show();
					
				 	var link = "<?php echo base_url('restaurants');?>";
					window.location = link;	
					
				}else if(response.success==2){
					var link = "<?php echo base_url();?>";
					$(".otp_error").show();
					$(".otp_error").text(response.message);
					
					$("#verify_otp_div").hide();
					$("#send_otp_div").show();
					$("#send_otp_div #send_otp").text('Resend OTP');
					
					return false;
					//window.location = link;	
				}else{
					alert(response.message);
				}
				
			},
			error: function (xhr, extStatus, errorThrown) {
				alert('An error occurred! ' + errorThrown);
			}
		});
	});
	
	$('#sign_in').click(function (e) {
		e.preventDefault();
		
		var username = $('#username').val();
		var password = $('#login_password').val();
		var current_url = $('#login_current_url').val();
		var site_url = "<?php echo base_url();?>";
		
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		
		if(username==''){
			$(".login_username_error").show();
			$(".login_username_error").text('Please Enter email or Phone number.');
			return false;
		}
		$(".login_username_error").hide();
		
		if(password==''){
			$(".login_password_error").show();
			$(".login_password_error").text("Please enter your password.");
			return false;
		}
		$(".login_password_error").hide();
		
		jQuery.ajax({
			type: "POST",
			dataType: 'html',
			url: site_url + "users/sign_in",
			data: {'username':username,'password':password,'current_url':current_url},
			success: function (response) {
				var response1 = JSON.parse(response);
				
				if(response1.success==1){
					var link = "<?php echo base_url();?>";
					window.location = response1.redirect_url;	
				}else{
					//alert(response1.message);
					$("#common_model_popup .modal-title").text('Alert');
					$("#common_model_popup .modal-body").text(response1.message);
					$("#common_model_popup").modal('show');
					
					console.log(response1.message);
				}
				
			},
			error: function (xhr, extStatus, errorThrown) {
				alert('An error occurred! ' + errorThrown);
			}
		});
	});
	
	$(window).scroll(function() {    
		var scroll = $(window).scrollTop();
		
		if (scroll >= 500) {
			//$(".restaurant-detail-title").addClass("sticky");
		}else{
			//$(".restaurant-detail-title").removeClass("sticky");
		}
	});
	
	var site_url = "<?php echo base_url();?>";
	$('#search').unbind('keypress keyup').bind('keypress keyup', function(e){
		
		var menu_name = $(this).val();
		var restaurant_id = $("#restaurant_id").val();
		
		if(menu_name==''){
			$('#search_out').hide();
			$('#search_out > div').remove();
			$('.search_div').hide();
		}else{
			$('#search_out').show();
			$('.search_div').show();
		}
		
		if ($(this).val().length < 3 && e.keyCode != 13){
			$('#search_out').hide();
			$('#search_out > div').remove();
			$('.search_div').hide();
			return;
		} 
		
		jQuery.ajax({
			type: "POST",
			dataType: 'html',
			url: site_url + "users/restaurant_menu_search",
			data: {'menu_name':menu_name,'restaurant_id':restaurant_id},
			success: function (response) {
				
				$('#search_out').html(response);
			},
			error: function (xhr, extStatus, errorThrown) {
				alert('An error occurred! ' + errorThrown);
			}
		});
	});
	

});

</script>

<script type="text/javascript">
    

</script>
</body>
</html>