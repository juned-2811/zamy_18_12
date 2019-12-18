<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <title>Food Ordering HTML Template</title>
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.png');?>" type="image/x-icon">
    
    <link rel="stylesheet" href="<?php echo base_url('assets/css/icons.min.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/animate.min.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/main.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/red-color.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/yellow-color.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/responsive.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/swiggy/css/swiggy.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/address_selection.css');?>">
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
		
		<header class="stick">
            <div class="topbar">
                <div class="container">
                    <div class="_2z2N5" onclick="show_map_sidebar();">
					<span class="_1tcx6"><span class="_3odgy" id="current_area">Ellisbridge</span></span>
					<span class="_3HusE" id="current_address">Netaji Rd, Maharashtra Society, Ellisbridge, Ahmedabad, Gujarat 380009, India</span>
					<span class="icon-downArrow kVKTT"></span>
					</div>
					
                    <div class="topbar-register">
                        <a class="log-popup-btn" href="#" title="Login" itemprop="url">LOGIN</a> / <a class="sign-popup-btn" href="#" title="Register" itemprop="url">REGISTER</a>
                    </div>
                    <div class="social1">
                        <a href="#" title="Facebook" itemprop="url" target="_blank"><i class="fa fa-facebook-square"></i></a>
                        <a href="#" title="Twitter" itemprop="url" target="_blank"><i class="fa fa-twitter"></i></a>
                        <a href="#" title="Google Plus" itemprop="url" target="_blank"><i class="fa fa-google-plus"></i></a>
                    </div>
                </div>                
            </div><!-- Topbar -->
            <div class="logo-menu-sec">
                <div class="container">
                    <div class="logo"><h1 itemprop="headline"><a href="index.html" title="Home" itemprop="url"><img src="assets/images/logo2.png" alt="logo.png" itemprop="image"></a></h1></div>
                    <nav>
                        
                    </nav><!-- Navigation -->
                </div>
            </div><!-- Logo Menu Section -->
        </header><!-- Header -->
		
		<div class="responsive-header">
            <div class="responsive-topbar">
                <div class="select-wrp">
                    <select data-placeholder="Feel Like Eating">
                        <option>FEEL LIKE EATING</option>
                        <option>Burger</option>
                        <option>Pizza</option>
                        <option>Fried Rice</option>
                        <option>Chicken Shots</option>
                    </select>
                </div>
                <div class="select-wrp">
                    <select data-placeholder="Choose Location">
                        <option>CHOOSE LOCATION</option>
                        <option>Multan</option>
                        <option>Lahore</option>
                        <option>Karachi</option>
                        <option>Islamabad</option>
                    </select>
                </div>
            </div>
            <div class="responsive-logomenu">
                <div class="logo"><h1 itemprop="headline"><a href="index.html" title="Home" itemprop="url"><img src="assets/images/logo.png" alt="logo.png" itemprop="image"></a></h1></div>
                <span class="menu-btn yellow-bg brd-rd4"><i class="fa fa-align-justify"></i></span>
            </div>
            <div class="responsive-menu">
                <span class="menu-close red-bg brd-rd3"><i class="fa fa-close"></i></span>
                <div class="menu-lst">
                    <ul>
                        <li class="menu-item-has-children"><a href="#" title="HOMEPAGES" itemprop="url"><span class="yellow-clr">FOOD ORDERING</span>HOMEPAGES</a>
                            <ul class="sub-dropdown">
                                <li><a href="index.html" title="HOMEPAGE 1" itemprop="url">HOMEPAGE 1</a></li>
                                <li><a href="index2.html" title="HOMEPAGE 2" itemprop="url">HOMEPAGE 2</a></li>
                            </ul>
                        </li>
                        <li class="menu-item-has-children"><a href="#" title="RESTAURANTS" itemprop="url"><span class="yellow-clr">REAL FOOD</span>RESTAURANTS</a>
                            <ul class="sub-dropdown">
                                <li><a href="restaurant-found.html" title="RESTAURANT 1" itemprop="url">RESTAURANT 1</a></li>
                                <li><a href="restaurant-found2.html" title="RESTAURANT 2" itemprop="url">RESTAURANT 2</a></li>
                                <li><a href="restaurant-detail.html" title="RESTAURANT DETAILS" itemprop="url">RESTAURANT DETAILS</a></li>
                                <li><a href="restaurant-detail.html" title="RESTAURANT DETAILS" itemprop="url">RESTAURANT DETAILS</a></li>
                                <li><a href="food-recipes.html" title="RESTAURANT DETAILS" itemprop="url">FOOD RECIPES</a></li>
                                <li><a href="our-articles.html" title="RESTAURANT DETAILS" itemprop="url">OUR ARTICLES</a></li>
                                <li><a href="our-menu.html" title="RESTAURANT DETAILS" itemprop="url">OUR MENU</a></li>
                                <li><a href="our-services.html" title="RESTAURANT DETAILS" itemprop="url">OUR SERVICES</a></li>
                            </ul>
                        </li>
                        <li class="menu-item-has-children"><a href="#" title="PAGES" itemprop="url"><span class="yellow-clr">REAL FOOD</span>PAGES</a>
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
                        </li>
                        <li><a href="contact.html" title="CONTACT US" itemprop="url"><span class="yellow-clr">REAL FOOD</span>CONTACT US</a></li>
                    </ul>
                </div>
                <div class="topbar-register">
                    <a class="log-popup-btn" href="#" title="Login" itemprop="url">LOGIN</a> / <a class="sign-popup-btn" href="#" title="Register" itemprop="url">REGISTER</a>
                </div>
                <div class="social1">
                    <a href="#" title="Facebook" itemprop="url" target="_blank"><i class="fa fa-facebook-square"></i></a>
                    <a href="#" title="Twitter" itemprop="url" target="_blank"><i class="fa fa-twitter"></i></a>
                    <a href="#" title="Google Plus" itemprop="url" target="_blank"><i class="fa fa-google-plus"></i></a>
                </div>
                <div class="register-btn">
                    <a class="yellow-bg brd-rd4" href="register-reservation.html" title="Register" itemprop="url">REGISTER RESTAURANT</a>
                </div>
            </div><!-- Responsive Menu -->
        </div><!-- Responsive Header -->
		
		<section>
	<div class="block top-padd40 bottom-padd140 search_location_div">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-lg-12">
					<div class="text-center">
						<div class="restaurant-searching-inner">
							<h2 itemprop="headline">Order <span>Food Online From</span> the Best Restaurants</h2>
						</div>
					</div>
					
				</div>
				<div class="col-md-12 col-sm-12 col-lg-12">
					<?php 
					$current_location = $this->session->userdata('location');
					
					$area_list = $this->common_model->get_areas();
					
					$check_saved_locaion = $this->common_model->get_field_by_id('online_customer','location',array('id'=>$this->customer_id));
					?>
					<div class="text-center">
						<div class="col-md-4 col-md-offset-4">
							<?php echo form_open(base_url()); ?>
								<div class="row">
									<div class="select_location_wrap">
									<div class="select_location_row">
										<div class=" location_input select-wrp">
											<select name="location" id="" class="select_location location" data-placeholder="Choose Location" required>
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
									</div>
								</div>
							<?php echo form_close(); ?>
						</div>
					</div><!-- Contact Form Wrapper -->
					
				</div>
			</div>
		</div>
	</div>
