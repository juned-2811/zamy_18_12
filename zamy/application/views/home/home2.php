
<section>
	<div class="block">
		<div   class="fixed-bg"></div>
		<div class="restaurant-searching style2  text-center">
			<div class="restaurant-searching-inner">

				<h2 itemprop="headline"><?php echo !empty($info['title']) ? $info['title'] : ''; ?></h2>
				<form class="restaurant-search-form2 brd-rd30">
					<input class="brd-rd30" type="text" placeholder="RESTAURANT OR DISH NAME">
					<button class="brd-rd30 red-bg" type="submit">SEARCH</button>
				</form>
				<div class="funfacts">
						<div class="col-md-3 col-sm-6 col-lg-3">
							<div class="fact-box">
								<i class="brd-rd50"><img src="<?php echo base_url('pos.zamy.in/uploads/SiteConfig/'.$info['counter_img_1']); ?>" alt="fact-icon1" itemprop="image"></i>
								<div class="fact-inner">
									<strong><span class="counter"><?php echo !empty($info['counter_value_1']) ? $info['counter_value_1'] : ''; ?></span></strong>
									<h5><?php echo !empty($info['counter_title_1']) ? $info['counter_title_1'] : ''; ?></h5>
								</div>
							</div><!-- Fact Box -->
						</div>
						<div class="col-md-3 col-sm-6 col-lg-3">
							<div class="fact-box">
								<i class="brd-rd50"><img src="<?php echo base_url('pos.zamy.in/uploads/SiteConfig/'.$info['counter_img_2']); ?>" itemprop="image"></i>
								<div class="fact-inner">
									<strong><span class="counter"><?php echo !empty($info['counter_value_2']) ? $info['counter_value_2'] : ''; ?></span></strong>
									<h5><?php echo !empty($info['counter_title_2']) ? $info['counter_title_2'] : ''; ?></h5>
								</div>
							</div><!-- Fact Box -->
						</div>
						<div class="col-md-3 col-sm-6 col-lg-3">
							<div class="fact-box">
								<i class="brd-rd50"><img src="<?php echo base_url('pos.zamy.in/uploads/SiteConfig/'.$info['counter_img_3']); ?>" itemprop="image"></i>
								<div class="fact-inner">
									<strong><span class="counter"><?php echo !empty($info['counter_value_3']) ? $info['counter_value_3'] : ''; ?></span><span>k</span></strong>
									<h5><?php echo !empty($info['counter_title_3']) ? $info['counter_title_3'] : ''; ?></h5>
								</div>
							</div><!-- Fact Box -->
						</div>
						<div class="col-md-3 col-sm-6 col-lg-3">
							<div class="fact-box">
								<i class="brd-rd50"><img src="assets/images/resource/fact-icon4.png" alt="fact-icon4" itemprop="image"></i>
								<div class="fact-inner">
									<strong><span class="counter"><?php echo !empty($info['counter_value_4']) ? $info['counter_value_4'] : ''; ?></span></strong>
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
								if(!empty($all_restaurants)){
									foreach($all_restaurants as $resto){
										 
										echo '<li class="wow bounceIn" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: bounceIn;"><div class="top-restaurant"><a class="brd-rd50" href="#" title="Restaurant 1" itemprop="url"><img src="'. $this->config->item('restaurant_image_url').$resto['images'].'" alt="'.$resto['images'].'" itemprop="image"></a></div></li>';
									}
								} 
							?>  
						</ul>
					</div>
				</div> 
			</div>
		</div>
	</div>
