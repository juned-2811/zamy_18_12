<?php 
if(!empty($all_search_items)){
foreach($all_search_items as $item){

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
				
			$menu_id = $menu['foodmenu_id'];
		?>
			<li id="cat_item_" class="wow fadeInUp cat_item pure_veg_<?php echo $menu['food_type'];?>" data-wow-delay="0.<?php echo $i;?>s">
				<div class="featured-restaurant-box">
					<div class="featured-restaurant-thumb">
						<a href="#" title="" itemprop="url"><img src="<?php echo base_url()?>assets/images/resource/dish-img1-1.jpg" alt="dish-img1-1.jpg" itemprop="image"></a>
					</div>
					<div class="featured-restaurant-info">
						<h4 itemprop="headline" class="item_name"><?php echo $menu['menu_name']?></h4>
						<span class="price">₹ <?php echo $menu['price']?></span>
						<p itemprop="description"><?php echo $menu['long_description']?></p>
						<ul class="post-meta">
							<li><i class="flaticon-transport"></i> 30min</li>
						</ul>
					</div>
					<div class="ord-btn">
						<?php if(!empty($menu['product_variation'])){ ?>
						<a class="brd-rd2" href="#" title="Order Now" itemprop="url" data-cart-control="load-item" data-menu-id="<?php echo $menu_id ?>" data-quantity="1"  onclick="select_menu_popup(<?php echo $menu_id;?>,0)">CUSTOMIZE</a>
						<?php }else{ ?>
							<a class="brd-rd2 btn-cart" href="#" title="Order Now" itemprop="url" data-cart-control="add-item" data-menu-id="<?php echo $menu_id ?>" data-quantity="1" onclick="select_menu(<?php echo $menu_id ?>,0)">ADD</a>
						<?php } ?>
						
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

<?php } 
}
?>