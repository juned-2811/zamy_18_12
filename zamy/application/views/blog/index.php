<div style="margin-top: 65px"></div>
<section>
	<div class="block">
		<div class="fixed-bg" style="background-image: url(assets/images/topbg.jpg);"></div>
		<div class="page-title-wrapper text-center">
			<div class="col-md-12 col-sm-12 col-lg-12">
				<div class="page-title-inner">
					<h1 itemprop="headline">Blog</h1>
						<span>A Greate Restaurant Website</span>
				</div>
			</div>
		</div>
	</div>
</section>

<div class="bread-crumbs-wrapper">
	<div class="container">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#" title="" itemprop="url">Home</a></li>
			<li class="breadcrumb-item active">Blog</li>
		</ol>
	</div>
</div>

<section>
	<div class="block less-spacing gray-bg">
		<div class="sec-box">
			<div class="container">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-lg-12">
						<div class="remove-ext">
							<div class="row">

								<?php 
									if(!empty($blog_details)){
									foreach($blog_details as $data){ 
									$id                     = $data['id'];
									$title  				= $data['title'];
									$sub_title  			= $data['sub_title'];
									$image  				= $data['image'];
									$blog_alias				= $data['blog_alias'];
									$timestamp				= $data['updated'];

									$timezone = 'UTC'; 
								    $datetime = new DateTime($timestamp, new DateTimeZone($timezone));
								    $date = $datetime->format('d F');

									if(!empty($image) && file_exists( $this->config->item('blog_image_base_path').$data['image'])){
										  $image = $data['image']; 
								   }
									else{
										$res_image = base_url('assets/images/resource/most-popular-img1.png');
									}
								 
								?>
								<div class="col-md-4 col-sm-6 col-lg-4">
									<div class="news-box wow fadeIn" data-wow-delay="0.1s">
										<div class="news-thumb">
											<a class="brd-rd2" href="#" title="" itemprop="url"><img src="<?php echo $this->config->item('blog_image').$image?>" alt="news-img1.jpg" height="223" width="364" itemprop="image"></a>
											<div class="news-btns">
												<a class="post-date red-bg" href="#" title="" itemprop="url"><?php echo $date;?></a>
												<a class="read-more" href="#" itemprop="url">READ MORE</a>
											</div>
										</div>
										<div class="news-info">
											<h4 itemprop="headline"><a href="<?php echo base_url('blog/details/').$blog_alias.'/'.$id;?>" title="" itemprop="url"><?php echo $title;?></a></h4>
											<p itemprop="description"><?php echo $sub_title;?></p>
										</div>
									</div>
								</div>

							<?php }} ?>
								
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

   