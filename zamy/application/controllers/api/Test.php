<?php 
 
if (!defined('BASEPATH')) exit('No direct script access allowed');

// Load the Rest Controller library
require APPPATH . '/libraries/REST_Controller.php';

class Test extends REST_Controller {

    public function __construct() { 
        parent::__construct();
        
        // Load the user model
		$this->load->model('api/Api_model','api_model');
		  
    }
 
	public function restaurant_category_menu_post()	{
		
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
							//'start'		=> $offset,
							//'limit'		=> $limit,
							//'like'		=> array('cat_name' => $search_products)
						); 
			 
			$category_list = $this->common_model->getRows('food_category',$data);
			// echo $this->db->last_query();
			 
			//$category_list = !empty($category_list) ? $category_list : '' ;
			
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
}
?>