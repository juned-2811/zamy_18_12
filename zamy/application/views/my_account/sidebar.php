<?php
$this->load->model('common_model');

$online_customer_details = $this->common_model->get_data_by_id(array('id'=>$this->customer_id),'online_customer')[0];
?>
<div class="profile-sidebar brd-rd5 wow fadeIn" data-wow-delay="0.2s">
	<div class="profile-sidebar-inner brd-rd5">
		<div class="user-info red-bg">
			<img class="brd-rd50" src="<?php echo base_url('uploads/customer_profiles/'.$online_customer_details['profile']); ?>" alt="user-avatar.jpg" itemprop="image">
			<div class="user-info-inner">
				<h5 itemprop="headline"><a href="#" title="" itemprop="url"><?php echo !empty($online_customer_details['name']) ? $online_customer_details['name'] : '' ?></a></h5>
				<span><a href="#" title="" itemprop="url"><?php echo !empty($online_customer_details['email']) ? $online_customer_details['email'] : '' ?></a></span>
				<a class="brd-rd3 sign-out-btn yellow-bg" href="<?php echo base_url('logout');?>" title="" itemprop="url"><i class="fa fa-sign-out"></i> SIGN OUT</a>
			</div>
		</div>
		<ul class="nav">
			<li class="<?php if($this->uri->uri_string() == 'my_account') { echo 'active'; } ?>"><a href="<?php echo base_url('my_account/Edit_profile');?>"><i class="fa fa-cog"></i> ACCOUNT SETTINGS</a></li>
			<li class="<?php if($this->uri->uri_string() == 'my_account/orders') { echo 'active'; } ?>"><a href="<?php echo base_url('my_account/orders');?>"><i class="fa fa-shopping-basket"></i> MY ORDERS</a></li>
			<li class="<?php if($this->uri->uri_string() == 'my_account/favourites') { echo 'active'; } ?>"><a href="<?php echo base_url('my_account/favorite_res');?>"><i class="fa fa-heart"></i> Favourites Restaurant</a></li>
			<li class="<?php if($this->uri->uri_string() == 'my_account/favourites') { echo 'active'; } ?>"><a href="<?php echo base_url('my_account/favorite_food');?>"><i class="fa fa-heart"></i> Favourites Food</a></li>

			<li class="<?php if($this->uri->uri_string() == 'my_account/addresses') { echo 'active'; } ?>"><a href="<?php echo base_url('my_account/addresses');?>"><i class="fa fa-wpforms"></i> Addresses</a></li>
			<li class="<?php if($this->uri->uri_string() == 'my_account/customer_support') { echo 'active'; } ?>"><a href="<?php echo base_url('my_account/customer_support');?>"><i class="fa fa-wpforms"></i> Customer Support</a></li>
		</ul>
	</div>
</div>