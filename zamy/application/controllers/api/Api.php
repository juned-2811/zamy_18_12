<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

// Load the Rest Controller library
require APPPATH . '/libraries/REST_Controller.php';

class Api extends REST_Controller {

    public function __construct() { 
        parent::__construct();
        
        // Load the user model
		$this->load->model('api/Api_model','api_model');
		$this->load->model('common_model');
		$this->load->helper('paytm');
		 
    }
   
	public function dasboard_api_post(){
		
		$user_id = $this->input->post('user_id');
		
		$data['cart_count'] = get_cart_count($user_id);
		
		$limit = 10; 
		$data['top_restaurant_list'] = get_top_restaurant($limit);
		
		/********** Inactive restaurant show only for attune *********/
		 if(!empty($user_id)){
				$old_cart_data['conditions'] 	= array('id'=>$user_id);
				$old_cart_data['fields'] 		= 'email';
				$old_cart_data['returnType'] 	= 'single';
				$cust_email 			= $this->common_model->getRows('online_customer',$old_cart_data);
			  
			  $email = EMAIL;
			if(in_array($cust_email['email'],$email)){
				 
				 
				$this->db->select('kitchens.id,kitchens.res_name,kitchens.res_alias,kitchens.logo,kitchens.images,kitchens.landmark,kitchens.area, kitchens.approx_delivery_time,kitchens.approx_cost,kitchens.service_type,count(orders.id) as total_orders,count(orders.restaurant_id) as total_restaurant_orders');
				$this->db->from('kitchens');
				$this->db->join('orders', 'orders.restaurant_id = kitchens.id','left');
				 
				$this->db->group_by("kitchens.id");
				$this->db->order_by('total_orders','DESC');
				$this->db->where('kitchens.id',55);
				$inactive_restaurant = $this->db->get()->result_array();
					  
				$data['top_restaurant_list'] = array_merge($inactive_restaurant,$data['top_restaurant_list']); 
			}
				
		}
	
		/******* Inactive restaurant show only for attune ************/

		
		array_walk($data['top_restaurant_list'], function (&$value, $key) {
		   $value['images'] = $this->config->item('restaurant_image_url').$value['images'];
		   $value['logo'] = $this->config->item('pos_restaurant_logo').$value['logo'];
		}); 
		
		$restaurant_id = 3;
		$data['fav_food_list'] = $this->common_model->fav_food_enjoy($restaurant_id,$limit); 
		array_walk($data['fav_food_list'], function (&$value, $key) {
		   $value['menu_logo'] = $this->config->item('foodMenu_image_url').$value['menu_logo'];
		   $value['kitchen_image'] = $this->config->item('restaurant_image_url').$value['kitchen_image'];
		}); 
		 
		$category_param = array(
						'condition' => array('cat_status',1),
						'start' => 0,
						'limit' => 10,
						'fields' => 'cat_id,cat_name,cat_display_name,cat_logo'
						);
		$data['category_list']  = $this->common_model->getRows('food_category',$category_param);
		array_walk($data['category_list'], function (&$value, $key) {
			$value['cat_logo'] = $this->config->item('foodCategory_image_url').$value['cat_logo'];
		});
		
		
		$popular_this_month = populer_this_month_food('',$limit); 
	 		
		$i =0; 
		foreach($popular_this_month as $row){
		 
		  $in_cart = 'no';
		  $variation_id = '';
			if(isset($user_id) && !empty($user_id)){
				$old_cart_data['conditions'] 	= array('user_id'=>$user_id);
				$old_cart_data['fields'] 		= 'persistent_cart';
				$old_cart_data['returnType'] 	= 'single';
				$check_existing_cart 			= $this->common_model->getRows('cart',$old_cart_data);
					 $food_menu_id  = array(); $variation_id =array();
				if(!empty($check_existing_cart)){
					$cart_table_data = unserialize($check_existing_cart['persistent_cart']);
				
					$food_menu_id = array_column($cart_table_data, 'food_menu_id');
					$variation_id = array_column($cart_table_data, 'variation_id');
					
					if(in_array( $row['food_menu_id'], $food_menu_id )){
						$in_cart = 'yes'; 
					} 
				} 
			}
			 
			$choice = explode(',', $row['choice']); 
			$food_type = '1'; //For veg
			if(in_array('2',$choice) || in_array('18',$choice)){   

				$food_type = '2';  //For non-veg
			} 
			$menu_name = get_food_menu($row['food_menu_id']);
		 
			$data['popular_this_month'][$i]['res_name'] 	= $row['res_name'];
			$data['popular_this_month'][$i]['food_menu_id'] = $row['food_menu_id'];
			$data['popular_this_month'][$i]['kitchen_id'] 	= $row['id'];
			$data['popular_this_month'][$i]['images'] 		= $this->config->item('foodMenu_image_url').$row['menu_logo'];
			$data['popular_this_month'][$i]['landmark'] 	= $row['landmark'];
			$data['popular_this_month'][$i]['area'] 		= $row['area'];
			$data['popular_this_month'][$i]['menu_name'] 	= $menu_name['menu_name'];
			$data['popular_this_month'][$i]['short_code'] 	= $menu_name['short_code'];
			$data['popular_this_month'][$i]['price'] 		= $menu_name['price'];
			$data['popular_this_month'][$i]['food_type'] 	= $food_type;
			$data['popular_this_month'][$i]['cart'] 		= $in_cart;
			$data['popular_this_month'][$i]['variation_product'] = 'no';
			$variance = $this->api_model->get_food_menu_variance($row['food_menu_id']);
			 
			$variation_result = array();
			if(!empty($variance)){
			  $variation_price 		= array_column($variance , 'vprice');
			  $variation_sale_price = array_column($variance, 'vreduced_price');
				  
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
				$data['popular_this_month'][$i]['price'] = $vminprice.'-'.$vmaxprice;   
				
				$total_tax    = get_gst($row['id'],'total_tax');
				foreach($variance as $var){
					
					$vprice = (!empty($var['vreduced_price']) && $var['vreduced_price'] != '0.00')? $var['vreduced_price'] : $var['vprice'];				
					$vtax_price = $vprice - (($vprice * $total_tax['total_tax']) / 100);  
					$variation_data = array();
					$variation_data['variation_id'] = $var['id'];
					$variation_data['variation_name'] = $var['name'];
					$variation_data['variation_price'] = $var['vprice'];
					$variation_data['variation_sale_price'] = $var['vreduced_price'] ;
					$variation_data['tax_price'] 	   = $vtax_price;
					$variation_data['cart_variation_id']  = 'no';
					
					if(!empty($variation_id) && in_array( $var['id'], $variation_id )){ 
						$variation_data['cart_variation_id'] = 'yes';
						
					} 
					$data['popular_this_month'][$i]['variation_product'] = "yes";
					$variation_result[] = $variation_data; 
				}
			}else{ 
					$variation_result  = array();
				} 
				$data['popular_this_month'][$i]['product_variation'] = $variation_result; 
			$i++;	
			}  
 		 
		/////////////
		if($data){
			// Set the response and exit
			$this->response([
				'status' => 1,
				'message' => 'success',
				'data' => $data
			], REST_Controller::HTTP_OK);
		}else{
			// Set the response and exit
			//BAD_REQUEST (400) being the HTTP response code
			 $this->response([
				'status' => 0,
				'message' => 'Data not found.',
				'data' => ''
			], REST_Controller::HTTP_BAD_REQUEST);
		}
		exit;
	}
	 