</section><!-- top resturents -->

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
						// foodMenu_image_url
						?>
							<div class="col-md-4 col-sm-6 col-lg-4">
								<div class="popular-dish-box wow fadeIn" data-wow-delay="0.2s">
									<div class="popular-dish-thumb">
										<a href="food-detail.html" title="" itemprop="url"><img src="assets/images/resource/popular-dish-img1.jpg" alt="popular-dish-img1.jpg" itemprop="image"></a>
										<span class="post-rate yellow-bg brd-rd2"><i class="fa fa-star yellow-clr"></i> 4.25</span>
										<span class="post-likes brd-rd4"><i class="fa fa-heart-o"></i> 12</span>
									</div>
									<div class="popular-dish-info">
										<h4 itemprop="headline"><a href="food-detail.html" title="" itemprop="url">Chill Spicy Food</a></h4>
										<p itemprop="description">Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
										<span class="price">$85.00</span>
										<a class="brd-rd2" href="food-detail.html" title="Order Now" itemprop="url">Order Now</a>
										<div class="restaurant-info">
											<img src="assets/images/resource/restaurant-logo1.png" alt="restaurant-logo1.png" itemprop="image">
											<div class="restaurant-info-inner">
												<h6 itemprop="headline"><a href="restaurant-detail.html" title="" itemprop="url">Fabio al Porto Ristorante</a></h6>
												<span class="red-clr">5th Avenue New York 68</span>
											</div>
										</div>
									</div>
								</div><!-- Popular Dish Box -->
							</div>
							<div class="col-md-4 col-sm-6 col-lg-4">
								<div class="popular-dish-box wow fadeIn" data-wow-delay="0.4s">
									<div class="popular-dish-thumb">
										<a href="food-detail.html" title="" itemprop="url"><img src="assets/images/resource/popular-dish-img2.jpg" alt="popular-dish-img2.jpg" itemprop="image"></a>
										<span class="post-rate yellow-bg brd-rd2"><i class="fa fa-star yellow-clr"></i> 3.25</span>
										<span class="post-likes brd-rd4"><i class="fa fa-heart-o"></i> 10</span>
									</div>
									<div class="popular-dish-info">
										<h4 itemprop="headline"><a href="food-detail.html" title="" itemprop="url">Crab With Curry Sources</a></h4>
										<p itemprop="description">Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
										<span class="price">$70.00</span>
										<a class="brd-rd2" href="food-detail.html" title="Order Now" itemprop="url">Order Now</a>
										<div class="restaurant-info">
											<img src="assets/images/resource/restaurant-logo2.png" alt="restaurant-logo2.png" itemprop="image">
											<div class="restaurant-info-inner">
												<h6 itemprop="headline"><a href="restaurant-detail.html" title="" itemprop="url">Fabio al Porto Ristorante</a></h6>
												<span class="red-clr">5th Avenue New York 68</span>
											</div>
										</div>
									</div>
								</div><!-- Popular Dish Box -->
							</div>
							<div class="col-md-4 col-sm-6 col-lg-4">
								<div class="popular-dish-box wow fadeIn" data-wow-delay="0.6s">
									<div class="popular-dish-thumb">
										<a href="food-detail.html" title="" itemprop="url"><img src="assets/images/resource/popular-dish-img3.jpg" alt="popular-dish-img3.jpg" itemprop="image"></a>
										<span class="post-rate yellow-bg brd-rd2"><i class="fa fa-star yellow-clr"></i> 5.00</span>
										<span class="post-likes brd-rd4"><i class="fa fa-heart-o"></i> 15</span>
									</div>
									<div class="popular-dish-info">
										<h4 itemprop="headline"><a href="food-detail.html" title="" itemprop="url">Salted Fried Chicken $20</a></h4>
										<p itemprop="description">Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
										<span class="price">$99.00</span>
										<a class="brd-rd2" href="food-detail.html" title="Order Now" itemprop="url">Order Now</a>
										<div class="restaurant-info">
											<img src="assets/images/resource/restaurant-logo3.png" alt="restaurant-logo3.png" itemprop="image">
											<div class="restaurant-info-inner">
												<h6 itemprop="headline"><a href="restaurant-detail.html" title="" itemprop="url">Fabio al Porto Ristorante</a></h6>
												<span class="red-clr">5th Avenue New York 68</span>
											</div>
										</div>
									</div>
								</div><!-- Popular Dish Box -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section><!-- choose and enjoy meal -->

