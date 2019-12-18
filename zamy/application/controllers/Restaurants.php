<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Restaurants extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('common_model');
		$this->customer_id 	= $this->session->userdata('cust_id');
	}
	 
	public function index($res_name=null){
		 
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
				$this->load->library('pagination'); 
				
				$query_data['fields'] = 'id,res_name,res_alias,logo,images,service_type,city,area,landmark,approx_delivery_time,approx_cost,pure_veg';
			    $query_data['conditions'] = array('status' => 1);
				$query_data['returnType'] = 'count';
				
		        $allrow = $this->common_model->getRows('kitchens',$query_data);
				$config = array();
				
                $config['base_url'] = base_url()."restaurants";
				 
				  // custom paging configuration
				$config['num_links'] = 2;
				$config['use_page_numbers'] = TRUE;
				
				$config['first_link'] = 'First';
				$config['first_tag_open'] = '<li class="page-item first">';
				$config['first_tag_close'] = '</li>';
				 
				$config['last_link'] = 'Last';
				$config['last_tag_open'] = '<li class="page-item last">';
				$config['last_tag_close'] = '</li>';
 
				$config['next_link'] = 'Next';
				$config['next_tag_open'] = '<li class="page-item next"> ';
				$config['next_tag_close'] = '</li>';
	 
				$config['prev_link'] = 'Prev';
				$config['prev_tag_open'] = '<li class="page-item prev">';
				$config['prev_tag_close'] = '</li>';
		
				$config['cur_tag_open'] = '<li class="page-item active"> <a class="page-link brd-rd2" href="#" itemprop="url">';
				$config['cur_tag_close'] = '</a></li>';
				
				$config['num_tag_open'] = '<li class="page-item"> ';
				$config['num_tag_close'] = ' </li>';
				 
                $config['per_page'] = 10;
                $config["total_rows"] = $allrow;  
                $this->pagination->initialize($config); 
				$page =  ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
                $str_links = $this->pagination->create_links(); 
				$data['links'] = explode('&nbsp;',$str_links );

				$query_data1['fields'] = 'id, res_name ,res_alias, logo,images ,service_type, city,area, landmark, approx_delivery_time, approx_cost,pure_veg';
				$query_data1['conditions'] = array('status' => 1);
				$query_data1['start'] = $config['per_page'] * $page; 
				$query_data1['limit'] = $config['per_page'];

                $all_restaurants = $this->common_model->getRows('kitchens',$query_data1);
			 
				/********** Inactive restaurant show only for attune *********/
				$email = EMAIL;
				
				$cust_email = $this->session->userdata('cust_email');
				if(!empty($email) && in_array($cust_email,$email)){
				 
				  
					 $query_data1['fields'] = 'id, res_name ,res_alias, logo,images ,service_type, city,area, landmark, approx_delivery_time, approx_cost,pure_veg';
					$query_data1['conditions'] = array('id' => 55);
					$query_data1['start'] = $config['per_page'] * $page; 
					$query_data1['limit'] = $config['per_page'];

					$inactive_restaurant = $this->common_model->getRows('kitchens',$query_data1);
						
					$all_restaurants = array_merge($inactive_restaurant,$all_restaurants); 
				}
			
				/******* Inactive restaurant show only for attune ************/
				
				
				 // echo $this->db->last_query();
				$data['current_location'] 	= $current_location;
				$data['all_restaurants'] 	= $all_restaurants;

				$data['view'] = 'restaurants/index';
				$this->load->view('layout',$data);
			}
		}else{
			
			$current_location = $this->session->userdata('location');
			if(empty($current_location)){
				//redirect(base_url('restaurants'), 'refresh');
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
			$coupon_code = '';
			if($this->session->has_userdata('cust_id')){
				
				$old_cart_data['conditions'] 	= array('user_id'=>$this->customer_id);
				$old_cart_data['fields'] 		= 'persistent_cart,coupon_code,coupon_amount,total,complementary_food';
				
				$check_existing_cart 			= $this->common_model->getRows('cart',$old_cart_data);
				 
				if(!empty($check_existing_cart[0])){
					//$cart_table_data = array_reverse(unserialize($check_existing_cart[0]['persistent_cart']));
					$cart_table_data = unserialize($check_existing_cart[0]['persistent_cart']); 	
				}
				
				$cart_items 		= $cart_table_data;
				$cart_total 		= $check_existing_cart[0]['total'];
				$coupon_code 		= $check_existing_cart[0]['coupon_code']; 
				$complementary_food = $check_existing_cart[0]['complementary_food'];
			
			}else{
				$cart = new Cart;
				
				if($cart->total_items() > 0){
					$cart_items = $cart->contents();
					$cart_total = $cart->total();
					$coupon_code = '';
					if($this->session->has_userdata('complementary_food')){
						$complementary_food = $this->session->userdata('complementary_food');
					}
				}
			}
		 
			$newdata = $this->common_model->get_field_by_id('kitchens','image_gallery',array('id' => $restaurant_id));
			$delivery_charge =  get_delivery_charge_by_restaurant_ID($restaurant_id);
			$data['image_gallery_info'] = unserialize($newdata);
			$data['delivery_charge'] 	= !empty($delivery_charge['delivery_charge'])?$delivery_charge['delivery_charge']:'0';
			$data['cart_items']			= $cart_items;
			$data['cart_total']			= $cart_total;
			$data['coupon_code']			= $coupon_code; 
			$data['complementary_food']	= $complementary_food;
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
		$offset 	= $this->input->post('page');
		$limit = 1;
 
		$all_items 		= $this->common_model->get_res_cat_menus($restaurant_id,'','',$limit,$offset);
		
		$data['all_items']		= $all_items;
		$data['restaurant_id']	= $restaurant_id;
		
		$data	=	$this->load->view('restaurants/view_all_menus',$data, TRUE);
		
		echo $data;
		exit;
	}
	public function chek_res_fav_status(){
		$restaurant_id		= $this->input->post('restaurant_id');
		$user_id 			= $this->customer_id; 
		
		
		$check_fields = array(
				'restaurant_id'	=> $restaurant_id,
				'user_id'	=> $user_id
			); 
		
		$res_data['conditions'] = $check_fields;
		$check_entry = $this->common_model->getRows('fav_restaurants',$res_data);

		if ($check_entry) {
			$return =  1;
		}
		else{
            $return =  0;
		}
		echo $return;
	}
    public function chek_food_fav_status(){
		$restaurant_id		= $this->input->post('restaurant_id');
		$foodmenu_id		= $this->input->post('foodmenu_id');
		$user_id 			= $this->customer_id; 
		
		
		$check_fields = array(
				'restaurant_id'	=> $restaurant_id,
				'user_id'	=> $user_id,
				'foodmenu_id' => $foodmenu_id 
			); 
		
		$res_data['conditions'] = $check_fields;
		$check_entry = $this->common_model->getRows('favorite_food',$res_data);

		if ($check_entry) {
			$return =  1;
		}
		else{
            $return =  0;
		}
		echo $return;
	}
	public function get_food_menu_for_filter_count(){
		$restaurant_id = $this->input->post('restaurant_id');
		$result = food_menu_all_count_restaurant_id($restaurant_id);
		echo json_encode($result);
		exit();
	}
	 
} 