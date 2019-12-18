<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('common_model');
		$this->load->model('order_model');
		$this->customer_id 	= $this->session->userdata('cust_id');
	}
	
	public function index(){
		
		is_login();
		
		$user_id = $this->customer_id;
		
		$all_orders = $this->order_model->my_orders($user_id);
	
		$my_orders = array();
		if(!empty($all_orders)){
			$my_orders = $all_orders;
		}
		$data['my_orders'] = $my_orders;
		$data['sidebar']		= 'my_account/sidebar';
		$data['page'] 			= 'order/my_orders';
		$data['view'] 			= 'my_account/index';
		$this->load->view('layout',$data);
	}
	
	public function view_order($order_id){
		is_login();
		$user_id 	= $this->customer_id;
		
		$order_details = $this->order_model->order_details($order_id,$user_id);
		
		$order_data = array();
		if(!empty($order_details)){
			$order_data = $order_details;
		}

		$data['rating_info'] = array('user_id'=>$this->customer_id,'order_id'=>$order_id);	
		$data['order_data'] = $order_data;
		
		$data['view'] = 'order/order_details';
		$data['customer_id'] = $user_id;
		$this->load->view('layout',$data);
	}
	
	public function create_ticket(){
		
		$user_id 		= $this->customer_id;
		
		$order_id 		= $this->input->post('order_id');
		$sub_order_id 	= $this->input->post('sub_order_id');
		$ticketTitle 	= $this->input->post('ticketTitle');
		$description 	= $this->input->post('description');
		$subject 		= $this->input->post('subject');
		
		
		$check_ticket = $this->common_model->get_field_by_id('customer_support','ticketID',array('order_id'=>$order_id));
		
		if(count($check_ticket)>0){
			echo "Ticket already exist for order_id : $order_id";
		}else{
			
		}
	}

	public function save_ratings(){

		$user_id 		= $this->input->post('user_id');
		$order_id 		= $this->input->post('order_id');
		$rating 		= $this->input->post('rating');
		$comment 		= $this->input->post('comment');
		$food_menu_id 	= $this->input->post('food_menu_id');
		$restaurant_id 	= $this->input->post('restaurant_id');
		
		$get_rating 	= get_rating_status($order_id,$food_menu_id);
		if(empty($get_rating)){
			
			$data['user_id'] 		=  $user_id;
			$data['order_id'] 		=  $order_id;
			$data['rating'] 		=  $rating;
			
			if(!empty($comment)){
				$data['comment'] 	=  $comment;
			}else{
				$data['comment'] 	=  '';
			}
			
			$data['food_menu_id'] 	=  $food_menu_id;
			$data['restaurant_id'] 	=  $restaurant_id;
			$result = $this->common_model->add_data('order_rating',$data);
			
			$msg = '';
			if ($result) {
				$msg = "Rating Saved successfully";
			} else {
				$msg = "ERROR!";
			}
		}else{
			$msg = 'Rating already submited';
		}
		echo $msg;
	}
	public function save_customer_ticket(){

		$ticketChatID = $this->input->post('ticketChatID');
		$ticketSenderID = $this->input->post('ticketSenderID');
		$ticketReceiverID = $this->input->post('ticketReceiverID');
		$order_id = $this->input->post('order_id');
		$ticketTitle = $this->input->post('ticketTitle');
		$subject = $this->input->post('subject');
		$ticketBody = $this->input->post('ticketBody');
		$ticketstatus = 'open';

		$check_ticket = $this->common_model->get_field_by_id('customer_support','ticketID',array('order_id'=>$order_id));
		$msg = '';
		if(count($check_ticket)>0){
			$msg .= "Ticket already exist for order_id : $order_id";
		}else{
					$data = array('ticketChatID'=>$ticketChatID,
			          'ticketSenderID'=>$ticketSenderID,
			          'ticketReceiverID'=>$ticketReceiverID,
			          'order_id'=>$order_id,
			          'ticketTitle'=>$ticketTitle,
			          'subject'=>$subject,
			          'ticketBody'=>$ticketBody,
			          'status'=>1,
			          'ticketstatus'=>$ticketstatus);
		               $result = $this->common_model->add_data('customer_support',$data);
		               
		               if ($result) {
		               	$msg .= "Your Review Ticket Saved successfully";
		               } else {
		               	$msg .= "ERROR!";
		               }
		    }
 
		echo $msg;
        
	}
	
	function get_delivery_boy_latlong(){
		
	}
}

?>