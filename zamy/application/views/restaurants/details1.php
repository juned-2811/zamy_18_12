<?php 

								if(!empty($all_items)){
								foreach($all_items as $item){
								
								$category_id = $item['cat_id'];
								$cat_name 	= get_field('food_category','cat_name',array('cat_id'=>$category_id));
							?>
								
									<div class="dishes-list-wrapper">
									<div id="menu_cat_<?php echo $category_id;?>" data-cat_id="<?php echo $category_id;?>" class="category_div">
										<h4 class="title3" itemprop="headline"><span class="sudo-bottom sudo-bg-red"><?php echo $cat_name;?></span></h4>
									
										<ul class="dishes-list">
										<?php 
											if(!empty($item['menu_items'])){
											$i=1;
											foreach($item['menu_items'] as $menu){
											
											$menu_id 		= $menu['foodmenu_id'];
											
											if(!empty($menu['product_variation'])){
												
											
											$variation_price = array_column($menu['product_variation'], 'variation_price');
											$variation_sale_price = array_column($menu['product_variation'], 'variation_sale_price');
											
											
											$min_price 			= min($variation_price);
											$min_reduced_price 	= min($variation_sale_price);
											
											$max_price 			= max($variation_price);
											$max_reduced_price 	= max($variation_sale_price);
											
											$vminprice = (!empty($min_reduced_price) && $min_reduced_price != '0.00' && $min_reduced_price < $min_price )? $min_reduced_price : $min_price;
											
											if(!empty($min_reduced_price) && $min_reduced_price != '0.00' && ($min_reduced_price < $min_price)){
												
												$vminprice = $min_reduced_price;
												$vmaxprice = $max_reduced_price;
												
											}else{
												$vminprice = $min_price;
												$vmaxprice = $max_price;
											}
											
											}
										?>
  
											<li id="cat_item_" class="wow fadeInUp cat_item pure_veg_<?php echo $menu['food_type'];?>" data-wow-delay="0.<?php echo $i;?>s">
												<div class="featured-restaurant-box">
													<div class="featured-restaurant-thumb">
														<a href="#" title="" itemprop="url"><img src="<?php echo $menu['menu_logo'] ; ?> " alt="<?php echo $menu['menu_logo'] ?>" itemprop="image"></a>
													</div>
													<div class="featured-restaurant-info">
														<h4 itemprop="headline" class="item_name"><?php echo $menu['menu_name']?></h4>
										<?php 
										$food_id = $menu['foodmenu_id'];
                                     	$CI =& get_instance();
				                        $rating_count = get_rating_for_food($food_id);
				                        $total_avg = $rating_count['ratings_sum']/5;
				                        $stock_status 	= get_field('foodmenu','stock_status',array('foodmenu_id'=>$food_id));

										?>	
										<input type="hidden" name="food_id_get" id="food_id_get" value="<?php echo $food_id;  ?>">			
														
														<p itemprop="description"><?php echo $menu['long_description']?></p>
														<ul class="post-meta">
															<li><i class="flaticon-transport" data-toggle="tooltip" title="Dellivery Time"></i> <?php echo $menu['minimum_preparation_time'] ?></li>
															<li><span class="post-rate yellow-bg brd-rd2"><i class="fa fa-star yellow-clr" data-toggle="tooltip" title="Rating"></i><?php echo $total_avg; ?></span></li>
															<li>
																<a href="JavaScript:Void(0)" type="button" title="Favourit Food" id="add_this_food_to_fav_<?php echo $food_id; ?>" onclick="food_favourite(<?php echo $food_id; ?>);"><i class="fa fa-heart-o" id="hh_heart"></i></a>
															</li>
														</ul>
													</div>
													<div class="ord-btn">
														<div>
                       <?php 
					          
					         if($stock_status == 3) {
						?>
						<button id="not_avilable" title="stock is not avilable" class="btn btn-info not_avilable">Not Available</button>			
						<?php 
						    }
						    else{

						?>	
														<?php if(!empty($menu['product_variation'])){ ?>
														<span class="price">

															<?php
															echo '<i class="fa fa-inr"> '.$vminprice.'</i> - <i class="fa fa-inr"> '.$vmaxprice.'</i>';
															?>
															</span>
														<?php }else{ ?>
															<span class="price">
															<i class="fa fa-inr"><?php echo $menu['price']?></i>
															</span>
														<?php } ?>
														</div> 
														<?php if(!empty($menu['product_variation'])){ ?>
															<button id="addtocart_<?php echo $restaurant_id.$menu_id;?>" class="brd-rd2 variation" title="Order Now" itemprop="url" data-cart-control="load-item" data-menu-id="<?php echo $menu_id ?>" data-quantity="1"  onclick="select_menu_popup(<?php echo $restaurant_id?>,<?php echo $menu_id;?>,0)">CUSTOMIZE</button>
														<?php }else{ ?>
															<button id="addtocart_<?php echo $restaurant_id.$menu_id;?>" class="brd-rd2 btn-cart" title="Order Now" itemprop="url" data-cart-control="add-item" data-menu-id="<?php echo $menu_id ?>" data-quantity="1" onclick="select_menu(<?php echo $restaurant_id?>,<?php echo $menu_id ?>,0)">Order Now</button>
														<?php } ?>
														<p class="addedtocart_<?php echo $restaurant_id.$menu_id;?>" style="display:none;">Added to cart</p>
                                        <?php }  ?>


													</div>
												</div>
											</li>
											<?php
											$i++;
												}
											}
											?>
										</ul>
									</div>
								</div>
							<?php 
								} 
								}
							?>