</section><!-- choose and enjoy meal -->
		<footer>
            <div class="block top-padd80 bottom-padd80 dark-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-lg-12">
                            <div class="footer-data">
                                <div class="row">
                                    <div class="col-md-3 col-sm-6 col-lg-3">
                                        <div class="widget about_widget wow fadeIn" data-wow-delay="0.1s">
                                            <div class="logo"><h1 itemprop="headline"><a href="#" title="Home" itemprop="url"><img src="assets/images/logo.png" alt="logo.png" itemprop="image"></a></h1></div>
                                            <p itemprop="description">Food Ordering is a Premium HTML Template. Best choice for your online store. Let purchase it to enjoy now</p>
                                            <div class="social2">
                                                <a class="brd-rd50" href="#" title="Facebook" itemprop="url" target="_blank"><i class="fa fa-facebook"></i></a>
                                                <a class="brd-rd50" href="#" title="Google Plus" itemprop="url" target="_blank"><i class="fa fa-google-plus"></i></a>
                                                <a class="brd-rd50" href="#" title="Twitter" itemprop="url" target="_blank"><i class="fa fa-twitter"></i></a>
                                                <a class="brd-rd50" href="#" title="Pinterest" itemprop="url" target="_blank"><i class="fa fa-pinterest"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-lg-3">
                                        <div class="widget information_links wow fadeIn" data-wow-delay="0.2s">
                                            <h4 class="widget-title" itemprop="headline">INFORMATION</h4>
                                            <ul>
                                                <li><a href="#" title="" itemprop="url">Careers</a></li>
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
                                               <li><i class="fa fa-map-marker"></i> 123 New Design Str, ABC Building, melbourne, Australia.</li>
                                               <li><i class="fa fa-phone"></i> (0044) 8647 1234 587</li>
                                               <li><i class="fa fa-envelope"></i> <a href="#" title="" itemprop="url">hello@yourdomain.com</a></li>
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
                <p itemprop="description">&copy; 2018 <a class="red-clr" href="http://webinane.com/" title="Webinane" itemprop="url" target="_blank">WEBINANE</a>. All Rights Reserved</p>
            </div>
        </div><!-- Bottom Bar -->
		
		
		<div class="log-popup text-center">
            <div class="sign-popup-wrapper brd-rd5">
                <div class="sign-popup-inner brd-rd5">
                    <a class="log-close-btn" href="#" title="" itemprop="url"><i class="fa fa-close"></i></a>
                    <div class="sign-popup-title text-center">
                        <h4 itemprop="headline">SIGN IN</h4>
                        <!--<span>with your social network</span>-->
                    </div>
                   <!-- <div class="popup-social text-center">
                        <a class="facebook brd-rd3" href="#" title="Facebook" itemprop="url" target="_blank"><i class="fa fa-facebook"></i> Facebook</a>
                        <a class="google brd-rd3" href="#" title="Google Plus" itemprop="url" target="_blank"><i class="fa fa-google-plus"></i> Google</a>
                        <a class="twitter brd-rd3" href="#" title="Twitter" itemprop="url" target="_blank"><i class="fa fa-twitter"></i> Twitter</a>
                    </div>
                    <span class="popup-seprator text-center"><i class="brd-rd50">or</i></span>-->
                    <?php echo form_open('',array('id'=>'login','class'=>'sign-form login')); ?>
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
                                <a class="sign-btn" href="#" title="" itemprop="url">Not a member? Sign up</a>
                                <a class="recover-btn" href="#" title="" itemprop="url">Recover my password</a>
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
					<?php echo form_open('',array('id'=>'verify_otp_form','class'=>'sign-form verify_otp')); ?>
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
							
							<div class="col-md-12 col-sm-12 col-lg-12" id="one_time_password" style="display:none;">
								<input class="brd-rd3" type="text" name="otp" id="otp" placeholder="One time password">
								<span class="error otp_error" style="display:none;">OTP is required</span>
							</div>
                            <div class="col-md-12 col-sm-12 col-lg-12" id="send_otp_div">
                                <button class="red-bg brd-rd3" id="send_otp">Request OTP</button>
                            </div>
							<div class="col-md-12 col-sm-12 col-lg-12" id="verify_otp_div" style="display:none;">
                                <button class="red-bg brd-rd3" type="submit" id="verify_otp">Verify OTP</button>
                            </div>
							<div class="col-md-12 col-sm-12 col-lg-12" id="register_now" style="display:none">
                                <button class="red-bg brd-rd3" type="submit" id="register">REGISTER NOW</button>
                            </div>
                            <div class="col-md-12 col-sm-12 col-lg-12">
                                <a class="sign-btn" href="#" title="" itemprop="url">Already Registered? Sign in</a>
                                <a class="recover-btn" href="#" title="" itemprop="url">Recover my password</a>
                            </div>
                        </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
	</main>
	
	<script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>
	<script src="<?php echo base_url('assets/js/bootstrap.min.js')?>"></script>
	<script src="<?php echo base_url('assets/js/plugins.js')?>"></script>
	<script src="<?php echo base_url('assets/js/main.js')?>"></script>