<section>
	<div class="block gray-bg">
		<div class="top-mockup"><img src="<?php echo base_url('pos.zamy.in/uploads/SiteConfig/'.$info['populer_top_left']); ?>" alt=""></div>
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
					<div class="filters-wrapper">
						<div class="title1-wrapper">
							<i><img alt="" src="<?php echo base_url('pos.zamy.in/uploads/SiteConfig/'.$info['popular_logo']); ?>"></i>
							<div class="title1-inner">
								<span><?php echo !empty($info['popular_sub_title']) ? $info['popular_sub_title'] : ''; ?></span>
								<h2 itemprop="headline"><?php echo !empty($info['popular_title']) ? $info['popular_title'] : ''; ?></h2>
								<b><?php echo !empty($info['bottom_sub_title']) ? $info['bottom_sub_title'] : ''; ?></b>
							</div>
						</div>
						<div class="rite-meta">
						<a href="#" title="" class="view-more">view more food</a>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-xs-12">
					<div class="dishes-caro">
						<div class="dish-item">
							<figure><img src="assets/images/resource/dish-caro1.jpg" alt=""></figure>
							<div class="item-meta">
								<img src="assets/images/resource/restaurant-logo1.png" alt="">
								<div>
									<span>Fabio Al Porto Ristorante</span>
									<p>68 5th Avenue New York </p>
								</div>
							</div>
							<div class="caro-dish-name">
								<h4>Korean Bibimbap Yamyam</h4>
								<span>$10.00–$30.00</span>
							</div>
						</div>
						<div class="dish-item">
							<figure><img src="assets/images/resource/dish-caro1.jpg" alt=""></figure>
							<div class="item-meta">
								<img src="assets/images/resource/restaurant-logo1.png" alt="">
								<div>
									<span>Fabio Al Porto Ristorante</span>
									<p>68 5th Avenue New York </p>
								</div>
							</div>
							<div class="caro-dish-name">
								<h4>Korean Bibimbap Yamyam</h4>
								<span>$10.00–$30.00</span>
							</div>
						</div>
						<div class="dish-item">
							<figure><img src="assets/images/resource/dish-caro1.jpg" alt=""></figure>
							<div class="item-meta">
								<img src="assets/images/resource/restaurant-logo1.png" alt="">
								<div>
									<span>Fabio Al Porto Ristorante</span>
									<p>68 5th Avenue New York </p>
								</div>
							</div>
							<div class="caro-dish-name">
								<h4>Korean Bibimbap Yamyam</h4>
								<span>$10.00–$30.00</span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-8 col-xs-12">
					<div class="popular-of-month">
						<div class="pop-dish wow fadeIn" data-wow-delay="0.1s">
							<div class="poplr-dish">
								<img src="assets/images/resource/round-pic1.jpg" alt="">
								<div class="dish-meta">
									<span>$10.00–$30.00</span>
									<h4><a href="#" title="">Tequila & Lime hake</a></h4>
								</div>
							</div>
							<div class="item-meta">
								<img alt="" src="assets/images/resource/restaurant-logo1.png">
								<div>
									<span>Fabio Al Porto Ristorante</span>
									<p>68 5th Avenue New York </p>
								</div>
							</div>
						</div>
						<div class="pop-dish wow fadeIn" data-wow-delay="0.2s">
							<div class="poplr-dish">
								<img src="assets/images/resource/round-pic2.jpg" alt="">
								<div class="dish-meta">
									<span>$10.00–$30.00</span>
									<h4><a href="#" title="">Maximus nibh facilisis</a></h4>
								</div>
							</div>
							<div class="item-meta">
								<img alt="" src="assets/images/resource/restaurant-logo1.png">
								<div>
									<span>Fabio Al Porto Ristorante</span>
									<p>68 5th Avenue New York </p>
								</div>
							</div>
						</div>
						<div class="pop-dish wow fadeIn" data-wow-delay="0.3s">
							<div class="poplr-dish">
								<img src="assets/images/resource/round-pic3.jpg" alt="">
								<div class="dish-meta">
									<span>$10.00–$30.00</span>
									<h4><a href="#" title="">Hendrerit nisi venenatis</a></h4>
								</div>
							</div>
							<div class="item-meta">
								<img alt="" src="assets/images/resource/restaurant-logo1.png">
								<div>
									<span>Dream Food By Opaq</span>
									<p>68 5th Avenue New York </p>
								</div>
							</div>
						</div>
						<div class="pop-dish">
							<div class="poplr-dish wow fadeIn" data-wow-delay="0.4s">
								<img src="assets/images/resource/round-pic4.jpg" alt="">
								<div class="dish-meta">
									<span>$10.00–$30.00</span>
									<h4><a href="#" title="">Grilled Shrimp Scampi</a></h4>
								</div>
							</div>
							<div class="item-meta">
								<img alt="" src="assets/images/resource/restaurant-logo1.png">
								<div>
									<span>Fabio Al Porto Ristorante</span>
									<p>68 5th Avenue New York </p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="bottom-mockup"><img src="<?php echo base_url('pos.zamy.in/uploads/SiteConfig/'.$info['populer_bottom_right_img']); ?>" alt=""></div>
	</div>
