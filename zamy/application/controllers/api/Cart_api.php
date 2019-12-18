<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

// Load the Rest Controller library
require APPPATH . '/libraries/REST_Controller.php';

class Cart_api extends REST_Controller {

    public function __construct() { 
        parent::__construct();
        
        // Load the user model
		$this->load->model('api/Api_model','api_model');
		$this->load->model('common_model');
		$this->load->helper('paytm');
		$this->load->helper('coupon');
		$this->load->helper('push_notification');
		$this->load->helper('email');
		 
    }
   
	public function add_to_cart_post(){
		
		$restaurant_id	= $this->input->post('restaurant_id');
		$foodmenu_id	= $this->input->post('food_menu_id');
		$variation_id 	= !empty($this->input->post('variation_id')) ? $this->input->post('variation_id'):'0';		
		$user_id 		= $this->input->post('user_id');
  	 
		$menu_price_name = $this->common_model->get_menu_price_name($restaurant_id,$foodmenu_id,$variation_id);
		
		if((!empty($menu_price_name['reduced_price']) && $menu_price_name['reduced_price'] != '0.00') && $menu_price_name['reduced_price'] < $menu_price_name['price']){
			$unit_price = $menu_price_name['reduced_price'];
		}else{
			$unit_price = (!empty($menu_price_name['price']) && $menu_price_name['price'] != '0.00') ? $menu_price_name['price'] : 0;
		}
		
		$menu = $this->common_model->get_food_menu($restaurant_id,$foodmenu_id,$variation_id);
		$variation_name = ( !empty($menu->name)) ?  " (" .$menu->name .") " :'';
		
		$menu_name = $menu->menu_name;
		
		$insertItem = array();
		
		
		 
	    if($user_id){
			
			$itemData = array();
			$itemData[0]['rowid'] 			= $foodmenu_id.$variation_id;
			$itemData[0]['restaurant_id'] 	= $restaurant_id;
			$itemData[0]['food_menu_id'] 	= $foodmenu_id;
			$itemData[0]['menu_name'] 		= $menu_name;
			$itemData[0]['variation_name'] 	= $variation_name;
			$itemData[0]['variation_id'] 	= $variation_id;
			$itemData[0]['price'] 			= $unit_price;
			$itemData[0]['qty'] 			= 1;
			$itemData[0]['subtotal'] 		= $unit_price;
		 
			// Insert item to cart table
			 
			$old_cart_data['conditions'] 	= array('user_id'=>$user_id);
			$old_cart_data['fields'] 		= 'persistent_cart,total,coupon_code,coupon_amount,total_amount';
			$old_cart_data['returnType'] 	= 'single';
			$check_existing_cart 			= $this->common_model->getRows('cart',$old_cart_data);
			$delivery_charge = get_delivery_charge_by_restaurant_ID($restaurant_id);
			if(!empty($check_existing_cart)){
				$cart_table_data = unserialize($check_existing_cart['persistent_cart']);
				
			}
			 
			$add_data = array();
			if(empty($cart_table_data)){
				
				
				$add_data['user_id'] 			= $user_id;
				$add_data['persistent_cart'] 	= serialize($itemData);
				$add_data['total'] 				= $itemData[0]['subtotal'];
				$add_data['total_amount'] 		= $itemData[0]['subtotal'] + $delivery_charge['delivery_charge'];
				$add_data['updated_date'] 		= date('Y-m-d h:i:s');
			 
				$insertItem = $this->common_model->add_data('cart',$add_data);

			}else{ 
				
				if(!empty($cart_table_data[0]['restaurant_id']) && $cart_table_data[0]['restaurant_id']  != $restaurant_id){
					$this->response([
						'status' => 0,
						'message' => 'Your cart contains items from other restaurant. Would you like to reset your cart for adding items from this restaurant?',
						'data' => (object)[]
					], REST_Controller::HTTP_OK);
					
				}else{
				 
					$update_cart_array = array(); 
					$update_cart_array1=array() ; 
					$update_cart = array();
						$total = 0;	
					$i=0;			
								if(!empty($cart_table_data)){
									$row_id = array_column($cart_table_data, 'rowid');
								}
					foreach($cart_table_data as $cart){
						
						$rowid = $cart['rowid'];
						$table_rowid = $foodmenu_id.$variation_id;
						
						if(($cart['restaurant_id'] == $restaurant_id) && ($rowid == $table_rowid )){
						 
							$update_cart[$i]['rowid'] 			= $cart['rowid'];
							$update_cart[$i]['restaurant_id'] 	= $cart['restaurant_id'];
							$update_cart[$i]['food_menu_id'] 	= $cart['food_menu_id'];
							$update_cart[$i]['menu_name'] 		= $cart['menu_name'];
							$update_cart[$i]['variation_id'] 	= $cart['variation_id'];
							$update_cart[$i]['variation_name'] 	= $cart['variation_name'];
							$update_cart[$i]['price'] 			= $cart['price'];
							$update_cart[$i]['qty']				= $cart['qty'] + 1;
							$update_cart[$i]['subtotal'] 		= $update_cart[$i]['qty'] * $update_cart[$i]['price'] ;
							  
							//$update_cart_array[] = $update_cart[$i];
							
							$total += $update_cart[$i]['subtotal'];
						}
						else{ 
														
							$update_cart[$i]['rowid'] 			= $cart['rowid'];
							$update_cart[$i]['restaurant_id'] 	= $cart['restaurant_id'];
							$update_cart[$i]['food_menu_id'] 	= $cart['food_menu_id'];
							$update_cart[$i]['menu_name'] 		= $cart['menu_name'];
							$update_cart[$i]['variation_id'] 	= $cart['variation_id'];
							$update_cart[$i]['variation_name'] 	= $cart['variation_name'];
							$update_cart[$i]['price'] 			= $cart['price'];
							$update_cart[$i]['qty']				= $cart['qty'] ;
							$update_cart[$i]['subtotal'] 		= $cart['subtotal'];
							 
							 
							//$update_cart_array[] = $update_cart[$i];
							
							$total += $update_cart[$i]['subtotal']; 
							
					} 
				$i++;					
				} 
				 if(in_array($table_rowid,$row_id )){
					 	
						$update_cart_array = $update_cart;		
				 } else{
				 
						$new_itemData[]  = array(
								'rowid'				=> $foodmenu_id.$variation_id,
								'restaurant_id' 	=> $restaurant_id, 
								'food_menu_id' 		=> $foodmenu_id, 
								'menu_name' 		=> $menu_name, 
								'variation_name' 	=> $variation_name, 
								'variation_id' 		=> $variation_id, 
								'price' 			=> $unit_price, 
								'qty' 				=> 1,
								'subtotal'			=> $unit_price, 
							);
							 
						$update_cart_array = array_merge($update_cart,$new_itemData);
						$total += $unit_price;
						 			
				  }
				
	
				if(!empty($update_cart_array)){
					
					$coupon_code = '';
					if(!empty($check_existing_cart['coupon_code'])){
						
						$coupon_code = $check_existing_cart['coupon_code'];
						$coupon_discount_data = coupon_discount($coupon_code,$total,$user_id,$restaurant_id);
						$update_data['coupon_code'] = $coupon_code;
						$update_data['coupon_amount'] = $coupon_discount_data['discount_amount'];
						  
						$total_amount = $total - $coupon_discount_data['discount_amount']; 
					}
					
					
					$update_data['persistent_cart'] 	= serialize($update_cart_array);
					$update_data['total'] 				= $total;
					$update_data['total_amount'] 		= !empty($total_amount)?$total_amount + $delivery_charge['delivery_charge']: $total + $delivery_charge['delivery_charge'];
					$update_data['updated_date'] 		= date('Y-m-d h:i:s');
					
					$insertItem = $this->common_model->update_data('cart',$update_data,array('user_id'=>$user_id)); 
				}
			} 
		}
			if($insertItem){
				
				$complementary = check_complementary_zamy($user_id);

				if($complementary){
					$this->common_model->update_data('cart',array('complementary_food'=>$complementary),array('user_id'=>$user_id));
				}
				$data['cart_count'] = get_cart_count($user_id);
				$data['data'] = $insertItem;
					// Set the response and exit
				$this->response([
					'status' => 1,
					'message' => 'Item added to cart successfully.',
					'data' => $data
				], REST_Controller::HTTP_OK);
			}else{
				// Set the response and exit
				//BAD_REQUEST (400) being the HTTP response code
				 $this->response([
					'status' => 0,
					'message' => 'Something went wrong.',
					'data' => ''
				], REST_Controller::HTTP_BAD_REQUEST);
			}
		}else{
                // Set the response and exit
                //BAD_REQUEST (400) being the HTTP response code
				 $this->response([
                    'status' => 0,
                    'message' => 'Something went wrong.',
                    'data' => ''
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
		exit; 
    }
	
	public function update_cart_post(){
		
		$restaurant_id 	= $this->input->post('restaurant_id');
		$foodmenu_id	= $this->input->post('food_menu_id');
		$variation_id 	= !empty($this->input->post('variation_id')) ? $this->input->post('variation_id'):'0';	 
		$qty 			= $this->input->post('qty'); 	
		$user_id 		= $this->input->post('user_id');
		$rowid 			= $foodmenu_id.$variation_id;
		
		$itemData = array(
            'rowid' 	=> $rowid,
            'qty' 		=> $qty 
        );
		 
		$updateItem = '';
      
	    if($user_id){
			// update item in cart table
			  
			$old_cart_data['conditions'] 	= array('user_id'=>$user_id);
			$old_cart_data['fields'] 		= 'persistent_cart,total,coupon_code,coupon_amount,total_amount';
			$old_cart_data['returnType'] 	= 'single';
			$check_existing_cart 			= $this->common_model->getRows('cart',$old_cart_data);
			
			$update_cart_array = array();
			$update_data = array();
			$cart_table_data = unserialize($check_existing_cart['persistent_cart']);
			
			$total = 0;
			if(!empty($cart_table_data)){
				
				foreach($cart_table_data as $cart){
					
					$cart_rowid = $cart['rowid'];
					
					if(($cart['restaurant_id'] == $restaurant_id) && ($cart_rowid == $rowid )){
						
						$update_cart['rowid'] 			= $cart['rowid'];
						$update_cart['restaurant_id'] 	= $cart['restaurant_id'];
						$update_cart['food_menu_id'] 	= $cart['food_menu_id'];
						$update_cart['menu_name'] 		= $cart['menu_name'];
						$update_cart['variation_id'] 	= $cart['variation_id'];
						$update_cart['variation_name'] 	= $cart['variation_name'];
						$update_cart['price'] 			= $cart['price'];
						$update_cart['qty']				= $qty;
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
						$update_cart['subtotal'] 		= $update_cart['qty'] * $update_cart['price'] ;
						
						$update_cart_array[] = $update_cart; 
						$total += $update_cart['subtotal'];
					}
				} 
				 $delivery_charge = get_delivery_charge_by_restaurant_ID($restaurant_id);
				
				$discount_amount = '';
				
				if(!empty($check_existing_cart['coupon_code'])){
					
					$coupon_code = $check_existing_cart['coupon_code'];
					$coupon_discount_data = coupon_discount($coupon_code,$total,$user_id,$restaurant_id);
					$update_data['coupon_code'] = $coupon_code;
					$update_data['coupon_amount'] = $coupon_discount_data['discount_amount'];
					  
					$total_amount = $total - $coupon_discount_data['discount_amount'];
				  
				 } 
				 if(!empty($total_amount))
				 { 
					 $total_amnt = 0;
					 if($total_amount > 0)
						 $total_amnt = $total_amount;
				 }
				 else{
					$total_amnt = $total;
				 }  
				
				$update_data['persistent_cart'] 	= serialize($update_cart_array); 
				$update_data['total'] 				= $total;
				$update_data['total_amount'] 		= $total_amnt + $delivery_charge['delivery_charge'];
				$update_data['updated_date'] 		= date('Y-m-d h:i:s'); 
				
				$updateItem = $this->common_model->update_data('cart',$update_data,array('user_id'=>$user_id));
			}
		}
		else{
			$cart = new Cart;
			// update item in cart session
			$updateItem = $cart->update($itemData);
		}
		if($updateItem){
			$data['coupon_code']= $check_existing_cart['coupon_code'];  
			$data['subtotal']   = $total; 
			$data['discount_amount']=  $discount_amount;
			$data['total']   	= $total_amnt ; 
			
			// Set the response and exit
			$this->response([
				'status' => 1,
				'message' => 'Cart Item updated',
				'data' => $data
			], REST_Controller::HTTP_OK);
		}else{
			// Set the response and exit
			//BAD_REQUEST (400) being the HTTP response code
			 $this->response([
				'status' => 0,
				'message' => 'Not able to update cart.Something went wrong.',
				'data' => ''
			], REST_Controller::HTTP_BAD_REQUEST);
		} 
		exit;
	}
	
	public function remove_cart_item_post(){
		
		$user_id		= $this->input->post('user_id'); 
		$restaurant_id 	= $this->input->post('restaurant_id');
		$food_menu_id 	= $this->input->post('food_menu_id');
		$variation_id 	= $this->input->post('variation_id');
		$rowid 			= $food_menu_id.$variation_id;
		 if($user_id){
			
			$old_cart_data['conditions'] 	= array('user_id'=>$user_id);
			$old_cart_data['fields'] 		= 'persistent_cart,coupon_code,coupon_amount';
			$old_cart_data['returnType'] 	= 'single';
			$check_existing_cart 			= $this->common_model->getRows('cart',$old_cart_data);
			
			$update_cart_array = array();
			$update_data = array();
			$cart_table_data = array();
			
			if(!empty($check_existing_cart)){
				$cart_table_data = unserialize($check_existing_cart['persistent_cart']); 
			}
			$total = 0;
			if(!empty($cart_table_data) && count($cart_table_data) > 1){
				
				foreach($cart_table_data as $cart){
					
					$cart_rowid = $cart['rowid'];
					
					if($cart_rowid != $rowid ){
						
						$update_cart['rowid'] 			= $cart['rowid'];
						$update_cart['restaurant_id'] 	= $cart['restaurant_id'];
						$update_cart['food_menu_id'] 	= $cart['food_menu_id'];
						$update_cart['menu_name'] 		= $cart['menu_name'];
						$update_cart['variation_id'] 	= $cart['variation_id'];
						$update_cart['variation_name'] 	= $cart['variation_name'];
						$update_cart['price'] 			= $cart['price'];
						$update_cart['qty']				= $cart['qty'];
						$update_cart['subtotal'] 		= $update_cart['qty'] * $update_cart['price'] ;
						
						$update_cart_array[] = $update_cart;
						
						$total += $update_cart['subtotal'];
					}
				}
				
				$discount_amount = '';
				
				if(!empty($check_existing_cart['coupon_code'])){
					
					$coupon_code = $check_existing_cart['coupon_code'];
					$coupon_discount_data = coupon_discount($coupon_code,$total,$user_id,$restaurant_id);
					$update_data['coupon_code'] = $coupon_code;
					$update_data['coupon_amount'] = $coupon_discount_data['discount_amount'];
					  
					$total_amount = $total - $coupon_discount_data['discount_amount'];
					 
				 } 
				 if(!empty($total_amount))
				 { 
					 $total_amnt = 0;
					 if($total_amount > 0)
						 $total_amnt = $total_amount;
				 }
				 else{
					$total_amnt = $total;
				 }  
				$delivery_charge = get_delivery_charge_by_restaurant_ID($restaurant_id); 
				$update_data['persistent_cart'] 	= serialize($update_cart_array);
				$update_data['total'] 				= $total;
				$update_data['total_amount'] 		= $total_amnt + $delivery_charge['delivery_charge'];
				$update_data['updated_date'] 		= date('Y-m-d h:i:s');
				
				$removeItem = $this->common_model->update_data('cart',$update_data,array('user_id'=>$user_id));
			}else{
				$removeItem = $this->common_model->delete_data('cart',array('user_id'=>$user_id));
			}
			if($removeItem){
				$data['cart_count'] = get_cart_count($user_id);
				$data['data'] = $removeItem;
				
				$this->response([
						'status' => 1,
						'message' => 'Item removed from cart.',
						'data' => $data
					], REST_Controller::HTTP_OK);
			}else{
				$this->response([
					'status' => 0,
					'message' => 'Not able to remove from cart.',
					'data' => ''
				], REST_Controller::HTTP_BAD_REQUEST);
			}
		 }
		 else{
			$this->response([
				'status' => 0,
				'message' => 'user_id required.',
				'data' => ''
			], REST_Controller::HTTP_BAD_REQUEST);
		 }
		 exit;
	}
	
	public function clear_cart_post() {
		 
		$user = $this->input->post('user_id');
	 
		 if(!empty($user)){
				  
			$cart_data = $this->common_model->get_data_by_id(array('user_id' => $user),'cart','id,user_id');
			if($cart_data){
				$result = $this->common_model->delete_data('cart',array('user_id' => $user));
			 
				if($result){
					
					$data['cart_count'] = get_cart_count($user);
					$data['data'] = $result;
				
					// Set the response and exit
					$this->response([
						'status' => 1,
						'message' => 'Cart clear successfully.',
						'data' => $data
					], REST_Controller::HTTP_OK);
				}
			}
			else{
					// Set the response and exit
					//BAD_REQUEST (400) being the HTTP response code
					 $this->response([
						'status' => 0,
						'message' => 'Cart Empty.',
						'data' => ''
					], REST_Controller::HTTP_BAD_REQUEST);
				}
		 }
		 else{
			 // Set the response and exit
			$this->response([
                    'status' => 0,
                    'message' => 'user_id is required.',
                    'data' => ''
                ], REST_Controller::HTTP_BAD_REQUEST);
		}
		exit;
    } 
	
	public function get_cart_data_post() {
		 
		$user_id = $this->input->post('user_id');
	 
		 if(!empty($user_id)){
				  
			$old_cart_data['conditions'] = array('user_id'=>$user_id);
			$old_cart_data['returnType'] = 'single';
					$cart_data_arr 		 = $this->common_model->getRows('cart',$old_cart_data);
			 
			if($cart_data_arr){
				
				$complementery = check_complementary_zamy($user_id);
			 
				$value = unserialize($cart_data_arr['persistent_cart']);
				$delivery_charge = get_delivery_charge_by_restaurant_ID($value[0]['restaurant_id']);
				
				$cart_data	= array(
								'id' 	  => $cart_data_arr['id'],
								'user_id' => $cart_data_arr['user_id'],
								'total'	  => $cart_data_arr['total'],
								'delivery_charge'=> $delivery_charge['delivery_charge'],
								'coupon_code'	=> $cart_data_arr['coupon_code'], 
								'total_amount'	=> (!empty($cart_data_arr['coupon_code']) || !empty($delivery_charge['delivery_charge']) )?$cart_data_arr['total_amount']:$cart_data_arr['total'],
								'coupon_amount'	  => $cart_data_arr['coupon_amount'], 
								'created_date'	=> $cart_data_arr['created_date'],
								'complementery'	=> !empty($complementery['complementary_food_msg'])?$complementery['complementary_food_msg'] :''
							  );
		    
					foreach($value as $key => &$val){
  
						$condition['conditions'] = array('foodmenu_id'=>$val['food_menu_id']);
						$condition['returnType'] = 'single';
						$condition['fields'] 	 = 'menu_logo,swiggy_logo';
						$menu_data  			 = $this->common_model->getRows('foodmenu',$condition);
						 
						$menu_logo 	 = 'no_image_food.png'; 		
						$swiggy_logo = 'no_image_food.png'; 		 
						if(!empty( $menu_data['menu_logo']) && file_exists($this->config->item('foodMenu_image_basepath').$menu_data['menu_logo'])){
							$menu_logo 	 = $menu_data['menu_logo'];
							$swiggy_logo = $menu_data['swiggy_logo'];
						} 
						 
						$val['swiggy_logo'] = $this->config->item('foodMenu_image_url').$swiggy_logo;
						$val['menu_logo']   = $this->config->item('foodMenu_image_url').$menu_logo; 
					}
				  
				$cart_data['items'] = $value ;
				
				$cart_data['cart_count'] = get_cart_count($user_id);
					 
				
				// Set the response and exit
				$this->response([
					'status' => 1,
					'message' => 'Get cart data successfully.',
					'data' => $cart_data
				], REST_Controller::HTTP_OK); 
			}
			else{
				$cart_data['cart_count']  = 0;
					// Set the response and exit
					//BAD_REQUEST (400) being the HTTP response code
					 $this->response([
						'status' => 0,
						'message' => 'Cart Empty.',
						'data' => $cart_data
					], REST_Controller::HTTP_BAD_REQUEST);
				}
		 }
		 else{
			 // Set the response and exit
			$this->response([
                    'status' => 0,
                    'message' => 'user_id is required.',
                    'data' => ''
                ], REST_Controller::HTTP_BAD_REQUEST);
		}
		exit;
    } 
	 
	public function checkout_post(){
		
		$user_id		= $this->input->post('user_id');
		$restaurant_id	= $this->input->post('restaurant_id');
		$address_id 	= $this->input->post('address_id');
		$payment_method = $this->input->post('payment_method');
		
		if(empty($payment_method)){
			
			$this->response([
				'status' => 0,
				'message' => 'payment_method required.',
				'data' => ''
			], REST_Controller::HTTP_BAD_REQUEST);
		}
		
		$admin_commission = admin_commission($restaurant_id);
	 
		if(!empty($address_id)){
			$address_postcode = $this->common_model->get_field_by_id('address_book','postcode',array('id' => $address_id));
			$shippings_area	  = $this->common_model->get_field_by_id('shippings_area','zipcode',array('zipcode' => $address_postcode));
		 
			if(empty($shippings_area) ){
			 
				//$address_data['your_address'] 	  = $address_book;
				//$address_data['restaurant_address']	  = $kitchens;
			 
				$this->response([
					'status' => 0,
					'message' => "Sorry we can't delivered order in your shipping address. Please change your shipping address.",
					'data' => (object)[]
				], REST_Controller::HTTP_OK);
				exit;
			}
			else{
				
				$customer_name = $this->common_model->get_field_by_id('online_customer','name',array('id'=>$user_id)); 
				$address_data['conditions'] = array('id'=>$address_id,'status'=>1);
				$address_data['returnType'] = 'single';
				$address = $this->common_model->getRows('address_book',$address_data);
				$shipping_address ='';
				$shipping_address .= $address['address_1'].", ";
				if(!empty($address['address_2'])){
					$shipping_address .= $address['address_2'];
				}
				if(!empty($address['country']) && ($address['country']=='IN' || $address['country']=='India' || $address['country']=='india' )){
					$shipping_country = "India";
				}
				$shipping_address .= $address['shipping_area'].", ";
				$shipping_address .= $address['city'].", ";
				$shipping_address .= $address['state']."-";
				$shipping_address .= $address['postcode'].", ";
				$shipping_address .= $shipping_country;
				
				$order_data['user_id'] 			= $user_id;
				$order_data['restaurant_id'] 	= $restaurant_id;
				$order_data['customer_name'] 	= $customer_name;
				$order_data['shipping_name'] 	= $address['name'];
				$order_data['shipping_email'] 	= $address['email'];
				$order_data['shipping_phone'] 	= $address['phone'];
				$order_data['shipping_address'] = $shipping_address;
				$order_data['shipping_lat'] 	= $address['address_lat'];
				$order_data['shipping_lng'] 	= $address['address_lng'];
				
				$old_cart_data['conditions'] 	= array('user_id'=>$user_id);
				$old_cart_data['fields'] 		= 'persistent_cart,total,coupon_code,coupon_amount,total_amount';
				$check_existing_cart 			= $this->common_model->getRows('cart',$old_cart_data);
				 //echo $this->db->last_query();
				$cart_table_data = array();
				$coupon_code 	= '';
				$discount_type	= '';
				$coupon_amount 	= '';
			
				
				if(!empty($check_existing_cart[0])){
					$cart_table_data = unserialize($check_existing_cart[0]['persistent_cart']);
					
					 $delivery_charge = get_delivery_charge_by_restaurant_ID($cart_table_data[0]['restaurant_id']);
					 $delivery_charge['delivery_charge'] = !empty($delivery_charge['delivery_charge'])? $delivery_charge['delivery_charge'] : 0;
					$coupon_code 	= $check_existing_cart[0]['coupon_code'];
				
					if(!empty($coupon_code)){
						$coupon_cond['conditions'] = array('coupon_code'=>$coupon_code,'status'=>1);
						$check_existing_coupon 	= $this->common_model->getRows('site_coupons',$coupon_cond);
					
						if(!empty($check_existing_coupon[0])){
							
							$coupon_code 		= $check_existing_coupon[0]['coupon_code'];
							$discount_type		= $check_existing_coupon[0]['dis_type'];
							$coupon_amount 		= $check_existing_cart[0]['coupon_amount'];
							$sub_total 			= $check_existing_cart[0]['total'];
							$cart_total 		= $check_existing_cart[0]['total_amount'];
							
							
							$get_usage_count 	= $check_existing_coupon[0]['get_usage_count'];
							$get_used_by 		= $check_existing_coupon[0]['get_used_by'];
							
							$new_get_usage_count = $get_usage_count + 1;
							if(!empty($get_used_by)){
								$new_get_used_by	 = $get_used_by.",".$user_id;
							}else{
								$new_get_used_by	 = $user_id;
							}
							
							$coupon_update['get_usage_count'] 	= $new_get_usage_count;
							$coupon_update['get_used_by'] 		= $new_get_used_by;
							
							$check_existing_coupon 	= $this->common_model->update_data('site_coupons',$coupon_update,array('coupon_code'=>$coupon_code));
							
						}
						 
					}else{
						$sub_total 	= $check_existing_cart[0]['total'];
						$cart_total = $check_existing_cart[0]['total'];
					} 
					
						 /* START get referral info */
					if(!empty($coupon_code) && $coupon_code == 'REFERRAL100') {
						
						$query				= $this->db->get_where('referrals_data', array('user_id' => $user_id));
						$get_referral_code	= $query->row_array();
						
						$earned_point = $get_referral_code['earn_point'] - 100 ;
						$update		  = $this->common_model->update_data('referrals_data',array('earn_point' => $earned_point), array('id' =>  $get_referral_code['id']));
					}
				 
					/* END get referral info */ 
					
					
					
				}
				 
				$cart_items = $cart_table_data;
				//$cart_total = $check_existing_cart[0]['total'];
			 
				$order_data['total_items'] 		= count($cart_items);
				$order_data['sub_total'] 		= $sub_total;
				$order_data['delivery_charge'] 	= $delivery_charge['delivery_charge'];
				$order_data['coupon_code'] 		= $coupon_code;
				$order_data['discount_type'] 	= $discount_type;
				$order_data['discount_amount'] 	= $coupon_amount;
				$order_data['order_total'] 		= $cart_total + $delivery_charge['delivery_charge'];
				$order_data['payment_method'] 	= $payment_method;
				$order_data['order_status'] 	= 'processing';
				$order_data['admin_commission'] = $admin_commission;
				$order_data['created_date'] 	= date('Y-m-d H:i:s');
				
				$order_data['commission_amount'] = ($order_data['order_total'] * $admin_commission) /100;
				$order_data['grand_total'] 		 = $order_data['order_total'] - $order_data['commission_amount'];

				if($user_id == 114 || $user_id == 3 || $user_id == 4 || $user_id == 8 || $user_id == 14 || $user_id == 30 || $user_id == 80 || $user_id == 180){

					$order_data['test_order']  = 1;
					$order_place = $this->common_model->add_data('orders',$order_data);
				}else{
					$order_place 					 =  $this->common_model->add_data('orders',$order_data);
				}
			 
				
				$order_id = $this->db->insert_id();
				if($order_id){
					if(!empty($cart_items)){
						foreach($cart_items as $items){
						
							$order_items['order_id'] 		= $order_id;
							$order_items['restaurant_id'] 	= $items['restaurant_id'];
							$order_items['food_menu_id'] 	= $items['food_menu_id'];
							$order_items['menu_name'] 		= !empty($items['menu_name'])? $items['menu_name']:'';
							$order_items['variation_id'] 	= $items['variation_id'];
							$order_items['variation_name'] 	= $items['variation_name'];
							$order_items['price'] 			= $items['price'];
							$order_items['qty'] 			= $items['qty'];
							$order_items['subtotal'] 		= $items['subtotal'];
							$order_items['created_date'] 	= date('Y-m-d H:i:s'); 
							$order_place = $this->common_model->add_data('order_items',$order_items);
						}
					}			
					if(strtolower($payment_method)=='cod'){
						/*'pending','processing','cancel_request','completed','refund_requested','refund_approved','refund_cancelled','cancelled','refunded','failed'*/
						
						$order_completed = $this->common_model->update_data('orders',array('order_status'=>'processing'),array('id'=>$order_id));
						
						if($order_completed){
							$this->common_model->delete_data('cart',array('user_id'=>$user_id));
						}
						
						$this->load->helper('email');
				
						order_confirmation($order_id,$user_id); // Sent Email to Customer
						order_confirmation_admin($order_id,$user_id); // Send Email to admin and restaurant
						
						/* Push notification */
						
						//Order placed successfully  for Customer 
						$notification_type='1';  
						push_notification($order_id,$user_id,$notification_type);
						 
						/* Push notification */
						
						/* if(!empty($order_data['shipping_phone']) && !empty($order_id)){
							$sms_message = 'Thank you for your order. Your Order ID is : #'.$order_id.'.';
							send_sms($order_data['shipping_phone'],$sms_message); //Commom Helper Function
						}*/
						 
						 $this->response([
								'status' => 1,
								'message' => 'Order received.',
								'data' => $order_id
							], REST_Controller::HTTP_OK);
					 
					}
					elseif(strtolower($payment_method)=='instamojo'){
						
						$order_completed = $this->common_model->update_data('orders',array('order_status'=>'pending'),array('id'=>$order_id));
						
						if($order_completed){
							$this->common_model->delete_data('cart',array('user_id'=>$user_id));
						}
						 
						$paymet_data['order_id']  = $order_id;
					  
						$paymet_data['paytm_link']  = base_url().'instamojo_pay/pay_api?order_id='.$order_id.'&user_id='.$user_id.'&amount='.$order_data['order_total'].'&name='.$customer_name.'&phone='.$address['phone'].'&email='.$address['email'];
						   
						$this->response([
								'status' => 1,
								'message' => 'Order received.',
								'data' => $paymet_data
							], REST_Controller::HTTP_OK); 
						//$this->load->view('paytm/pgRedirect',$paymet_data);
					}
					else{
						$order_completed = $this->common_model->update_data('orders',array('order_status'=>'pending'),array('id'=>$order_id));
							 
						if($order_completed){
							$this->common_model->delete_data('cart',array('user_id'=>$user_id));
						}
						
						$paymet_data['order_id']  = $order_id;
						$paymet_data['paytm_link']  = base_url().'paytm/payby_paytm?ORDER_ID='.$order_id.'&CUST_ID='.$user_id.'&TXN_AMOUNT='.$order_data['order_total'];
						   
						$this->response([
								'status' => 1,
								'message' => 'Order received.',
								'data' => $paymet_data
							], REST_Controller::HTTP_OK); 
						//$this->load->view('paytm/pgRedirect',$paymet_data);
					}
				}	  
			}
		}
		exit;
	}
	 
	public function payment_method_get() {
		   
			$payment_modes = $this->common_model->get_data_by_id(array('status' => 1),'payment_modes');
			if($payment_modes){
			   
				// Set the response and exit
				$this->response([
					'status' => 1,
					'message' => 'Get payment modes successfully.',
					'data' => $payment_modes
				], REST_Controller::HTTP_OK); 
			}
			else{
				// Set the response and exit
				//BAD_REQUEST (400) being the HTTP response code
				 $this->response([
					'status' => 0,
					'message' => 'No data found.',
					'data' => ''
				], REST_Controller::HTTP_BAD_REQUEST);
			}
		  
		 exit;
    }
  
	public function get_cart_count_post() {
	 
		$user_id = $this->input->post('user_id');
		
		if($user_id){
			$cart_item_count['cart_count'] = get_cart_count($user_id);
				if($cart_item_count){
					$this->response([
						'status' => 1,
						'message' => 'get cart count.',
						'data' => $cart_item_count
					], REST_Controller::HTTP_OK);
				}
				else{
					 $this->response([
					'status' => 0,
					'message' => 'No record found.',
					'data' => ''
					], REST_Controller::HTTP_BAD_REQUEST);
				}
		}
		else{
			 $this->response([
				'status' => 0,
				'message' => 'user_id is required.',
				'data' => ''
			], REST_Controller::HTTP_BAD_REQUEST);
		 }
		exit;
    }   
	
	public function bulk_add_to_cart_post(){
		
		$data = json_decode($this->post('data'));
		$order_data_array = $data->order_data_array;
			
		if(!empty($order_data_array)){
			 
			$user_id =  $order_data_array->user_id;
			
			$old_cart_data['conditions'] 	= array('user_id'=>$user_id);
			$old_cart_data['fields'] 		= 'persistent_cart';
			$old_cart_data['returnType'] 	= 'single';
			$check_existing_cart 			= $this->common_model->getRows('cart',$old_cart_data);
		
			if(!empty($check_existing_cart)){
				$cart_table_data = unserialize($check_existing_cart['persistent_cart']);
			}
			 
			$cartItems = $order_data_array->food_menu_data;
			
			$cart_data = array();
			$add_cart = array();
			$total = 0;
			foreach($cartItems as $cart){
				
				if(empty($cart_table_data)){
					 
					$add_cart['rowid'] 			= $cart->food_menu_id.$cart->variation_id;
					$add_cart['restaurant_id'] 	= $order_data_array->restaurant_id;
					$add_cart['food_menu_id'] 	= $cart->food_menu_id;
					$add_cart['menu_name'] 		= $cart->menu_name;
					$add_cart['variation_id'] 	= $cart->variation_id;
					$add_cart['variation_name'] 	= $cart->variation_name;
					$add_cart['price'] 			= $cart->price;
					$add_cart['qty']				= $cart->qty ;
					$add_cart['subtotal'] 		= $cart->subtotal;
			  
					$total += $cart->subtotal;
					$add_cart_array[] = $add_cart;
				}else{
					$rowid = $cart->food_menu_id.$cart->variation_id;
					
					$table_rowid = $this->search_cart($cart_table_data,'rowid',$rowid);
					
					if(($order_data_array->restaurant_id == $table_rowid['restaurant_id']) && (in_array($rowid,$cart_table_data))){
						
						$update_cart['rowid'] 			= $cart->food_menu_id.$cart->variation_id;
						$update_cart['restaurant_id'] 	= $order_data_array->restaurant_id;
						$update_cart['food_menu_id'] 	= $cart->food_menu_id;
						$update_cart['menu_name'] 		= $cart->menu_name;
						$update_cart['variation_id'] 	= $cart->variation_id;
						$update_cart['variation_name'] 	= $cart->variation_name;
						$update_cart['price'] 			= $cart->price;
						$update_cart['qty']				= $cart->qty + $cart_table_data[$table_rowid]['qty'];
						$update_cart['subtotal'] 		= $update_cart['qty'] * $update_cart['price'] ;
						
						$update_cart_array[] = $update_cart;
						
						$total += $update_cart['subtotal'];
						
					}else{
						
						$update_cart['rowid'] 			= $cart->food_menu_id.$cart->variation_id;
						$update_cart['restaurant_id'] 	= $order_data_array->restaurant_id;
						$update_cart['food_menu_id'] 	= $cart->food_menu_id;
						$update_cart['menu_name'] 		= $cart->menu_name;
						$update_cart['variation_id'] 	= $cart->variation_id;
						$update_cart['variation_name'] 	= $cart->variation_name;
						$update_cart['price'] 			= $cart->price;
						$update_cart['qty']				= $cart->qty ;
						$update_cart['subtotal'] 		= $cart->subtotal  ;
												
						$update_cart_array[] = $update_cart;
						
						$total += $update_cart['subtotal'];
					}
				}
			}
			 
			$insertItem =  '';
			if(!empty($add_cart_array)){
				
				$add_data['user_id'] 			= $user_id;
				$add_data['persistent_cart'] 	= serialize($add_cart_array);
				$add_data['total'] 				= $total;
				$add_data['updated_date'] 		= date('Y-m-d h:i:s');
				
				$insertItem = $this->common_model->add_data('cart',$add_data);
			}
			
			if(!empty($update_cart_array)){
				
				$update_data['persistent_cart'] 	= serialize($update_cart_array);
				$update_data['total'] 				= $total;
				$update_data['updated_date'] 		= date('Y-m-d h:i:s');
				
				$insertItem = $this->common_model->update_data('cart',$update_data,array('user_id'=>$user_id));
			}
			if($insertItem){
					// Set the response and exit
					$this->response([
						'status' => 1,
						'message' => 'Item added to cart successfully.',
						'data' => $insertItem
					], REST_Controller::HTTP_OK);
				}else{
					// Set the response and exit 
					 $this->response([
						'status' => 0,
						'message' => 'Something went wrong.',
						'data' => ''
					], REST_Controller::HTTP_BAD_REQUEST);
				} 
		}	
		 $this->response([
				'status' => 0,
				'message' => 'data is required.',
				'data' => ''
			], REST_Controller::HTTP_BAD_REQUEST);	
			 exit;
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
		
	public function check_shipping_address_post(){ 
	
		$address_id 	= $this->input->post('address_id');
		 
		if(!empty($address_id)){
			$address_postcode = $this->common_model->get_field_by_id('address_book','postcode',array('id' => $address_id));
			$shippings_area	  = $this->common_model->get_field_by_id('shippings_area','zipcode',array('zipcode' => $address_postcode));
		 
			if(empty($shippings_area) ){
				
				//$address_data['your_address'] 	  = $address_book;
				//$address_data['restaurant_address']	  = $kitchens;
			  
				$this->response([
					'status' => 0,
					'message' => "Sorry we can't delivered order in your shipping address. Please change your shipping address.",
					'data' => (object)[]
				], REST_Controller::HTTP_OK);
				
			}else{
					// Set the response and exit
					$this->response([
						'status' => 1,
						'message' => 'Order can shipped in your address.',
						'data' => (object)[]
					], REST_Controller::HTTP_OK);
				
			}
		}else{
			$this->response([
					'status' => 0,
					'message' => "address_id is required.",
					'data' => ''
				], REST_Controller::HTTP_BAD_REQUEST);
		}
		exit;
	}
	
	public function coupon_list_post(){
		
		$restaurant_id = $this->input->post('restaurant_id');
		$user_id = $this->input->post('user_id');
		
		if(!empty($restaurant_id))	{
		 
		$coupon_list = array();
		$get_coupons = $this->common_model->get_coupons($restaurant_id,$user_id);
		$cart_total = $this->common_model->get_field_by_id('cart','total_amount',array('user_id' => $user_id));
		if(!empty($get_coupons)){
			 
			
			foreach($get_coupons as $coupons){ 
				$coupon = coupon_check($coupons['coupon_code'], $cart_total,$user_id,$restaurant_id);
				
				if(!empty($coupon) && $coupon == $coupons['coupon_code']){
					$coupon_list[] = $coupons;
				}
			}   
		} 
		 
			if($coupon_list)	 {
				$this->response([
					'status' => 1,
					'message' => "Coupon List.",
					'data' => $coupon_list
				], REST_Controller::HTTP_OK);
			}
			else{
				$this->response([
					'status' => 0,
					'message' => 'No data found.',
					'data' => ''
				], REST_Controller::HTTP_BAD_REQUEST);
			} 
		} else{
			
			 $this->response([
				'status' => 0,
				'message' => 'restaurant_id is required.',
				'data' => ''
			], REST_Controller::HTTP_BAD_REQUEST);
			
		}
		exit; 
	} 
	
	public function apply_coupon_post(){
		 
		$user_id		= $this->input->post('user_id'); 
		$coupon_code 	= $this->input->post('coupon_code');
		$cart_total 	= $this->input->post('cart_total');
		$restaurant_id 	= $this->input->post('restaurant_id');
	  
		$req_field = ''; 
		
		foreach($_POST as $key=>$val){
			 
			if(empty($_POST[$key]) ){
				
				$req_field  = $key;
				break;
			}
		}  
 
		if(!empty($req_field)){
			
			$this->response([
                    'success' => 0,
                    'message' => $req_field.' is required.',
                    'data' => ''
                ], REST_Controller::HTTP_BAD_REQUEST);
				
		}else{
			
			$apply_coupon_response = apply_coupon($coupon_code,$cart_total,$user_id,$restaurant_id);
			 
			if($apply_coupon_response){
				
			
				$this->response([
					'status' => 1,
					'message' => "Coupon apply successfully.",
					'data' => $apply_coupon_response
				], REST_Controller::HTTP_OK);
			}
			else{
				$this->response([
                    'success' => 0,
                    'message' => 'Something went wrong.',
                    'data' => ''
                ], REST_Controller::HTTP_BAD_REQUEST);
			} 
		} 
		exit; 
	} 
 
	function remove_coupon_post(){
		
		$user_id		= $this->input->post('user_id');  
		$cart_total 	= $this->input->post('cart_total'); 
	    $delivery_fees 	= $this->input->post('delivery_fees'); 
		$delivery_fees  = !empty($delivery_fees) ? $delivery_fees: 0;
		  
		$req_field = ''; 
		
		foreach($_POST as $key=>$val){
			 
			if(empty($_POST[$key]) ){
					if($key == 'delivery_fees' ){ 	// delivery_fees  is not required
					continue;
				}
				else{ 
					$req_field  = $key;
					break;
				}
			}
		}  

		if(!empty($req_field)){
			
			$this->response([
                    'status' => 0,
                    'message' => $req_field.' is required.',
                    'data' => ''
                ], REST_Controller::HTTP_BAD_REQUEST);
				
		}else{
			$cart_data['coupon_code'] =  '';
			$cart_data['coupon_amount'] = '';
			$cart_data['total_amount'] = $cart_total + $delivery_fees; 
			$remove_coupon_response = $this->common_model->update_data('cart',$cart_data,array('user_id'=>$user_id));
			 
			if($remove_coupon_response){
				
				$this->response([
					'status' => 1,
					'message' => "Coupon code remove Successfully.",
					'data' => $cart_data['total_amount']
				], REST_Controller::HTTP_OK);
				 
			}
			else{
				$this->response([
                    'status' => 0,
                    'message' => 'Something went wrong.',
                    'data' => (object)[]
                ], REST_Controller::HTTP_BAD_REQUEST);
			}
		} 
		exit;
	} 
	
	function cancel_order_post(){
		 
	    $order_id 	= $this->input->post('order_id'); 
		  
		if(empty($order_id)){
			
			$this->response([
                    'status' => 0,
                    'message' => 'order_id is required.',
                    'data' => ''
                ], REST_Controller::HTTP_BAD_REQUEST);
				
		}else{
			
			
			$old_cart_data['conditions'] 	= array('id'=>$order_id);
			$old_cart_data['fields'] 		= 'order_status';
			$old_cart_data['returnType'] 	= 'single';
			$check_existing_status 			= $this->common_model->getRows('orders',$old_cart_data);
			
			 $cancel_order = '';
			$status_arr = array('pending', 'processing', 'Waiting for Acceptance');
			if(in_array($check_existing_status['order_status'], $status_arr)){
				$cancel_order = $this->common_model->update_data('orders',array('order_status' => 'Cancelled'),array('id'=>$order_id));	
			} 
			 
			if(!empty($cancel_order)){
				
				$this->response([
					'status' => 1,
					'message' => "Cancel order Successfully.",
					'data' => $cancel_order
				], REST_Controller::HTTP_OK);
				 
			}
			else{
				$this->response([
                    'status' => 0,
                    'message' => 'Something went wrong.',
                    'data' => (object)[]
                ], REST_Controller::HTTP_BAD_REQUEST);
			}
		} 
		exit;
	}  
}
	