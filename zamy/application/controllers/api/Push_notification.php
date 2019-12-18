<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

// Load the Rest Controller library
require APPPATH . '/libraries/REST_Controller.php';

class Push_notification extends REST_Controller {

    public function __construct() {
        parent::__construct();
        
        // Load the user model 
		$this->load->model('common_model'); 
	 
    }
   
	public function customer_push_notification_post(){
		 
		$case  		 = $this->input->post('case');
		$device_type = $this->input->post('device_type');
		$fire_token  = $this->input->post('fire_token');
		$notification_type	= $this->input->post('notification_type');
		$order_id  	 = $this->input->post('order_id');
		$message  	 = $this->input->post('message');
		
		/*case = 1 for Customer and Case = 2 for Delivery Boy*/
		
		switch ($case) {
			case "2":
			// case 2 for IOS
				define( 'API_ACCESS_KEY', 'AAAAa02IxTk:APA91bFpr-r82VOuO96_GFGerDKmMeAEfyYdwHKlI2TmQ0NtZrMN9EMMHvR62SY9TPjCiOtad13oiFydrnqvNRFHGYkUCz0W51ttnc9ceAAfCLT_LbSqr4K4q5giK0IIiadqQkud1IgEDfrHS_Wa5O-bf3RVk247uw' );
			break;
			case "1":
			// case 1 for Android
				define( 'API_ACCESS_KEY', 'AAAAKChcgCM:APA91bHHITvyb60P-ZXoDbSOJBek6_HKw9Ah6eJGo1JDZqgYITHKiF1mB5uQ1pCGyrXxnzCbWpjqpokuK9Tl93X4x-jfBiWKb_YRc_37MBjpSx_Lpi8YHfC4RjPWj9WIYCIwwMvnhyG1' );
			break;
			default:
			// default for Android
				define( 'API_ACCESS_KEY', 'AAAAKChcgCM:APA91bHHITvyb60P-ZXoDbSOJBek6_HKw9Ah6eJGo1JDZqgYITHKiF1mB5uQ1pCGyrXxnzCbWpjqpokuK9Tl93X4x-jfBiWKb_YRc_37MBjpSx_Lpi8YHfC4RjPWj9WIYCIwwMvnhyG1' );
		}
		
		$registrationIds = $fire_token;	 
		//new order received  for Delivery boy
		$data_forIos = array();
		if($notification_type=='1')
		{
			$msg = array
			(
			  "title"=> "Order Received #".$order_id,
			  "body"=> "New order received",
			  "message"=> "New order received",
			  "notification_type"=> $notification_type,
			  "order_id"=> $order_id, 
			  "sound" => "default"
			);

			$data_forIos = array(
			  "notification_type"=> $notification_type,
			  "order_id"=> $order_id, 
			);
		} 
		
		//order cancelled role for Delivery boy
		if($notification_type=='2')
		{
			$msg = array
			(
			  "title"=> "Order cancelled #".$order_id,
			  "body"=> "Order has been cancelled",
			  "message"=> "Order has been cancelled",
			  "notification_type"=> $notification_type,
			  "order_id"=> $order_id, 
			  "sound" => "default"
			);
			$data_forIos = array(
				"notification_type"=> $notification_type,
			  "order_id"=> $order_id,
			  "sub_order_id"=> $subID
			  );
		}
	  
		//Order placed successfully  for Customer
		/*if($notification_type=='3')
		{
			$msg = array
			(
			  "title"=> "Thanks for ordering #".$order_id,
			  "body"=>"You order is placed successfully and being prepared",
			  "message"=> "You order is placed successfully and being prepared",
			  "notification_type"=> $notification_type,
			  "order_id"=> $order_id, 
			  "sound" => "default"
			);
			$data_forIos = array(
				"notification_type"=> $notification_type,
			  "order_id"=> $order_id, 
			  ); 
		}*/
		//Order delivered  for Customer
		if($notification_type=='5')
		{
			$msg = array
			(
			  "title"=> "Order delivered #".$order_id,
			  "body"=> "You order is delivered successfully. Enjoy your meal",
			  "message"=> "You order is delivered successfully. Enjoy your meal",
			  "notification_type"=> $notification_type,
			  "order_id"=> $order_id, 
			  "sound" => "default"
			);
			$data_forIos = array(
				"notification_type"=> $notification_type,
			    "order_id"=> $order_id,
			);
		} 
	
		//Ticket reply  for Customer
		if($notification_type=='6')
		{
			$msg = array
			(
			  "title"=> "Ticket #".$order_id,
			  "body"=> $message,
			  "message"=> $message,
			  "notification_type"=> $notification_type,
			  "ticket_id"=> $order_id,
			  "sound" => "default"
			);
			$data_forIos = array(
				"notification_type"=> $notification_type,
			  "ticket_id"=> $order_id);
		}
		
		//Ticket Status changed  for Customer
		if($notification_type=='7')
		{
			$msg = array
			(
			  "title"=> "Ticket #".$order_id,
			  "body"=> $message,
			  "message"=> $message,
			  "notification_type"=> $notification_type,
			  "ticket_id"=> $order_id,
			  "sound" => "default"
			);
			$data_forIos = array(
				"notification_type"=> $notification_type,
			  "ticket_id"=> $order_id);
		}
		
		if($notification_type=='9')
		{
			$msg = array
			(
			  "title"=> "Order out for delivered #".$order_id,
			  "body"=> "You order is out for delivery",
			  "message"=> "You order is out for delivery",
			  "notification_type"=> $notification_type,
			  "order_id"=> $order_id, 
			  "sound" => "default"
			);
			$data_forIos = array("notification_type"=> $notification_type,
			  "order_id"=> $order_id, 
			);
		}
		 
		$path = '';
		
		 
		if($device_type == 'a'){
			$path = 'https://fcm.googleapis.com/fcm/send ';
			$fields = array
			(
				'to' 	=> $registrationIds,
				"data"  => $msg 
			);
		} else {
			$path = 'https://fcm.googleapis.com/fcm/send';
			$fields = array
			(
				'to' 		=> $registrationIds,
				'priority' => 'high',
				"notification"=>$msg,
				"data"	=> $data_forIos 
			);	
		}
			
		$headers = array
		( 
			'Authorization: key=' . API_ACCESS_KEY,
			'Content-Type: application/json'
		);
		
		$ch = curl_init(); 
		curl_setopt( $ch,CURLOPT_URL, $path); 
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
		// echo json_encode( $fields );
		$result = curl_exec( $ch );
		curl_close( $ch );	
		 
		$customer_data['conditions'] = array('fire_token'=>$fire_token);
		$customer_data['fields'] 	 = 'id,phone';
		$customer_data['returnType'] = 'single';
		$userRow 					 = $this->common_model->getRows('online_customer',$customer_data); 
		
		if($userRow){
			$mobile= $userRow['phone'];
			if($case == '2'){
				$mobile= $userRow['phone'];
			} else {
				if($notification_type != '6' && $notification_type != '7'){
					$mobile = $userRow['phone'];
				} else {
					$order_data['conditions'] 	= array('id'=>$order_id);
					$order_data['fields'] 		= 'shipping_phone';
					$order_data['returnType'] 	= 'single';
					$mobileRow = $this->common_model->getRows("orders",$order_data);
					if($mobileRow){
						$mobile = $mobileRow['shipping_phone'];
					} else {
						$mobile= $userRow['phone'];
					}
				}
				
			}
			  
			send_sms($mobile,$message); //Commom Helper Function
		}
		
		if(!empty($result)){
			
			$this->response([
                    'status' => 1,
                    'message' => '',
                    'data' => $result
                ], REST_Controller::HTTP_OK); 
		} 
	}
}