<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('common_model');
		$this->customer_id 	= $this->session->userdata('customer_id');
	}
	
	public function index($keyword=null){
		//is_login();
		$current_location = $this->session->userdata('location');
		
		$search_keyword	= $this->input->post('search_keyword');
		$search_area	= $this->input->post('search_area');
		
		$all_restaurants = array();
		$all_dishes = array();
		if(!empty($search_keyword) || !empty($search_area)){
			
			if(!empty($search_area)){
				$query_data['area'] 	= $search_area;
				$query_data['res_name'] = $search_keyword;
			}else{
				$query_data['area'] 	= '';
				$query_data['res_name'] = $search_keyword;
			}
			
			//$all_restaurants = $this->common_model->getRows('kitchens',$query_data);
			
			$all_restaurants 	= $this->common_model->search_restaurants($query_data);
			if(!empty($search_keyword)){
				$all_dishes 		= $this->common_model->search_dishes($search_keyword);
			}
			
		}
		
		$cart_items =array();
		if($this->session->has_userdata('cust_id')){
				
				$old_cart_data['conditions'] 	= array('user_id'=>$this->customer_id);
				$old_cart_data['fields'] 		= 'persistent_cart,total,complementary_food';
				
				$check_existing_cart 			= $this->common_model->getRows('cart',$old_cart_data);
				$cart_table_data = '';
				
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
		$query_params['fields'] = 'id,res_name,service_type,res_alias,email,address,images,logo,approx_cost,approx_delivery_time,city,area,landmark';
		$query_params['conditions'] = array('status'=>1);
		$other_restaurants = $this->common_model->getRows('kitchens',$query_params);
		$data['cart_items']			= $cart_items;
		$data['current_location'] 	= $current_location;
		$data['keyword'] 			= $search_keyword;		
		$data['search_area'] 		= $search_area;		
		$data['all_restaurants'] 	= $all_restaurants;		
		$data['all_dishes'] 		= $all_dishes;	
		$data['other_restaurants']	= $other_restaurants;
		$data['view'] = 'restaurants/search_restaurants';
		$this->load->view('layout',$data);
	}	
}