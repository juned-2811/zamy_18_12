<?php defined('BASEPATH') OR exit('No direct script access allowed');

function getcombo($tablename,$cond,$fieldlist1,$fieldlist2,$selecteditem,$comboname,$events='',$other='',$otherOption=''){
	
	$CI =& get_instance();
	$condition="";
	if(trim($cond)!=""){
		$condition=" and $cond ";
	}
	
	$row=$CI->db->query("select $fieldlist1,$fieldlist2 from `$tablename` where 1=1 $condition $other");
	
	$returnbox = "<select name='".$comboname."' id='".$comboname."' class='form-control'  ".$events." >";
	$returnbox .= "<option value=''>-Select-</option>";
	
		if($row->num_rows()>0){
		
			foreach($row->result_array() as $val){
				$returnbox .="<option value='".$val[$fieldlist1]."'";
				if($val[$fieldlist1] == $selecteditem)
				{		
					$returnbox .= " selected='selected'"; 
				} 
				$returnbox .=">".$val[$fieldlist2]."</option>";
			}
		}
		if($otherOption=='yes'){
			$returnbox .="<option value='-4'>Others</option>";
		}		
		$returnbox .= "</select>";			
	
	return $returnbox;
}
/* Ajax Load states from country id*/
function load_state_with_country_id($from, $name, $field, $type, $class, $e_match='', $condition, $c_match,$onchange= '')
{
	$CI =& get_instance();
	if ($condition=="") {
		return "<select class='form-control chosen' name='state_id'>
					<option value=''>Choose a Country First</option>
				</select>";
	}
	else {
		return $CI->common_model->select_html($from, $name, $field, $type, $class, '', $condition, $c_match, $onchange);
	}
}
/* Ajax Load City from state id*/
function load_city_with_state_id($from, $name, $field, $type, $class, $e_match='', $condition, $c_match,$onchange= '')
{
	$CI =& get_instance();
	if ($condition=="") {
		return "<select class='form-control chosen' name='city_id'>
					<option value=''>Choose a Country First</option>
				</select>";
	}
	else {
		return $CI->common_model->select_html($from, $name, $field, $type, $class, '', $condition, $c_match, $onchange);
	}
}

function get_frenchise_restaurants($user_id){
	$CI =& get_instance();
	$CI->db->select('kitchens.id,kitchens.res_name');
	$CI->db->join('kitchens', 'kitchens.frenchise_id=users.id');
	$CI->db->where_in('kitchens.id in (users.kitchen_id)');
	$CI->db->where('users.id', $user_id);
	$CI->db->where('kitchens.type', 1); // type 1 - kitchen, 2- HO
	$query = $CI->db->get('users');
	
	$restaurants = $query->result_array();
	return $restaurants;
}



function is_login(){
	$CI =& get_instance();
	$login_state = $CI->session->userdata('cust_is_login');
	if($login_state != TRUE){
		redirect(base_url());
	}
}

function get_field_by_id($table,$field,$where){
	
	$CI =& get_instance();
	$CI->db->select($field);
	$CI->db->where($where);
	$query = $CI->db->get($table);
	$result = $query->row_array()[$field];
	return $result;
}
//find string between 2 latters
function get_string_between($string, $start, $end){
	$CI =& get_instance();
	
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}
function query_sms_table( $table, $where ) {
	$CI =& get_instance();
	$CI->db->where($where);
	$CI->db->limit(1);
	$query = $CI->db->get($table);
	$result = $query->row();
	return $result;
}

function replace_sms_table( $table_name, $data, $where) {
	$CI =& get_instance();
	$CI->db->where($where);
	$CI->db->limit(1);
	$check_exist = $CI->db->get($table_name);
	if ($check_exist->num_rows() > 0){
		
		$CI->db->where($where);
		$CI->db->update($table_name,$data);
		
	}else{
		$CI->db->insert($table_name, $data);
	}
}
function delete_sms_table( $table_name, $where ) {
	$CI =& get_instance();
	$CI->db->where($where);
	$CI->db->delete($table_name);
}

