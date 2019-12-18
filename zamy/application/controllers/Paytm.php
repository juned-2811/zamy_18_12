<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Paytm extends CI_Controller {
    public function __construct() {
        parent::__construct();
        @session_start();
        //===================================================
        // Loads Paytm Authorized Files
        //===================================================
	header("Pragma: no-cache");
	header("Cache-Control: no-cache");
	header("Expires: 0");  
         $this->load->helper('paytm');
		 $this->load->helper('email');
        $this->load->model('api/Api_model','api_model');
		$this->load->helper('push_notification');
	//===================================================
    }
    public function index()
    {
		
    }
    public function payby_paytm()
    {
    	 
		 $posted = $_GET;
		
		$paytmParams = array();
		$paytmParams['ORDER_ID'] 		= $posted['ORDER_ID'];
		$paytmParams['TXN_AMOUNT'] 		= $posted['TXN_AMOUNT'];
		$paytmParams["CUST_ID"] 		= $posted['CUST_ID'];
		 
		$paytmParams["MID"] 			= PAYTM_MERCHANT_MID;
		$paytmParams["CHANNEL_ID"] 		= 'WEB';
		$paytmParams["WEBSITE"] 		= PAYTM_MERCHANT_WEBSITE;
		$paytmParams["CALLBACK_URL"] 	= base_url('paytm/paytm_response');
		$paytmParams["INDUSTRY_TYPE_ID"]= 'Retail';
	
		$paytmChecksum =  getChecksumFromArray($paytmParams, PAYTM_MERCHANT_KEY);
		$paytmParams["CHECKSUMHASH"] = $paytmChecksum;
		
		$transactionURL = PAYTM_TXN_URL;
		// p($posted);
		// p($paytmParams,1);
		$data = array();
		$data['paytmParams'] 	= $paytmParams;
		$data['transactionURL'] = $transactionURL;
    		
    		$this->load->view('paytm/payby_paytm', $data);
    	
    }
    public function paytm_response(){
		
    	$paytmChecksum 	= "";
		$paramList 		= array();
		$isValidChecksum= "FALSE";
		$paramList = $_POST;
		$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg
		header("Pragma: no-cache");
		header("Cache-Control: no-cache");
		header("Expires: 0");
		//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application’s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
		$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.
		if($isValidChecksum == "TRUE") {
			$order = $this->api_model->get_order($_POST['ORDERID']);
			if ($_POST["STATUS"] == "TXN_SUCCESS") {
				
				
				if($order['order_status'] !=='completed'){
					
					if($order['order_status'] == 'pending'){

						$order_completed = $this->common_model->update_data('orders',array('order_status'=>'processing'),array('id'=>$_POST['ORDERID'])); 
					
						if($order_completed){
							 
							$this->common_model->delete_data('cart',array('user_id'=>$order['customer_id']));
						} 
					}
				}
				
				order_confirmation($_POST['ORDERID'],$order['customer_id']); // Sent Email to Customer
				order_confirmation_admin($_POST['ORDERID'],$order['customer_id']); // Send Email to admin and restaurant
			
				/* Push notification */
						
					//Order placed successfully  for Customer 
					$notification_type='1';  
					push_notification($_POST['ORDERID'],$order['customer_id'],$notification_type);
						 
				/* Push notification */
						
				/*if(!empty($order['shipping_phone']) && !empty($order_id)){
					$sms_message = 'Thank you for your order. Your Order ID is : #'.$order_id.'.';
					send_sms($order['shipping_phone'],$sms_message); //Commom Helper Function
				} */
				
				redirect(base_url('paytm/check_paytm_response?status=success')); 
			}
			else {
				$order_failed = $this->common_model->update_data('orders',array('order_status'=>'failed'),array('id'=>$_POST['ORDERID'])); 
				
				/* Push notification */
						
					//Order Failed for Customer 
					$notification_type='2';  
					push_notification($_POST['ORDERID'],$order['customer_id'],$notification_type);
						 
				/* Push notification */
				redirect(base_url().'paytm/check_paytm_response?status=failure');
			} 
		} 
		else {
		 
			redirect(base_url().'paytm/check_paytm_response?status=ChecksumMismatched');//Process transaction as suspicious.
		}
    } 
}

?>