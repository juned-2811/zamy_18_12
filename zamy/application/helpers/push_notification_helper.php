<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
function push_notification($order_id,$user_id,$notification_type){
	 // $case = 1 delivery boy notification
	$CI =& get_instance();
	
	if($notification_type == 1){
		$message = 'Thank you for your order. Your Order ID is : #'.$order_id.'.';
	}else if($notification_type == 2){
		$message = 'Order payment failed Your Order ID is : #'.$order_id.'.';
	}else if($notification_type == 3){
		$message = 'You order #'.$order_id.' is delivered successfully. Enjoy your meal.';
	}else if($notification_type == 4){
		$message = 'You ticket is created.Your Ticket ID is : #'.$order_id;
	}else if($notification_type == 6){
		$message = 'You order #'.$order_id.' is out for delivery';
	}
	
	$data['conditions'] 	= array('id'=>$user_id);
	$data['fields'] 		= 'device_type,fire_token';
	$data['returnType'] 	= 'single'; 
	$user_data				= $CI->common_model->getRows('online_customer',$data);
		 
	customer_push_notification_post($user_data['device_type'],$user_data['fire_token'],$notification_type,$order_id,$message);
}

function customer_push_notification_post($device_type,$fire_token,$notification_type,$order_id,$message){
	
	$CI =& get_instance();	 
	
	// default for Android
	define( 'API_ACCESS_KEY', 'AAAAKChcgCM:APA91bHHITvyb60P-ZXoDbSOJBek6_HKw9Ah6eJGo1JDZqgYITHKiF1mB5uQ1pCGyrXxnzCbWpjqpokuK9Tl93X4x-jfBiWKb_YRc_37MBjpSx_Lpi8YHfC4RjPWj9WIYCIwwMvnhyG1' );
	
	
	$registrationIds = $fire_token;	 
	//new order received  for Delivery boy
	$data_forIos = array();
		  
 
	//Order placed successfully  for Customer
	if($notification_type=='1')
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
	}
	//Order Failed
	if($notification_type=='2')
	{
		$msg = array
		(
		  "title"=> "Order payment failed#".$order_id,
		  "body"=>"Your order payment failed",
		  "message"=> "Your order payment failed",
		  "notification_type"=> $notification_type,
		  "order_id"=> $order_id, 
		  "sound" => "default"
		);
		$data_forIos = array(
			"notification_type"=> $notification_type,
		  "order_id"=> $order_id, 
		  ); 
	}
	 
	//Order delivered  for Customer
	if($notification_type=='3')
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
	 
	if($notification_type=='6')
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
	$userRow 					 = $CI->common_model->getRows('online_customer',$customer_data); 
	 
	if($userRow){
		 
			$order_data['conditions'] 	= array('id'=>$order_id);
			$order_data['fields'] 		= 'shipping_phone';
			$order_data['returnType'] 	= 'single';
			$mobileRow = $CI->common_model->getRows("orders",$order_data);
			if($mobileRow){
				$mobile = $mobileRow['shipping_phone'];
			} else {
				$mobile= $userRow['phone'];
			}
		 
	}  
	
	send_sms($mobile,$message); //Commom Helper Function
	  
}