<script type="text/javascript">
$(document).ready(function() {
	$('#send_otp').click(function () {
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
			data: {'phone':phone,'name':name,'email':email,'password':password,'otp':otp},
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
			data: {'username':username,'password':password},
			success: function (response) {
				var response1 = JSON.parse(response);
				
				if(response1.success==1){
					var link = "<?php echo base_url();?>";
					window.location = link;	
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
});
</script>
</body>
</html>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD9UPC1UTFH7mwjIxCbF_rYFa4igU9u0xA&libraries=places"></script>

<script src="<?php echo base_url('assets/js/custommap.js');?>"></script>

<div id="overlay-sidebar-root">
<div>
<div>
<div class="cmn-zamy-sdbr">
	<div class="position-relative">
		<div class="cmn-sgy-div">
			<div class="zamy-srch">
				<div class="zamy-clse" onclick="close_map_address();">
					<span class="SSFcO fa fa-close"></span>
					<!-- <div class="_2Joay"></div> -->
				</div>
				<div class="zamy-src-inpt">
					<input class="form-control" type="text" id="searchInput" type="text"  name="" placeholder="Search for area, street name.." value="">
					
					<ul id="geoData">
						<li>Full Address: <span id="location"></span></li>
						<li>Area: <span id="searched_area"></span></li>
						<li>Postal Code: <span id="postal_code"></span></li>
						<li>Country: <span id="country"></span></li>
						<li>Latitude: <span id="lat"></span></li>
						<li>Longitude: <span id="lon"></span></li>
					</ul>
				</div>
			</div>
			<div id="map_wrap" style="padding-left: 75px; padding-right: 40px;display:none;">
			<div class="map_div">
				<div id="map"></div>
			</div>
			<div>
				<div class="_3Um38 _9Wk87">
					<input class="_381fS" id="search_address" disabled="" type="text" name="" value="Unnamed Road, Makarba, Ahmedabad, Gujarat 380051, India">
						<div class="_2EeI1 _26LFr"></div>
						<label class="_1Cvlf _2tL9P">Address</label>
					</div>
				</div>
				<a class="achr-btn" id="add_more_details_btn" onclick="add_more_details();">
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
							<div class="_3RRl6" onclick="map_address_type('cancel');">Cancel</div>
						</div>
					</div>
				</div>
				
				
				<a class="_2YQkO bg-theme mb20 skip-later map-red-btn" onclick="skip_map_address();">
					<div class="">SKIP &amp; ADD LATER</div>
				</a>
			</div>
			<div class="zmy-src-lctn">
				<div>
					<div class=" cmn-box-dsgn">
						<div class="location-gtbx">
							<div class="get-cmn-box" onclick="getLocation();">
								<div class="fa fa-crosshairs crosshairs"></div>
								<div class="get-cmn-box">
									<div class="lctn-txt-ttl">Get current location</div>
									<div class="using-gps">Using GPS</div>
								</div>
							</div>
						</div>
					</div>
					<div></div>
					<div class="cmn-box-dsgn">
						<div class="save-address">SAVED ADDRESSES</div>
						<div class="rct-adrs">
							<?php 
							if(!empty($address_book)){
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
								<div class="svd-adrs">
									<div class="<?php echo $address_class;?>"></div>
									<div class="address-wrap">
										<div class="adrs-txt"><?php echo $address_type;?></div>
										<div class="address-desc"><?php echo $address;?></div>
									</div>
								</div>
							</div>
							
							<?php 
							}
							}
							?>
							
						</div>
					</div>
					<div class="undefined  cmn-box-dsgn">
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
			</div>
		</div>
	</div>
</div>
</div>

<style>
#map {
    width: 100%;
    height: 250px;
}

.cmn-zamy-sdbr {
    z-index: 999; 
}
</style>

<script>
function show_map_sidebar(){
	$("#overlay-sidebar-root").show();
}
function add_more_details(){
	$("#add_more_details").show();
}
function skip_map_address(){
	$("#overlay-sidebar-root").hide();
}
function close_map_address(){
	$("#overlay-sidebar-root").hide();
}
</script>