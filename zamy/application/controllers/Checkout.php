<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('common_model');
		$this->load->model('order_model');
		$this->load->helper('paytm');
		$this->load->helper('coupon');
		$this->customer_id 	= $this->session->userdata('cust_id');
	}
	
	public function index($res_name=null){ 
		
		$user_id = $this->customer_id;
		
		if(empty($this->session->has_userdata('location'))){
			redirect(base_url(), 'refresh');
		}
	
		$cart_items = array();
		$sub_total = 0;
		$cart_total = 0;
		$coupon_amount = 0;
		$cart_table_data = array();
		$restaurant_id = '';
		$coupon_code 	= '';
		$discount_type	= '';
		$coupon_amount 	= '';
		if($this->session->has_userdata('cust_id')){
			
			$old_cart_data['conditions'] 	= array('user_id'=>$this->customer_id);
			$old_cart_data['fields'] 		= 'persistent_cart,total,coupon_code,coupon_amount,total_amount';
			
			$check_existing_cart 			= $this->common_model->getRows('cart',$old_cart_data);
			if(!empty($check_existing_cart[0])){
				$cart_table_data = unserialize($check_existing_cart[0]['persistent_cart']);
			}
			
			
			
			if(!empty($check_existing_cart[0])){
				
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
					}
					
				}else{
					$sub_total 	= $check_existing_cart[0]['total'];
					$cart_total = $check_existing_cart[0]['total_amount'];
				}
			}
			
			$cart_items = $cart_table_data;
			
			
			if(count($cart_items) > 1 ){
				$res_data = array_slice($cart_items,1);
			}else{
				$res_data = $cart_items;
			}
			
			if(!empty($cart_items)){
				$restaurant_id = $res_data[0]['restaurant_id'];
			}
		}else{
			$cart = new Cart;
			
			if($cart->total_items() > 0){
				$cart_items = $cart->contents();
				$sub_total = $cart->total();
				$cart_total = $cart->total();
			}
			
			if(count($cart_items) > 1 ){
				$res_data = array_slice($cart_items,0,1);
			}else{
				$res_data = array_slice($cart_items,0,1);
			}
			
			if(!empty($cart_items)){
				$restaurant_id = $res_data[0]['restaurant_id'];
			}
		}
		
		if(empty($cart_items)){
			redirect(base_url());
		}
		 
		$restaurant_details = array();
		/* if(!empty($cart_items)){
			$restaurant_id = $cart_items[0]['restaurant_id'];
		} */
		 
		if(!empty($restaurant_id)){
			$res_conditions['conditions'] = array('id'=>$restaurant_id,'status'=>1);
			$res_conditions['fields'] = 'id,res_name,res_alias,images,service_type,city,area,landmark,approx_delivery_time,approx_cost,pure_veg';
			$res_conditions['returnType'] = 'single';
			$restaurant_details = $this->common_model->getRows('kitchens',$res_conditions);
			
		}
		
		$req_param['conditions'] = array('user_id'=>$this->customer_id);
		$address_data = $this->common_model->getRows('address_book',$req_param);
		
		$address_book = array();
		if(!empty($address_data)){
			$address_book = $address_data;
		}
		
		$all_coupons = array();
		$get_coupons = $this->common_model->get_coupons($restaurant_id,$this->customer_id);
		if(!empty($get_coupons)){
			 
			
			foreach($get_coupons as $coupons){ 
				$coupon = coupon_check($coupons['coupon_code'], $cart_total,$this->customer_id,$restaurant_id);
				
				if(!empty($coupon) && $coupon == $coupons['coupon_code']){
					$all_coupons[] = $coupons;
				}
			}   
		} 
 
		$data['restaurant_details'] = $restaurant_details;
		$data['address_book']		= $address_book;
		$data['all_coupons']		= $all_coupons;
		$data['cart_items']			= $cart_items;
		$data['sub_total']			= $sub_total;
		$data['coupon_code']		= $coupon_code;
		$data['coupon_amount']		= $coupon_amount;
		$data['delivery_fees']		= 0;
		$data['cart_total']			= $cart_total;
		$data['delivery_charge']    = get_delivery_charge_by_restaurant_ID($restaurant_id);
		$data['view'] = 'cart/checkout';
		$this->load->view('layout',$data);
	}
	
	function process_order(){
		
		$user_id 		= $this->customer_id;
		$restaurant_id 	= $this->input->post('cart_restaurant_id');
		$address_id 	= $this->input->post('address_id');
		$checkout 		= $this->input->post('checkout');
		$payment_method = $this->input->post('payment_method');
		
		$admin_commission= admin_commission($restaurant_id);

		if(!empty($user_id) && !empty($restaurant_id) && !empty($address_id) && !empty($payment_method)){
			$customer_name = $this->common_model->get_field_by_id('online_customer','name',array('id'=>$user_id));
		
			$address_data['conditions'] = array('id'=>$address_id,'status'=>1);
			$address_data['returnType'] = 'single';
			$address = $this->common_model->getRows('address_book',$address_data);
			
			$shipping_address ='';
			$shipping_address .= $address['address_1'].", ";
			if(!empty($address['address_2'])){
				$shipping_address .= $address['address_2'];
			}
			if(!empty($address['country']) && $address['country']=='IN'){
				$shipping_country = "India";
			}else{
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
			$old_cart_data['fields'] 		= 'persistent_cart,total,complementary_food,coupon_code,coupon_amount,total_amount';
			$check_existing_cart 			= $this->common_model->getRows('cart',$old_cart_data);
			$delivery_charge = get_delivery_charge_by_restaurant_ID($restaurant_id);
			$cart_table_data = array();
			if(!empty($check_existing_cart[0])){
				$cart_table_data = unserialize($check_existing_cart[0]['persistent_cart']);
			}
			
			$cart_items = $cart_table_data;
			$cart_total = $check_existing_cart[0]['total'];
			$complementary_food ='';
			if(!empty($check_existing_cart[0]['complementary_food'])){
				$complementary_food = $check_existing_cart[0]['complementary_food'];
			}
			 
			$order_data['total_items'] 		= count($cart_items);
			$order_data['sub_total'] 		= $cart_total;
			$order_data['delivery_charge'] 	= $delivery_charge['delivery_charge'];
			
			$coupon_code 	= '';
			$coupon_amount 	= '';
			$total_amount 	= '';
			
			if(!empty($check_existing_cart[0]['coupon_code'])){
				$coupon_code 	= $check_existing_cart[0]['coupon_code'];
				$coupon_amount 	= $check_existing_cart[0]['coupon_amount'];
				$total_amount 	= $check_existing_cart[0]['total_amount'];
				
				$where_cond['conditions'] = array('coupon_code'=>$coupon_code,'status'=>1); 
				$check_existing_coupon 	= $this->common_model->getRows('site_coupons',$where_cond);
		  
				if(!empty($check_existing_coupon[0])){
					
					$order_data['coupon_code'] 		= $check_existing_coupon[0]['coupon_code'];
					$order_data['discount_type'] 	= $check_existing_coupon[0]['dis_type'];
					$order_data['discount_amount'] 	= $coupon_amount;
					$order_data['order_total'] 		= $total_amount;
					
					if($order_data['order_total'] > 0){
						$order_data['order_total'] = $order_data['order_total'];
					} else{
						$order_data['order_total'] = 0;
					}
					 
					 /* START get referral info */
					if($check_existing_cart[0]['coupon_code'] == 'REFERRAL100') {
						
						$query				= $this->db->get_where('referrals_data', array('user_id' => $user_id));
						$get_referral_code	= $query->row_array();
						  
						$earned_point = $get_referral_code['earn_point'] - 100 ;
						$update		  = $this->common_model->update_data('referrals_data',array('earn_point' => $earned_point), array('id' =>  $get_referral_code['id'])); 
						 
					} 
					/* END get referral info */ 
				}

			}else{
				$order_data['coupon_code'] 		= '';
				$order_data['discount_type'] 	= '';
				$order_data['discount_amount'] 	= '';
				$order_data['order_total'] 		= $cart_total;//+ 10; + 10;
				
				if($order_data['order_total'] > 0){
					$order_data['order_total'] = $order_data['order_total'] + $order_data['delivery_charge'];
				} else{
					$order_data['order_total'] = 0 + $order_data['delivery_charge'];
				}
			}
			
			$order_data['payment_method'] 		= $payment_method;
			$order_data['order_status'] 		= 'processing';
			$order_data['admin_commission'] 	= $admin_commission;
			
			$order_data['commission_amount'] 	= ($order_data['order_total'] * $admin_commission) /100;
			$order_data['grand_total'] 			= $order_data['order_total'] - $order_data['commission_amount'];
			$order_data['complementary_food'] 	= $complementary_food;
			$order_data['created_date'] 		= date('Y-m-d h:i:s');

			if($user_id == 114 || $user_id == 3 || $user_id == 4 || $user_id == 8 || $user_id == 14 || $user_id == 30 || $user_id == 80 || $user_id == 180){

				$order_data['test_order']  = 1;
				$order_place = $this->common_model->add_data('orders',$order_data);
			}else{
				
				$order_place = $this->common_model->add_data('orders',$order_data);	
			}
			
			

			$order_id = $this->db->insert_id();
			
			if($order_id){
				if($order_data['coupon_code']!=''){
					$coupon_cond['conditions'] = array('coupon_code'=>$order_data['coupon_code'],'status'=>1);
					$coupon_cond['returnType'] = 'single';
					$check_existing_coupon 	= $this->common_model->getRows('site_coupons',$coupon_cond);
					
					$get_usage_count 	= $check_existing_coupon ['get_usage_count'];
					$get_used_by 		= $check_existing_coupon ['get_used_by'];
					
					$new_get_usage_count = $get_usage_count + 1;
					if(!empty($get_used_by)){
						$new_get_used_by	 = $get_used_by.",".$user_id;
					}else{
						$new_get_used_by	 = $user_id;
					}
					
					$coupon_update['get_usage_count'] 	= $new_get_usage_count;
					$coupon_update['get_used_by'] 		= $new_get_used_by;
					
					$check_existing_coupon 	= $this->common_model->update_data('site_coupons',$coupon_update,array('coupon_code'=>$order_data['coupon_code']));
				}
				
				foreach($cart_items as $items){
					
					$order_items['order_id'] 		= $order_id;
					$order_items['restaurant_id'] 	= $items['restaurant_id'];
					$order_items['food_menu_id'] 	= $items['food_menu_id'];
					$order_items['menu_name'] 		= $items['menu_name'];
					$order_items['variation_id'] 	= $items['variation_id'];
					$order_items['variation_name'] 	= $items['variation_name'];
					$order_items['price'] 			= $items['price'];
					$order_items['qty'] 			= $items['qty'];
					$order_items['subtotal'] 		= $items['subtotal'];
					
					$order_place = $this->common_model->add_data('order_items',$order_items);
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
					
					if(!empty($order_data['shipping_phone']) && !empty($order_id)){
						$sms_message = 'Thank you for your order. Your Order ID is : #'.$order_id.'.';
						send_sms($order_data['shipping_phone'],$sms_message); //Commom Helper Function
					} 
					
					//redirect(base_url('checkout/order_received/'.$order_id));
					redirect(base_url('my_account/orders/view_order/'.$order_id));
					
				}elseif(strtolower($payment_method)=='instamojo'){
					 
						$this->common_model->update_data('orders',array('order_status'=>'pending'),array('id'=>$order_id));
						
						$delivery_charge = 0;
						if(!empty($order_data['delivery_charge'])){
							$delivery_charge = $order_data['delivery_charge'];
						}
						
						$order_total = $order_data['order_total'] + $delivery_charge;
							
						$paymet_data['order_id'] 	= $order_id;	
						$paymet_data['phone'] 	= $address['phone'];
						$paymet_data['email'] 	= $address['email'];
						$paymet_data['customer_name'] 	= $customer_name; 
						$paymet_data['order_total'] = $order_total;
						
						$this->load->view('instamojo/order_payment',$paymet_data);
					  
				}
				elseif(strtolower($payment_method)=='razorpay'){
					 
						$this->common_model->update_data('orders',array('order_status'=>'pending'),array('id'=>$order_id));
						
						$delivery_charge = 0;
						if(!empty($order_data['delivery_charge'])){
							$delivery_charge = $order_data['delivery_charge'];
						}
						
						$order_total = $order_data['order_total'] + $delivery_charge;
							
						$payment_data['order_id'] 	= $order_id;	
						$payment_data['phone'] 	= $address['phone'];
						$payment_data['email'] 	= $address['email'];
						$payment_data['customer_name'] 	= $customer_name; 
						$payment_data['order_total'] = $order_total;
						$payment_data['return_url'] = base_url().'razorpay/callback';
						$payment_data['surl'] = base_url().'razorpay/success';;
						$payment_data['furl'] = base_url().'razorpay/failed';;
						$payment_data['currency_code'] = 'INR';
						$this->load->view('razorpay/order_payment', $payment_data);  
				}
				else{
					
					/* if($order_data['order_total'] <= 0){
							redirect(base_url('my_account/orders/view_order/'.$order_id));
					}
					else{ */
						$this->common_model->update_data('orders',array('order_status'=>'pending'),array('id'=>$order_id));
						
						$delivery_charge = 0;
						if(!empty($order_data['delivery_charge'])){
							$delivery_charge = $order_data['delivery_charge'];
						}
						
						$order_total = $order_data['order_total'] + $delivery_charge;
							
						$paymet_data['order_id'] 	= $order_id;
						$paymet_data['user_id'] 	= $user_id;
						$paymet_data['order_total'] = $order_total;
						$this->load->view('cart/process_order',$paymet_data);
					//} 
					
				}
				
				
				
		
				/* $data['redirect_url'] =  base_url('my_account/orders/view_order/'.$order_id);
				$data['msg'] = "Order successfully placed.";
				$data['success'] = 1; */
				
				/* echo  json_encode($data) ;
				exit; */
			}
		}
	}
	 
	function order_received(){
		$order_id = $this->uri->segment(3);
		
		is_login();
		$user_id 	= $this->customer_id;
		
		$order_details = $this->order_model->order_details($order_id,$user_id);
		
		$order_data = array();
		if(!empty($order_details)){
			$order_data = $order_details;
		}	
		$data['order_data'] = $order_data;
		$data['view'] = 'order/order_received';
		$this->load->view('layout',$data);
	}
	
	function response(){
		
		$paytmChecksum = "";
		$paramList = array(); 
		$isValidChecksum = "FALSE";
		 
		$paramList = $_POST;
		
		$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg
		
		//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application’s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
		$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.

		if($isValidChecksum == "TRUE") {
			echo "<b>Checksum matched and following are the transaction details:</b>" . "<br/>";
			if ($_POST["STATUS"] == "TXN_SUCCESS") {
				echo "<b>Transaction status is success</b>" . "<br/>";
				$order_completed = $this->common_model->update_data('orders',array('order_status'=>'processing'),array('id'=>$_POST['ORDERID'])); 
				//echo $this->db->last_query();
					 
					if($order_completed){
						 
						$this->common_model->delete_data('cart',array('user_id'=>$this->customer_id));
					}
				
				//redirect(base_url('checkout/order_received/'.$_POST['ORDERID'])); 
				
				$this->load->helper('email');
				
				order_confirmation($_POST['ORDERID'],$this->customer_id); // Sent Email to Customer
				order_confirmation_admin($_POST['ORDERID'],$this->customer_id); // Send Email to admin and restaurant
				
				if(!empty($order_data['shipping_phone']) && !empty($_POST['ORDERID'])){
					$sms_message = 'Thank you for your order. Your Order ID is : #'.$_POST['ORDERID'].'.';
					send_sms($order_data['shipping_phone'],$sms_message); //Commom Helper Function
				} 
				
				redirect(base_url('my_account/orders/view_order/'.$_POST['ORDERID'])); 
				//Process your transaction here as success transaction.
				//Verify amount & order id received from Payment gateway with your application's order id and amount.
			}
			else {
				
				$order_completed = $this->common_model->update_data('orders',array('order_status'=>'processing'),array('id'=>$_POST['ORDERID'])); 
				//echo $this->db->last_query();
					 
					if($order_completed){
						 
						$this->common_model->delete_data('cart',array('user_id'=>$this->customer_id));
					}
				
				//redirect(base_url('checkout/order_received/'.$_POST['ORDERID'])); 
				
				$this->load->helper('email');
				
				order_failed_confirmation($_POST['ORDERID'],$this->customer_id); // Sent Email to Customer
				order_failed_confirmation_admin($_POST['ORDERID'],$this->customer_id); // Send Email to admin and restaurant
				
				if(!empty($order_data['shipping_phone']) && !empty($_POST['ORDERID'])){
					$sms_message = 'Order payment failed. Your Order ID is : #'.$_POST['ORDERID'].'.';
					send_sms($order_data['shipping_phone'],$sms_message); //Commom Helper Function
				} 
				
				redirect(base_url('my_account/orders/view_order/'.$_POST['ORDERID'])); 
				
				
				echo "<b>Transaction status is failure</b>" . "<br/>";
			}

		/* 	if (isset($_POST) && count($_POST)>0 )
			{ 
				foreach($_POST as $key=>$value) 
				{
					$fields_string .= $key.'='.$value.'&';
				}
					rtrim($fields_string, '&');
			}	 */
			 	
		}
		else {
			echo "<b>Checksum mismatched.</b>";
			//Process transaction as suspicious.
		}
	}
	
	function apply_coupon(){
		
		$user_id 		= $this->customer_id;
		
		$coupon_code 	= $this->input->post('coupon_code');
		$cart_total 	= $this->input->post('sub_total');
		$restaurant_id 	= $this->input->post('restaurant_id');

		$apply_coupon_response = apply_coupon($coupon_code,$cart_total,$user_id,$restaurant_id);
		
		return $apply_coupon_response;
	}
	
	
	function remove_coupon(){
		
		$user_id 		= $this->customer_id; 
		$cart_total 	= $this->input->post('sub_total');
		$delivery_fees 	= trim($this->input->post('delivery_fees'));
		$delivery_fees  = !empty($delivery_fees) ? $delivery_fees: 0;
		  
		$cart_data['coupon_code'] =  '';
		$cart_data['coupon_amount'] = '';
		$cart_data['total_amount'] = $cart_total + $delivery_fees; 
		$remove_coupon_response = $this->common_model->update_data('cart',$cart_data,array('user_id'=>$user_id));
		 
		if($remove_coupon_response){
			$data['total_amount'] = $cart_data['total_amount'];
			$data['msg'] = "Coupon code remove Successfully.";
			$data['success'] = 1;
		}
		else{
			$data['total_amount'] = '';
			$data['msg'] = "Something went wrong.";
			$data['success'] = 0;
		}
		echo  json_encode($data) ;
		exit;
	}
	function check_shipping_area(){
		
		$address_id 	  =  $this->input->post('address_id');
		$address_postcode = $this->common_model->get_field_by_id('address_book','postcode',array('id' => $address_id));
		$shippings_area	  = $this->common_model->get_field_by_id('shippings_area','zipcode',array('zipcode' => $address_postcode));
		$message = 0;
		if(empty($shippings_area) ){  
			$message = 1; 
		} 
		echo $message ;
	}
}