function get_gst($restaurant_id,$sum=null){
	$CI =& get_instance();
	
	if(!empty($sum) && $sum=='total_tax'){
		$CI->db->select('GROUP_CONCAT(title) as title,sum(amount) as total_tax');
	}else{
		$CI->db->select('title,amount');
	}
	
	$CI->db->where('restaurant_id',$restaurant_id);
	$query = $CI->db->get('tax');
	if(!empty($sum) && $sum=='total_tax'){
		$result = $query->row_array();
	}else{
		$result = $query->result_array();
	}
	
	return $result;
}

function get_field($table,$field,$where){
	$CI =& get_instance();
	
	$CI->db->select($field);
	$CI->db->where($where);
	$query = $CI->db->get($table);
	$result = $query->row_array()[$field];
	return $result;
}

function admin_commission($restaurant_id){
	$CI =& get_instance();
	$CI->db->select('users.admin_commission as admin_commission');
	$CI->db->join('kitchens', 'kitchens.frenchise_id=users.id');
	$CI->db->where('kitchens.id',$restaurant_id);
	$query = $CI->db->get('users');
	$result = $query->row_array()['admin_commission'];
	return $result;
	
}

function get_delivery_boy_latlong($order_id){
	
	$CI =& get_instance();
	$CI->db->select('delivery_boy.full_name as delivery_boy_name,delivery_boy.profile_pic as delivery_boy_profile_pic,delivery_boy.phone as delivery_boy_phone,delivery_boy.latitude as delivery_boy_latitude,delivery_boy.longitude as delivery_boy_longitude,delivery_boy.angle as delivery_boy_angle,
	assign_delivery_boy.shipping_lat as customer_latitude,assign_delivery_boy.shipping_lng as customer_longitude,assign_delivery_boy.shipping_address as customer_address,assign_delivery_boy.job_accepted_status
	');
	
	$CI->db->join('orders','orders.id=assign_delivery_boy.order_id');
	$CI->db->join('delivery_boy','delivery_boy.id=assign_delivery_boy.delivery_boy_id');
	$CI->db->where('order_id',$order_id);
	$query = $CI->db->get('assign_delivery_boy');
	return $query->row_array();
}

function get_rating_restaurant_id($restaurant_id){
	$CI =& get_instance();
	$CI->db->select('sum(rating) as ratings');
	$CI->db->where('restaurant_id',$restaurant_id);
    $query = $CI->db->get('order_rating');
	return $query->row_array();
}
 
function get_rating_for_food($foodmenu_id){
	$CI =& get_instance();
	$CI->db->select('sum(rating) as ratings_sum,count(rating) as rating_count');
	$CI->db->where('food_menu_id',$foodmenu_id);
    $query = $CI->db->get('order_rating');
	return $query->row_array();
}

function get_rating_status($order_id,$foodmenu_id){
	$CI =& get_instance();
	$CI->db->select('id,rating');
	$CI->db->where('order_id',$order_id);
	$CI->db->where('food_menu_id',$foodmenu_id);
    $query = $CI->db->get('order_rating');
	return $query->row_array();
}

function get_customer_ticket_status($order_id){
	$CI =& get_instance();
	$CI->db->select('ticketID,ticketTitle');
	$CI->db->where('order_id',$order_id);
    $query = $CI->db->get('customer_support');
	return $query->row_array();
}

function check_complementary_restaurant($restaurant_id,$user_id=null){
	
	$allow_complementary = 0;
	$CI =& get_instance();
	
	if(!empty($user_id)){
		
		$CI->db->select('id');
		$CI->db->where('user_id',$user_id);
		$query = $CI->db->get('orders');
		$order_exist =  $query->num_rows();
		
		if($order_exist==0){
			$allow_complementary =  get_cart_count($user_id);
		}
	}else{
		$cart = new Cart;
		$total_items = $cart->contents();
		
		$allow_complementary = count($total_items);
	}
	
	if($allow_complementary==1){
		
		$CI->db->select('allow_complementary,complementary_food_msg');
		$CI->db->where('id',$restaurant_id);
		$query1 = $CI->db->get('kitchens');
		$complementary =  $query1->row_array();
		
		if(!empty($complementary) && $complementary['allow_complementary']==1 && $complementary['complementary_food_msg']!=''){
			return $complementary['complementary_food_msg'];
		}
	}
}

function login_signup_cart($user_id){
	$CI =& get_instance();
	
	$old_cart_data['conditions'] 	= array('user_id'=>$user_id);
	$old_cart_data['fields'] 		= 'persistent_cart';
	$old_cart_data['returnType'] 	= 'single';
	$check_existing_cart 			= $CI->common_model->getRows('cart',$old_cart_data);

	if(!empty($check_existing_cart)){
		$cart_table_data = unserialize($check_existing_cart['persistent_cart']);
	}
	
	$cart = new Cart;
	$cartItems = $cart->contents();
	
	$cart_data = array();
	$add_cart = array();
	$total = 0;
	foreach($cartItems as $cart){
		
		if(empty($cart_table_data)){
			$rowid = $cart['rowid'];
			
			$add_cart['rowid'] 			= $cart['rowid'];
			$add_cart['restaurant_id'] 	= $cart['restaurant_id'];
			$add_cart['food_menu_id'] 	= $cart['food_menu_id'];
			$add_cart['menu_name'] 		= $cart['menu_name'];
			$add_cart['variation_id'] 	= $cart['variation_id'];
			$add_cart['variation_name'] = $cart['variation_name'];
			$add_cart['price'] 			= $cart['price'];
			$add_cart['qty']			= $cart['qty'];
			$add_cart['subtotal'] 		= $cart['subtotal'];
			
			$total += $cart['subtotal'];
			$add_cart_array[] = $add_cart;
		}else{
			$rowid = $cart['rowid'];
			
			$table_rowid = search_cart($cart_table_data,'rowid',$rowid);
			
			if(($cart['restaurant_id'] == $table_rowid['restaurant_id']) && (in_array($rowid,$cart_table_data))){
				
				$update_cart['rowid'] 			= $cart['rowid'];
				$update_cart['restaurant_id'] 	= $cart['restaurant_id'];
				$update_cart['food_menu_id'] 	= $cart['food_menu_id'];
				$update_cart['menu_name'] 		= $cart['menu_name'];
				$update_cart['variation_id'] 	= $cart['variation_id'];
				$update_cart['variation_name'] 	= $cart['variation_name'];
				$update_cart['price'] 			= $cart['price'];
				$update_cart['qty']				= $cart['qty'] + $cart_table_data[$table_rowid]['qty'];
				$update_cart['subtotal'] 		= $update_cart['qty'] * $update_cart['price'] ;
				
				$update_cart_array[] = $update_cart;
				
				$total += $update_cart['subtotal'];
				
			}else{
				$update_cart['rowid'] 			= $cart['rowid'];
				$update_cart['restaurant_id'] 	= $cart['restaurant_id'];
				$update_cart['food_menu_id'] 	= $cart['food_menu_id'];
				$update_cart['menu_name'] 		= $cart['menu_name'];
				$update_cart['variation_id'] 	= $cart['variation_id'];
				$update_cart['variation_name'] 	= $cart['variation_name'];
				$update_cart['price'] 			= $cart['price'];
				$update_cart['qty']				= $cart['qty'];
				$update_cart['subtotal'] 		= $cart['subtotal'];
				
				$update_cart_array[] = $update_cart;
				
				$total += $update_cart['subtotal'];
			}
		}
	}
	if(!empty($add_cart_array)){
		
		$add_data['user_id'] 			= $user_id;
		$add_data['persistent_cart'] 	= serialize($add_cart_array);
		$add_data['total'] 				= $total;
		$add_data['updated_date'] 		= date('Y-m-d h:i:s');
		
		$CI->common_model->add_data('cart',$add_data);
	}
	
	if(!empty($update_cart_array)){
		
		$update_data['persistent_cart'] 	= serialize($update_cart_array);
		$update_data['total'] 				= $total;
		$update_data['updated_date'] 		= date('Y-m-d h:i:s');
		
		$CI->common_model->update_data('cart',$update_data,array('user_id'=>$user_id));
	}
	
	$complementary_food = check_complementary_zamy($user_id);
	
	$CI->common_model->update_data('cart',array('complementary_food'=>$complementary_food),array('user_id'=>$user_id));
	
	$CI->session->unset_userdata('complementary_food');
}

function search_cart($products, $field, $value)
{
   foreach($products as $key => $product)
   {
	  if ( $product[$field] === $value )
		 return $key;
   }
   return false;
}

function check_complementary_zamy($user_id=null){
	
	$allow_complementary = 0;
	$CI =& get_instance();
	
	if(!empty($user_id)){
		
		$CI->db->select('id');
		$CI->db->where('user_id',$user_id);
		$query = $CI->db->get('orders');
		$order_exist =  $query->num_rows();
		
		if($order_exist==0){
			if(get_cart_count($user_id)==0){
				$allow_complementary =  1;
			}
		}
	}else{
		$cart = new Cart;
		$total_items = $cart->contents();
		if($CI->session->has_userdata('complementary_food')){
			$allow_complementary = 0;
		}else{
			$allow_complementary = 1;
		}
		//$allow_complementary = count($total_items);
	}
	
	if($allow_complementary==1){
		
		$CI->db->select('allow_complementary,complementary_food_msg');
		$CI->db->limit(1);
		$query1 = $CI->db->get('site_complementary');
		$complementary =  $query1->row_array();
		
		if(!empty($complementary) && $complementary['allow_complementary']==1 && $complementary['complementary_food_msg']!=''){
			return $complementary['complementary_food_msg'];
		}
	}
}



function send_sms($mobile, $message){
 
	$apiKey = urlencode('ZbEA9roJ2euxWWPH8OWpgQyKYK');
	$numbers = $mobile;
	$sender = urlencode('ZAMYin');
	$message = rawurlencode($message);
	$SMSType = '2'; 
	$data = 'APIkey='.$apiKey.'&Mobile='.$numbers."&SenderID=".$sender."&MsgText=".$message."&SMSType=".$SMSType; 
	
	$ch_sms = curl_init('http://ui.netsms.co.in/API/SendSMS.aspx?' . $data);
	curl_setopt($ch_sms, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch_sms);
	curl_close($ch_sms);
	return $response;

}

function get_cs_admin_conversation($ticketChatID){
	$CI =& get_instance();
	$CI->db->select('customer_support.*,online_customer.name as user_name,online_customer.email as user_email,online_customer.profile as user_profile_name');
	$CI->db->join('orders', 'orders.id = customer_support.order_id');
	$CI->db->join('online_customer', 'online_customer.id = orders.user_id','left');
	$CI->db->where('customer_support.ticketChatID',$ticketChatID);
	$CI->db->where('customer_support.status',1);
	$CI->db->order_by('customer_support.ticketID','desc');
	$query = $CI->db->get('customer_support');
	return $query->result_array();

}

function order_details_by_ticket_ID($ticketID){
	$CI =& get_instance();
	$CI->db->select('customer_support.*,online_customer.name as user_name,online_customer.email as user_email');
	$CI->db->join('orders', 'orders.id = customer_support.order_id');
	$CI->db->join('online_customer', 'online_customer.id = orders.user_id','left');
	$CI->db->join('order_items', 'order_items.order_id = customer_support.order_id', 'left');
	$CI->db->where('customer_support.ticketID',$ticketID);
	$CI->db->order_by('customer_support.ticketID','desc');
	$query = $CI->db->get('customer_support');
	return $query->result_array();

}

function get_delivery_charge_by_restaurant_ID($restaurant_id){
   $CI =& get_instance();
   $CI->db->select('kitchens.area as kitchen_area,shippings_area.area as shipping_area, shippings_area.delivery_charge');
   $CI->db->join('shippings_area', 'shippings_area.area = kitchens.area');
   $CI->db->where('kitchens.id',$restaurant_id);
   $query = $CI->db->get('kitchens');
   return $query->row_array();
}

function getMessageChatID(){

	$CI =& get_instance();
	$CI->db->select('max(ticketChatID) as ticketChatID');
	$query = $CI->db->get('customer_support');
	return $query->result_array();
}

function view_message($id){
	$CI =& get_instance();
	$CI->db->select('tc.*');
	$CI->db->where('tc.ticketChatID',$id);
	$CI->db->order_by('tc.ticketDateTime','ASC');
	$query = $CI->db->get('customer_support as tc');
	return $query->result_array();
}

function Restaurant_count(){
	$CI =& get_instance();
	$CI->db->select('count(res.id) as Total_restaurant');
	$CI->db->where('res.status',1);
	$query = $CI->db->get('kitchens as res');
	return $query->row_array();  
}

function Total_users(){
    $CI =& get_instance();
	$CI->db->select('count(oc.id) as Total_users');
	$query = $CI->db->get('online_customer as oc');
	return $query->row_array();  
}

function total_orders_users(){
    $CI =& get_instance();
	$CI->db->select('count(orders.id) as order_users_count');
	$CI->db->from('orders');
	$CI->db->join('online_customer', 'online_customer.id = orders.user_id','left');
	$query = $CI->db->get();
	return $query->row_array();  
}

function customer_support_count(){
	$CI =& get_instance();
	$CI->db->select('count(cs.ticketID) as cs_count');
	$query = $CI->db->get('customer_support as cs');
	return $query->row_array();  
}

function get_top_restaurant($limit='',$offset='0',$total_row=''){
	 
	
	$CI =& get_instance();
	$CI->db->select('kitchens.id,kitchens.res_name,kitchens.res_alias,kitchens.logo,kitchens.images,kitchens.landmark,kitchens.area, kitchens.approx_delivery_time,kitchens.approx_cost,kitchens.service_type,count(orders.id) as total_orders,count(orders.restaurant_id) as total_restaurant_orders');
    $CI->db->from('kitchens');
    $CI->db->join('orders', 'orders.restaurant_id = kitchens.id','left');
     
    $CI->db->group_by("kitchens.id");
    $CI->db->order_by('total_orders','DESC');
    $CI->db->where('kitchens.status',1);
	if(!empty($total_row)){
		$query = $CI->db->get()->num_rows();
	}
	else{
		$limit = !empty($limit)?$limit:'12';
		$CI->db->limit($limit,$offset);
		$query = $CI->db->get()->result_array();
	}	 
	 
	return $query;
}


function get_fav_food_by_user($user_id){
    $CI =& get_instance();
	$CI->db->select('foodmenu.menu_name, foodmenu.short_code, foodmenu.order_type, foodmenu.menu_logo, foodmenu.price, foodmenu.reduced_price,foodmenu.long_description,kitchens.id as restaurant_id, kitchens.res_name, kitchens.res_alias, kitchens.images as kitchen_image, kitchens.address, kitchens.country, kitchens.state, kitchens.city, kitchens.approx_cost, kitchens.pure_veg,kitchens.approx_delivery_time,kitchens.service_type,favorite_food.foodmenu_id as food_id');
    $CI->db->from('favorite_food');
    $CI->db->join('kitchens', 'kitchens.id = favorite_food.restaurant_id','left');
    $CI->db->join('foodmenu', 'foodmenu.foodmenu_id = favorite_food.foodmenu_id','left');
    $CI->db->where('favorite_food.user_id',$user_id);
    $CI->db->limit(3);
    $CI->db->group_by("favorite_food.id");
    $query = $CI->db->get();
	return $result = $query->result_array();
}


function get_populer_this_month(){
	$CI =& get_instance();
	$CI->db->select('foodmenu.menu_name, foodmenu.short_code, foodmenu.order_type, foodmenu.menu_logo,foodmenu.price, foodmenu.reduced_price,foodmenu.long_description,kitchens.id as restaurant_id, kitchens.res_name, kitchens.res_alias, kitchens.images as kitchen_image, kitchens.address, kitchens.approx_cost, kitchens.pure_veg,kitchens.approx_delivery_time,kitchens.service_type,count(orders.id) as total_orders,count(orders.restaurant_id) as total_restaurant_orders');
    $CI->db->from('kitchens');
    $CI->db->join('foodmenu', 'foodmenu.restaurant_id = kitchens.id','left');
    $CI->db->join('orders', 'orders.restaurant_id = kitchens.id','left');
    $CI->db->where('DATE_FORMAT(orders.created_date,"%Y-%m")',date("Y-m"));
    $CI->db->limit(3);
    $CI->db->group_by("kitchens.id");
    $CI->db->order_by('total_orders','DESC');
    $query = $CI->db->get();
	return $result = $query->result_array();
}

function populer_this_month_restaurants(){
	$CI =& get_instance();
	$CI->db->select('orders.id,orders.restaurant_id,count(orders.restaurant_id) AS restaurant_count,kitchens.res_name, kitchens.res_alias, kitchens.images as kitchen_image, kitchens.address, kitchens.approx_cost, kitchens.pure_veg,kitchens.approx_delivery_time,kitchens.service_type');
	$CI->db->join('kitchens', 'kitchens.id = orders.restaurant_id','left');
    $CI->db->where('DATE_FORMAT(orders.created_date,"%Y-%m")',date("Y-m"));
	$CI->db->limit(5);
    $CI->db->group_by("orders.restaurant_id");
    $CI->db->order_by('restaurant_count','DESC');
    $query = $CI->db->get('orders');
	return $result = $query->result_array();
}
/*
*/
function populer_this_month_food($ids=null,$limit=''){
	$CI =& get_instance();
	$CI->db->select('orders.id as order_id,order_items.food_menu_id,count(order_items.food_menu_id) AS food_menu_id_count,
	orders.restaurant_id,
	kitchens.res_name, kitchens.id, kitchens.res_alias, kitchens.images as kitchen_image, kitchens.address,kitchens.logo, kitchens.area, kitchens.landmark, kitchens.approx_cost, kitchens.pure_veg,kitchens.approx_delivery_time,kitchens.service_type, foodmenu.menu_logo, foodmenu.swiggy_logo,foodmenu.choice');
	$CI->db->join('orders', 'orders.id = order_items.order_id','left');
	$CI->db->join('kitchens', 'kitchens.id = orders.restaurant_id','left');
	$CI->db->join('foodmenu', 'foodmenu.foodmenu_id = order_items.food_menu_id','right');
    $CI->db->where('DATE_FORMAT(orders.created_date,"%Y-%m")',date("Y-m"));
    $CI->db->where('kitchens.status',1);
	$CI->db->where("kitchens.id!=",'3');
	if(!empty($ids)){
		$CI->db->where_not_in('order_items.food_menu_id',$ids);
		$CI->db->limit(5);
	}else{
		$limit = !empty($limit)?$limit:'3';
		$CI->db->limit($limit);
	}
	
    $CI->db->group_by("order_items.food_menu_id");
    $CI->db->order_by('food_menu_id_count','DESC');
    $query = $CI->db->get('order_items');
	$result = $query->result_array();
	
	return $result;
}
/*
function home_top_featured_restaurant(){
	$CI =& get_instance();
	$CI->db->select('kitchens.id,kitchens.res_name,kitchens.address, foodmenu.short_code, foodmenu.order_type,foodmenu.menu_logo,foodmenu.price,foodmenu.long_description,kitchens.res_alias,kitchens.approx_delivery_time,kitchens.approx_cost,kitchens.service_type,foodmenu.menu_name,count(orders.id) as total_orders,order_items.food_menu_id,count(order_items.food_menu_id) AS food_menu_id_count,');
	$CI->db->from('order_items');
	$CI->db->join('orders', 'orders.id = order_items.order_id');
	$CI->db->join('kitchens', 'kitchens.id = orders.restaurant_id','left');
	$CI->db->join('foodmenu', 'foodmenu.foodmenu_id = order_items.food_menu_id','right');
    $CI->db->group_by("order_items.food_menu_id");
    $CI->db->order_by('food_menu_id_count','DESC');
    $CI->db->limit(3);
    $query = $CI->db->get();
	return $result = $query->result_array();
}*/
function replaceKeys($oldKey, $newKey,$input){
	$CI =& get_instance();
    $return = array(); 
    foreach ($input as $key => $value) {
        if ($key===$oldKey)
            $key = $newKey;

        if (is_array($value))
            $value = replaceKeys( $oldKey, $newKey, $value);

        $return[$key] = $value;
    }
    return $return; 
}
function restaurant_filter_by_food_category(/*$cat_val*/){
	$CI =& get_instance();
	$CI->db->select('kitchens.id,kitchens.address,kitchens.res_name,kitchens.res_alias,kitchens.logo,kitchens.images,kitchens.approx_delivery_time,kitchens.approx_cost,kitchens.service_type,food_category.cat_id,food_category.cat_name as food_cate_title,foodmenu.foodmenu_id');
	$CI->db->join('foodmenu', 'foodmenu.cat_id = food_category.cat_id');
	$CI->db->join('kitchens', 'kitchens.id = foodmenu.restaurant_id','left');
    $CI->db->where('kitchens.status',1);
    $CI->db->group_by("kitchens.id");
    $query = $CI->db->get('food_category');
	return $result = $query->result_array();
}
function get_food_filter_food_category(){
	$CI =& get_instance();
	$CI->db->select('kitchens.id,kitchens.address,kitchens.res_name,kitchens.res_alias,kitchens.approx_delivery_time,kitchens.approx_cost,kitchens.service_type,food_category.cat_id,food_category.cat_name as food_cate_title,foodmenu.foodmenu_id,foodmenu.choice as food_menu_choice,foodmenu.menu_name,foodmenu.menu_logo');
	$CI->db->from('foodmenu');
	$CI->db->join('food_category', 'food_category.cat_id = foodmenu.cat_id');
	$CI->db->join('kitchens', 'kitchens.id = foodmenu.restaurant_id','left');
	
	$selected_values = array('3'=>'3','29'=>'29','39'=>'39');

     
	$CI->db->where('foodmenu.is_deleted',0);
	$CI->db->where('kitchens.status',1);
	$CI->db->group_start();
    foreach($selected_values as $value)
    {
        $CI->db->or_where("find_in_set($value, foodmenu.choice)");
    }
    $CI->db->group_end();
	$query = $CI->db->get();
	return $result = $query->result_array();
}
function config_food_filter_food_category($choice){
	$CI =& get_instance();
	$CI->db->select('kitchens.id,kitchens.address,kitchens.res_name,kitchens.res_alias,kitchens.approx_delivery_time,kitchens.approx_cost,kitchens.service_type,food_category.cat_id,food_category.cat_name as food_cate_title,foodmenu.foodmenu_id,foodmenu.choice as food_menu_choice,foodmenu.menu_name,foodmenu.menu_logo,foodmenu.reduced_price,foodmenu.price');
	$CI->db->from('foodmenu');
	$CI->db->join('food_category', 'food_category.cat_id = foodmenu.cat_id');
	$CI->db->join('kitchens', 'kitchens.id = foodmenu.restaurant_id','left');
	
	$selected_values = array($choice=>$choice);

     
	$CI->db->where('foodmenu.is_deleted',0);
	$CI->db->where('kitchens.status',1);
	$CI->db->limit(8);
	$CI->db->group_start();
    foreach($selected_values as $value)
    {
        $CI->db->or_where("find_in_set($value, foodmenu.choice)");
    }
    $CI->db->group_end();
	$query = $CI->db->get();
	return $result = $query->result_array();
}
function get_bottom_featured_restaurant(){
 	$CI =& get_instance();
	$CI->db->select('kitchens.id,kitchens.res_name,kitchens.res_alias,kitchens.logo,kitchens.images,kitchens.approx_delivery_time,kitchens.approx_cost,kitchens.service_type');
    $CI->db->where('kitchens.is_featured',1);
    $CI->db->where('kitchens.status',1);
    $CI->db->limit(6);
    $query = $CI->db->get('kitchens');
	return $result = $query->result_array();
} 
function get_food_category_array(){
   	$CI =& get_instance();
	$CI->db->select('food_cate_title');
	$CI->db->from('homepage_food_cate');
	$CI->db->where('status',1);
    $query = $CI->db->get();
	return $result = $query->result_array(); 
}
function get_count_fav_food_by_users($foodmenu_id){
	$CI =& get_instance();
	$CI->db->select('count(favorite_food.id) as total_fav_res');
    $CI->db->where('favorite_food.foodmenu_id',$foodmenu_id);
    $query = $CI->db->get('favorite_food');
	return $result = $query->row_array();	
}
function get_count_fav_res_by_users($restaurant_id){
    $CI =& get_instance();
	$CI->db->select('count(fav_restaurants.id) as total_fav_res');
    $CI->db->where('fav_restaurants.restaurant_id',$restaurant_id);
    $query = $CI->db->get('fav_restaurants');
	return $result = $query->row_array();	
}
function get_all_fav_res_by_users($user_id){
	$CI =& get_instance();
	$CI->db->select('count(fav_restaurants.id) as total_fav_res,kitchens.id as restaurant_id,kitchens.*,fav_restaurants.*');
	$CI->db->from('fav_restaurants');
	$CI->db->join('kitchens', 'kitchens.id = fav_restaurants.restaurant_id');
    $CI->db->where('fav_restaurants.user_id',$user_id);
    $CI->db->group_by("fav_restaurants.id");
    $query = $CI->db->get();
	return $result = $query->result_array();	
}

function get_all_fav_food_by_users($user_id){

	$CI =& get_instance();
	$CI->db->select('foodmenu.foodmenu_id,foodmenu.menu_name,foodmenu.menu_logo,foodmenu.price,kitchens.res_alias');
	$CI->db->from('favorite_food');
	$CI->db->join('foodmenu', 'foodmenu.foodmenu_id = favorite_food.foodmenu_id');
	$CI->db->join('kitchens', 'kitchens.id = favorite_food.restaurant_id');
    $CI->db->where('favorite_food.user_id',$user_id);
    $CI->db->group_by("favorite_food.id");
    $query = $CI->db->get();
	return $result = $query->result_array();

}

function get_food_menu($id){
	$CI =& get_instance();
	$CI->db->select('foodmenu.foodmenu_id,foodmenu.menu_name, foodmenu.short_code, foodmenu.order_type, foodmenu.menu_logo,foodmenu.price, foodmenu.reduced_price,foodmenu.long_description');
    $CI->db->where('foodmenu.foodmenu_id',$id);
    $query = $CI->db->get('foodmenu');
	return $result = $query->row_array();
}

function blog_detail($alias){
	$CI =& get_instance();
	$CI->db->select('blog_post.id,blog_post.title, blog_post.sub_title, blog_post.image, blog_post.tags, blog_post.status, blog_post.description,blog_post.updated, blog_category.name');
	$CI->db->join('blog_category','blog_category.id = blog_post.category');
    $CI->db->where('blog_post.blog_alias',$alias);
    $query = $CI->db->get('blog_post');
	return $result = $query->result_array();
}

function get_food_menu_variance_for_price($menu_id){   
        $CI =& get_instance();     
        $CI->db->select('v.id, v.name ,fmv.vprice,fmv.vreduced_price');
		$CI->db->from('variations as v');
		$CI->db->join('foodmenu_variation as fmv','fmv.vfood_variation = v.id');
		$CI->db->where('fmv.vfoodmenu_id',$menu_id);
		$query = $CI->db->get();
		return $result = $query->result_array();
}


function my_random_string($n=6) { 
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
    $randomString = ''; 
  
    for ($i = 0; $i < $n; $i++) { 
        $index = rand(0, strlen($characters) - 1); 
        $randomString .= $characters[$index]; 
    } 
  
    return $randomString; 
}

function food_menu_all_count_restaurant_id($restaurant_id){
    $CI =& get_instance();
	$CI->db->select('food_category.cat_id as food_category_id,food_category.cat_name,count(foodmenu.foodmenu_id) as total_category_count'); 
	$CI->db->from('food_category');
	$CI->db->join('foodmenu','foodmenu.cat_id = food_category.cat_id');
	$CI->db->where('food_category.restaurant_id',$restaurant_id);
	$CI->db->where('food_category.is_deleted',0);
	$CI->db->where('foodmenu.is_deleted',0);
	$CI->db->where("!FIND_IN_SET ('2', choice) and !FIND_IN_SET ('18', choice)");
	$CI->db->group_by('food_category.cat_id');
    $query = $CI->db->get();
    return $result = $query->result_array();
}

function find_all_count_restaurant_id($restaurant_id){
	$CI =& get_instance();
	$CI->db->select('food_category.cat_id as food_category_id,food_category.cat_name,count(foodmenu.foodmenu_id) as total_category_count'); 
	$CI->db->from('food_category');
	$CI->db->join('foodmenu','foodmenu.cat_id = food_category.cat_id');
	$CI->db->where('food_category.restaurant_id',$restaurant_id);
	$CI->db->where('food_category.is_deleted',0);
	$CI->db->where('foodmenu.is_deleted',0);
	$CI->db->group_by('food_category.cat_id');
    $query = $CI->db->get();
    return $result = $query->result_array();
}



