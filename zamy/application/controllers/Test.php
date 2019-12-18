<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('users/user_model', 'user_model');
		$this->load->model('common_model');
		$this->load->helper('email');
		$this->load->helper('coupon');
		$this->customer_id 	= $this->session->userdata('cust_id');
	}
	
	function home(){
		
		$req_param['conditions'] = array('user_id'=>$this->customer_id);
		$address_book = $this->common_model->getRows('address_book',$req_param);
		
		$query_data['fields'] = 'area';
		$area_list = $this->common_model->get_areas('kitchens',$query_data);
		
		$data['area_list'] = $area_list;
		$data['address_book']	= $address_book;
		$this->load->view('home/location',$data);
		
	}
	
	function order_confirmation(){
		
		$order_confirmation =	order_confirmation(307,$this->customer_id);
		$order_confirmation_admin =	order_confirmation_admin(307,$this->customer_id);
		
		echo "<pre>";
		print_r($order_confirmation);
		print_r($order_confirmation_admin);
		echo "</pre>";
		
	}
	
	function apply_coupon(){
		
		$user_id 		= $this->customer_id;
		
		$coupon_code 	= 'test';
		$cart_total 	= '310';
		$restaurant_id 	= 9;
		
		$get_coupons 			= $this->common_model->get_coupons($restaurant_id);
		if(!empty($get_coupons)){
			$all_coupons = $get_coupons;
		}
		
		echo "<pre>";
		print_r($all_coupons);
		echo "</pre>";
		
		
		$apply_coupon_response = apply_coupon($coupon_code,$cart_total,$user_id,$restaurant_id);
		
		
		
		
		return $apply_coupon_response;
	}
	
	function populer_this_month(){
		
		$populer_this_month_restaurants = populer_this_month_restaurants();
		$populer_this_month_food = populer_this_month_food();
		
		echo "<pre>";
		print_r($populer_this_month_food);
		echo "</pre>";
		
	}
}