</section>

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
										<h4 itemprop="headline">Explore Restaurants</h4>
										<p itemprop="description">Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
									</div>
								</div><!-- Step Box -->
							</div>
							<div class="col-md-4 col-sm-4 col-lg-4">
								<div class="step-box wow fadeInUp" data-wow-delay="0.4s">
									<i><img src="assets/images/resource/setp-img2.png" alt="setp-img2.png" itemprop="image"> <span class="brd-rd50 red-bg">2</span></i>
									<div class="setp-box-inner">
										<h4 itemprop="headline">Choose a Tasty Dish</h4>
										<p itemprop="description">Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
									</div>
								</div><!-- Step Box -->
							</div>
							<div class="col-md-4 col-sm-4 col-lg-4">
								<div class="step-box wow fadeInUp" data-wow-delay="0.6s">
									<i><img src="assets/images/resource/setp-img3.png" alt="setp-img3.png" itemprop="image"> <span class="brd-rd50 red-bg">3</span></i>
									<div class="setp-box-inner">
										<h4 itemprop="headline">Follow The Status</h4>
										<p itemprop="description">Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
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
									<div class="featured-restaurant-box wow fadeInUp" data-wow-delay="0.1s">
										<div class="featured-restaurant-thumb">
											<a href="food-detail.html" title="" itemprop="url"><img class="brd-rd2" src="assets/images/resource/featured-restaurant-img1.jpg" alt="featured-restaurant-img1.jpg" itemprop="image"></a>
										</div>
										<div class="featured-restaurant-info">
											<span class="red-clr">5th Avenue New York 68</span>
											<h4 itemprop="headline"><a href="food-detail.html" title="" itemprop="url">Tuna Roast Source</a></h4>
											<span class="price">$85.00</span>
											<p itemprop="description">Lorem Ipsum is simply dummy text of the printing industry</p>
											<ul class="post-meta">
												<li><i class="fa fa-check-circle-o"></i> Min order $50</li>
												<li><i class="flaticon-transport"></i> 30min</li>
											</ul>
											<span class="post-rate yellow-bg brd-rd2"><i class="fa fa-star yellow-clr"></i> 4.25</span>
										</div>
									</div>
									<div class="featured-restaurant-box wow fadeInUp" data-wow-delay="0.2s">
										<div class="featured-restaurant-thumb">
											<a href="food-detail.html" title="" itemprop="url"><img class="brd-rd2" src="assets/images/resource/featured-restaurant-img2.jpg" alt="featured-restaurant-img2.jpg" itemprop="image"></a>
										</div>
										<div class="featured-restaurant-info">
											<span class="red-clr">5th Avenue New York 68</span>
											<h4 itemprop="headline"><a href="food-detail.html" title="" itemprop="url">Crab With Curry Sources</a></h4>
											<span class="price">$70.00</span>
											<p itemprop="description">Lorem Ipsum is simply dummy text of the printing industry</p>
											<ul class="post-meta">
												<li><i class="fa fa-check-circle-o"></i> Min order $40</li>
												<li><i class="flaticon-transport"></i> 20min</li>
											</ul>
											<span class="post-rate yellow-bg brd-rd2"><i class="fa fa-star yellow-clr"></i> 4.03</span>
										</div>
									</div>
									<div class="featured-restaurant-box wow fadeInUp" data-wow-delay="0.3s">
										<div class="featured-restaurant-thumb">
											<a href="food-detail.html" title="" itemprop="url"><img class="brd-rd2" src="assets/images/resource/featured-restaurant-img3.jpg" alt="featured-restaurant-img3.jpg" itemprop="image"></a>
										</div>
										<div class="featured-restaurant-info">
											<span class="red-clr">5th Avenue New York 68</span>
											<h4 itemprop="headline"><a href="food-detail.html" title="" itemprop="url">Imported Salmon Steak</a></h4>
											<span class="price">$90.00</span>
											<p itemprop="description">Lorem Ipsum is simply dummy text of the printing industry</p>
											<ul class="post-meta">
												<li><i class="fa fa-check-circle-o"></i> Min order $60</li>
												<li><i class="flaticon-transport"></i> 45min</li>
											</ul>
											<span class="post-rate yellow-bg brd-rd2"><i class="fa fa-star yellow-clr"></i> 5.00</span>
										</div>
									</div>
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
											<span class="red-clr">5th Avenue New York 68</span>
											<h4 itemprop="headline"><a href="food-detail.html" title="" itemprop="url">Maenaam Thai Restaurant</a></h4>
											<span class="price">$85.00</span>
											<p itemprop="description">Lorem Ipsum is simply dummy text of the printing industry</p>
											<ul class="post-meta">
												<li><i class="fa fa-check-circle-o"></i> Min order $50</li>
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

