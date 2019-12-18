<?php defined('BASEPATH') OR exit('No direct script access allowed');

function get_cart_count($user_id=null){
	$CI =& get_instance();
	
	$total_items = 0;
	if(!empty($user_id)){
		$old_cart_data['conditions'] 	= array('user_id'=>$user_id);
		$old_cart_data['fields'] 		= 'persistent_cart';
		
		$check_existing_cart 			= $CI->common_model->getRows('cart',$old_cart_data);
		

		$cart_table_data = array();
		if(!empty($check_existing_cart[0])){
			$cart_table_data = unserialize($check_existing_cart[0]['persistent_cart']);
		}
		
		$total_items = count($cart_table_data);
	}else{
		
		$cart = new Cart;
		
		if($cart->total_items() > 0){
			$total_items = $cart->total_items();
		}
	} 
	
	return $total_items;
}