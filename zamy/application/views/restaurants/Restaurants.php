<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Restaurants extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('common_model');
		$this->customer_id 	= $this->session->userdata('cust_id');
	}
	 
	public function index($res_name=null){
		
		/*if(empty($this->session->has_userdata('location'))){
			redirect(base_url(), 'refresh');
		}*/
		//is_login();
		 
		if(empty($res_name)){
			if($this->input->post('search_location')){
				$this->form_validation->set_rules('location', 'location', 'trim|required');
			
				if ($this->form_validation->run() == FALSE) {
					$this->load->view('home/add_location');
				}else {
					$location = $this->input->post('location');

					$user_data = array(
						'location' 	=> $location
					);
					
					$this->session->set_userdata($user_data);
					redirect(base_url('restaurants'), 'refresh');
				}
			}else{
				if(empty($this->session->has_userdata('location'))){
					//redirect(base_url(), 'refresh');
				}
				
				$current_location = $this->session->userdata('location');
				
				$query_data['fields'] = 'id,res_name,res_alias,logo,images,service_type,city,area,landmark,approx_delivery_time,approx_cost,pure_veg';
				$all_restaurants = $this->common_model->getRows('kitchens',$query_data);
				$data['current_location'] 	= $current_location;
				$data['all_restaurants'] 	= $all_restaurants;

				$data['view'] = 'restaurants/index';
				$this->load->view('layout',$data);
			}
		}else{
			
			$current_location = $this->session->userdata('location');
			if(empty($current_location)){
				redirect(base_url('restaurants'), 'refresh');
			}
			
			$res_data['conditions'] = array('res_alias'=>$res_name,'status'=>1);
			$query_data['fields'] = 'id,res_name,res_alias,images,service_type,city,area,landmark,approx_delivery_time,approx_cost,pure_veg';
			$res_data['returnType'] = 'single';
			$restaurant_details = $this->common_model->getRows('kitchens',$res_data);
			
			$restaurant_details['city'] =  $this->common_model->get_field_by_id('city','name',array('city_id'=>$restaurant_details['city']));
			
			$restaurant_id = $restaurant_details['id'];
			if(empty($restaurant_id) || $restaurant_id==0){
				redirect('restaurants');
				exit;
			}
		
			$recommended_items = $this->common_model->recommended_menu_items($restaurant_id);
			$all_categories = $this->common_model->get_res_cat($restaurant_id);
			
			
			$all_items = $this->common_model->get_res_cat_menus($restaurant_id,$all_categories[0]['menu_items'][0]['cat_id']);
			
			$fav_data['conditions'] = array('restaurant_id'	=> $restaurant_id,'user_id'	=> $this->customer_id); 
			$check_entry = $this->common_model->getRows('fav_restaurants',$fav_data);
			
			if(!empty($check_entry)){
				$fav_restaurants = 1;
			}else{
				$fav_restaurants = 0;
			}
			$data['current_location'] = $current_location;
			$data['restaurant_details'] = $restaurant_details;
			$data['recommended_items'] 	= $recommended_items;
			
			$data['all_categories']		= $all_categories;
			$data['all_items']			= $all_items;
			$data['restaurant_id']		= $restaurant_id;
			$data['is_favourite']		= $fav_restaurants;
			
			$cart_items = array();
			$cart_total = 0;
			$cart_table_data = array();
			$complementary_food ='';
			if($this->session->has_userdata('cust_id')){
				
				$old_cart_data['conditions'] 	= array('user_id'=>$this->customer_id);
				$old_cart_data['fields'] 		= 'persistent_cart,total,complementary_food';
				
				$check_existing_cart 			= $this->common_model->getRows('cart',$old_cart_data);
				
				
				if(!empty($check_existing_cart[0])){
					//$cart_table_data = array_reverse(unserialize($check_existing_cart[0]['persistent_cart']));
					$cart_table_data = unserialize($check_existing_cart[0]['persistent_cart']);
				}
				
				$cart_items 		= $cart_table_data;
				$cart_total 		= $check_existing_cart[0]['total'];
				$complementary_food = $check_existing_cart[0]['complementary_food'];
			
			}else{
				$cart = new Cart;
				
				if($cart->total_items() > 0){
					$cart_items = $cart->contents();
					$cart_total = $cart->total();
					if($this->session->has_userdata('complementary_food')){
						$complementary_food = $this->session->userdata('complementary_food');
					}
				}
			}
			$newdata = $this->common_model->get_field_by_id('kitchens','image_gallery',array('id' => $restaurant_id));

			$data['image_gallery_info'] = unserialize($newdata);
			$data['delivery_charge'] = get_delivery_charge_by_restaurant_ID($restaurant_id);
			$data['cart_items']			= $cart_items;
			$data['cart_total']			= $cart_total;
			$data['complementary_food']	= $complementary_food;
			$data['delivery_fees']		= 0;

			$data['view'] = 'restaurants/details';
			$this->load->view('layout',$data);
		} 
	}
	public function fav_restaurants(){
		$restaurant_id		= $this->input->post('restaurant_id');
		$user_id 			= $this->customer_id; 
		
		
		$check_fields = array(
				'restaurant_id'	=> $restaurant_id,
				'user_id'	=> $user_id
			); 
		
		$res_data['conditions'] = $check_fields;
		$check_entry = $this->common_model->getRows('fav_restaurants',$res_data);
		
		if(!empty($check_entry)){
			$result = $this->common_model->delete_data('fav_restaurants',$check_fields);
			
		}else{
			$result = $this->common_model->add_data('fav_restaurants',$check_fields);
			
		}
		 
		echo $result;
		
	}

	public function fav_food()
	{
		$food_id	   = $this->input->post('foodmenu_id');
		$user_id       = $this->customer_id;
        $restaurant_id = $this->input->post('restaurant_id');
		$check_fields  = array(
				'foodmenu_id'	=> $food_id,
				'user_id'	    => $user_id,
				'restaurant_id' => $restaurant_id
		); 
		
		$res_data['conditions'] = $check_fields;
		$check_entry = $this->common_model->getRows('favorite_food',$res_data);
		
		if(!empty($check_entry)){
			$result = $this->common_model->delete_data('favorite_food',$check_fields);
			
		}else{
			$result = $this->common_model->add_data('favorite_food',$check_fields);
			
		}
		 
		echo $result; 
		
	}

	public function filter_cate_item()
	{
		$cat_id = $this->input->post('cat_id');
		$restaurant_id = $this->input->post('restaurant_id');

		$data['all_items'] = $this->common_model->get_res_cat_menus($restaurant_id,$cat_id);
		$data['restaurant_id'] =$restaurant_id;
		 
		$data=$this->load->view('restaurants/details1',$data, TRUE);
		// echo json_encode($all_items);
		  echo $data;
	} 
	
	public function view_all_menus(){
		
		
		$restaurant_id 	= $this->input->post('restaurant_id');
		$all_items 		= $this->common_model->get_res_cat_menus($restaurant_id);
		
		$data['all_items']		= $all_items;
		$data['restaurant_id']	= $restaurant_id;
		
		$data	=	$this->load->view('restaurants/view_all_menus',$data, TRUE);
		
		echo $data;
		exit;
	}
	 
} 