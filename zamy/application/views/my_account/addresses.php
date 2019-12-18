<div class="" id="account-settings">
<div class="tabs-wrp account-settings brd-rd5">
	<h4 itemprop="headline">Manage Addresses</h4>
	<a class="red-bg brd-rd4 add_new_address pull-right yellow-bg" href="<?php echo base_url('my_account/addresses/add')?>" title="Register" itemprop="url">
	Add New Address</a>
	
	<div class="account-settings-inner">
		<div class="row">
			
			<div class="col-md-12 col-sm-12 col-lg-12">
				<div class="address-book-form-wrap">
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
						<div class="col-md-6">
							<div class="address-book-box wow fadeInUp">
								<div class="address-book-info">
									<h4 itemprop="headline"><i class="<?php echo $address_class;?>"></i> <?php echo $address_type;?></h4>
									<div class="address"><?php echo $address;?></div>
								</div>
								<div class="edit-address-liks">
									<a class="brd-rd3" href="<?php echo base_url('my_account/addresses/edit/'.$data['id']);?>" title="" itemprop="url">Edit</a>
									<a class="brd-rd3" href="<?php echo base_url('my_account/addresses/del_address/'.$data['id']);?>" title="" itemprop="url">Delete</a>
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
</div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
<script src="<?php echo base_url('assets/js/google-map-int3.js')?>"></script>