<section>
	<div class="block gray-bg">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-lg-12">
					<div class="filters-wrapper">
						<div class="title1-wrapper">
							<i><img src="assets/images/resource/icon.png" alt=""></i>
							<div class="title1-inner">
								<span><?php echo !empty($info['cyf_sub_title']) ? $info['cyf_sub_title'] : ''; ?></span>
								<h2 itemprop="headline"><?php echo !empty($info['cyf_title']) ? $info['cyf_title'] : ''; ?></h2>
							</div>
						</div>
						<ul class="filter-buttons right">
							<li class="active"><a class="brd-rd30" data-filter="*" href="#" itemprop="url">All</a></li>
							<li><a class="brd-rd30" data-filter=".filter-item1" href="#" itemprop="url">Beverages</a></li>
							<li><a class="brd-rd30" data-filter=".filter-item2" href="#" itemprop="url">Burgers</a></li>
							<li><a class="brd-rd30" data-filter=".filter-item3" href="#" itemprop="url">Pasta</a></li>
						</ul><!-- Filter Buttons -->
						<div class="filters-inner">
							<div class="row">
								<div class="masonry">
									<div class="col-md-6 col-sm-6 col-lg-6 filter-item filter-item1">
										<div class="featured-restaurant-box style2 brd-rd12 wow fadeInUp" data-wow-delay="0.1s">
											<div class="featured-restaurant-thumb">
												<a href="restaurant-detail.html" title="" itemprop="url"><img src="assets/images/resource/most-popular-img1-1.png" alt="most-popular-img1-1.png" itemprop="image"></a>
											</div>
											<div class="featured-restaurant-info">
												<span class="red-clr">5th Avenue New York 68</span>
												<h4 itemprop="headline"><a href="restaurant-detail.html" title="" itemprop="url">Domino's Pizza</a></h4>
												<span class="food-types">Type of food: <a href="#" title="" itemprop="url">Apple Juice</a>, <a href="#" title="" itemprop="url">BB.Q</a>, <a href="#" title="" itemprop="url">Beef Roast</a></span>
												<ul class="post-meta">
													<li><i class="fa fa-check-circle-o"></i> Min order $50</li>
													<li><i class="flaticon-transport"></i> 30min</li>
													<li><i class="flaticon-money"></i> Accepts cash & online payments</li>
												</ul>
												<span class="post-rate yellow-bg brd-rd2"><i class="fa fa-star yellow-clr"></i> 4.25</span>
												<span class="post-likes style2 red-clr"><i class="fa fa-heart-o"></i> 12</span>
												<a class="brd-rd5" href="restaurant-detail.html" title="Order Online">Order Now</a>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-6 col-lg-6 filter-item filter-item2">
										<div class="featured-restaurant-box style2 brd-rd12 wow fadeInUp" data-wow-delay="0.2s">
											<div class="featured-restaurant-thumb">
												<a href="restaurant-detail.html" title="" itemprop="url"><img src="assets/images/resource/most-popular-img1-2.png" alt="most-popular-img1-2.png" itemprop="image"></a>
											</div>
											<div class="featured-restaurant-info">
												<span class="red-clr">5th Avenue New York 68</span>
												<h4 itemprop="headline"><a href="restaurant-detail.html" title="" itemprop="url">Burger King</a></h4>
												<span class="food-types">Type of food: <a href="#" title="" itemprop="url">Apple Juice</a>, <a href="#" title="" itemprop="url">BB.Q</a>, <a href="#" title="" itemprop="url">Beef Roast</a></span>
												<ul class="post-meta">
													<li><i class="fa fa-check-circle-o"></i> Min order $50</li>
													<li><i class="flaticon-transport"></i> 30min</li>
													<li><i class="flaticon-money"></i> Accepts cash & online payments</li>
												</ul>
												<span class="post-rate yellow-bg brd-rd2"><i class="fa fa-star yellow-clr"></i> 4.25</span>
												<span class="post-likes style2 red-clr"><i class="fa fa-heart-o"></i> 12</span>
												<a class="brd-rd5" href="restaurant-detail.html" title="Order Online">Order Now</a>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-6 col-lg-6 filter-item filter-item3">
										<div class="featured-restaurant-box style2 brd-rd12 wow fadeInUp" data-wow-delay="0.3s">
											<div class="featured-restaurant-thumb">
												<a href="restaurant-detail.html" title="" itemprop="url"><img src="assets/images/resource/most-popular-img1-3.png" alt="most-popular-img1-3.png" itemprop="image"></a>
											</div>
											<div class="featured-restaurant-info">
												<span class="red-clr">5th Avenue New York 68</span>
												<h4 itemprop="headline"><a href="restaurant-detail.html" title="" itemprop="url">Wendy's Cafe</a></h4>
												<span class="food-types">Type of food: <a href="#" title="" itemprop="url">Apple Juice</a>, <a href="#" title="" itemprop="url">BB.Q</a>, <a href="#" title="" itemprop="url">Beef Roast</a></span>
												<ul class="post-meta">
													<li><i class="fa fa-check-circle-o"></i> Min order $50</li>
													<li><i class="flaticon-transport"></i> 30min</li>
													<li><i class="flaticon-money"></i> Accepts cash & online payments</li>
												</ul>
												<span class="post-rate yellow-bg brd-rd2"><i class="fa fa-star yellow-clr"></i> 4.25</span>
												<span class="post-likes style2 red-clr"><i class="fa fa-heart-o"></i> 12</span>
												<a class="brd-rd5" href="restaurant-detail.html" title="Order Online">Order Now</a>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-6 col-lg-6 filter-item filter-item1 filter-item2 filter-item3">
										<div class="featured-restaurant-box style2 brd-rd12 wow fadeInUp" data-wow-delay="0.4s">
											<div class="featured-restaurant-thumb">
												<a href="restaurant-detail.html" title="" itemprop="url"><img src="assets/images/resource/most-popular-img1-4.png" alt="most-popular-img1-4.png" itemprop="image"></a>
											</div>
											<div class="featured-restaurant-info">
												<span class="red-clr">5th Avenue New York 68</span>
												<h4 itemprop="headline"><a href="restaurant-detail.html" title="" itemprop="url">Restaurant</a></h4>
												<span class="food-types">Type of food: <a href="#" title="" itemprop="url">Apple Juice</a>, <a href="#" title="" itemprop="url">BB.Q</a>, <a href="#" title="" itemprop="url">Beef Roast</a></span>
												<ul class="post-meta">
													<li><i class="fa fa-check-circle-o"></i> Min order $50</li>
													<li><i class="flaticon-transport"></i> 30min</li>
													<li><i class="flaticon-money"></i> Accepts cash & online payments</li>
												</ul>
												<span class="post-rate yellow-bg brd-rd2"><i class="fa fa-star yellow-clr"></i> 4.25</span>
												<span class="post-likes style2 red-clr"><i class="fa fa-heart-o"></i> 12</span>
												<a class="brd-rd5" href="restaurant-detail.html" title="Order Online">Order Now</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div><!-- Filters Wrapper -->
				</div>
			</div>
		</div>
	</div>