	public function category_post() {
		$restaurant_id	= $this->input->post('restaurant_id');
		$pageno			= $this->input->post('pageno');
	
		if (isset($pageno)) {
			$pageno = $pageno;
		} else {
			$pageno = 1;
		}
		  
		if(!empty($restaurant_id)){
 
			$offset	='0'; 
			$limit 	= 10;
			$offset = ($pageno-1) * $limit; 
			$data_set['conditions']= array('restaurant_id'=>$restaurant_id); 
			$data_set['returnType']= 'count'; 
			$total_rows			= $this->common_model->getRows('food_category',$data_set);
			$result['total_rows'] = $total_rows;
			$result['total_pages']= ceil($total_rows / $limit); 
			   
			$data = array( 'conditions' => array('restaurant_id'=>$restaurant_id),
							'start'		=> $offset,
							'limit'		=> $limit
						); 
						
			$category_list = $this->common_model->getRows('food_category',$data);
			
			$result['category_list'] = !empty($category_list) ? $category_list : '' ;
			array_walk($result['category_list'], function (&$value, $key) {
			   $value['cat_logo'] = $this->config->item('foodCategory_image_url').''.$value['cat_logo'];
			});
			if($result){
                // Set the response and exit
                $this->response([
                    'status' => 1,
                    'message' => 'Get Category list successful.',
                    'data' => $result
                ], REST_Controller::HTTP_OK);
            }else{
                // Set the response and exit
                //BAD_REQUEST (400) being the HTTP response code
				 $this->response([
                    'status' => 0,
                    'message' => 'Wrong restaurant_id.',
                    'data' => ''
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
		}else{
			 // Set the response and exit
			$this->response([
                    'status' => 0,
                    'message' => 'restaurant_id is required.',
                    'data' => ''
                ], REST_Controller::HTTP_BAD_REQUEST);
		}
		exit;
    }
	
	public function menu_post() {
		$restaurant_id 			= $this->post('restaurant_id');
		$cat_id 			= $this->post('cat_id');
		$search_products 	= $this->post('keywords');
	
		if(!empty($restaurant_id)){
			 
			if(!empty($cat_id)){
				$data['conditions']= array('restaurant_id'=>$restaurant_id,'cat_id'=>$cat_id,'menu_available'=>1);
			}else if(!empty($search_products)){
				$data['conditions']= array('restaurant_id'=>$restaurant_id,'menu_available'=>1);
				$data['like']= array('menu_name'=>$search_products);
			}else{
				$data['conditions']= array('restaurant_id'=>$restaurant_id,'menu_available'=>1);
			}
			$data['fields'] = array('foodmenu_id','cat_id','menu_name','menu_logo','choice','long_description','price','reduced_price','container_charges','minimum_preparation_time');
			
			$menu = $this->common_model->getRows('foodmenu',$data);
		
			$data=array();
			$product_data=array();
			$total_tax = get_gst($restaurant_id,'total_tax');
			$i = 0;
			foreach($menu as $row){
				
				$choice = explode(',', $row['choice']); 
				$food_type = '1'; //For veg
				if(in_array('2',$choice)){   

					$food_type = '2';  //For non-veg
				}
				$price = (!empty($row['reduced_price']) && $row['reduced_price'] != '0.00')? $row['reduced_price'] : $row['price'];				 
				
				$tax_price = $price - (($price * $total_tax['total_tax']) / 100);  
				
				$data['menu'][$i]['foodmenu_id']= $row['foodmenu_id'];
				$data['menu'][$i]['cat_id'] 	= $row['cat_id'];
				$data['menu'][$i]['menu_name'] 	= $row['menu_name'];
				$data['menu'][$i]['menu_logo']	= $this->config->item('foodMenu_image_url').$row['menu_logo'];
				$data['menu'][$i]['long_description'] = $row['long_description'];
				$data['menu'][$i]['price'] = round($row['price'],0);
				$data['menu'][$i]['reduced_price'] = round($row['reduced_price']);
				$data['menu'][$i]['tax_price'] 	   = $tax_price;
				$data['menu'][$i]['container_charges'] = round($row['container_charges']);
				$data['menu'][$i]['minimum_preparation_time'] = $row['minimum_preparation_time'].' min';
				$data['menu'][$i]['food_type'] = $food_type;
				$variance = $this->api_model->get_food_menu_variance($row['foodmenu_id']);
				
				$variation_result  = array();
				if(!empty($variance)){
					
					foreach($variance as $var){
						$vprice = (!empty($var['vreduced_price']) && $var['vreduced_price'] != '0.00')? $var['vreduced_price'] : $var['vprice'];				
						$vtax_price = $vprice - (($vprice * $total_tax['total_tax']) / 100);  
						$variation_data = array();
						$variation_data['variation_id'] = $var['id'];
						$variation_data['variation_name'] = $var['name'];
						$variation_data['variation_price'] = $var['vprice'];
						$variation_data['variation_sale_price'] = $var['vreduced_price'] ;
						$variation_data['tax_price'] 	   = $vtax_price;
						$variation_result[] = $variation_data;
					}
				}
				else{
					/*$variation_result = '';*/
					$variation_result  = array();
				}
					
				$data['menu'][$i]['product_variation'] = $variation_result;
				$i++;	
			}
					
			if($data){
                // Set the response and exit
                $this->response([
                    'status' => 1,
                    'message' => 'Get Menu list successful.',
                    'data' => $data
                ], REST_Controller::HTTP_OK);
            }else{
                // Set the response and exit
                //BAD_REQUEST (400) being the HTTP response code
				 $this->response([
                    'status' => 0,
                    'message' => 'Data not found.',
                    'data' => ''
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
		}else{
			 // Set the response and exit
			$this->response([
                    'status' => 0,
                    'message' => 'user_id is required.',
                    'data' => ''
                ], REST_Controller::HTTP_BAD_REQUEST);
		}
		exit;
    }
	 
	public function add_remove_favourite_restaurant_post() {
		
		$restaurant_id = $this->post('restaurant_id');
		$user_id 	   = $this->post('user_id');
		 
		 if(!empty($restaurant_id) && !empty($user_id)){
				
			$check_fields = array(
				'restaurant_id'	=> $restaurant_id,
				'user_id'	=> $user_id
			); 
			$res_data['conditions'] = $check_fields;
			$check_entry = $this->common_model->getRows('fav_restaurants',$res_data);
			
			if(!empty($check_entry)){
				$result = $this->common_model->delete_data('fav_restaurants',$check_fields);
				$msg = 'restaurant removed Successfully';
			}else{
				$result = $this->common_model->add_data('fav_restaurants',$check_fields);
				$msg = 'restaurat Added Successfully';
			}
			if($result){  
                // Set the response and exit
                $this->response([
                    'status' => 1,
                    'message' => $msg,
                    'data' => $result
                ], REST_Controller::HTTP_OK);
            }else{
                // Set the response and exit
                //BAD_REQUEST (400) being the HTTP response code
				 $this->response([
                    'status' => 0,
                    'message' => 'Wrong restaurant_id & user_id.',
                    'data' => ''
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
		 }
		 else{
			 // Set the response and exit
			$this->response([
                    'status' => 0,
                    'message' => 'restaurant_id & user_id is required.',
                    'data' => ''
                ], REST_Controller::HTTP_BAD_REQUEST);
		} 
		exit;
    }
	
	public function get_favourite_restaurant_post() {
		 
		$user_id = $this->input->post('user_id');
		 if (isset($_POST['pageno'])) {
			$pageno = $_POST['pageno'];
		} else {
			$pageno = 1;
		}
		 
		if(!empty($user_id)){
			 $offset	='0'; 
			$limit 	= 10;
			$offset = ($pageno-1) * $limit; 
			$total_row='total_row';
			 
			$total_rows			= $this->api_model->get_favourite_restaurant($user_id,$limit,$offset,$total_row); 
			$data['total_rows'] = $total_rows; 
			$data['total_pages']= ceil($total_rows / $limit); 
			$data['list']  = $this->api_model->get_favourite_restaurant($user_id,$limit,$offset);
			 
			if($data){
                // Set the response and exit
                $this->response([
                    'status' => 1,
                    'message' => 'success',
                    'data' => $data
                ], REST_Controller::HTTP_OK);
            }else{
                // Set the response and exit
                //BAD_REQUEST (400) being the HTTP response code
				 $this->response([
                    'status' => 0,
                    'message' => 'No data found.',
                    'data' => ''
                ], REST_Controller::HTTP_OK);
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
	
	public function top_restaurant_list_post(){
		
		if (isset($_POST['pageno'])) {
			$pageno = $_POST['pageno'];
		} else {
			$pageno = 1;
		}
		$offset	='0'; 
		$limit 	= 10;
		$offset = ($pageno-1) * $limit; 
		$total_row='total_row';
			
		$total_rows			= get_top_restaurant($limit,$offset,$total_row); 
		$data['total_rows'] = $total_rows;
		$data['total_pages']= ceil($total_rows / $limit); 
		
		$data['top_restaurant_list']  = get_top_restaurant($limit,$offset);  
		 array_walk($data['top_restaurant_list'], function (&$value, $key) {
		   $value['images'] = $this->config->item('restaurant_image_url').$value['images'];
		    $value['logo'] = $this->config->item('pos_restaurant_logo').$value['logo'];
		});
		$i=0;
		   
		foreach($data['top_restaurant_list'] as $row){
			
			$total_fav_count =  $this->api_model->fav_restaurant_count($row['id']);
			$data['top_restaurant_list'][$i]['total_fav_count']   =$total_fav_count['count']; 
			$i++; 
		}
		 
		if($data){
			// Set the response and exit
			$this->response([
				'status' => 1,
				'message' => 'success',
				'data' => $data
			], REST_Controller::HTTP_OK);
		}else{
			// Set the response and exit
			//BAD_REQUEST (400) being the HTTP response code
			 $this->response([
				'status' => 0,
				'message' => 'Data not found.',
				'data' => ''
			], REST_Controller::HTTP_BAD_REQUEST);
		}
		exit;
	}
	
	public function restaurant_category_menu_post()	{
		
		$restaurant_id		= $this->post('restaurant_id'); 
		$search_products	= $this->post('keywords');
		$pageno				= $this->post('pageno'); 
		$user_id			= $this->post('user_id'); 
		$veg_item			= $this->post('veg_item'); 
		$pageno = isset($pageno) ? $pageno: 1;
		 
		if(!empty($restaurant_id)){
			
			/*********** RESTAURANT DETAILS ARRAY**********/
			$data = array('conditions' => array('id'=>$restaurant_id), 
						  'fields'	=> 'res_name, email, logo, print_logo, images,address, area,landmark, zipcode, additional_info,owner_contact_number,contact_information', 
						); 
			 
			$restaurant_details = $this->common_model->getRows('kitchens',$data); 
			
			$restaurant_favorite = 'no';		
	 
			if(isset($user_id) && !empty($user_id)){
				$favourite_restaurant = $this->api_model->get_favourite_restaurant($user_id);
				
				$favourite_restaurant_id = array_column($favourite_restaurant, 'id');
				
				if(!empty($favourite_restaurant) && in_array( $restaurant_id, $favourite_restaurant_id )){
						$restaurant_favorite = 'yes';
					} 
			} 	
			
			array_walk($restaurant_details, function (&$value, $key) {
				 
				$value['images'] = $this->config->item('restaurant_image_url').$value['images']; 
			}); 
			 
			$restaurant_details[0]['additional_info'] =trim(preg_replace('/\s\s+/', ' ', $restaurant_details[0]['additional_info']));
			$data_arr['restaurant_details']   = $restaurant_details[0] ;
			$data_arr['restaurant_details']['restaurant_favorite'] = $restaurant_favorite;
			
			/*********** RESTAURANT DETAILS ARRAY**********/
			
			/*********** CATAGORY LIST ARRAY**********/
			
			$limit 					= 10; 
			$offset 				= ( $pageno - 1) * $limit;  
			$data_set['conditions'] = array('restaurant_id'=>$restaurant_id); 
			$data_set['returnType'] = 'count'; 
			$total_rows				= $this->common_model->getRows('food_category',$data_set);
			$data_arr['total_rows'] = $total_rows;
			$data_arr['total_pages']= ceil($total_rows / $limit); 
			   
			$data = array( 'conditions' => array('restaurant_id'=>$restaurant_id, 'is_deleted' => 0 ),
							//'start'		=> $offset,
							//'limit'		=> $limit,
							//'like'		=> array('cat_name' => $search_products)
						); 
			 
			$category_list = $this->common_model->getRows('food_category',$data);
			   
			/*********** CATAGORY LIST ARRAY**********/
			if(!empty($category_list)){
				$j = 0;
				foreach($category_list as $cat){
					
					/*********** MENU ARRAY**********/
					
					if(!empty($search_products) && !empty($cat['cat_id']) ){
						$data_menu['conditions'] = array('restaurant_id'=>$restaurant_id,'cat_id'=>$cat['cat_id'],'menu_available'=>1, 'is_deleted'=> 0, 'menu_status' => 1);
						$data_menu['like'] = array('menu_name'=>$search_products);
					} 
					elseif(!empty($cat['cat_id'])){
						$data_menu['conditions']= array('restaurant_id'=>$restaurant_id,'cat_id'=>$cat['cat_id'],'menu_available'=>1, 'is_deleted'=> 0, 'menu_status' => 1);
					}
					elseif(!empty($search_products)){
						$data_menu['conditions'] = array('restaurant_id'=>$restaurant_id,'menu_available'=>1, 'is_deleted'=> 0, 'menu_status' => 1);
						$data_menu['like'] = array('menu_name'=>$search_products);
					}else{
						$data_menu['conditions'] = array('restaurant_id'=>$restaurant_id,'menu_available'=>1, 'is_deleted'=> 0, 'menu_status' => 1);
					}
					
					if(!empty($veg_item)){
						$data_menu['where'] =  "!FIND_IN_SET ('2', choice) and !FIND_IN_SET ('18', choice)";
					}
					
					$data_menu['fields'] = array('foodmenu_id','cat_id','menu_name','menu_logo','choice','short_code','long_description','price','reduced_price','container_charges','minimum_preparation_time');
					  
					$menu = $this->common_model->getRows('foodmenu',$data_menu);
					//echo $this->db->last_query();
					
					/*********** MENU ARRAY**********/
					
					$data = array();
					$product_data = array();
					$total_tax    = get_gst($restaurant_id,'total_tax');
					$i = 0;
					
					$data_arr['category'][$j]['cat_id'] 	= $cat['cat_id'];
					$data_arr['category'][$j]['cat_name'] = $cat['cat_name'];
					$data_arr['category'][$j]['cat_display_name'] = $cat['cat_display_name'];
					$data_arr['category'][$j]['cat_logo'] = $this->config->item('foodCategory_image_url').$cat['cat_logo'];
					
					if(!empty($menu)){
						  
						foreach($menu as $row){
						 	 
							$in_cart = 'no';
						  $variation_id = '';
							if(isset($user_id) && !empty($user_id)){
								$old_cart_data['conditions'] 	= array('user_id'=>$user_id);
								$old_cart_data['fields'] 		= 'persistent_cart';
								$old_cart_data['returnType'] 	= 'single';
								$check_existing_cart 			= $this->common_model->getRows('cart',$old_cart_data);
									 $food_menu_id  = array(); $variation_id =array();
								if(!empty($check_existing_cart)){
									$cart_table_data = unserialize($check_existing_cart['persistent_cart']);
								
									$food_menu_id = array_column($cart_table_data, 'food_menu_id');
									$variation_id = array_column($cart_table_data, 'variation_id');
									
									if(in_array( $row['foodmenu_id'], $food_menu_id )){
										$in_cart = 'yes'; 
									}
									
								} 
							}
							 
							$choice = explode(',', $row['choice']); 
							$food_type = '1'; //For veg
							if(in_array('2',$choice) || in_array('18',$choice)){   

								$food_type = '2';  //For non-veg
							}
							$price = (!empty($row['reduced_price']) && $row['reduced_price'] != '0.00')? $row['reduced_price'] : $row['price'];				 
							
							$tax_price = $price - (($price * $total_tax['total_tax']) / 100);  
							
							$data['menu'][$i]['foodmenu_id']= $row['foodmenu_id'];
							$data['menu'][$i]['cat_id'] 	= $row['cat_id'];
							$data['menu'][$i]['menu_name'] 	= $row['menu_name'];
							$data['menu'][$i]['menu_logo']	= $this->config->item('foodMenu_image_url').$row['menu_logo'];
							$data['menu'][$i]['long_description'] = $row['short_code'];
							$data['menu'][$i]['choice'] 	= $row['choice'];
							$data['menu'][$i]['price'] = round($row['price'],0);
							$data['menu'][$i]['reduced_price'] = round($row['reduced_price']);
							$data['menu'][$i]['tax_price'] 	   = $tax_price;
							$data['menu'][$i]['container_charges'] = round($row['container_charges']);
							$data['menu'][$i]['minimum_preparation_time'] = $row['minimum_preparation_time'].' min';
							$data['menu'][$i]['food_type'] = $food_type;
							$data['menu'][$i]['cart'] = $in_cart;
							 
							//$data['menu'][$i]['cart_variation_id'] = $in_cart_variation_id;
							$data['menu'][$i]['variation_price'] = '';
							$variance = $this->api_model->get_food_menu_variance($row['foodmenu_id']);
					
							$variation_result  = array();
							if(!empty($variance)){
							  
							  $variation_price = array_column($variance , 'vprice');
							  $variation_sale_price = array_column($variance, 'vreduced_price');
								 
								
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
								$data['menu'][$i]['variation_price'] = $vminprice.'-'.$vmaxprice;
							  
								foreach($variance as $var){
									$vprice = (!empty($var['vreduced_price']) && $var['vreduced_price'] != '0.00')? $var['vreduced_price'] : $var['vprice'];				
									$vtax_price = $vprice - (($vprice * $total_tax['total_tax']) / 100);  
									$variation_data = array();
									$variation_data['variation_id'] = $var['id'];
									$variation_data['variation_name'] = $var['name'];
									$variation_data['variation_price'] = $var['vprice'];
									$variation_data['variation_sale_price'] = $var['vreduced_price'] ;
									$variation_data['tax_price'] 	   = $vtax_price;
									$variation_data['cart_variation_id']  = 'no';
									if(!empty($variation_id) && in_array( $var['id'], $variation_id )){ 
										$variation_data['cart_variation_id'] = 'yes';
									} 
									$variation_result[] = $variation_data; 
								}
							}
							else{ 
								$variation_result  = array();
							}
							 
							$data['menu'][$i]['product_variation'] = $variation_result;
							$i++;	
						} 
							$data_arr['category'][$j]['menu'] = $data['menu']; 
					}
					else{
						
						$data_arr['category'][$j]['menu'] = array();
					} 
					$j++;	
				}
				
			}else{
				$data_arr['category']  = array();
				$data_arr['category'][]['menu'] = array();
			}
			 
			if($data_arr){
                // Set the response and exit
                $this->response([
                    'status' => 1,
                    'message' => 'Get Menu list successful.',
                    'data' => $data_arr
                ], REST_Controller::HTTP_OK);
            }else{
                // Set the response and exit
                //BAD_REQUEST (400) being the HTTP response code
				 $this->response([
                    'status' => 0,
                    'message' => 'Data not found.',
                    'data' => ''
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
		}else{
			 // Set the response and exit
			$this->response([
                    'status' => 0,
                    'message' => 'restaurant_id is required.',
                    'data' => ''
                ], REST_Controller::HTTP_BAD_REQUEST);
		}
		exit;
      
    }  
	 
	public function get_customer_order_list_post() {
		 
		$user_id = $this->input->post('user_id');
		if (isset($_POST['pageno'])) {
			$pageno = $_POST['pageno'];
		} else {
			$pageno = 1;
		}  
		 if(!empty($user_id)){
			$offset	='0';  
			$limit 	= 10;
			$offset = ($pageno-1) * $limit; 
			$total_row='total_row';
				
			$total_rows			  = $this->api_model->get_customer_order_list($user_id,$limit,$offset,$total_row); 
			
			$result['total_rows'] = $total_rows;
			$result['total_pages']= ceil($total_rows / $limit); 	 
				  
			$result['list'] = $this->api_model->get_customer_order_list($user_id,$limit,$offset);	 
			 
			array_walk($result['list'], function (&$value, $key) {
				 
				$value['images'] = $this->config->item('restaurant_image_url').$value['images']; 
				 $value['logo'] = $this->config->item('pos_restaurant_logo').$value['logo'];
			}); 
			if($result){
                // Set the response and exit
                $this->response([
                    'status' => 1,
                    'message' => 'Get order List.',
                    'data' => $result
                ], REST_Controller::HTTP_OK);
            }else{
                // Set the response and exit
                //BAD_REQUEST (400) being the HTTP response code
				 $this->response([
                    'status' => 0,
                    'message' => 'Wrong user_id.',
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
	 
	public function get_order_detail_post() {
		 
		$order_id = $this->input->post('order_id');
		 
		 if(!empty($order_id)){
				 
			$result = $this->api_model->get_order_detail($order_id);
			 
			if($result){
                // Set the response and exit
                $this->response([
                    'status' => 1,
                    'message' => 'Get order Details.',
                    'data' => $result
                ], REST_Controller::HTTP_OK);
            }else{ 
                // Set the response and exit
                //BAD_REQUEST (400) being the HTTP response code
				 $this->response([
                    'status' => 0,
                    'message' => 'Wrong order_id.',
                    'data' => ''
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
		 }
		 else{
			 // Set the response and exit
			$this->response([
                    'status' => 0,
                    'message' => 'order_id is required.',
                    'data' => ''
                ], REST_Controller::HTTP_BAD_REQUEST);
		}
		exit;
    }
	 
	public function contact_us_post() {
		 
		$name 	 = $this->input->post('name'); 
		$email	 = $this->input->post('email'); 
		$subject = $this->input->post('subject'); 
		$msg 	 = $this->input->post('msg'); 
		$req_field = ''; 
		foreach($_POST as $key=>$val){
			 
			if(empty($_POST[$key]) ){
				
				/*if($key == 'name' ){ 
														// name is not required
					continue;
				}else{ */
					$req_field  = $key;
					break;
				//}
			}
		} 
		if(!empty($req_field)){
			$this->response([
                    'status' => 0,
                    'message' => $req_field.' is required.',
                    'data' => ''
                ], REST_Controller::HTTP_BAD_REQUEST);
		}
		else{
			 
			$data =  array(
						'name' 		=> $name,
						'email' 	=> $email ,
						'subject' 	=> $subject,
						'msg' 		=> $msg,
						'status'	=> 1
					);
			$insert 		= $this->common_model->add_data('contact_us',$data);
			$contact_us_id 	= $this->db->insert_id();
		  	$contact_us 	= $this->common_model->get_data_by_id(array('id' => $contact_us_id),'contact_us');
			if($contact_us){
				$this->response([
				'status' => 1,
				'message' => 'Thanks for connectiong us! We will bein touch with you shortly.',
				'data' => $contact_us
				], REST_Controller::HTTP_OK);
			}else{
				// Set the response and exit
				//BAD_REQUEST (400) being the HTTP response code
				 $this->response([
					'status' => 0,
					'message' => 'No record found.',
					'data' => ''
				], REST_Controller::HTTP_BAD_REQUEST);
			}   
		}
		exit;
    }  
	 
	public function order_tracking_post(){
		
		$order_id = $this->input->post('order_id');
		if(!empty($order_id)){
			$data['order']  = get_delivery_boy_latlong($order_id);
 			if($data['order']){
			// Set the response and exit
				$this->response([
					'status' => 1,
					'message' => 'success',
					'data' => $data
				], REST_Controller::HTTP_OK);
			}else{
				// Set the response and exit
				//BAD_REQUEST (400) being the HTTP response code
				 $this->response([
					'status' => 0,
					'message' => 'Data not found.',
					'data' => ''
				], REST_Controller::HTTP_BAD_REQUEST);
			}
		}
		else{
			// Set the response and exit
			//BAD_REQUEST (400) being the HTTP response code
			 $this->response([
				'status' => 0,
				'message' => 'order_id is required.',
				'data' => ''
			 ], REST_Controller::HTTP_BAD_REQUEST);
		} 
		exit;
	}
	
	public function search_restaurant_dish_post()	
	{
		$search_products	= $this->post('search_keyword');
		$pageno				= $this->post('pageno'); 
		$pageno = isset($pageno) ? $pageno: 1;
		  
		if(!empty($search_products)){
		 
			$offset		= '0';  
			$limit 		= 10;
			$offset 	= ($pageno-1) * $limit; 
			$total_row	= 'total_row';
				
			$total_rows			= $this->api_model->search_restaurant_dish($search_products,$limit,$offset,$total_row);  
			$restaurant_details	= $this->api_model->search_restaurant_dish($search_products,$limit,$offset);
			
			$data_arr = array();
			 	if(!empty($restaurant_details)){
				$j = 0;
				foreach($restaurant_details as $res){
					 
					if(!empty($restaurant_details) && !empty($search_products)){
						$data['conditions'] = array('restaurant_id'=> $res['id'] ,'menu_available'=>1);
						//$data['like'] 		= array('menu_name'=>$search_products);
					}
					elseif(!empty($search_products)){
						$data['conditions'] = array('restaurant_id'=> $res['id'] ,'menu_available'=>1);
						$data['like'] 		= array('menu_name'=>$search_products);
					} 					
					 else{
						$data['conditions'] = array('restaurant_id'=> $res['id'],'menu_available'=>1);
					}
					
					$data['fields']	= array('foodmenu_id','restaurant_id','cat_id','menu_name','menu_logo','choice','long_description','short_code','price','reduced_price','container_charges','minimum_preparation_time'); 
					$menu 			= $this->common_model->getRows('foodmenu',$data);
 
					$data = array();
					$product_data = array();
					$total_tax    = get_gst($res['id'],'total_tax');
					$i = 0;
					$total_rows = $total_rows;
					
					 $data_arr['total_rows'] =  $total_rows;
					 $data_arr['total_pages']= ceil($total_rows / $limit); 
					 
					 /*favourite count*/
					 $i=0; 
					$total_fav_count =  $this->api_model->fav_restaurant_count($res['id']);
					/*restaurant rating*/
					 $res_rating = get_rating_restaurant_id($res['id']);
					 /*restaurant rating*/
					 $data_res['id'] 		= $res['id'];
					 $data_res['res_name']  = $res['res_name'];
					 $data_res['email']	    = $res['email'];
					 $data_res['service_type'] = $res['service_type'];
					 $data_res['logo']	  	= $this->config->item('pos_restaurant_logo').$res['logo'];
					 $data_res['print_logo']= $this->config->item('restaurant_image_url').$res['print_logo'];
					 $data_res['images']	= $this->config->item('restaurant_image_url').$res['images'];
					 $data_res['address']	= $res['address'];
					 $data_res['area']		= $res['area'];
					 $data_res['landmark']	= $res['landmark'];
					 $data_res['zipcode'] 	= $res['zipcode'];
					 $data_res['additional_info'] = $res['additional_info'];
					 $data_res['owner_contact_number'] = $res['owner_contact_number'];
					 $data_res['contact_information']  = $res['contact_information'];
					 $data_res['approx_delivery_time']  = $res['approx_delivery_time'];
					 $data_res['approx_cost']  	 = $res['approx_cost'];
					 $data_res['total_fav_count']= $total_fav_count['count']; 
					 $data_res['restaurant_rating']= $res_rating['ratings']/5; 
					 
					if(!empty($menu)){
						  
						 $total_rows = $total_rows;
						 $data_arr['total_rows'] =  $total_rows;
						 $data_arr['total_pages']= ceil($total_rows / $limit); 
						 
						 
						foreach($menu as $row){
							
							$choice = explode(',', $row['choice']); 
							$food_type = '1'; //For veg
							if(in_array('2',$choice)){   

								$food_type = '2';  //For non-veg
							}
							$price = (!empty($row['reduced_price']) && $row['reduced_price'] != '0.00')? $row['reduced_price'] : $row['price'];				 
							
							$tax_price = $price - (($price * $total_tax['total_tax']) / 100);  
							
							/*Food rating*/
							$food_rating = get_rating_for_food($row['foodmenu_id']);
							$total_avg_rating = $food_rating['ratings_sum']/5; 
							/*Food rating*/
							
							$data['menu'][$i]['restaurant_id']	= $row['restaurant_id'];
							$data['menu'][$i]['foodmenu_id']	= $row['foodmenu_id'];
							$data['menu'][$i]['cat_id'] 		= $row['cat_id'];
							$data['menu'][$i]['menu_name'] 		= $row['menu_name'];
							$data['menu'][$i]['short_code'] 	= $row['short_code'];
							$data['menu'][$i]['menu_logo']		= $this->config->item('foodMenu_image_url').$row['menu_logo'];
							$data['menu'][$i]['long_description'] = $row['short_code'];
							$data['menu'][$i]['price'] 			= round($row['price'],0);
							$data['menu'][$i]['reduced_price'] 	= round($row['reduced_price']);
							$data['menu'][$i]['tax_price'] 	   	= round($tax_price,2);
							$data['menu'][$i]['container_charges'] = round($row['container_charges']);
							$data['menu'][$i]['minimum_preparation_time'] = $row['minimum_preparation_time'].' min';
							$data['menu'][$i]['food_type'] 		= $food_type;
							$data['menu'][$i]['variation_price']= '';
							$data['menu'][$i]['food_rating']	=  $total_avg_rating ;
							$variance = $this->api_model->get_food_menu_variance($row['foodmenu_id']);
							 
							$variation_result  = array();
							if(!empty($variance)){
								 
							  $variation_price = array_column($variance , 'vprice');
							  $variation_sale_price = array_column($variance, 'vreduced_price');
								  
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
								$data['menu'][$i]['variation_price'] = $vminprice.'-'.$vmaxprice;
								foreach($variance as $var){
									$vprice = (!empty($var['vreduced_price']) && $var['vreduced_price'] != '0.00')? $var['vreduced_price'] : $var['vprice'];				
									$vtax_price = $vprice - (($vprice * $total_tax['total_tax']) / 100);  
									$variation_data = array();
									$variation_data['variation_id'] = $var['id'];
									$variation_data['variation_name'] = $var['name'];
									$variation_data['variation_price'] = $var['vprice'];
									$variation_data['variation_sale_price'] = $var['vreduced_price'] ;
									$variation_data['tax_price'] 	   = $vtax_price;
									$variation_result[] = $variation_data;
								}
							}
							else{ 
								$variation_result  = array();
							}
								
							$data['menu'][$i]['product_variation'] = $variation_result; 
							$i++;	
						}   
						 $data_arr['search_data'][$j]['restaurant'] = $data_res;
						 $data_arr['search_data'][$j]['restaurant']['menu'] = $data['menu'];
						 $j++;	
					}else{
						 $data_arr['search_data'][$j]['restaurant'] = $data_res;
						 $variation_result = '';
						 $data['product_variation'] = $variation_result; 
						 $data_arr['search_data'][$j]['restaurant']['menu'] = $data;
						 
						 
					}						
				}
			}
			   
			if($data_arr){
                // Set the response and exit
                $this->response([
                    'status' => 1,
                    'message' => 'Get Menu list successful.',
                    'data' => $data_arr
                ], REST_Controller::HTTP_OK);
            }else{
                // Set the response and exit
                //BAD_REQUEST (400) being the HTTP response code
				 $this->response([
                    'status' => 0,
                    'message' => 'Data not found.',
                    'data' => (object)[]
                ], REST_Controller::HTTP_OK);
            }
		}else{
			 // Set the response and exit
			$this->response([
                    'status' => 0,
                    'message' => 'keywords is required.',
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
	
	function search_cart($products, $field, $value){
	
		foreach($products as $key => $product)
	   {
		  if ( $product[$field] === $value )
			 return $key;
	   }
	   return false;
	}
		
	public function get_address_book_post() {
		 
		$user_id = $this->input->post('user_id');
	 
		 if(!empty($user_id)){
				  
			$data['address_book'] = $this->common_model->get_data_by_id(array('user_id' => $user_id),'address_book');
			if($data['address_book']){
			   
				// Set the response and exit
				$this->response([
					'status' => 1,
					'message' => 'Get address book successfully.',
					'data' => $data
				], REST_Controller::HTTP_OK); 
			}
			else{
				// Set the response and exit
				//BAD_REQUEST (400) being the HTTP response code
				 $this->response([
					'status' => 0,
					'message' => 'No data found.',
					'data' => (object)[]
				], REST_Controller::HTTP_OK);
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
 
	public function add_update_address_book_post() {
		 
		$user_id		= $this->input->post('user_id');
		$address_type	= $this->input->post('address_type');
		$other_address_type	= $this->input->post('other_address_type');
		$name			= $this->input->post('name');
		$email			= $this->input->post('email');
		$phone			= $this->input->post('phone');
		$shipping_area	= $this->input->post('shipping_area');
		$address_1		= $this->input->post('address_1');
		$address_2		= $this->input->post('address_2');
		$country		= $this->input->post('country');
		$state			= $this->input->post('state');
		$city			= $this->input->post('city');
		$postcode		= $this->input->post('postcode');
		$address_lat	= $this->input->post('address_lat');
		$address_lng	= $this->input->post('address_lng');
		$address_id		= $this->input->post('address_id');
		
		$update_data	= array();
		
		$req_field = ''; 
		
		foreach($_POST as $key=>$val){
			 
			if(empty($_POST[$key]) ){
				
				if($key == 'other_address_type' || $key == 'address_id'){ 
														// other_address_type / adddress_id is not required
					continue;
				}else{ 
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
			 
			$update_data += array( 
								'user_id' => $user_id,
								'address_type' => $address_type, 
								'other_address_type' => !empty($other_address_type)?$other_address_type:'', 
								'name' => $name, 
								'email' => $email, 
								'phone' => $phone, 
								'shipping_area' => $shipping_area, 
								'address_1' => $address_1, 
								'address_2' => $address_2, 
								'country' => $country, 
								'state' => $state, 
								'city' => $city, 
								'postcode' => $postcode, 
								'address_lat' => $address_lat, 
								'address_lng' => $address_lng,
								'status' => 1, 
						   );
			
			if(!empty($address_id)){ 
				
				$update_data += array(  'updated_date' => date('Y-m-d H:i:s')); 
				  
				$insertItem = $this->common_model->update_data('address_book',$update_data,array('user_id'=>$user_id, 'id'=>$address_id));  
				 
				$msg = 'Address book updated successfully.';
				
			}else{
				$update_data += array( 'created_date' => date('Y-m-d H:i:s')); 
			   
				$insertItem = $this->common_model->add_data('address_book',$update_data);
				
				$msg = 'Address book inserted successfully.';
			}
					 
			if($insertItem){
			   
				// Set the response and exit
				$this->response([
					'status' => 1,
					'message' => $msg,
					'data' => $update_data
				], REST_Controller::HTTP_OK); 
			}
			else{
				// Set the response and exit
				//BAD_REQUEST (400) being the HTTP response code
				 $this->response([
					'status' => 0,
					'message' => 'Something went wrong.',
					'data' => ''
				], REST_Controller::HTTP_BAD_REQUEST);
			}
		}
			
		 exit;
    }
	
	public function delete_address_book_post() {
		 
		$address_id = $this->input->post('address_id');
		 
		 if(!empty($address_id)){
				  
			$data = $this->common_model->delete_data('address_book',array('id' => $address_id));
			if($data){
			   
				// Set the response and exit
				$this->response([
					'status' => 1,
					'message' => 'Delete address book successfully.',
					'data' => $data
				], REST_Controller::HTTP_OK); 
			}
			else{
				// Set the response and exit
				//BAD_REQUEST (400) being the HTTP response code
				 $this->response([
					'status' => 0,
					'message' => 'Something went wrong.',
					'data' => ''
				], REST_Controller::HTTP_BAD_REQUEST);
			}
		 }
		 else{
			 // Set the response and exit
			$this->response([
                    'status' => 0,
                    'message' => 'address_id is required.',
                    'data' => ''
                ], REST_Controller::HTTP_BAD_REQUEST);
		 }
		 exit;
    }

	public function shipping_area_get() {
		   
			$shipping_area = $this->common_model->get_areas();
			if($shipping_area){
			   
				// Set the response and exit
				$this->response([
					'status' => 1,
					'message' => 'Get shipping area successfully.',
					'data' => $shipping_area
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
	
	public function edit_address_book_post() {
		 
		$address_id = $this->input->post('address_id');
	 
		 if(!empty($address_id)){
				  
			$data['address_book'] = $this->common_model->get_data_by_id(array('id' => $address_id),'address_book');
			if($data['address_book']){
			   
				// Set the response and exit
				$this->response([
					'status' => 1,
					'message' => 'Get address book successfully.',
					'data' => $data
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
	
	public function order_rating_post() {
		 
		$order_id		= $this->input->post('order_id');
		$user_id		= $this->input->post('user_id');
		$food_menu_id	= $this->input->post('food_menu_id');
		$rating			= $this->input->post('rating');
		$restaurant_id	= $this->input->post('restaurant_id');
		$comment 		= $this->input->post('comment'); 
		$req_field = ''; 
		
		foreach($_POST as $key=>$val){
			 
			if(empty($_POST[$key]) ){
				
				if($key == 'comment'){  // comment is not required
					continue;
				}else{ 
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
			
			$rating_arr = array(
							'user_id' 		=> $user_id,
							'order_id' 		=> $order_id,
							'food_menu_id' 	=> $food_menu_id,
							'rating' 		=> $rating, 
							'restaurant_id' => $restaurant_id, 
							'comment' 		=> $this->input->post('comment'), 
							'created_date'	=> date('Y-m-d H:i:s'), 
						  );
						  
			$insertrating = $this->common_model->add_data('order_rating',$rating_arr);
			
			if($insertrating){
				
			   $data = $this->common_model->get_data_by_id(array('user_id' => $user_id, 'food_menu_id'=>$food_menu_id , 'order_id' => $order_id),'order_rating');
			   
				// Set the response and exit
				$this->response([
					'status' => 1,
					'message' => 'Rating saved successfully.' ,
					'data' => $data
				], REST_Controller::HTTP_OK); 
			}
			else{
				// Set the response and exit
				//BAD_REQUEST (400) being the HTTP response code
				 $this->response([
					'status' => 0,
					'message' => 'Something went wrong.',
					'data' => ''
				], REST_Controller::HTTP_BAD_REQUEST);
			}
		}
		 exit;
	}
	 
	public function order_detail_post() {
		 
		$order_id = $this->input->post('order_id');
		 
		 if(!empty($order_id)){
				 
			$order = $this->api_model->get_order($order_id);
		
			if($order){
				$order_item = $this->api_model->get_order_items($order_id);
				
				array_walk($order_item, function (&$value, $key) {
				   $value['menu_logo'] = $this->config->item('foodMenu_image_url').$value['menu_logo']; 
				}); 
		  
				$data['order'] = $order;
				$data['order']['order_item'] = $order_item;
				$data['order']['order_tracking']  = get_delivery_boy_latlong($order_id); 
                // Set the response and exit
                $this->response([
                    'status' => 1,
                    'message' => 'Get order Details.',
                    'data' => $data
                ], REST_Controller::HTTP_OK);
            }else{ 
                // Set the response and exit
                //BAD_REQUEST (400) being the HTTP response code
				 $this->response([
                    'status' => 0,
                    'message' => 'Wrong order_id.',
                    'data' => ''
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
		 }
		 else{
			 // Set the response and exit
			$this->response([
                    'status' => 0,
                    'message' => 'order_id is required.',
                    'data' => ''
                ], REST_Controller::HTTP_BAD_REQUEST);
		}
		exit;
    } 

	public function track_delivery_boy_post() {
		 
		$order_id = $this->input->post('order_id');
		 
		 if(!empty($order_id)){
				 
			$result = $this->api_model->get_driver_info($order_id);
			 
			if($result){
				  
				$profile_pic = '';
			
				if(!empty($result['profile_pic']) && file_exists($this->config->item('delivery_boy_image_url').$result['profile_pic']))
				{
					$profile_pic = $result['profile_pic'];
				}
				
				$data = array(
						'id'		 => $result['id'], 
						'full_name'  => $result['full_name'],
						'phone'		 => $result['phone'],
						'profile_pic' => $this->config->item('delivery_boy_image_url').$profile_pic,
						'latitude' 	=> $result['latitude'],
						'longitude' => $result['longitude'],
						'angle' => $result['angle'], 
					);	
					
                // Set the response and exit
                $this->response([
                    'status' => 1,
                    'message' => '',
                    'data' => $data
                ], REST_Controller::HTTP_OK);
            }else{
                // Set the response and exit
                //BAD_REQUEST (400) being the HTTP response code
				 $this->response([
                    'status' => 0,
                    'message' => 'No data found.',
                    'data' => (object)[]
                ], REST_Controller::HTTP_OK);
            }
		 }
		 else{
			 // Set the response and exit
			$this->response([
                    'status' => 0,
                    'message' => 'order_id is required.',
                    'data' => ''
                ], REST_Controller::HTTP_BAD_REQUEST);
		}
		exit;
    }
	
	public function restaurant_category_menu_page_post()	{
		 
		$restaurant_id		= $this->post('restaurant_id'); 
		$search_products	= $this->post('keywords');
		$pageno				= $this->post('pageno'); 
		$user_id			= $this->post('user_id'); 
		$veg_item			= $this->post('veg_item'); 
		$pageno = isset($pageno) ? $pageno: 1;
		 
		if(!empty($restaurant_id)){
			
			/*********** RESTAURANT DETAILS ARAY**********/
			$data = array('conditions' => array('id'=>$restaurant_id), 
						  'fields'	=> 'res_name, email, logo, print_logo, images,address, area,landmark, zipcode, additional_info,owner_contact_number,contact_information', 
						); 
			 
			$restaurant_details = $this->common_model->getRows('kitchens',$data); 
			
			$restaurant_favorite = 'no';		
	 
			if(isset($user_id) && !empty($user_id)){
				$favourite_restaurant = $this->api_model->get_favourite_restaurant($user_id);
				
				$favourite_restaurant_id = array_column($favourite_restaurant, 'id');
				
				if(!empty($favourite_restaurant) && in_array( $restaurant_id, $favourite_restaurant_id )){
						$restaurant_favorite = 'yes';
					} 
			} 	
			
			array_walk($restaurant_details, function (&$value, $key) {
				 
				$value['images'] = $this->config->item('restaurant_image_url').$value['images']; 
			}); 
			 
			$restaurant_details[0]['additional_info'] =trim(preg_replace('/\s\s+/', ' ', $restaurant_details[0]['additional_info']));
			$data_arr['restaurant_details']   = $restaurant_details[0] ;
			$data_arr['restaurant_details']['restaurant_favorite'] = $restaurant_favorite;
			
			/*********** RESTAURANT DETAILS ARAY**********/
			 
			$limit 					= 10; 
			$offset 				= ( $pageno - 1) * $limit;  
			$data_set['conditions'] = array('restaurant_id'=>$restaurant_id); 
			$data_set['returnType'] = 'count'; 
			$total_rows				= $this->common_model->getRows('food_category',$data_set);
			$data_arr['total_rows'] = $total_rows;
			$data_arr['total_pages']= ceil($total_rows / $limit); 
			   
			$data = array( 'conditions' => array('restaurant_id'=>$restaurant_id),
							'start'		=> $offset,
							'limit'		=> $limit,
							//'like'		=> array('cat_name' => $search_products)
						); 
			 
			$category_list = $this->common_model->getRows('food_category',$data);
			  
			if(!empty($category_list)){
				$j = 0;
				foreach($category_list as $cat){
					
					if(!empty($search_products) && !empty($cat['cat_id']) ){
						$data_menu['conditions'] = array('restaurant_id'=>$restaurant_id,'cat_id'=>$cat['cat_id'],'menu_available'=>1);
						$data_menu['like'] = array('menu_name'=>$search_products);
					} 
					elseif(!empty($cat['cat_id'])){
						$data_menu['conditions']= array('restaurant_id'=>$restaurant_id,'cat_id'=>$cat['cat_id'],'menu_available'=>1);
					}
					elseif(!empty($search_products)){
						$data_menu['conditions'] = array('restaurant_id'=>$restaurant_id,'menu_available'=>1);
						$data_menu['like'] = array('menu_name'=>$search_products);
					}else{
						$data_menu['conditions'] = array('restaurant_id'=>$restaurant_id,'menu_available'=>1);
					}
					
					if(!empty($veg_item)){
						$data_menu['where'] =  "!FIND_IN_SET ('2', choice) and !FIND_IN_SET ('18', choice)";
					}
					
					$data_menu['fields'] = array('foodmenu_id','cat_id','menu_name','menu_logo','choice','long_description','price','reduced_price','container_charges','minimum_preparation_time');
					  
					$menu = $this->common_model->getRows('foodmenu',$data_menu);
					//echo $this->db->last_query();
					$data = array();
					$product_data = array();
					$total_tax    = get_gst($restaurant_id,'total_tax');
					$i = 0;
					
					$data_arr['category'][$j]['cat_id'] 	= $cat['cat_id'];
					$data_arr['category'][$j]['cat_name'] = $cat['cat_name'];
					$data_arr['category'][$j]['cat_display_name'] = $cat['cat_display_name'];
					$data_arr['category'][$j]['cat_logo'] = $this->config->item('foodCategory_image_url').$cat['cat_logo'];
					
					if(!empty($menu)){
						  
						foreach($menu as $row){
						 	 
							$in_cart = 'no';
						  
							if(isset($user_id) && !empty($user_id)){
								$old_cart_data['conditions'] 	= array('user_id'=>$user_id);
								$old_cart_data['fields'] 		= 'persistent_cart';
								$old_cart_data['returnType'] 	= 'single';
								$check_existing_cart 			= $this->common_model->getRows('cart',$old_cart_data);
									 $food_menu_id  = array(); $variation_id =array();
								if(!empty($check_existing_cart)){
									$cart_table_data = unserialize($check_existing_cart['persistent_cart']);
								
									$food_menu_id = array_column($cart_table_data, 'food_menu_id');
									$variation_id = array_column($cart_table_data, 'variation_id');
									
									if(in_array( $row['foodmenu_id'], $food_menu_id )){
										$in_cart = 'yes'; 
									} 
								} 
							}
							$choice = explode(',', $row['choice']); 
							$food_type = '1'; //For veg
							if(in_array('2',$choice) || in_array('18',$choice)){   

								$food_type = '2';  //For non-veg
							}
							$price = (!empty($row['reduced_price']) && $row['reduced_price'] != '0.00')? $row['reduced_price'] : $row['price'];				 
							
							$tax_price = $price - (($price * $total_tax['total_tax']) / 100);  
							
							$data['menu'][$i]['foodmenu_id']= $row['foodmenu_id'];
							$data['menu'][$i]['cat_id'] 	= $row['cat_id'];
							$data['menu'][$i]['menu_name'] 	= $row['menu_name'];
							$data['menu'][$i]['menu_logo']	= $this->config->item('foodMenu_image_url').$row['menu_logo'];
							$data['menu'][$i]['long_description'] = $row['long_description'];
							$data['menu'][$i]['choice'] 	= $row['choice'];
							$data['menu'][$i]['price'] = round($row['price'],0);
							$data['menu'][$i]['reduced_price'] = round($row['reduced_price']);
							$data['menu'][$i]['tax_price'] 	   = $tax_price;
							$data['menu'][$i]['container_charges'] = round($row['container_charges']);
							$data['menu'][$i]['minimum_preparation_time'] = $row['minimum_preparation_time'].' min';
							$data['menu'][$i]['food_type'] = $food_type;
							$data['menu'][$i]['cart'] = $in_cart;
							 
							//$data['menu'][$i]['cart_variation_id'] = $in_cart_variation_id;
							$data['menu'][$i]['variation_price'] = '';
							$variance = $this->api_model->get_food_menu_variance($row['foodmenu_id']);
					
							$variation_result  = array();
							if(!empty($variance)){
							  
							  $variation_price = array_column($variance , 'vprice');
							  $variation_sale_price = array_column($variance, 'vreduced_price');
								  
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
								$data['menu'][$i]['variation_price'] = $vminprice.'-'.$vmaxprice;
							  
								foreach($variance as $var){
									$vprice = (!empty($var['vreduced_price']) && $var['vreduced_price'] != '0.00')? $var['vreduced_price'] : $var['vprice'];				
									$vtax_price = $vprice - (($vprice * $total_tax['total_tax']) / 100);  
									$variation_data = array();
									$variation_data['variation_id'] = $var['id'];
									$variation_data['variation_name'] = $var['name'];
									$variation_data['variation_price'] = $var['vprice'];
									$variation_data['variation_sale_price'] = $var['vreduced_price'] ;
									$variation_data['tax_price'] 	   = $vtax_price;
									$variation_data['cart_variation_id']  = 'no';
									if(in_array( $var['id'], $variation_id )){ 
										$variation_data['cart_variation_id'] = 'yes';
									} 
									$variation_result[] = $variation_data; 
								}
							}
							else{ 
								$variation_result  = array();
							}
							 
							$data['menu'][$i]['product_variation'] = $variation_result;
							$i++;	
						} 
							$data_arr['category'][$j]['menu'] = $data['menu']; 
					}
					else{
						
						$data_arr['category'][$j]['menu'] = array();
					} 
					$j++;	
				}
				
			}else{
				$data_arr['category']  = array();
				$data_arr['category'][]['menu'] = array();
			}
			 
			if($data_arr){
                // Set the response and exit
                $this->response([
                    'status' => 1,
                    'message' => 'Get Menu list successful.',
                    'data' => $data_arr
                ], REST_Controller::HTTP_OK);
            }else{
                // Set the response and exit
                //BAD_REQUEST (400) being the HTTP response code
				 $this->response([
                    'status' => 0,
                    'message' => 'Data not found.',
                    'data' => ''
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
		}else{
			 // Set the response and exit
			$this->response([
                    'status' => 0,
                    'message' => 'restaurant_id is required.',
                    'data' => ''
                ], REST_Controller::HTTP_BAD_REQUEST);
		}
		exit;
    }  
	public function restaurant_info_post() {
		
		$restaurant_id	= $this->post('restaurant_id');
		  
		if(!empty($restaurant_id)){
			 
			$res_data['conditions'] = array('id'=>$restaurant_id,'status'=>1);
			$res_data['fields'] 	= 'id,email,address,city,area,landmark, zipcode, owner_contact_number,
			contact_information, manager_contact_number, biller_name, biller_contact_number'; 
			$res_data['returnType'] = 'single';
			$restaurant_details 	= $this->common_model->getRows('kitchens',$res_data);
					 
			$restaurant_details['city'] =  $this->common_model->get_field_by_id('city','name',array('city_id'=>$restaurant_details['city']));
   
			if($restaurant_details){
                // Set the response and exit
                $this->response([
                    'status' => 1,
                    'message' => 'Get restaurant info successfully.',
                    'data' => $restaurant_details
                ], REST_Controller::HTTP_OK);
            }else{
                // Set the response and exit
                 
				 $this->response([
                    'status' => 0,
                    'message' => 'Data not found.',
                    'data' => (object)[]
                ], REST_Controller::HTTP_OK);
            }
		}else{
			 // Set the response and exit
			$this->response([
                    'status' => 0,
                    'message' => 'restaurant_id is required.',
                    'data' => ''
                ], REST_Controller::HTTP_BAD_REQUEST);
		}
		exit;
    }
	
	public function restaurant_gallery_post() {
		
		$restaurant_id 			= $this->post('restaurant_id');
		  
		if(!empty($restaurant_id)){
			 
			$res_data['conditions'] = array('id'=>$restaurant_id,'status'=>1);
			$res_data['fields'] = 'image_gallery '; 
			$res_data['returnType'] = 'single';
			$restaurant_gallery = $this->common_model->getRows('kitchens',$res_data);
			
			if($restaurant_gallery){
				$restaurant_gallery  = unserialize($restaurant_gallery['image_gallery']);
				
				 $data = array();
				  
				if(!empty($restaurant_gallery)){
					
					foreach($restaurant_gallery as $value){
						
						if(!empty($value['gallery']) && file_exists($this->config->item('restaurant_gallery_fcpath').$value['gallery']))
						{
							//$str =  $this->config->item('restaurant_gallery_path').$value['gallery'];
							//$url = preg_replace('/([^:])(\/{2,})/', '$1/', $str); 
							$data['gallery'][] =  $this->config->item('restaurant_gallery_path').$value['gallery'] ; 
						//	$data['gallery1'][] =  $url ; 

						}
						else{
							$data = '';
						} 
					}
				} 
					
				if(!empty($data)){
					// Set the response and exit
					$this->response([
						'status' => 1,
						'message' => 'Get restaurant info successfully.',
						'data' => $data
					], REST_Controller::HTTP_OK);
				}else{
					// Set the response and exit
					 
					 $this->response([
						'status' => 0,
						'message' => 'Data not found.',
						'data' => (object)[]
					], REST_Controller::HTTP_OK);
				} 
			}
			else{
				 $this->response([
						'status' => 0,
						'message' => 'Data not found.',
						'data' => (object)[]
					], REST_Controller::HTTP_OK);
			} 
		}else{
			 // Set the response and exit
			$this->response([
                    'status' => 0,
                    'message' => 'restaurant_id is required.',
                    'data' => ''
                ], REST_Controller::HTTP_BAD_REQUEST);
		}
		exit;
    }
}
	