<div class="" id="my-orders">
<div class="tabs-wrp brd-rd5">
	<h4 itemprop="headline">MY ORDERS</h4>
	<!--<div class="select-wrap-inner">
		<div class="select-wrp2">
			<select>
				<option>Select Orders Status</option>
				<option>Select Orders Status</option>
				<option>Select Orders Status</option>
			</select>
		</div>
		<div class="select-wrp2">
			<select>
				<option>Select Date Range</option>
				<option>Select Date Range</option>
				<option>Select Date Range</option>
			</select>
		</div>
	</div>-->
	<div class="order-list">
		<?php 
		if(!empty($my_orders)){
		foreach($my_orders as $data){
		
		if(!empty($data['logo'])){
			$res_logo = "http://pos.zamy.in/uploads/kitchen/logo/".$data['logo'];
		}else{
			$res_logo = "http://pos.zamy.in/assets/logo/resource/most-popular-img1.png";
		}

			$order_status=$data['order_status'];

		?>
		<div class="order-item brd-rd5">
			<div class="order-thumb brd-rd5">
				<a href="#" title="" itemprop="url"><img src="<?php echo $res_logo; ?>" alt="" itemprop="image"></a>
				<!--<span class="post-rate yellow-bg brd-rd2"><i class="fa fa-star yellow-clr"></i> 4.25</span>-->
			</div>
			<div class="order-info">
				<span class="red-clr"><?php echo $data['area']." ".$data['landmark']?></span>
				<h4 itemprop="headline"><a href="<?php echo base_url('restaurants/'.$data['res_alias']);?>" title="" itemprop="url"><?php echo $data['restaurant_name']?></a></h4>
				<span class="price"><i class="fa fa-inr"></i>
				
				<?php 
				
				$order_total = $data['order_total'];
					
				if($order_total > 0){
					$order_total = $order_total ;
				} else{
					$order_total = 0;
				}
				//echo $order_total + $data['delivery_charge'];
				echo $order_total;
				
				?></span>
				<span class="<?php echo $order_status;?> brd-rd3"><?php echo $order_status;?></span>
				<a class="brd-rd2" href="<?php echo base_url('my_account/orders/view_order/'.$data['order_id']);?>" title="" itemprop="url">Order Detail</a>
			</div>
		</div>
		<?php } }?>
	</div>
	<!--<div class="pagination-wrapper text-center style2">
		<ul class="pagination justify-content-center">
			<li class="page-item prev"><a class="page-link brd-rd2" href="#" itemprop="url">PREV</a></li>
			<li class="page-item"><a class="page-link brd-rd2" href="#" itemprop="url">1</a></li>
			<li class="page-item"><a class="page-link brd-rd2" href="#" itemprop="url">2</a></li>
			<li class="page-item active"><span class="page-link brd-rd2">3</span></li>
			<li class="page-item"><a class="page-link brd-rd2" href="#" itemprop="url">4</a></li>
			<li class="page-item"><a class="page-link brd-rd2" href="#" itemprop="url">5</a></li>
			<li class="page-item">........</li>
			<li class="page-item"><a class="page-link brd-rd2" href="#" itemprop="url">18</a></li>
			<li class="page-item next"><a class="page-link brd-rd2" href="#" itemprop="url">NEXT</a></li>
		</ul>
	</div>--><!-- Pagination Wrapper -->
</div>
</div>