</section>

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
					<div class="col-md-4 col-sm-6 col-lg-4">
						<div class="article-dev wow fadeInUp" data-wow-delay="0.2s">
							<figure>
								<img src="assets/images/resource/article1.jpg" alt="">
							</figure>
							<div class="article-data">
								<div class="article-info-meta">
									<span>thu</span>
									<a href="#" title="">15 dec 2018</a>
									<a href="#" title="">By webinane</a>
								</div>
								<div class="article-meta">
									<h3><a href="#" title="">
											Special Food Recipes For DpecialOccasions.
										</a>
									</h3>
									<div class="like-meta">
										<span><i class="fa fa-heart-o"></i> 12</span>
										<span><i class="fa fa-comment-o"></i> 7</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6 col-lg-4">
						<div class="article-dev wow fadeInUp" data-wow-delay="0.4s">
							<figure>
								<img src="assets/images/resource/article2.jpg" alt="">
							</figure>
							<div class="article-data">
								<div class="article-info-meta">
									<span>Mon</span>
									<a href="#" title="">25 Sep 2018</a>
									<a href="#" title="">By webinane</a>
								</div>
								<div class="article-meta">
									<h3><a href="#" title="">
											Candy Canes Wafer Sweet Roll 2
										</a>
									</h3>
									<div class="like-meta">
										<span><i class="fa fa-heart-o"></i> 12</span>
										<span><i class="fa fa-comment-o"></i> 7</span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6 col-lg-4">
						<div class="article-dev wow fadeInUp" data-wow-delay="0.6s">
							<figure>
								<img src="assets/images/resource/article3.jpg" alt="">
							</figure>
							<div class="article-data">
								<div class="article-info-meta">
									<span>Wed</span>
									<a href="#" title="">11 july 2018</a>
									<a href="#" title="">By webinane</a>
								</div>
								<div class="article-meta">
									<h3><a href="#" title="">
											Cheesecake Pastry Marshmallow
										</a>
									</h3>
									<div class="like-meta">
										<span><i class="fa fa-heart-o"></i>12</span>
										<span><i class="fa fa-comment-o"></i>7</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
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
								<div class="app-mockup text-right overlape-110 wow fadeInUp" data-wow-delay="0.2s"><img src="<?php echo base_url('pos.zamy.in/uploads/SiteConfig/'.$info['img_1']); ?>" alt="app-mockup.png" itemprop="image"></div>
							</div>
							<div class="col-md-6 col-md-offset-1 col-sm-12 col-sm-offset-0 col-lg-6 col-lg-offset-1">
								<div class="app-info">
									<h4 itemprop="headline"><?php echo !empty($info['bs_title']) ? $info['bs_title'] : ''; ?></h4>
									<p itemprop="description"><?php echo !empty($info['bs_text']) ? $info['bs_text'] : ''; ?></p>
									<div class="app-download-btns">
										<a class="wow zoomInUp" data-wow-delay="0.2s" href="#" title="Google Play Store" itemprop="url" target="_blank"><img src="<?php echo base_url('pos.zamy.in/uploads/SiteConfig/'.$info['img_2']); ?>" alt="app-download-btn1.png" itemprop="image"></a>
										<a class="wow zoomInUp" data-wow-delay="0.4s" href="#" title="Apple App Store" itemprop="url" target="_blank"><img src="<?php echo base_url('pos.zamy.in/uploads/SiteConfig/'.$info['img_3']); ?>" itemprop="image"></a>
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
