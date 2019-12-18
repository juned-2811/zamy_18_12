<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Razorpay extends CI_Controller {
    public function __construct() {
        parent::__construct();
 
		$this->load->helper('email'); 
		$this->load->helper('push_notification');
	//===================================================
    }
  // checkout page
    public function checkout() {
        $data['title'] = 'Checkout payment | Zamy';  
        //$this->site->setProductID($id);
       // $data['itemInfo'] = $this->site->getProductDetails(); 
        $data['return_url'] = base_url().'razorpay/callback';
        $data['surl'] = base_url().'razorpay/success';;
        $data['furl'] = base_url().'razorpay/failed';;
        $data['currency_code'] = 'INR';
        $this->load->view('razorpay/checkout', $data);
    }
 
    // initialized cURL Request
    private function get_curl_handle($payment_id, $amount)  {
        $url = 'https://api.razorpay.com/v1/payments/'.$payment_id.'/capture';
        $key_id = RAZOR_KEY_ID;
        $key_secret = RAZOR_KEY_SECRET;
        $fields_string = "amount=$amount";
        //cURL Request
        $ch = curl_init();
        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERPWD, $key_id.':'.$key_secret);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__).'/ca-bundle.crt');
        return $ch;
    }   
        
    // callback method
    public function callback() {        
        if (!empty($this->input->post('razorpay_payment_id')) && !empty($this->input->post('merchant_order_id'))) {
            $razorpay_payment_id = $this->input->post('razorpay_payment_id');
            $merchant_order_id = $this->input->post('merchant_order_id');
            $currency_code = 'INR';
            $amount = $this->input->post('merchant_total');
            $success = false;
            $error = '';
            try {                
                $ch = $this->get_curl_handle($razorpay_payment_id, $amount);
                //execute post
                $result = curl_exec($ch);
                $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                if ($result === false) {
                    $success = false;
                    $error = 'Curl error: '.curl_error($ch);
                } else {
                    $response_array = json_decode($result, true);
                   // echo "<pre>";print_r($response_array);exit;
                        //Check success response
                        if ($http_status === 200 and isset($response_array['error']) === false) {
                            $success = true;
                        } else {
                            $success = false;
                            if (!empty($response_array['error']['code'])) {
                                $error = $response_array['error']['code'].':'.$response_array['error']['description'];
                            } else {
                                $error = 'RAZORPAY_ERROR:Invalid Response <br/>'.$result;
                            }
                        }
                }
                //close connection
                curl_close($ch);
            } catch (Exception $e) {
                $success = false;
                $error = 'OPENCART_ERROR:Request to Razorpay Failed';
            }
		 
            if ($success === true) {
                if(!empty($this->session->userdata('ci_subscription_keys'))) {
                    $this->session->unset_userdata('ci_subscription_keys');
                 }
                if (!$order_info['order_status_id']) {
					
					$order_id = $this->input->post('merchant_order_id');
					$phone = $this->input->post('merchant_phone');
				  
					$user_id = $this->common_model->get_field_by_id('orders','user_id',array('id'=>$order_id));	
						
					order_confirmation($order_id,$user_id); // Sent Email to Customer
					order_confirmation_admin($order_id,$user_id); // Send Email to admin and restaurant
					
					if(!empty($phone) && !empty($order_id)){
						$sms_message = 'Thank you for your order. Your Order ID is : #'.$order_id.'.';
						send_sms($phone ,$sms_message); //Commom Helper Function
					}
				   
					redirect(base_url('my_account/orders/view_order/'.$order_id ));
				
                  //  redirect($this->input->post('merchant_surl_id'));
                } else {
                    redirect($this->input->post('merchant_surl_id'));
                } 
            } else { 
				
                $order_id = $this->input->post('merchant_order_id');
                $phone = $this->input->post('merchant_phone');
			  
				$user_id = $this->common_model->get_field_by_id('orders','user_id',array('id'=>$order_id));	
				order_failed_confirmation($order_id,$user_id); // Sent Email to Customer
				order_failed_confirmation_admin($order_id,$user_id); // Send Email to admin and restaurant
				if(!empty($phone ) && !empty($order_id)){
					$sms_message = 'Order payment failed Your Order ID is : #'.$order_id.'.';
					send_sms($phone ,$sms_message); //Commom Helper Function
				} 
			   
				redirect(base_url('my_account/orders/view_order/'.$order_id ));
					 
                //redirect($this->input->post('merchant_furl_id'));
            }
        } else {
            echo 'An error occured. Contact site administrator, please!';
        }
    } 
	
    public function success() {
        $data['title'] = 'Razorpay Success | Zamy';  
        $this->load->view('razorpay/success', $data);
    }  
	
    public function failed() {
	 
        $data['title'] = 'Razorpay Failed | Zamy';            
        $this->load->view('razorpay/failed', $data);
    }  
	
	public function razorPaySuccess()
    { 
     $data = [
               'user_id' => '1',
               'payment_id' => $this->input->post('razorpay_payment_id'),
               'amount' => $this->input->post('totalAmount'),
               'product_id' => $this->input->post('product_id'),
            ];
     //$insert = $this->db->insert('payments', $data);
     $arr = array('msg' => 'Payment successfully credited', 'status' => true);  
    }
    public function RazorThankYou()
    {
     $this->load->view('razorthankyou');
    }
	
	public function map_check() {
        
        $this->load->view('razorpay/map');
    }
		
	public function storelocator() {
        
        $lat = $_GET['lat'];
        $lng = $_GET['lng'];
        $radius = $_GET['radius'];
		$query = "SELECT id,full_name,latitude,longitude, ( 3959 * acos( cos( radians('$radius') ) * cos( radians( $lat ) ) * cos( radians( $lng ) - radians('$radius') ) + sin( radians('$radius') ) * sin( radians( $lat ) ) ) ) AS distance FROM delivery_boy HAVING distance < '$radius' ORDER BY distance LIMIT 0 , 20";
		 
		//echo $query;
		
		// Search the rows in the markers table
		/* $query = sprintf("SELECT id,latitude,longitude, ( 3959 * acos( cos( radians('%s') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('%s') ) + sin( radians('%s') ) * sin( radians( latitude ) ) ) ) AS distance FROM markers HAVING distance < '%s' ORDER BY distance LIMIT 0 , 20",
		  mysqli_real_escape_string($lat),
		  mysqli_real_escape_string($lng),
		  mysqli_real_escape_string($lat),
		  mysqli_real_escape_string($radius));
		$result = mysql_query($query);
		$result = mysql_query($query); */
		echo $query;
		
    }
}