<script type="text/javascript">
function food_favourite(foodmenu_id){
	var restaurant_id = $("#restaurant_id").val();
		jQuery.LoadingOverlay("show");
 	
	$.ajax({
		url: '<?php echo base_url("Restaurants/fav_food");?>',
		type: 'post',
		data: {'foodmenu_id':foodmenu_id,'restaurant_id':restaurant_id},
		dataType: 'html',
		success: function (data) {
			console.log(data);
			
			$("#hh_heart").removeClass('fa-heart-o');
			$("#hh_heart").addClass('fa-heart');
			$("#hh_heart").css("color", "red");
            jQuery.LoadingOverlay("hide");
		},
		error: function () {
			alert("error"); 
		}
	});
}
$(document).ready(function() {
	var restaurant_id = $("#restaurant_id").val();
	var foodmenu_id = $("#food_id_get").val();
   	$.ajax({
		url: '<?php echo base_url("Restaurants/chek_food_fav_status");?>',
		type: 'post',
		data: {'foodmenu_id':foodmenu_id,'restaurant_id':restaurant_id},
		success: function (data) {
			if (data == 1) {
			$("#hh_heart").removeClass('fa-heart-o');
			$("#hh_heart").addClass('fa-heart');
			$("#hh_heart").css("color", "red");
		    }
		},
		error: function () {
			alert("error");
		}
	});	 
});
$(".cat_item_count_filter").hide();

$("#veg_only").click(function(){
    if($(this).prop("checked") == true){
        var restaurant_id = $("#restaurant_id").val();
        $.ajax({
          url : '<?php echo base_url("Restaurants/get_food_menu_for_filter_count");?>',
          data : {restaurant_id,restaurant_id},
          type : 'POST',
          success : function(data){
          	 
           var obj = JSON.parse(data);
           var menu_list  = obj;
			var yourArray = new Array;
			var foodcountArray = new Array;
           for (var i = 0; i < menu_list.length; i++) {
           	//alert(menu_list[i]['food_category_id']);
            var cat_id = menu_list[i]['food_category_id'];
            yourArray.push(cat_id);
           	var foodcount   = menu_list[i]['total_category_count'];
            foodcountArray.push(foodcount);
            //$("#cat_item_count_"+cat_id+"").addClass("hidden");       
            //$("#cat_item_count_filter_"+cat_id+"").addClass("hidden");
            //$("#counter_cat_val_"+cat_id+"").text(foodcount);
            //$("#counter_cat_val_"+cat_id+"").removeClass("hidden");
           	$("#counter_cat_val_"+cat_id+"").text(foodcount);

            
           	


           }
			$(".cat_calss").each(function(){
                  var id  = $(this).attr('counter_li');
 
                
                if(jQuery.inArray(id, yourArray) == -1){
                	 $("#cat_item_count_"+id+"").addClass("hidden");	
            		$("#counter_cat_val_"+id+"").text(0);
            	}
            	
               
            });
           
            $(".cat_item_count").addClass("hidden");
    	    $(".veg_display").removeClass("hidden");  
          },
          error : function(){
          	alert("ERROR");
          }
        });
    }
    else if($(this).prop("checked") == false){
    	$(".cat_item_count").removeClass("hidden");
    	$(".veg_display").addClass("hidden");
 
    }

});
$(".not_avilable").click(function(){
alert('Product is Not Available right now');
});
</script>