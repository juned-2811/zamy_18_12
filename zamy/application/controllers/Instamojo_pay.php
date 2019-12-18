<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Instamojo_pay extends CI_Controller {
	
	
	
    public function __construct() {
        parent::__construct();
       $params = array('api_key' => '5ca7197f1ae34b273019d88eb452a27a', 'auth_token' => "3bd2eb5e01e8a29871706bced24b1d80", 'endpoint' => 'https://www.instamojo.com/api/1.1/');
		 
		$this->load->library('instamojo', $params); 
  		$this->load->helper('email');
		$this->load->helper('push_notification');
			//===================================================
    }
    public function pay()
    { 
		$purpose = "ZAMY Order #".$_POST["order_id"]." Payment";
		$amount = $_POST["amount"];
		$name  = $_POST["name"];
		$phone = $_POST["phone"];
		$email = $_POST["email"];
		$order_id = $_POST["order_id"];
	    
		try {
			$response = $this->instamojo->paymentRequestCreate(array(
				"purpose" => $purpose, 
				"amount" => $amount,
				"buyer_name" => $name,
				"phone" => $phone,
				"email" => $email,
				"send_email" => false,
				"send_sms" => false,
				'allow_repeated_payments' => false,
				"redirect_url" => base_url('instamojo_pay/thankyou/').$order_id,
				"webhook" => base_url('instamojo_pay/webhook') 
				));
				 
		   $pay_ulr = $response['longurl'];
			header("Location: $pay_ulr");
			exit();
		}
		catch (Exception $e) {
			 
			print('Error: ' . $e->getMessage());
		}
    }
	
	public function thankyou()
    {  
		$order_id = '';
		  
		$payid = $_GET["payment_request_id"];  
		try {
			$response = $this->instamojo->paymentRequestStatus($payid);
		
			$redirect_url = $response['redirect_url'];
			$order_id = explode('/',$redirect_url);
			$order_id = end($order_id);
		 
			$user_id = $this->common_model->get_field_by_id('orders','user_id',array('id'=>$order_id));		
			order_confirmation($order_id,$user_id); // Sent Email to Customer
			order_confirmation_admin($order_id,$user_id); // Send Email to admin and restaurant
			
			if(!empty($response['payments'][0]['buyer_phone'] ) && !empty($order_id)){
				$sms_message = 'Thank you for your order. Your Order ID is : #'.$order_id.'.';
				send_sms($response['payments'][0]['buyer_phone'] ,$sms_message); //Commom Helper Function
			} 
		   
			redirect(base_url('my_account/orders/view_order/'.$order_id ));
			
			/*echo "<h4>Payment ID: " . $response['payments'][0]['payment_id'] . "</h4>" ;
			echo "<h4>Payment Name: " . $response['payments'][0]['buyer_name'] . "</h4>" ;
			echo "<h4>Payment Email: " . $response['payments'][0]['buyer_email'] . "</h4>" ;
			echo "<pre>";
			print_r($response);
			echo "</pre>"; */
		}
		catch (Exception $e) { 
			print('Error: ' . $e->getMessage());
		} 
    }
	
	public function webhook()
    {
		$data = $_POST;
		$mac_provided = $data['mac'];  /* Get the MAC from the POST data*/
		unset($data['mac']);  /* Remove the MAC key from the data. */
		$ver = explode('.', phpversion());
		$major = (int) $ver[0];
		$minor = (int) $ver[1];
		if($major >= 5 and $minor >= 4){
			 ksort($data, SORT_STRING | SORT_FLAG_CASE);
		}
		else{
			 uksort($data, 'strcasecmp');
		}
		/* You can get the 'salt' from Instamojo's developers page(make sure to log in first): https://www.instamojo.com/developers*/
		/* Pass the 'salt' without the <>.*/
		$mac_calculated = hash_hmac("sha1", implode("|", $data), "c47c55bd40974c5fbdf1f98ede35fa93");

		if($mac_provided == $mac_calculated){
		   
			if($data['status'] == "Credit"){
			   /* Payment was successful, mark it as completed in your database  */
						
						$to = 'YOUR_EMAIL_ADDRESS';
						$subject = 'Website Payment Request ' .$data['buyer_name'].'';
						$message = "<h1>Payment Details</h1>";
						$message .= "<hr>";
						$message .= '<p><b>ID:</b> '.$data['payment_id'].'</p>';
						$message .= '<p><b>Amount:</b> '.$data['amount'].'</p>';
						$message .= "<hr>";
						$message .= '<p><b>Name:</b> '.$data['buyer_name'].'</p>';
						$message .= '<p><b>Email:</b> '.$data['email'].'</p>';
						$message .= '<p><b>Phone:</b> '.$data['phone'].'</p>';
						$message .= "<hr>";
						$headers .= "MIME-Version: 1.0\r\n";
						$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
						/* send email*/
						mail($to, $subject, $message, $headers);
				}
			else{
			   /* Payment was unsuccessful, mark it as failed in your database*/
			}
		}
		else{
			echo "Invalid MAC passed";
		}
    }
	
	 public function pay_api()
    { 
		$purpose = "ZAMY Order #".$_GET["order_id"]." Payment";
		$amount = $_GET["amount"];
		$name  = $_GET["name"];
		$phone = $_GET["phone"];
		$email = $_GET["email"];
		$order_id = $_GET["order_id"];
	    
		try {
			$response = $this->instamojo->paymentRequestCreate(array(
				"purpose" => $purpose, 
				"amount" => $amount,
				"buyer_name" => $name,
				"phone" => $phone,
				"email" => $email,
				"send_email" => false,
				"send_sms" => false,
				'allow_repeated_payments' => false,
				"redirect_url" => base_url('instamojo_pay/thankyou_api/').$order_id,
				"webhook" => base_url('instamojo_pay/webhook') 
				));
				 
		   $pay_ulr = $response['longurl'];
			header("Location: $pay_ulr");
			exit();
		}
		catch (Exception $e) {
			 
			print('Error: ' . $e->getMessage());
		}
    }
	public function thankyou_api()
    {
		$order_id = '';
		  
		$payid = $_GET["payment_request_id"];  
		try {
			$response = $this->instamojo->paymentRequestStatus($payid);
			 
			if($response['payments'][0]['status'] == 'Failed'){
				$redirect_url = $response['redirect_url'];
				$order_id = explode('/',$redirect_url);
				$order_id = end($order_id); 
				$user_id = $this->common_model->get_field_by_id('orders','user_id',array('id'=>$order_id));
				/* Push notification */
						
					//Order Failed for Customer 
					$notification_type='2';  
					push_notification($order_id,$user_id,$notification_type);
					redirect(base_url().'intamojo_pay/check_paytm_response?status=failure');	 
				/* Push notification */
			}
			else{
				 
				$redirect_url = $response['redirect_url'];
				$order_id = explode('/',$redirect_url);
				$order_id = end($order_id); 
				$user_id = $this->common_model->get_field_by_id('orders','user_id',array('id'=>$order_id));
				  	
				order_confirmation($order_id,$user_id); // Sent Email to Customer
				order_confirmation_admin($order_id,$user_id); // Send Email to admin and restaurant
				
				/* Push notification */
						
					//Order placed successfully  for Customer 
					$notification_type='1';  
					push_notification($order_id,$user_id,$notification_type);
						 
				/* Push notification */
						 
				redirect(base_url('intamojo_pay/check_response?status=success')); 
			} 
		}
		catch (Exception $e) { 
			print('Error: ' . $e->getMessage());
			  
			redirect(base_url().'intamojo_pay/check_paytm_response?status=failure');
			 
		} 
    } 
}